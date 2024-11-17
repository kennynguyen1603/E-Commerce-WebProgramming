<div id="carousel-container" class="carousel-container <?php echo htmlspecialchars($carouselClass); ?>">
    <button class="carousel-btn prev-btn" onclick="prevSlide()">&#10094;</button>
    <div id="carousel-inner" class="carousel-inner">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="carousel-item">
                    <?php include __DIR__ . '/product_item.php'; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available</p>
        <?php endif; ?>
    </div>
    <button class="carousel-btn next-btn" onclick="nextSlide()">&#10095;</button>
</div>

<script src="/E-Commerce/public/assets/js/carousel.js" defer></script>