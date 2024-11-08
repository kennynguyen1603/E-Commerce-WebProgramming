<div class="checkout-container">
    <!-- Billing Information -->
    <div class="billing-info">
        <h2>Billing Information</h2>
        <form method="post" action="process_checkout.php"> <!-- Chỉnh sửa action và method -->
            <div class="form-group">
                <label>User Name</label>
                <div class="input-row">
                    <input type="text" name="first_name" placeholder="First name" required>
                    <input type="text" name="last_name" placeholder="Last name" required>
                </div>
            </div>
            <div class="form-group">
                <label>Company Name (Optional)</label>
                <input type="text" name="company_name" placeholder="Company name">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" placeholder="Street Address" required>
            </div>
            <div class="form-group">
                <label>Location</label>
                <div class="input-row">
                    <select name="country" id="country" required>
                        <option value="">Select Country</option>
                        <!-- Country options here -->
                    </select>
                    <select name="region" id="region" required>
                        <option value="">Select Region/State</option>
                        <!-- State options here -->
                    </select>
                    <select name="city" id="city" required>
                        <option value="">Select City</option>
                        <!-- City options here -->
                    </select>
                    <input type="text" name="zip_code" placeholder="Zip Code" required>
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <input type="checkbox" name="different_address" id="different-address">
                <label for="different-address">Ship to a different address</label>
            </div>
        </form>

        <!-- Payment Option -->
        <h2>Payment Option</h2>
        <div class="payment-options">
            <label><input type="radio" name="payment" value="cod" required> Cash on Delivery</label>
            <label><input type="radio" name="payment" value="razorpay" required> Razorpay</label>
            <label><input type="radio" name="payment" value="wallet" required> My Wallet</label>
        </div>

        <!-- Additional Information -->
        <h2>Additional Information</h2>
        <textarea name="order_notes" placeholder="Order Notes (Optional)"></textarea>
    </div>

    <!-- Order Summary -->
    <div class="order-summary">
        <h3>Order Summary</h3>

        <!-- Display each product information -->
        <?php if (!empty($orderSummary)): ?>
            <?php foreach ($orderSummary as $summaryItem): ?>
                <div class="summary-item">
                    <img src="<?php echo htmlspecialchars($summaryItem['thumbnail_url']); ?>" alt="<?php echo htmlspecialchars($summaryItem['name']); ?>">
                    <span><?php echo htmlspecialchars($summaryItem['name']); ?></span>
                    <span><?php echo $summaryItem['quantity']; ?> x ₹<?php echo number_format($summaryItem['discounted_price'], 2); ?></span>
                    <span>Total: ₹<?php echo number_format($summaryItem['total_price'], 2); ?></span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No items in the order summary.</p>
        <?php endif; ?>

        <!-- Order totals -->
        <div class="summary-totals">
            <p>Sub-total: ₹<?php echo isset($subTotal) ? number_format($subTotal, 2) : '0.00'; ?></p>
            <p>Shipping: Free</p>
            <p>Discount: ₹<?php echo isset($discountTotal) ? number_format($discountTotal, 2) : '0.00'; ?></p>
            <p>Tax: ₹<?php echo isset($tax) ? number_format($tax, 2) : '0.00'; ?></p>
            <p class="total">Total: ₹<?php echo isset($total) ? number_format($total, 2) : '0.00'; ?> INR</p>
            <button type="submit" class="place-order">Place Order</button>
        </div>
    </div>
</div>