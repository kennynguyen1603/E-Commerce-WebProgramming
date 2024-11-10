<div class="checkout-container">
    <!-- Billing Information -->
    <div class="billing-info">
        <h2>Billing Information</h2>
        <form method="post" action="/e-commerce/app/server/checkout_handler.php">
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
                    <!-- Country Selection -->
                    <select name="country" id="country" required>
                        <option value="">Select Country</option>
                        <option value="Vietnam">Vietnam</option>
                    </select>

                    <!-- Region (Province) Selection -->
                    <select name="region" id="region" required>
                        <option value="">Select Region/Province</option>
                        <option value="Hanoi">Hanoi</option>
                        <option value="Ho Chi Minh City">Ho Chi Minh City</option>
                        <option value="Da Nang">Da Nang</option>
                        <option value="Can Tho">Can Tho</option>
                        <option value="Hai Phong">Hai Phong</option>
                    </select>

                    <!-- City/District Selection -->
                    <select name="city" id="city" required>
                        <option value="">Select City/District</option>
                        <optgroup label="Hanoi">
                            <option value="Ba Dinh">Ba Dinh</option>
                            <option value="Hoan Kiem">Hoan Kiem</option>
                            <option value="Hai Ba Trung">Hai Ba Trung</option>
                            <option value="Dong Da">Dong Da</option>
                        </optgroup>
                        <optgroup label="Ho Chi Minh City">
                            <option value="District 1">District 1</option>
                            <option value="District 3">District 3</option>
                            <option value="Binh Thanh">Binh Thanh</option>
                            <option value="Phu Nhuan">Phu Nhuan</option>
                        </optgroup>
                    </select>

                    <!-- Zip Code Input -->
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

            <!-- Hidden input to store order items -->
            <input type="hidden" name="order_items" id="order_items">

            <button type="submit" class="place-order" onclick="handlePlaceOrder()">Place Order</button>
        </form>
    </div>

    <!-- Order Summary -->
    <div class="order-summary">
        <h3>Order Summary</h3>
        <?php if (!empty($data['orderSummary'])): ?>
            <?php foreach ($data['orderSummary'] as $summaryItem): ?>
                <div class="summary-item" style="display: flex; flex-direction: column;">
                    <?php if (isset($summaryItem['thumbnail_url']) && isset($summaryItem['name'])): ?>
                        <img src="<?php echo htmlspecialchars($summaryItem['thumbnail_url']); ?>" alt="<?php echo htmlspecialchars($summaryItem['name']); ?>">
                        <span><?php echo htmlspecialchars($summaryItem['name']); ?></span>
                    <?php else: ?>
                        <p>Product information is missing.</p>
                    <?php endif; ?>
                    <span><?php echo $summaryItem['quantity'] ?? 'N/A'; ?> x ₹<?php echo isset($summaryItem['discounted_price']) ? number_format($summaryItem['discounted_price'], 2) : '0.00'; ?></span>
                    <span>Total: ₹<?php echo isset($summaryItem['total_price']) ? number_format($summaryItem['total_price'], 2) : '0.00'; ?></span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No items in the order summary.</p>
        <?php endif; ?>

        <div class="summary-totals">
            <p>Sub-total: ₹<?php echo isset($data['subTotal']) ? number_format($data['subTotal'], 2) : '0.00'; ?></p>
            <p>Shipping: Free</p>
            <p>Discount: ₹<?php echo isset($data['discountTotal']) ? number_format($data['discountTotal'], 2) : '0.00'; ?></p>
            <p>Tax: ₹<?php echo isset($data['tax']) ? number_format($data['tax'], 2) : '0.00'; ?></p>
            <p class="total">Total: ₹<?php echo isset($data['total']) ? number_format($data['total'], 2) : '0.00'; ?> INR</p>
        </div>
    </div>
</div>

<script>
    function validatePaymentInfo() {
        const requiredFields = [{
                name: 'first_name',
                label: 'First Name'
            },
            {
                name: 'last_name',
                label: 'Last Name'
            },
            {
                name: 'address',
                label: 'Address'
            },
            {
                name: 'country',
                label: 'Country'
            },
            {
                name: 'region',
                label: 'Region/State'
            },
            {
                name: 'city',
                label: 'City'
            },
            {
                name: 'zip_code',
                label: 'Zip Code'
            },
            {
                name: 'email',
                label: 'Email'
            },
            {
                name: 'phone',
                label: 'Phone Number'
            }
        ];

        let missingFields = [];
        for (const field of requiredFields) {
            const element = document.querySelector(`[name="${field.name}"]`);
            if (element && !element.value.trim()) {
                missingFields.push(field.label);
            }
        }

        const paymentSelected = document.querySelector('[name="payment"]:checked');
        if (!paymentSelected) {
            missingFields.push("Payment Method");
        }

        if (missingFields.length > 0) {
            alert("Please fill out the following fields:\\n- " + missingFields.join("\\n- "));
            return false;
        }
        return true;
    }

    function handlePlaceOrder() {
        const form = document.querySelector('form');
        if (validatePaymentInfo()) {
            const orderItems = <?php echo json_encode($data['orderSummary']); ?>;
            document.getElementById('order_items').value = JSON.stringify(orderItems);
            form.submit();
        }
    }
</script>