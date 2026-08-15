<?php
$pageTitle = "Login";
include 'includes/header.php';
require_once 'config/database.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid password!';
        }
    } else {
        $error = 'No account found with this email!';
    }
}
?>

<section class="auth-page">
    <div class="container">
        <form class="auth-form" method="POST">
            <h2>Welcome Back</h2>
            <p>Sign in to your account</p>
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="your@email.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
            <div class="auth-link">Don't have an account? <a href="<?php echo $base_url; ?>/register.php">Register here</a></div>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
