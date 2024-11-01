<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="home-container">
        <!-- Landing Page -->
        <div class="landing-page">
            <video autoplay muted loop class="video-background">
                <source src="https://storage.googleapis.com/teko-gae.appspot.com/media/video/2023/10/25/710b449c-ab0a-4ab0-bbd5-503151b026b5/large.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <div class="landing-content">
                <h1>iPhone 16 Pro</h1>
                <p>Titanium. So strong. So light. So Pro.</p>
                <div class="btn">
                    <a href="#products" class="btn-click btn-buy">Buy</a>
                    <a href="#about" class="btn-click btn-learn">Learn More</a>
                </div>
            </div>
        </div>


        <!-- Best Sellers Section -->
        <section class="best-sellers">
            <h2 class="section-title">Best Sellers</h2>

            <?php
            $productsAPI = include __DIR__ . '/../../../database/test.php';
            $products = $productsAPI;
            $carouselClass = 'best-sellers-carousel';
            include 'carousel.php';
            ?>

            <button class="view-all-btn"> View All </button>
        </section>


        <!-- Product Showcase -->
        <section class="product-showcase">x
            <div class="product-card" style="background-image: url('https://lh3.googleusercontent.com/duCLshNlvCJo9IYWYSCZtqWkIH4wT6-TtTfMkH_H4vMvZlBou9AqXuvjcioovJ3uXKiWB_zQE4ROIJmJPeaG1dL1E913JG5nCQ=w1300');">
                <div class="product-info left">
                    <h4>iPhone 16</h4>
                    <h2>Newphoria</h2>
                    <p>From $799</p>
                    <a href="#">Learn More</a>
                </div>
            </div>
            <div class="product-card" style="background-image: url('https://lh3.googleusercontent.com/vxaBAdkZJ7CYV0uWcxP5JQodMLyLPB9-aBTIsG9goFKuZU-nsuHRLShupFBI5CyiTvGNht8nXZSBg1Y9O_okOqAA0iz7LuKFDQ=w2012');">
                <div class="product-info right">
                    <h4>AirPods Max</h4>
                    <h2>A magic connection to your devices.</h2>
                    <p>$549</p>
                    <a href="#">Learn More</a>
                </div>
            </div>
        </section>

        <!-- Shop By Category -->
        <section class="category">
            <h2 class="section-title">Shop By Category</h2>

            <?php
            // $productsAPI = include __DIR__ . '/../../../database/test.php';
            // $products = $productsAPI;
            include 'category_grid.php';
            ?>

            <button class="view-all-btn"> View All </button>
        </section>

        <!-- Product Sale Component -->
        <section class="product-sale">
            <div class="product-info">
                <span class="sale-badge">SALE</span>
                <h4>AirPods Max</h4>
                <h2>Sounds like an epiphany.</h2>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                <p class="original-price">$549</p>
                <p class="discounted-price">$449</p>
                <button class="buy-button">Buy</button>
            </div>
            <div class="product-image">
                <img src="https://lh3.googleusercontent.com/pdru5LjS4QZ2b9zxZaF5AdPK9G3E-7FF2DdG-NXD_AOi629gZMqa0BSKxTMjKRzq_7V136c48MBEDmhpHJeiyKi3cSz2bsw=rw-w940" alt="AirPods Max">
            </div>
        </section>
    </div>

</body>

</html>