<?php
require_once __DIR__ . '/../middleware/admin.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Invalid request'); }
$action = $_GET['action'] ?? '';

if ($action === 'save-settings') {
    $allowed = ['website_name', 'support_email', 'contact_number', 'store_address', 'currency'];
    $db = (new Database())->connect();
    $statement = $db->prepare('INSERT INTO site_settings (setting_key, setting_value, updated_by) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), updated_by = VALUES(updated_by)');
    foreach ($allowed as $key) {
        $statement->execute([$key, trim($_POST[$key] ?? ''), $_SESSION['user_id']]);
    }
    header('Location: ../../frontend/admin/settings.php?success=1');
    exit;
}

if ($action === 'update-profile') {
    $password = $_POST['new_password'] ?? '';
    if ($password !== '' && $password !== ($_POST['confirm_password'] ?? '')) { exit('Passwords do not match.'); }
    $user = new User();
    $user->updateProfile($_SESSION['user_id'], [
        'full_name' => trim($_POST['full_name'] ?? ''), 'email' => trim($_POST['email'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''), 'address' => trim($_POST['address'] ?? ''), 'password' => $password,
    ]);
    $_SESSION['full_name'] = trim($_POST['full_name'] ?? '');
    $_SESSION['email'] = trim($_POST['email'] ?? '');
    header('Location: ../../frontend/admin/profile.php?success=1');
    exit;
}

if ($action === 'update-user-status') {
    $userId = (int)($_POST['user_id'] ?? 0);
    $status = $_POST['status'] ?? '';
    if ($userId === (int)$_SESSION['user_id']) {
        header('Location: ../../frontend/admin/users.php?error=self'); exit;
    }
    $target = (new User())->getById($userId);
    if (!$target || $target['role'] === 'admin' || !(new User())->updateStatus($userId, $status)) {
        header('Location: ../../frontend/admin/users.php?error=update'); exit;
    }
    header('Location: ../../frontend/admin/users.php?success=1'); exit;
}

http_response_code(400);
echo 'Invalid action';
