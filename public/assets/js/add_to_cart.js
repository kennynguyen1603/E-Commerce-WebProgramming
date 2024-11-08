// add_to_cart.js
function addToCart(productId, customerId, quantity = 1) {
  if (!customerId) {
    alert("Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.");
    const currentUrl = window.location.href;
    window.location.href =
      "/e-commerce/app/views/login.php?redirect=" +
      encodeURIComponent(currentUrl);
    return;
  }

  if (!productId) {
    alert("Không thể thêm vào giỏ hàng: thiếu thông tin sản phẩm.");
    return;
  }

  const productData = {
    customer_id: customerId,
    product_id: productId,
    quantity: quantity,
  };

  fetch("/e-commerce/app/server/add_to_cart_handler.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(productData),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Sản phẩm đã được thêm vào giỏ hàng!");
      } else {
        alert("Có lỗi xảy ra, vui lòng thử lại: " + (data.error || ""));
      }
    })
    .catch((error) => {
      console.error("Lỗi:", error);
      alert("Có lỗi xảy ra trong quá trình kết nối, vui lòng thử lại.");
    });
}

// Gán hàm addToCart vào window để có thể sử dụng trên toàn bộ trang
window.addToCart = addToCart;
