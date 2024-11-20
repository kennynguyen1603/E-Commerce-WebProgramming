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


$productDetails['reviews'] = [
    [
        'customer_id' => 'John Doe',
        'rating' => 5,
        'comment' => 'This is by far the best laptop I’ve ever purchased. The performance is unmatched, and the display is breathtaking. Totally worth the price!',
    ],
    [
        'customer_id' => 'Jane Smith',
        'rating' => 4,
        'comment' => 'Amazing product with great battery life. However, the shipping took longer than expected.',
    ],
    [
        'customer_id' => 'Michael Brown',
        'rating' => 5,
        'comment' => 'Fantastic build quality and super-fast performance. I use it for video editing, and it handles everything flawlessly.',
    ]
];

?>

<div class="product-detail">
    <div class="detail-container">
        <div class="product-image-section">
            <!-- Main Image -->
            <div class="main-image">
                <img id="main-image" src="<?php echo htmlspecialchars($mainImage); ?>" alt="Product Image">
            </div>
            <!-- Thumbnail Images -->
            <div class="thumbnail-carousel">
                <button class="carousel-arrow carousel-prev" onclick="prevImage()">
                    <i style="font-size:24px" class="fa">&#xf060;</i>
                </button>
                <div class="thumbnails">
                    <?php foreach ($otherImages as $image): ?>
                        <div class="thumbnail-slide">
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="Product Thumbnail" onclick="changeMainImage('<?php echo htmlspecialchars($image); ?>')">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-arrow carousel-next" onclick="nextImage()">
                    <i style="font-size:24px" class="fa">&#xf061;</i>
                </button>
            </div>
        </div>
        <div class="product-info-section">
            <p class="product-title"><?php echo htmlspecialchars($productDetails['name']); ?></p>
            <div class="product-rating">
                <span class="stars">★★★★☆</span>
                <span class="rating-value">4.7</span>
                <span class="review-count">(10 User Feedback)</span>
            </div>
            <div class="product-meta">
                <p>ID: <?php echo htmlspecialchars($productDetails['id']); ?></p>
                <p>Availability: <span class="availability"><?php echo isset($productDetails['stock']) && $productDetails['stock'] > 0 ? 'In Stock' : 'Out of Stock'; ?></span></p>
            </div>
            <div class="product-price">
                <span class="discounted-price">₹<?php echo number_format($productDetails['price'] * (1 - $productDetails['discount'] / 100), 2); ?></span>
                <span class="original-price">₹<?php echo number_format($productDetails['price'], 2); ?></span>
                <span class="discount-percent"><?php echo $productDetails['discount']; ?>% OFF</span>
            </div>
            <div class="product-options">
                <label>Memory</label>
                <select>
                    <option>16 GB Unified Memory</option>
                </select>
                <label>Size</label>
                <select>
                    <option>14-inch Liquid Retina XDR Display</option>
                </select>
                <label>Storage</label>
                <select>
                    <option>1TB SSD Storage</option>
                </select>
            </div>
            <div class="cart-controls">
                <button class="quantity-control" onclick="decreaseQuantity()">-</button>
                <input type="text" value="1" class="quantity-input" id="quantity-input">
                <button class="quantity-control" onclick="increaseQuantity()">+</button>
                <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
                <button class="buy-now" onclick="checkout('<?php echo $productDetails['id']; ?>', document.getElementById('quantity-input').value)">Buy Now</button>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <button class="tab active" data-tab="description" onclick="showTab('description')">Description</button>
        <button class="tab" data-tab="reviews" onclick="showTab('reviews')">Reviews</button>
    </div>

    <!-- Tab Content -->
    <div class="tab-container">
        <div id="description" class="tab-content active">
            <div class="description-section">
                <h3>Description</h3>
                <p>The most powerful MacBook Pro ever is here. With the blazing-fast M1 Pro or M1 Max chip — the first Apple silicon designed for pros — you get groundbreaking performance and amazing battery life. Add to that a stunning Liquid Retina XDR display, the best camera and audio ever in a Mac notebook, and all the ports you need. The first notebook of its kind, this MacBook Pro is a beast. M1 Pro takes the exceptional performance of the M1 architecture to a whole new level for pro users.</p>
                <p>Even the most ambitious projects are easily handled with up to 10 CPU cores, up to 16 GPU cores, a 16-core Neural Engine, and dedicated encode and decode media engines that support H.264, HEVC, and ProRes codecs.</p>
            </div>
            <div class="feature-section">
                <h3>Feature</h3>
                <ul>
                    <li><i class="icon">✔</i> Free 1 Year Warranty</li>
                    <li><i class="icon">✔</i> Free Shipping & Fasted Delivery</li>
                    <li><i class="icon">✔</i> 100% Money-back guarantee</li>
                    <li><i class="icon">✔</i> 24/7 Customer support</li>
                    <li><i class="icon">✔</i> Secure payment method</li>
                </ul>
            </div>
            <div class="shipping-info-section">
                <h3>Shipping Information</h3>
                <ul>
                    <li><strong>Courier:</strong> 2-4 days, free shipping</li>
                    <li><strong>Local Shipping:</strong> up to one week, $19.00</li>
                    <li><strong>UPS Ground Shipping:</strong> 4-6 days, $29.00</li>
                    <li><strong>Unishop Global Export:</strong> 3-4 days, $39.00</li>
                </ul>
            </div>
        </div>
        <div id="reviews" class="tab-content">
            <div class="review-section">
                <h3>Customer Reviews</h3>
                <?php if (!empty($productDetails['reviews'])): ?>
                    <?php foreach ($productDetails['reviews'] as $review): ?>
                        <div class="review-item">
                            <div class="review-header">
                                <strong><?php echo htmlspecialchars($review['customer_id']); ?></strong>
                                <span class="review-rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?php echo $i <= $review['rating'] ? '★' : '☆'; ?>
                                    <?php endfor; ?>
                                </span>
                            </div>
                            <p class="review-comment"><?php echo htmlspecialchars($review['comment']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-reviews">No reviews yet. Be the first to review this product!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="/e-commerce/public/assets/js/checkout.js"></script>

<script>
    function showTab(tabId) {
        // Lấy tất cả các tab
        const tabs = document.getElementsByClassName('tab-content');
        const tabButtons = document.querySelectorAll('.tabs .tab');

        // Ẩn tất cả tab và bỏ class "active" trên các nút tab
        for (let tab of tabs) {
            tab.classList.remove('active');
        }
        for (let button of tabButtons) {
            button.classList.remove('active');
        }

        // Hiển thị tab được chọn và thêm class "active" cho nút tab tương ứng
        document.getElementById(tabId).classList.add('active');
        document.querySelector(`.tabs .tab[data-tab="${tabId}"]`).classList.add('active');
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