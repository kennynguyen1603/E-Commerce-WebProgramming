<form method="GET" action="/e-commerce/app/views/products.php" id="filterForm">
    <div class="filter">
        <!-- Brand Filter (Multiple Selection) -->
        <div class="brand">
            <h3 class="filter-title">Brand</h3>
            <ul class="checkbox-container">
                <li><input type="checkbox" name="brand[]" id="apple" value="Apple"><label for="apple">Apple</label></li>
                <li><input type="checkbox" name="brand[]" id="samsung" value="Samsung"><label for="samsung">Samsung</label></li>
                <li><input type="checkbox" name="brand[]" id="xiaomi" value="Xiaomi"><label for="xiaomi">Xiaomi</label></li>
                <!-- Add other brands if needed -->
            </ul>
        </div>

        <!-- Category Filter (Multiple Selection) -->
        <div class="category">
            <h3 class="filter-title">Category</h3>
            <ul class="checkbox-container">
                <li><input type="checkbox" name="category[]" id="smartPhone" value="smartPhone"><label for="smartPhone">Smart Phone</label></li>
                <li><input type="checkbox" name="category[]" id="Tablet" value="Tablet"><label for="Tablet">Tablet</label></li>
                <li><input type="checkbox" name="category[]" id="Laptop" value="Laptop"><label for="Laptop">Laptop</label></li>
                <li><input type="checkbox" name="category[]" id="smartWatch" value="smartWatch"><label for="smartWatch">Smart Watch</label></li>
                <li><input type="checkbox" name="category[]" id="airpods" value="AirPods"><label for="airpods">AirPods</label></li>
                <li><input type="checkbox" name="category[]" id="Others" value="Others"><label for="Others">Others</label></li>
            </ul>
        </div>

        <!-- Price Range Slider -->
        <div class="price-range">
            <!-- <h3 class="filter-title">Price Range</h3>
            <div class="slider">
                <div class="process"></div>
            </div>
            <div class="range-inputs">
                <input type="range" class="range-min" min="0" max="4000" value="0" id="minPrice" oninput="updatePriceRange()">
                <input type="range" class="range-max" min="0" max="4000" value="4000" id="maxPrice" oninput="updatePriceRange()">
            </div>
            <div class="price-values">
                <span>0$</span>
                <span id="currentMinPrice">0$</span>
                <span id="currentMaxPrice">4000$</span>
                <span>4000$</span>
            </div> -->
        </div>

        <!-- Price Filters Radio Buttons -->
        <div class="price-filters">
            <h3 class="filter-title">Price Filters</h3>
            <div class="radio-buttons">
                <div><input type="radio" name="priceFilter" id="allPrice" value="0-10000"><label for="allPrice">All price</label></div>
                <div><input type="radio" name="priceFilter" id="under1000" value="0-1000"><label for="under1000">Under 1000$</label></div>
                <div><input type="radio" name="priceFilter" id="1000-2000" value="1000-2000"><label for="1000-2000">1000$ - 2000$</label></div>
                <div><input type="radio" name="priceFilter" id="2000-3000" value="2000-3000"><label for="2000-3000">2000$ - 3000$</label></div>
                <div><input type="radio" name="priceFilter" id="3000-4000" value="3000-4000"><label for="3000-4000">3000$ - 4000$</label></div>
                <div><input type="radio" name="priceFilter" id="above4000" value="4000-100000"><label for="above4000">Above 4000$</label></div>
            </div>
        </div>
    </div>
</form>

<script>
    // This function will update the slider values and display based on the radio button selection.
    // function updatePriceFromRadio(radio) {
    //     const priceRange = radio.value.split('-');
    //     const minPrice = parseInt(priceRange[0]);
    //     const maxPrice = parseInt(priceRange[1]);

    //     // Update slider values
    //     document.getElementById('minPrice').value = minPrice;
    //     document.getElementById('maxPrice').value = maxPrice;

    //     // Update price range display
    //     document.getElementById('currentMinPrice').textContent = minPrice + "$";
    //     document.getElementById('currentMaxPrice').textContent = maxPrice + "$";

    //     // Update process bar
    //     const process = document.getElementById('priceRangeProcess');
    //     process.style.left = `${(minPrice / 4000) * 100}%`;
    //     process.style.right = `${100 - (maxPrice / 4000) * 100}%`;

    //     // Update the form input values if needed
    //     document.getElementById('filterForm').submit();
    // }

    // // This function will update the price range display and the process bar when the slider is changed.
    // function updatePriceRange() {
    //     const minPrice = parseInt(document.getElementById('minPrice').value);
    //     const maxPrice = parseInt(document.getElementById('maxPrice').value);

    //     // Update price range display
    //     document.getElementById('currentMinPrice').textContent = minPrice + "$";
    //     document.getElementById('currentMaxPrice').textContent = maxPrice + "$";

    //     // Update process bar
    //     const process = document.getElementById('priceRangeProcess');
    //     process.style.left = `${(minPrice / 4000) * 100}%`;
    //     process.style.right = `${100 - (maxPrice / 4000) * 100}%`;
    // }

    // // Initialize the form when the page loads
    // window.onload = updatePriceRange;

    function updatePriceRange() {
        const minPrice = parseInt(document.getElementById('minPrice').value);
        const maxPrice = parseInt(document.getElementById('maxPrice').value);

        // Ensure the min price is always less than or equal to the max price
        if (minPrice > maxPrice) {
            document.getElementById('minPrice').value = maxPrice;
        }

        // Update the slider display
        document.querySelector('.range-min').style.width = `${(minPrice / 50000) * 100}%`;
        document.querySelector('.range-max').style.width = `${((maxPrice - minPrice) / 50000) * 100}%`;
        document.querySelector('.range-max').style.left = `${(minPrice / 50000) * 100}%`;

        // Update the price values in the UI
        document.getElementById('currentMinPrice').textContent = minPrice + "$";
        document.getElementById('currentMaxPrice').textContent = maxPrice + "$";
    }

    // Initialize the form when the page loads
    window.onload = updatePriceRange;
</script>