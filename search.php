<?php
$pageTitle = "Search";
include 'includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <h1>Search Products</h1>
        <p>Find what you're looking for</p>
    </div>
</section>

<section style="padding:60px 0;">
    <div class="container">
        <div style="max-width:600px;margin:0 auto 40px;">
            <form method="GET" action="<?php echo $base_url; ?>/products/products.php" style="display:flex;gap:10px;">
                <input type="text" name="search" placeholder="Search for clothes, shoes, accessories..." style="flex:1;padding:15px;border:2px solid #ddd;border-radius:5px;font-size:16px;">
                <button type="submit" class="btn btn-primary" style="padding:15px 30px;"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div style="text-align:center;">
            <h3 style="margin-bottom:20px;">Popular Searches</h3>
            <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
                <?php
                $tags = ['T-Shirts', 'Jeans', 'Dresses', 'Jackets', 'Sneakers', 'Summer Collection', 'Sale', 'New Arrivals'];
                foreach($tags as $tag): ?>
                <a href="<?php echo $base_url; ?>/products/products.php?search=<?php echo urlencode($tag); ?>" style="background:#f0f0f0;padding:10px 20px;border-radius:20px;text-decoration:none;color:#333;transition:all 0.3s;" onmouseover="this.style.background='#e94560';this.style.color='#fff';" onmouseout="this.style.background='#f0f0f0';this.style.color='#333';"><?php echo $tag; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
