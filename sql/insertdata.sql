INSERT INTO brands (name)
VALUES ('Apple'),
    ('Samsung'),
    ('Xiaomi');
INSERT INTO categories (name)
VALUES ('Smartphone'),
    ('Laptop'),
    ('Tablet'),
    ('Smartwatch'),
    ('Headphone'),
    ('Airpods'),
    ('Camera');
-- Smartphones
-- iPhone 16 Pro Max 256GB
-- iPhone 16 Pro Max 256GB
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 16 Pro Max 256GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        2200,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 Pro Max 256GB'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max.png',
        1
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 Pro Max 256GB'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max.png',
        0
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 Pro Max 256GB'
        ),
        'https://cdn2.cellphones.com.vn/x/media/catalog/product/i/p/iphone-16-pro-max-2.png',
        0
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 Pro Max 256GB'
        ),
        'https://cdn2.cellphones.com.vn/x/media/catalog/product/i/p/iphone-16-pro-max-3.png',
        0
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 Pro Max 256GB'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max-6.png',
        0
    );
-- iPhone 16 128GB
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 16 128GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        2000,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-1.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 128GB'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-1.png',
        1
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 128GB'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-2.png',
        0
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 128GB'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-3.png',
        0
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 128GB'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-6.png',
        0
    );
-- iPhone 16 Pro Max 256GB - Đổi Bảo Hành
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 16 Pro Max 256GB - Đổi Bảo Hành',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        1500,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/p/h/photo_2024-10-02_13-59-00_1_1.jpg'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 Pro Max 256GB - Đổi Bảo Hành'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max_3_1.png',
        0
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 Pro Max 256GB - Đổi Bảo Hành'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/p/h/photo_2024-10-02_13-59-00_1_1.jpg',
        0
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 Pro Max 256GB - Đổi Bảo Hành'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max-2_3_1.png',
        0
    ),
    (
        (
            SELECT id
            FROM products
            WHERE name = 'iPhone 16 Pro Max 256GB - Đổi Bảo Hành'
        ),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max-3_3_1.png',
        0
    );
-- iPhone 15 Pro Max 512GB | Chính hãng VN/A
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 15 Pro Max 512GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        1600,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_5.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        4,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_5.png',
        1
    ),
    (
        4,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_4__2.jpg',
        0
    ),
    (
        4,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_5__2.jpg',
        0
    ),
    (
        4,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_6__2.jpg',
        0
    );
-- iPhone 16 Plus 512GB | Chính hãng VN/A
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 16 Plus 512GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        2650,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-plus-1_2.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-plus-1_2.png',
        1
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-plus-2_2.png',
        0
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-plus-3_2.png',
        0
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-plus-6_2.png',
        0
    );
-- iPhone 14 Pro Max 256GB | Chính hãng VN/A
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 14 Pro Max 256GB | Chính hãng VN/A',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        1600,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-14-pro-max-256gb.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-14-pro-max-256gb.png',
        1
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone_14_pro_max_256gb.png',
        0
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone_14_pro_max_512gb_-_2_1__1.png',
        0
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone_14_pro_max_512gb_-_10_1.png',
        0
    );
-- iPhone 14 Pro 128GB | Chính hãng VN/A
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 14 Pro 128GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        1330,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-14-pro_2__4.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-14-pro_2__4.png',
        1
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone_14_pro_1tb_-_1_1_.png',
        0
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-14-pro-1tb-10.png',
        0
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/2/1/21_1_.png',
        0
    );
-- iPhone 13 Pro Max 256GB
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 13 Pro Max 256GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        900,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/p/r/pro_max_1_1_2_2_1_1.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/p/r/pro_max_1_1_2_2_1_1.png',
        1
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/2/_/2_61_8_2_1_4_1_1_1.jpg',
        0
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/3/_/3_51_1_2_1_4_1_1_1.jpg',
        0
    );
-- iPhone 13 Pro 128GB
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 13 Pro 128GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        600,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/1/_/1_66_6_2_4_1.jpg'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/1/_/1_66_6_2_4_1.jpg',
        1
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/4/_/4_36_3_2_5_1.jpg',
        0
    ),
    (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/2/_/2_61_8_2_5_1.jpg',
        0
    );
-- chua them
-- iPhone 13 128GB | Chính hãng VN/A
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 13 128GB | Chính hãng VN/A',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        500,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-13_2_.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone_13_128gb_-_4_1_.png',
        0
    );
-- iPhone 12 Pro Max 128GB
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 12 Pro Max 128GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        700,
        NULL
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/o/download_2__1_27.png',
        1
    );
-- iPhone 12 64GB | Chính hãng VN/A
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 12 64GB | Chính hãng VN/A',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        450,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-12.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/2/_/2_241.jpg',
        0
    );
-- iPhone X 256GB
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone X 256GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        300,
        NULL
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/_/0/_0001_finish_iphone-x_dark_gray_large_4.jpg',
        1
    );
-- iPhone 12 Pro 128GB Cũ đẹp
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 12 Pro 128GB Cũ đẹp',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        650,
        NULL
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/o/download_4_2_2.png',
        1
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/_/t_i_xu_ng_2_2.png',
        0
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/o/download_1__2_26_2.png',
        0
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/o/download_2__1_28_2.png',
        0
    );
-- iPhone 11 64GB | Chính hãng VN/A
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 11 64GB | Chính hãng VN/A',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        500,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-11.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/6/_/6_130.jpg',
        0
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/2/_/2_242.jpg',
        0
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/5/_/5_158.jpg',
        0
    );
-- iPhone 11 Pro Max 256GB
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 11 Pro Max 256GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        650,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-11-pro-max-midnight-green-select-2019_1_1_2_2_3.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-11-pro-max-gold-select-2019_1_1_2_2_3.png',
        0
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-11-pro-max-silver-select-2019_1_1_2_2_3.png',
        0
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-11-pro-max-space-select-2019_1_1_2_2_3.png',
        0
    );
-- iPhone 11 Pro 64GB
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone 11 Pro 64GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        450,
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-11-pro-midnight-green-select-2019_6_2_1.png'
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-11-pro-gold-select-2019_8_2_1.png',
        0
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-11-pro-silver-select-2019_6_1_1.png',
        0
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-11-pro-space-select-2019_6_2_1.png',
        0
    );
-- iPhone X 256GB
INSERT INTO products (
        name,
        category_id,
        brand_id,
        price,
        thumbnail_url
    )
VALUES (
        'iPhone X 256GB',
        (
            SELECT id
            FROM categories
            WHERE name = 'Smartphone'
        ),
        1,
        300,
        NULL
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/_/0/_0001_finish_iphone-x_dark_gray_large_4.jpg',
        1
    );
INSERT INTO product_images (product_id, image_url, is_main)
VALUES (
        LAST_INSERT_ID(),
        'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/_/0/_0000_finish_iphone-x_silver_large_2_1_4.jpg',
        0
    );