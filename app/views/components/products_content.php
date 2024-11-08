<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');
        const productCountElement = document.getElementById('productCount');
        const customerId = "<?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : ''; ?>";

        // Function to fetch and update products based on filters
        function fetchFilteredProducts() {
            const formData = new URLSearchParams(new FormData(filterForm)).toString();
            const search = searchInput ? searchInput.value : '';
            const sort = sortSelect ? sortSelect.value : '';

            const url = `/e-commerce/app/server/filter_product_handler.php?${formData}&search=${encodeURIComponent(search)}&sort=${encodeURIComponent(sort)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const productContainer = document.querySelector('.product-list');
                    productContainer.innerHTML = '';

                    // Populate product list with filtered data
                    data.forEach(product => {
                        const productItem = document.createElement('div');
                        productItem.classList.add('product-item');
                        productItem.innerHTML = `
                            <div class="product-image-container">
                                <img src="${product.thumbnail_url}" alt="${product.name}" class="product-image">
                                <div class="product-icons">
                                    <a href="/e-commerce/app/views/product_detail.php?id=${product.id}" class="icon-link"><i class="fas fa-eye"></i></a>
                                    <button class="icon-button add-to-cart"
                                        onclick="addToCart('${product.id}', '${customerId}', 1)"
                                    >
                                    <i class="fas fa-cart-plus"></i></button>
                                </div>
                            </div>
                            <h4 class="product-name">${product.name}</h4>
                            <p class="product-price">${product.price}</p>
                            <button class="btn btn-primary" onclick="checkout('${product.id}', 1)">Buy Now</button>
                        `;
                        productContainer.appendChild(productItem);
                    });
                    productCountElement.textContent = `${data.length} products found`;
                })
                .catch(error => console.error('Error fetching products:', error));
        }

        // Event listeners for search, sort, and filter form changes
        if (filterForm) filterForm.addEventListener('change', fetchFilteredProducts);
        if (searchInput) searchInput.addEventListener('input', fetchFilteredProducts);
        if (sortSelect) sortSelect.addEventListener('change', fetchFilteredProducts);
    });

    function updatePriceRange() {
        const minPrice = document.getElementById('minPrice').value;
        const maxPrice = document.getElementById('maxPrice').value;
        document.getElementById('currentMinPrice').textContent = minPrice;
        document.getElementById('currentMaxPrice').textContent = maxPrice;
    }
</script>

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
            <!-- Search Results -->
            <div class="results">
                <h3>Search Results:</h3>
                <p id="productCount">All Products</p>
            </div>
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

<script src="/e-commerce/public/assets/js/checkout.js"></script>