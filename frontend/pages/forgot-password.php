<?php include '../includes/header.php'; ?>
<section class="auth-container"><div class="auth-box"><div class="auth-right"><h2>Reset Password</h2><p>Enter your email and we will send a reset link.</p><form action="../../backend/api/auth.php?action=request-reset" method="POST"><div class="input-group"><label>Email</label><input type="email" name="email" required></div><button type="submit">Send Reset Link</button></form><div class="auth-footer"><a href="login.php">Back to Login</a></div></div></div></section>
</body></html>
