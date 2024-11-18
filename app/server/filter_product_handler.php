<?php
require_once __DIR__ . '/../../database/db_connection.php';
$db = new DB_Connection();

function fetchFilteredProducts($brands, $categories, $minPrice, $maxPrice, $priceFilter, $search = '', $sort = '', $limit, $offset)
{
    global $db;

    // Base query with JOINs to access brand and category names
    $query = "SELECT products.*, brands.name as brand, categories.name as category
              FROM products
              JOIN brands ON products.brand_id = brands.id
              JOIN categories ON products.category_id = categories.id
              WHERE 1=1";

    $params = [];
    $conditions = [];

    // Filter by multiple brands (using brand names)
    if (!empty($brands)) {
        $conditions[] = "brands.name IN (" . implode(',', array_fill(0, count($brands), '?')) . ")";
        $params = array_merge($params, $brands);
    }

    // Filter by multiple categories (using category names)
    if (!empty($categories)) {
        $conditions[] = "categories.name IN (" . implode(',', array_fill(0, count($categories), '?')) . ")";
        $params = array_merge($params, $categories);
    }

    // Filter by price range
    if (!empty($minPrice) && !empty($maxPrice)) {
        $conditions[] = "products.price BETWEEN ? AND ?";
        $params[] = $minPrice;
        $params[] = $maxPrice;
    }

    // Apply price filter from radio buttons if selected
    if (!empty($priceFilter)) {
        list($min, $max) = explode('-', $priceFilter);
        $conditions[] = "products.price BETWEEN ? AND ?";
        $params[] = $min;
        $params[] = $max;
    }

    // Apply search filter
    if (!empty($search)) {
        $conditions[] = "products.name LIKE ?";
        $params[] = '%' . $search . '%';
    }


    // Combine all conditions
    if (count($conditions) > 0) {
        $query .= " AND " . implode(' AND ', $conditions);
    }

    // Apply sorting
    switch ($sort) {
        case 'price_asc':
            $query .= " ORDER BY products.price ASC";
            break;
        case 'price_desc':
            $query .= " ORDER BY products.price DESC";
            break;
        case 'name_asc':
            $query .= " ORDER BY products.name ASC";
            break;
        case 'name_desc':
            $query .= " ORDER BY products.name DESC";
            break;
        default:
            $query .= " ORDER BY products.name"; // Default sorting
            break;
    }

    $query .= " LIMIT " . intval($limit) . " OFFSET " . intval($offset);

    return $db->get($query, $params);
}

// hàm lấy tổng số sản phẩm sau khi lọc
function getTotalFilteredProducts($brands, $categories, $minPrice, $maxPrice, $priceFilter, $search = '')
{
    global $db;

    // Base query with JOINs to access brand and category names
    $query = "SELECT COUNT(*) as total_products
              FROM products
              JOIN brands ON products.brand_id = brands.id
              JOIN categories ON products.category_id = categories.id
              WHERE 1=1";

    $params = [];
    $conditions = [];

    // Filter by multiple brands (using brand names)
    if (!empty($brands)) {
        $conditions[] = "brands.name IN (" . implode(',', array_fill(0, count($brands), '?')) . ")";
        $params = array_merge($params, $brands);
    }

    // Filter by multiple categories (using category names)
    if (!empty($categories)) {
        $conditions[] = "categories.name IN (" . implode(',', array_fill(0, count($categories), '?')) . ")";
        $params = array_merge($params, $categories);
    }

    // Filter by price range
    if (!empty($minPrice) && !empty($maxPrice)) {
        $conditions[] = "products.price BETWEEN ? AND ?";
        $params[] = $minPrice;
        $params[] = $maxPrice;
    }

    // Apply price filter from radio buttons if selected
    if (!empty($priceFilter)) {
        list($min, $max) = explode('-', $priceFilter);
        $conditions[] = "products.price BETWEEN ? AND ?";
        $params[] = $min;
        $params[] = $max;
    }

    // Apply search filter
    if (!empty($search)) {
        $conditions[] = "products.name LIKE ?";
        $params[] = '%' . $search . '%';
    }

    // Combine all conditions
    if (count($conditions) > 0) {
        $query .= " AND " . implode(' AND ', $conditions);
    }

    $result = $db->get($query, $params);
    return $result[0]['total_products'];
}

// Retrieve filter inputs
$brands = $_GET['brand'] ?? [];
$categories = $_GET['category'] ?? [];
$minPrice = $_GET['minPrice'] ?? 0;

$maxPrice = $_GET['maxPrice'] ?? 50000;
$priceFilter = $_GET['priceFilter'] ?? '';
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? '';

$limit = 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$products = fetchFilteredProducts($brands, $categories, $minPrice, $maxPrice, $priceFilter, $search, $sort, $limit, $offset);

$totalProductsQuery = "SELECT COUNT(*) FROM products";

$totalProducts = getTotalFilteredProducts($brands, $categories, $minPrice, $maxPrice, $priceFilter, $search);

// Return JSON response
header('Content-Type: application/json');
echo json_encode([
    'products' => $products,
    'totalProducts' => $totalProducts
]);
