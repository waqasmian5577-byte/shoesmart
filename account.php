<?php
$pageTitle = "My Account";
include 'includes/header.php';
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_query = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $user_query->fetch_assoc();

$orders_query = $conn->query("SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<section class="page-header">
    <div class="container">
        <h1>My Account</h1>
        <p>Welcome, <?php echo $user['username']; ?></p>
    </div>
</section>

<section style="padding:60px 0;">
    <div class="container">
        <div style="display:grid;grid-template-columns:250px 1fr;gap:30px;">
            <div style="background:#fff;padding:20px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05);height:fit-content;">
                <h3 style="margin-bottom:15px;padding-bottom:10px;border-bottom:2px solid #f0f0f0;">Menu</h3>
                <a href="#" style="display:block;padding:10px 0;color:#e94560;text-decoration:none;font-weight:600;"><i class="fas fa-user"></i> Profile</a>
                <a href="#" style="display:block;padding:10px 0;color:#333;text-decoration:none;"><i class="fas fa-shopping-bag"></i> My Orders</a>
                <a href="<?php echo $base_url; ?>/logout.php" style="display:block;padding:10px 0;color:#e94560;text-decoration:none;"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
            <div>
                <div style="background:#fff;padding:30px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05);margin-bottom:30px;">
                    <h3 style="margin-bottom:20px;">Profile Information</h3>
                    <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Phone:</strong> <?php echo $user['phone'] ?: 'Not set'; ?></p>
                </div>

                <div style="background:#fff;padding:30px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05);">
                    <h3 style="margin-bottom:20px;">My Orders</h3>
                    <?php if($orders_query->num_rows > 0): ?>
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:2px solid #f0f0f0;">
                                <th style="text-align:left;padding:10px;">Order ID</th>
                                <th style="text-align:left;padding:10px;">Date</th>
                                <th style="text-align:left;padding:10px;">Total</th>
                                <th style="text-align:left;padding:10px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($order = $orders_query->fetch_assoc()): ?>
                            <tr style="border-bottom:1px solid #f0f0f0;">
                                <td style="padding:10px;">#<?php echo $order['id']; ?></td>
                                <td style="padding:10px;"><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                                <td style="padding:10px;">Rs. <?php echo number_format($order['total_amount']); ?></td>
                                <td style="padding:10px;">
                                    <span style="background:<?php echo $order['order_status']=='delivered'?'#d4edda':($order['order_status']=='cancelled'?'#f8d7da':'#fff3cd'); ?>;color:<?php echo $order['order_status']=='delivered'?'#155724':($order['order_status']=='cancelled'?'#721c24':'#856404'); ?>;padding:5px 10px;border-radius:3px;font-size:12px;text-transform:capitalize;">
                                        <?php echo $order['order_status']; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p style="color:#666;">No orders yet. <a href="<?php echo $base_url; ?>/products/products.php" style="color:#e94560;">Start shopping!</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
