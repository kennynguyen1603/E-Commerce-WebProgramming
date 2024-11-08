SELECT products.*,
    brands.name as brand,
    categories.name as category
FROM products
    JOIN brands ON products.brand_id = brands.id
    JOIN categories ON products.category_id = categories.id
WHERE brands.name = 'Apple'
SELECT *
FROM product_images
WHERE product_id = 1