SELECT products.*,
    brands.name as brand,
    categories.name as category
FROM products
    JOIN brands ON products.brand_id = brands.id
    JOIN categories ON products.category_id = categories.id
WHERE brands.name = 'Apple'
SELECT *
FROM product_images
WHERE product_id = 1 -- thêm discount cho sản phẩm có name = 'iPhone 16 Pro Max 256GB'
SELECT id
FROM products
WHERE name = 'iPhone 16 Pro Max 256GB';
--1
INSERT INTO discounts (
        product_id,
        discount_percentage,
        start_date,
        end_date,
        description
    )
VALUES (
        1,
        15.00,
        '2024-11-20',
        '2024-12-20',
        'Giảm giá 15% nhân dịp ra mắt sản phẩm.'
    );
INSERT INTO stocks (product_id, quantity)
VALUES (1, 100);