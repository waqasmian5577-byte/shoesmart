<?php
$pageTitle = "Register";
include 'includes/header.php';
require_once 'config/database.php';

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = 'Passwords do not match!';
    } else {
        $check = $conn->query("SELECT id FROM users WHERE email = '$email' OR username = '$username'");
        if ($check->num_rows > 0) {
            $error = 'Email or username already exists!';
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed')");
            $success = 'Account created! You can now login.';
        }
    }
}
?>

<section class="auth-page">
    <div class="container">
        <form class="auth-form" method="POST">
            <h2>Create Account</h2>
            <p>Join FashionStore today</p>
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Choose a username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="your@email.com">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Min 6 characters" minlength="6">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" required placeholder="Confirm password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create Account</button>
            <div class="auth-link">Already have an account? <a href="<?php echo $base_url; ?>/login.php">Sign in</a></div>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
