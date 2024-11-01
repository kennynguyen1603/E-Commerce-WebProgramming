<?php
// Mặc định các giá trị nếu chưa có
if (!isset($categories)) {
    $categories = [
        ["image" => "https://lh3.googleusercontent.com/xYnn1VbsP_VYNAfL9DGyMogmwOtfArTlUIKTgffEEwrtEly1bkCeLs-sQ7vfWQLPilzLL53mSNmxkpclfkPjUgm6u8Xfwcn_=rw-w500", "name" => "Laptop"],
        ["image" => "https://lh3.googleusercontent.com/KIC-_OYoofCsDZAzqj_B3pfj4HJ9DW1lU-gkgMlbBg9OubsNMj0w603USxzDGjPSvrmQFwvdj5NpaywUOLF9lluNkhh6hzLh=rw-w238", "name" => "Iphone"],
        ["image" => "https://lh3.googleusercontent.com/jeZC4lERwv7pkyxyal5VJlOPr4Mwf31DaGATvWfkGIAmwSO9RRqpTyi0MhJQVajeTLVfMDqjwjJwcqizq1i9D5Q4lAx0JiQ=rw-w500", "name" => "AirPods"],
        ["image" => "https://lh3.googleusercontent.com/cGHnkmcTm2_-ACdZKK1UWxUVWOXpvPENPIxvfJy3G6yyA9hMZWC9fxeCEPRc-f37jtyHo-9lUma0deht-axkrADolMv-A44=rw-w500", "name" => "Charge"],
        ["image" => "https://lh3.googleusercontent.com/LwsAL6XLwPJbr3lpOMCVzHgJkLmsnkwsjb2V0_juRgiRkwHmarEaDkmNcNtTVNKkynJM42NhLUIqzW7NLiYa_au8PGOa36I=rw-w500", "name" => "Tablet"],
        ["image" => "https://lh3.googleusercontent.com/a7Q_BkbcTflpAArEyl0LyEpynQwxlqZtLtu7NGcSGao6S-lEQMQFShlP867R74UGf4EPxaTAcbkwSwUdueaLA3K9iZMf9ds=rw-w500", "name" => "Watch"],
        ["image" => "https://lh3.googleusercontent.com/a71VzO8t4wV7py-1HO59v0D133-obBthPip5brmTrxsIZFxPi52lxv85mKv_yJiW1ZNJA6qxTC2ltmuPUn5iSHyQkAEG47GC=rw-w500", "name" => "Camera"],
        ["image" => "https://lh3.googleusercontent.com/h3-tKiInHTOH4A4AulGC_oTqpqjXEVjZrU4z6wopD3AZaOBB6NriLNcFLPSdPog4OSqxF8NRThWBoS5h5oKOmTGpVdcUpPQf=rw-w500", "name" => "IMac"],
    ];
}
?>

<div class="shop-by-category">
    <div class="category-grid">
        <?php foreach ($categories as $category): ?>
            <div class="category-item">
                <img src="<?php echo htmlspecialchars($category['image']); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>">
            </div>
        <?php endforeach; ?>
    </div>
</div>