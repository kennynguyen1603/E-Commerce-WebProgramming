<div id="carousel-container" class="carousel-container <?php echo htmlspecialchars($carouselClass); ?>">
    <button class="carousel-btn prev-btn" onclick="prevSlide()">&#10094;</button>
    <div id="carousel-inner" class="carousel-inner">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="carousel-item">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="product-price"><?php echo htmlspecialchars($product['price']); ?></p>
                    <div class="stars">
                        <?php for ($i = 0; $i < $product['rating']; $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available</p>
        <?php endif; ?>
    </div>
    <button class="carousel-btn next-btn" onclick="nextSlide()">&#10095;</button>
</div>

<script src="/E-Commerce/public/assets/js/carousel.js" defer></script>