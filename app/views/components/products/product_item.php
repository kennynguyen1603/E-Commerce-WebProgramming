<div class='product-item'>
    <div class='product-image-container'>
        <img src='<?php echo $product['thumbnail_url']; ?>' alt='<?php echo $product['name']; ?>' class='product-image'>
        <div class='product-icons'>
            <a href='/e-commerce/app/views/product_detail.php?id=<?php echo $product['id']; ?>' class='icon-link'><i class="fa fa-eye" aria-hidden="true"></i></a>
            <button onclick="addToCart('<?php echo $product['id']; ?>', '<?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : ''; ?>', 1)" class='icon-button'>
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <h4 class='product-name'><?php echo $product['name']; ?></h4>
    <p class='product-price'><?php echo $product['price']; ?></p>
    <button class='btn btn-primary' onclick="checkout('<?php echo $product['id']; ?>', 1)">Buy Now</button>
</div>

<script src="/e-commerce/public/assets/js/add_to_cart.js"></script>
<script src="/e-commerce/public/assets/js/checkout.js"></script>