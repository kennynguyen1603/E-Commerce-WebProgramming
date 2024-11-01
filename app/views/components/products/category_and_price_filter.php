<div class="filter">
    <!-- Category Filter -->
    <div class="category">
        <h3 class="filter-title">Category</h3>
        <ul class="checkbox-container">
            <li><input type="checkbox" name="category" id="iPhone" value="iPhone"><label for="iPhone">iPhone</label></li>
            <li><input type="checkbox" name="category" id="iMac" value="iMac"><label for="iMac">iMac</label></li>
            <li><input type="checkbox" name="category" id="macBook" value="MacBook"><label for="macBook">MacBook</label></li>
            <li><input type="checkbox" name="category" id="appleWatch" value="Apple Watch"><label for="appleWatch">Apple Watch</label></li>
        </ul>
    </div>

    <!-- Price Range Slider -->
    <div class="price-range">
        <h3 class="filter-title">Price Range</h3>
        <div class="slider">
            <div class="process"></div>
        </div>
        <div class="range-inputs">
            <input type="range" class="range-min" min="0" max="50000" value="0" id="minPrice" oninput="updatePriceRange()">
            <input type="range" class="range-max" min="0" max="50000" value="50000" id="maxPrice" oninput="updatePriceRange()">
        </div>
        <div class="price-values">
            <span>0$</span>
            <span id="currentMinPrice">0$</span>
            <span id="currentMaxPrice">50000$</span>
            <span>50000$</span>
        </div>
    </div>

    <!-- Price Filters Radio Buttons -->
    <div class="price-filters">
        <h3 class="filter-title">Price Filters</h3>
        <div class="radio-buttons">
            <div><input type="radio" name="price" id="allPrice" value="0-50000"><label for="allPrice">All price</label></div>
            <div><input type="radio" name="price" id="under10000" value="0-10000"><label for="under10000">Under 10000$</label></div>
            <div><input type="radio" name="price" id="10000-20000" value="10000-20000"><label for="10000-20000">10000$ - 20000$</label></div>
            <div><input type="radio" name="price" id="20000-30000" value="20000-30000"><label for="20000-30000">20000$ - 30000$</label></div>
            <div><input type="radio" name="price" id="30000-40000" value="30000-40000"><label for="30000-40000">30000$ - 40000$</label></div>
            <div><input type="radio" name="price" id="40000-50000" value="40000-50000"><label for="40000-50000">40000$ - 50000$</label></div>
            <div><input type="radio" name="price" id="above50000" value="50000-100000"><label for="above50000">Above 50000$</label></div>
        </div>
    </div>
</div>