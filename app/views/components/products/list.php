    <?php
    // Giả lập dữ liệu sản phẩm
    $products = [
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro_1.png",
            "name" => "iPhone 16 Pro",
            "price" => "$999",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-1.png",
            "name" => "iPhone 16",
            "price" => "$799",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_3.png",
            "name" => "iPhone Pro 15",
            "price" => "$599",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_3.png",
            "name" => "iPhone Pro 15",
            "price" => "$799",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_3.png",
            "name" => "iPhone Pro 15",
            "price" => "$799",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_3.png",
            "name" => "iPhone Pro 15",
            "price" => "$799",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-1.png",
            "name" => "iPhone 16",
            "price" => "$799",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_3.png",
            "name" => "iPhone Pro 15",
            "price" => "$799",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_3.png",
            "name" => "iPhone Pro 15",
            "price" => "$799",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_3.png",
            "name" => "iPhone Pro 15",
            "price" => "$799",
            "rating" => "5"
        ],
        [
            "image" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:0/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_3.png",
            "name" => "iPhone Pro 15",
            "price" => "$799",
            "rating" => "5"
        ]
    ];

    foreach ($products as $product) {
        echo "<div class='product-item'>";
        echo "<img src='{$product['image']}' alt='{$product['name']}'>";
        echo "<h4 class='product-name'>{$product['name']}</h4>";
        echo "<p class='product-price'>{$product['price']}</p>";

        echo "<button class='btn btn-primary'>Buy Now</button>";
        echo "</div>";
    }
    ?>
