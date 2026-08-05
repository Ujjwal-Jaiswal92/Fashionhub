<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Register User
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Invalid Request");
        }

        $full_name = trim($_POST['full_name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address'] ?? '');
        $role = $_POST['role'];

        // Validation
        if (
            empty($full_name) ||
            empty($email) ||
            empty($password) ||
            empty($confirm_password) ||
            empty($role)
        ) {
            die("Please fill all required fields.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email address.");
        }

        if ($password !== $confirm_password) {
            die("Passwords do not match.");
        }

        if (strlen($password) < 6) {
            die("Password must be at least 6 characters.");
        }

        // Check Email
        if ($this->user->findByEmail($email)) { header('Location: ../../frontend/pages/register.php?error=email'); exit(); }

        $data = [
            'full_name' => $full_name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'address' => $address,
            'role' => $role
        ];

        $userId = $this->user->register($data);
        if ($userId) {
            $token = bin2hex(random_bytes(32));
            $db = (new Database())->connect();
            $db->prepare('INSERT INTO email_verifications (user_id, token_hash, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 24 HOUR))')->execute([$userId, hash('sha256', $token)]);
            $link = 'http://localhost/FashionHub/backend/api/auth.php?action=verify-email&token=' . $token;
            @mail($email, 'Verify your FashionHub account', "Open this link to verify your email: {$link}");
            header('Location: ../../frontend/pages/login.php?notice=registered'); exit();
        }
        header('Location: ../../frontend/pages/register.php?error=registration'); exit();
    }

    public function verifyEmail()
    {
        $token = $_GET['token'] ?? '';
        $db = (new Database())->connect();
        $stmt = $db->prepare('SELECT user_id FROM email_verifications WHERE token_hash = ? AND verified_at IS NULL AND expires_at > NOW() LIMIT 1');
        $stmt->execute([hash('sha256', $token)]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) { header('Location: ../../frontend/pages/login.php?error=verification'); exit(); }
        $db->prepare('UPDATE email_verifications SET verified_at = NOW() WHERE token_hash = ?')->execute([hash('sha256', $token)]);
        $db->prepare("UPDATE users SET status = 'Approved' WHERE user_id = ?")->execute([$row['user_id']]);
        header('Location: ../../frontend/pages/login.php?notice=verified');
        exit();
    }

    public function requestPasswordReset()
    {
        $email = trim($_POST['email'] ?? '');
        $user = $this->user->findByEmail($email);
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $db = (new Database())->connect();
            $db->prepare('INSERT INTO password_resets (user_id, token_hash, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))')->execute([$user['user_id'], hash('sha256', $token)]);
            $link = 'http://localhost/FashionHub/frontend/pages/reset-password.php?token=' . $token;
            @mail($email, 'Reset your FashionHub password', "Open this link to reset your password: {$link}");
        }
        header('Location: ../../frontend/pages/login.php?notice=reset'); exit();
    }

    public function resetPassword()
    {
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        if (strlen($password) < 6 || $password !== ($_POST['confirm_password'] ?? '')) { header('Location: ../../frontend/pages/reset-password.php?token=' . urlencode($token) . '&error=1'); exit(); }
        $db = (new Database())->connect();
        $stmt = $db->prepare('SELECT user_id FROM password_resets WHERE token_hash = ? AND used_at IS NULL AND expires_at > NOW() LIMIT 1');
        $stmt->execute([hash('sha256', $token)]);
        $reset = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$reset) { header('Location: ../../frontend/pages/login.php?error=reset'); exit(); }
        $db->prepare('UPDATE users SET password = ? WHERE user_id = ?')->execute([password_hash($password, PASSWORD_DEFAULT), $reset['user_id']]);
        $db->prepare('UPDATE password_resets SET used_at = NOW() WHERE token_hash = ?')->execute([hash('sha256', $token)]);
        header('Location: ../../frontend/pages/login.php?notice=password-reset'); exit();
    }

    /**
     * Login
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Invalid Request");
        }

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $user = $this->user->login($email, $password);

        if (!$user) { header('Location: ../../frontend/pages/login.php?error=login'); exit(); }
        if (($_POST['expected_role'] ?? '') === 'admin' && $user['role'] !== 'admin') {
            header('Location: ../../frontend/admin/login.php?error=role'); exit();
        }
        $loginAs = $_POST['login_as'] ?? '';
        if ($loginAs === 'seller' && $user['role'] !== 'seller') {
            header('Location: ../../frontend/pages/login.php?error=seller'); exit();
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        if (!empty($_POST['remember_me'])) {
            setcookie(session_name(), session_id(), time() + (60 * 60 * 24 * 30), '/');
        }

        $returnPath = $_SESSION['post_login_redirect'] ?? null;
        unset($_SESSION['post_login_redirect']);

        if ($loginAs === 'customer' && $returnPath) {
            header("Location: {$returnPath}");
        } elseif ($loginAs === 'customer') {
            header("Location: ../../frontend/pages/index.php");
        } else switch ($user['role']) {

            case 'admin':
                header("Location: ../../frontend/admin/dashboard.php");
                break;

            case 'seller':
                header("Location: ../../frontend/pages/seller-dashboard.php");
                break;

            default:
                header("Location: ../../frontend/pages/index.php");
                break;
        }

        exit();
    }

    /**
     * Logout
     */
    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header("Location: ../../frontend/pages/login.php");
        exit();
    }
}
?>
