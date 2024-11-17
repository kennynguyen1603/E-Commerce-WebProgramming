<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');
        const productCountElement = document.getElementById('productCount');
        const customerId = "<?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : ''; ?>";

        let currentPage = 1;
        const limit = 4;

        // Hàm lấy danh sách sản phẩm đã lọc
        function fetchFilteredProducts() {
            const formData = new URLSearchParams(new FormData(filterForm)).toString();
            const search = searchInput ? searchInput.value : '';
            const sort = sortSelect ? sortSelect.value : '';

            const url = `/e-commerce/app/server/filter_product_handler.php?${formData}&search=${encodeURIComponent(search)}&sort=${encodeURIComponent(sort)}&page=${currentPage}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const productContainer = document.querySelector('.product-list');
                    productContainer.innerHTML = ''; // Xóa các sản phẩm hiện tại

                    data.products.forEach(product => {
                        const productItem = document.createElement('div');
                        productItem.classList.add('product-item');
                        productItem.innerHTML = `
                            <div class="product-image-container">
                                <img src="${product.thumbnail_url}" alt="${product.name}" class="product-image">
                                <div class="product-icons">
                                    <a href="/e-commerce/app/views/product_detail.php?id=${product.id}" class="icon-link"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <button class="icon-button add-to-cart" onclick="addToCart('${product.id}', '${customerId}', 1)">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <h4 class="product-name">${product.name}</h4>
                            <p class="product-price">${product.price}</p>
                            <button class="btn btn-primary" onclick="checkout('${product.id}', 1)">Buy Now</button>
                        `;
                        productContainer.appendChild(productItem);
                    });

                    productCountElement.textContent = `${data.totalProducts} products found`;

                    updatePagination(data.totalProducts); // Cập nhật phân trang
                })
                .catch(error => console.error('Error fetching products:', error));
        }

        // Hàm cập nhật phân trang
        function updatePagination(totalProducts) {
            const totalPages = Math.ceil(totalProducts / limit);
            const paginationContainer = document.querySelector('.pagination-bar');
            paginationContainer.innerHTML = ''; // Xóa các nút phân trang cũ

            if (totalPages > 1) {
                // Thêm nút Previous
                if (currentPage > 1) {
                    const prevButton = document.createElement('button');
                    prevButton.textContent = 'Previous';
                    prevButton.classList.add('btn', 'btn-secondary');
                    prevButton.addEventListener('click', () => {
                        currentPage--;
                        fetchFilteredProducts();
                    });
                    paginationContainer.appendChild(prevButton);
                }

                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i;
                    pageButton.classList.add('btn', 'btn-secondary');
                    if (i === currentPage) {
                        pageButton.classList.add('active');
                    }
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        fetchFilteredProducts();
                    });
                    paginationContainer.appendChild(pageButton);
                }

                // Thêm nút Next
                if (currentPage < totalPages) {
                    const nextButton = document.createElement('button');
                    nextButton.textContent = 'Next';
                    nextButton.classList.add('btn', 'btn-secondary');
                    nextButton.addEventListener('click', () => {
                        currentPage++;
                        fetchFilteredProducts();
                    });
                    paginationContainer.appendChild(nextButton);
                }

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }

        // Lắng nghe sự thay đổi trên form và các trường tìm kiếm
        if (filterForm) filterForm.addEventListener('change', fetchFilteredProducts);
        if (searchInput) searchInput.addEventListener('input', fetchFilteredProducts);
        if (sortSelect) sortSelect.addEventListener('change', fetchFilteredProducts);

        // Lấy sản phẩm khi trang được tải
        fetchFilteredProducts();
    });

    // Hàm cập nhật giá trị khoảng giá
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
            <div class="results">
                <h3>Search Results:</h3>
                <p id="productCount">All Products</p>
            </div>
            <?php include 'products/sort_by.php'; ?>
        </div>

        <!-- Product List -->
        <div class="product-list">
        </div>

        <!-- Pagination Bar -->
        <div class="pagination-bar">
        </div>
    </main>
</div>

<script src="/e-commerce/public/assets/js/checkout.js"></script>