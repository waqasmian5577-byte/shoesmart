<?php
$pageTitle = "Home";
include 'includes/header.php';
require_once 'config/database.php';

$featured_query = "SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE p.featured = 1 AND p.status = 'active' LIMIT 8";
$featured_result = $conn->query($featured_query);

$categories_query = "SELECT * FROM categories";
$categories_result = $conn->query($categories_query);
?>

<section class="hero">
    <div class="container">
        <h1>Elevate Your Style</h1>
        <p>Discover the latest trends in fashion. Quality clothing for every occasion.</p>
        <a href="<?php echo $base_url; ?>/products/products.php" class="btn btn-primary">Shop Now</a>
        <a href="<?php echo $base_url; ?>/about.php" class="btn btn-secondary" style="margin-left:15px;">Learn More</a>
    </div>
</section>

<section class="categories-section">
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <p class="section-subtitle">Find exactly what you're looking for</p>
        <div class="category-grid">
            <?php while($cat = $categories_result->fetch_assoc()): ?>
            <a href="<?php echo $base_url; ?>/products/products.php?category=<?php echo $cat['slug']; ?>" class="category-card">
                <div class="category-icon">
                    <?php
                    $icons = ['T-Shirts'=>'👕','Shirts'=>'👔','Jeans'=>'👖','Dresses'=>'👗','Jackets'=>'🧥','Shoes'=>'👟'];
                    echo $icons[$cat['name']] ?? '🛍️';
                    ?>
                </div>
                <div class="category-name"><?php echo $cat['name']; ?></div>
            </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<section class="featured-products">
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <p class="section-subtitle">Our handpicked selection for you</p>
        <div class="product-grid">
            <?php while($row = $featured_result->fetch_assoc()): ?>
            <div class="product-card">
                <?php if($row['sale_price']): ?>
                    <span class="product-badge sale">SALE</span>
                <?php endif; ?>
                <div class="product-image">
                    <?php if($row['image']): ?>
                        <img src="<?php echo $base_url; ?>/images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width:100%;height:100%;object-fit:cover;">
                    <?php else: ?>
                        <i class="fas fa-tshirt"></i>
                    <?php endif; ?>
                </div>
                <div class="product-info">
                    <div class="product-category"><?php echo $row['category_name']; ?></div>
                    <h3 class="product-name"><a href="<?php echo $base_url; ?>/products/product-detail.php?slug=<?php echo $row['slug']; ?>"><?php echo $row['name']; ?></a></h3>
                    <div class="product-price">
                        <?php if($row['sale_price']): ?>
                            Rs. <?php echo number_format($row['sale_price']); ?>
                            <span class="original">Rs. <?php echo number_format($row['price']); ?></span>
                        <?php else: ?>
                            Rs. <?php echo number_format($row['price']); ?>
                        <?php endif; ?>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary" onclick="addToCart(<?php echo $row['id']; ?>)">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                        <a href="<?php echo $base_url; ?>/products/product-detail.php?slug=<?php echo $row['slug']; ?>" class="btn btn-outline">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
