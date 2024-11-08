<?php
$productId = $_GET['productId'] ?? null;
$productDetails = [
    'id' => 'A264671',
    'name' => '2020 Apple MacBook Pro with Apple M1 Chip',
    'price' => 120000,
    'discount' => 25,
    'stock' => 10,
    'brand' => 'Apple',
    'category' => 'Macbook',
    'description' => 'The most powerful MacBook Pro ever is here...',
    'features' => [
        'Free 1 Year Warranty',
        'Free Shipping & Fast Delivery',
        '100% Money-back guarantee',
        '24/7 Customer support',
        'Secure payment methods'
    ],
    'images' => [
        'img1.jpg',
        'img2.jpg',
        'img3.jpg',
        'img4.jpg'
    ],
    'shipping' => [
        'Courier' => '2-4 days, free shipping',
        'Local Shipping' => 'up to one week, $19.00',
        'UPS Ground Shipping' => '4-6 days, $29.00',
        'Unishop Global Export' => '3-4 days, $39.00'
    ],
    'ratings' => [
        'fiveStar' => 94532,
        'fourStar' => 6717,
        'threeStar' => 714,
        'twoStar' => 152,
        'oneStar' => 643
    ]
];
$averageRating = 4.7;
$totalRatings = 102058;
?>

<div class="product-detail">
    <div class="detail-container">
        <div class="main-content">
            <div class="image-carousel">
                <!-- Image Carousel -->
                <div class="carousel">
                    <?php foreach ($productDetails['images'] as $image): ?>
                        <div class="carousel-slide">
                            <img src="path/to/<?php echo $image; ?>" alt="Product Image">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-controls">
                    <button class="carousel-prev">&#9664;</button>
                    <button class="carousel-next">&#9654;</button>
                </div>
            </div>

            <div class="product-info">
                <h2><?php echo $productDetails['name']; ?></h2>
                <p class="product-id">ID: <?php echo $productDetails['id']; ?></p>
                <p class="availability">
                    <?php echo $productDetails['stock'] > 0 ? 'In stock' : 'Out of stock'; ?>
                </p>
                <p class="price">
                    <span class="discounted-price">₹<?php echo number_format($productDetails['price'] * (1 - $productDetails['discount'] / 100), 2); ?></span>
                    <span class="original-price">₹<?php echo number_format($productDetails['price'], 2); ?></span>
                    <span class="discount-percent"><?php echo $productDetails['discount']; ?>% OFF</span>
                </p>

                <!-- Add to Cart Section -->
                <div class="cart-controls">
                    <button class="quantity-control">-</button>
                    <input type="text" value="1" class="quantity-input">
                    <button class="quantity-control">+</button>
                    <button class="add-to-cart">Add to Cart</button>
                    <button class="buy-now">Buy Now</button>
                </div>

                <!-- Features -->
                <div class="features">
                    <h3>Features</h3>
                    <ul>
                        <?php foreach ($productDetails['features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Description & Review Tabs -->
        <div class="tabs">
            <button class="tab active" onclick="showTab('description')">Description</button>
            <button class="tab" onclick="showTab('review')">Review</button>
        </div>

        <div id="description" class="tab-content">
            <p><?php echo $productDetails['description']; ?></p>
        </div>

        <div id="review" class="tab-content" style="display: none;">
            <h3>Customer Ratings</h3>
            <p>Average Rating: <?php echo $averageRating; ?> out of 5</p>
            <div class="rating-bars">
                <!-- Rating Bar Example -->
                <?php foreach ($productDetails['ratings'] as $star => $count): ?>
                    <div class="rating-bar">
                        <span><?php echo ucfirst($star); ?></span>
                        <div class="bar" style="width: <?php echo ($count / $totalRatings) * 100; ?>%;"></div>
                        <span>(<?php echo $count; ?>)</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function showTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');
        document.getElementById(tabId).style.display = 'block';
    }
</script>