<?php
$pageTitle = "Contact Us";
include 'includes/header.php';
require_once 'config/database.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $msg = $conn->real_escape_string($_POST['message']);
    $conn->query("INSERT INTO contacts (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$msg')");
    $message = 'Thank you! Your message has been sent.';
}
?>

<section class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you</p>
    </div>
</section>

<section class="contact-page">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h3>Get in Touch</h3>
                <p><i class="fas fa-map-marker-alt" style="color:#e94560;width:25px;"></i> 123 Fashion Street, New York, NY 10001</p>
                <p><i class="fas fa-phone" style="color:#e94560;width:25px;"></i> +1 (555) 123-4567</p>
                <p><i class="fas fa-envelope" style="color:#e94560;width:25px;"></i> info@fashionstore.com</p>
                <p><i class="fas fa-clock" style="color:#e94560;width:25px;"></i> Mon-Fri: 9AM - 6PM</p>

                <h3 style="margin-top:40px;">Follow Us</h3>
                <p style="font-size:24px;display:flex;gap:15px;">
                    <a href="#" style="color:#1a1a2e;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color:#1a1a2e;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color:#1a1a2e;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color:#1a1a2e;"><i class="fab fa-pinterest"></i></a>
                </p>
            </div>
            <div>
                <?php if($message): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>
                <?php endif; ?>
                <form method="POST" class="checkout-form">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
