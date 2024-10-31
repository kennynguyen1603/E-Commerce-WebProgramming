<!-- ịnh tuyến cho các trang chính, trang công khai -->

<?php
require __DIR__ . '/router.php';
$router = new Router();

// Trang chủ
$router->get('/', 'HomeController@index');              // Hiển thị trang chủ

// Trang sản phẩm
$router->get('/product/{id}', 'ProductController@show'); // Hiển thị chi tiết sản phẩm dựa vào ID
$router->get('/products', 'ProductController@index');    // Hiển thị tất cả sản phẩm
$router->post('/product/add', 'ProductController@add');  // Thêm sản phẩm mới (admin)

// Trang giỏ hàng
$router->get('/cart', 'CartController@index');           // Hiển thị giỏ hàng
$router->post('/cart/add', 'CartController@add');        // Thêm sản phẩm vào giỏ
$router->post('/cart/remove', 'CartController@remove');  // Xóa sản phẩm khỏi giỏ
$router->post('/cart/checkout', 'CartController@checkout'); // Thanh toán

// Đơn hàng
$router->get('/orders', 'OrderController@index');        // Hiển thị danh sách đơn hàng của người dùng
$router->get('/order/{id}', 'OrderController@show');     // Hiển thị chi tiết đơn hàng dựa vào ID

// Xác thực người dùng
$router->get('/login', 'AuthController@showLoginForm');  // Hiển thị form đăng nhập
$router->post('/login', 'AuthController@login');         // Xử lý đăng nhập
$router->get('/register', 'AuthController@showRegisterForm'); // Hiển thị form đăng ký
$router->post('/register', 'AuthController@register');   // Xử lý đăng ký
$router->post('/logout', 'AuthController@logout');       // Đăng xuất

// Quản lý tài khoản người dùng
$router->get('/account', 'UserController@index');        // Trang tài khoản của người dùng
$router->post('/account/update', 'UserController@update'); // Cập nhật thông tin tài khoản

// Quản trị viên
$router->get('/admin', 'AdminController@index');         // Trang tổng quan quản trị
$router->get('/admin/products', 'AdminController@products'); // Quản lý sản phẩm
$router->get('/admin/orders', 'AdminController@orders'); // Quản lý đơn hàng
$router->get('/admin/users', 'AdminController@users');   // Quản lý người dùng

// Các trang khác
$router->get('/about', 'PageController@about');          // Trang giới thiệu
$router->get('/contact', 'PageController@contact');      // Trang liên hệ
$router->post('/contact', 'PageController@sendContact'); // Xử lý form liên hệ

// Chạy router
$router->run();
