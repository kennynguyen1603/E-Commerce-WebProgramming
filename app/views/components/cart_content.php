<div class="cart-container">
    <div class="cart-items">
        <h2>Shopping Cart</h2>
        <?php foreach ($cartItems as $item): ?>
            <div class="cart-item" data-product-id="<?php echo $item['product_id']; ?>">
                <button class="remove-item">X</button>
                <img src="<?php echo htmlspecialchars($item['main_image_url']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>">
                <div class="cart-item-details">
                    <p><?php echo htmlspecialchars($item['product_name']); ?></p>
                    <p class="cart-item-price">₹<?php echo number_format($item['discounted_price'], 2); ?></p>
                </div>
                <div class="cart-item-actions">
                    <button class="quantity-control">-</button>
                    <input type="text" value="<?php echo $item['cart_quantity']; ?>" class="quantity-input">
                    <button class="quantity-control">+</button>
                </div>
                <div class="cart-item-subtotal">
                    ₹<?php echo number_format($item['sub_total'], 2); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Phần hiển thị tổng cộng của giỏ hàng -->
    <div class="cart-summary">
        <h3>Card Totals</h3>
        <p>Sub-total: ₹<?php echo number_format($subTotal, 2); ?></p>
        <p>Shipping: Free</p>
        <p>Discount: ₹<?php echo number_format($discount, 2); ?></p>
        <p>Tax: ₹<?php echo number_format($tax, 2); ?></p>
        <p class="total">Total: ₹<?php echo number_format($total, 2); ?> INR</p>
        <a href="#" class="checkout-btn" onclick="checkoutCart()">PROCEED TO CHECKOUT</a>

        <!-- Phần mã giảm giá -->
        <div class="coupon-code">
            <input type="text" placeholder="Coupon Code">
            <button>APPLY COUPON</button>
        </div>
    </div>
</div>

<script>
    // Hàm để cập nhật số lượng sản phẩm
    function updateQuantity(productId, newQuantity) {
        // Gửi yêu cầu AJAX đến PHP để cập nhật số lượng
        const url = '/e-commerce/app/server/update_cart_quantity.php';
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    product_id: productId,
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Quantity updated successfully');
                    location.reload(); // Tải lại trang để cập nhật tổng cộng
                } else {
                    alert('Error: ' + (data.error || 'Failed to update quantity'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update quantity. Please try again.');
            });
    }

    let timeout; // debounce variable

    // Lắng nghe sự kiện click trên các nút tăng/giảm số lượng
    document.querySelectorAll('.quantity-control').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentNode.querySelector('.quantity-input');
            const productId = this.closest('.cart-item').getAttribute('data-product-id');
            let newQuantity = parseInt(input.value);

            if (this.textContent === '+') {
                newQuantity += 1;
            } else if (this.textContent === '-' && newQuantity > 1) {
                newQuantity -= 1;
            }

            input.value = newQuantity;

            // Hủy bỏ timeout trước đó (nếu có)
            clearTimeout(timeout);

            // Đặt timeout mới để cập nhật số lượng sau 500ms
            timeout = setTimeout(() => {
                updateQuantity(productId, newQuantity);
            }, 500);
        });
    });

    // Lắng nghe sự kiện click trên nút xóa sản phẩm
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.closest('.cart-item').getAttribute('data-product-id');

            // Gửi yêu cầu AJAX đến PHP để xóa sản phẩm
            const url = '/e-commerce/app/server/remove_from_cart.php';
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        product_id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Sản phẩm đã được xóa khỏi giỏ hàng.');
                        location.reload(); // Tải lại trang để cập nhật tổng cộng
                    } else {
                        alert('Lỗi: ' + (data.error || 'Không thể xóa sản phẩm khỏi giỏ hàng.'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Không thể xóa sản phẩm khỏi giỏ hàng. Vui lòng thử lại.');
                });
        });
    });
</script>

<script src="/e-commerce/public/assets/js/checkout.js"></script>