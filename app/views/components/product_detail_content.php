<?php
// Lấy thông tin sản phẩm từ biến $productDetails
$productDetails = $data['productDetails'];

$mainImage = null;
$otherImages = [];

// Lấy ảnh chính và các ảnh khác của sản phẩm
if (isset($productDetails['images']) && is_array($productDetails['images'])) {
    foreach ($productDetails['images'] as $image) {
        if (isset($image['is_main']) && $image['is_main'] == 1) {
            $mainImage = $image['image_url'];
        } elseif (isset($image['image_url'])) {
            $otherImages[] = $image['image_url'];
        }
    }
}
?>

<div class="product-detail">
    <div class="detail-container">
        <div class="main-content">
            <div class="image-carousel">
                <!-- Main Image -->
                <div class="carousel">
                    <div class="carousel-slide">
                        <img id="main-image" src="<?php echo htmlspecialchars($mainImage); ?>" alt="Product Image">
                    </div>
                </div>
                <!-- Thumbnail Images -->
                <div class="thumbnail-carousel">
                    <?php foreach ($otherImages as $image): ?>
                        <div class="thumbnail-slide">
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="Product Thumbnail" onclick="changeMainImage('<?php echo htmlspecialchars($image); ?>')">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-controls">
                    <button class="carousel-prev" onclick="prevImage()">&#9664;</button>
                    <button class="carousel-next" onclick="nextImage()">&#9654;</button>
                </div>
            </div>
            <div class="product-info">
                <h2><?php echo htmlspecialchars($productDetails['name']); ?></h2>
                <p class="availability">
                    <?php echo isset($productDetails['stock']) && $productDetails['stock'] > 0 ? 'In stock' : 'Out of stock'; ?>
                </p>
                <p class="price">
                    <span class="discounted-price">
                        ₹<?php echo number_format($productDetails['price'] * (1 - $productDetails['discount'] / 100), 2); ?>
                    </span>
                    <span class="original-price">₹<?php echo number_format($productDetails['price'], 2); ?></span>
                    <span class="discount-percent"><?php echo $productDetails['discount']; ?>% OFF</span>
                </p>
                <!-- <p class="description"><?php echo htmlspecialchars($productDetails['description'] ?? 'No description available.'); ?></p> -->
                <!-- Add to Cart Section -->
                <div class="cart-controls">
                    <button class="quantity-control" onclick="decreaseQuantity()">-</button>
                    <input type="text" value="1" class="quantity-input" id="quantity-input">
                    <button class="quantity-control" onclick="increaseQuantity()">+</button>
                    <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
                    <button class="buy-now" onclick="checkout('<?php echo $productDetails['id']; ?>', document.getElementById('quantity-input').value)">Buy Now</button>

                </div>
                <!-- Tabs -->
                <div class="tabs">
                    <button class="tab-button" onclick="showTab('description')">Description</button>
                    <button class="tab-button" onclick="showTab('reviews')">Reviews</button>
                </div>
                <!-- Tab Content -->
                <div id="description" class="tab-content">
                    <!-- <p><?php echo htmlspecialchars($productDetails['description'] ?? 'No description available.'); ?></p> -->
                </div>
                <div id="reviews" class="tab-content" style="display:none;">
                    <h3>Reviews</h3>
                    <?php if (!empty($productDetails['reviews'])): ?>
                        <ul>
                            <?php foreach ($productDetails['reviews'] as $review): ?>
                                <li>
                                    <strong><?php echo htmlspecialchars($review['customer_id']); ?></strong>
                                    <span><?php echo $review['rating']; ?> stars</span>
                                    <p><?php echo htmlspecialchars($review['comment']); ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No reviews yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/e-commerce/public/assets/js/checkout.js"></script>

<script>
    function showTab(tabId) {
        const tabs = document.getElementsByClassName('tab-content');
        for (let tab of tabs) {
            tab.style.display = 'none';
        }
        document.getElementById(tabId).style.display = 'block';
    }

    let currentImageIndex = 0;
    const images = ['<?php echo htmlspecialchars($mainImage); ?>', ...<?php echo json_encode($otherImages); ?>];

    function changeMainImage(image) {
        document.getElementById('main-image').src = image;
    }

    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        changeMainImage(images[currentImageIndex]);
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        changeMainImage(images[currentImageIndex]);
    }

    function increaseQuantity() {
        const input = document.getElementById('quantity-input');
        input.value = parseInt(input.value) + 1;
    }

    function decreaseQuantity() {
        const input = document.getElementById('quantity-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function addToCart() {
        const productId = "<?php echo htmlspecialchars($productDetails['id']); ?>";
        const productQuantity = document.getElementById('quantity-input').value;
        const customerId = "<?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : ''; ?>";
        // Kiểm tra giá trị đầu vào
        if (!customerId) {
            alert("Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.");
            const currentUrl = window.location.href;
            window.location.href = '/e-commerce/app/views/login.php?redirect=' + encodeURIComponent(currentUrl);
            return;
        }

        if (!productId) {
            alert("Không thể thêm vào giỏ hàng: thiếu thông tin sản phẩm.");
            return;
        }

        const productData = {
            customer_id: customerId,
            product_id: productId,
            quantity: productQuantity
        };


        fetch('/e-commerce/app/server/add_to_cart_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(productData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Sản phẩm đã được thêm vào giỏ hàng!');
                } else {
                    alert('Có lỗi xảy ra, vui lòng thử lại: ' + (data.error || ''));
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra trong quá trình kết nối, vui lòng thử lại.');
            });

    }
</script>