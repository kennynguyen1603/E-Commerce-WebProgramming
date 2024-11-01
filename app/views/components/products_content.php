<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="products-container">
        <!-- Sidebar: Category and Price Filter -->
        <aside class="sidebar">
            <?php include 'products/category_and_price_filter.php'; ?>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar: Search Bar and Sort By -->
            <div class="top-bar">
                <?php include 'products/search_bar.php'; ?>
                <?php include 'products/sort_by.php'; ?>
            </div>

            <!-- Product List -->
            <div class="product-list">
                <?php include 'products/list.php'; ?>
            </div>

            <!-- Pagination Bar -->
            <div class="pagination-bar">
                <?php include 'products/pagination_bar.php'; ?>
            </div>
        </main>
    </div>
</body>

</html>