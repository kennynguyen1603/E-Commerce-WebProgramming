function checkout(productId, quantity = 1) {
  const productData = {
    product_id: productId,
    quantity: quantity,
  };

  // Chuyển dữ liệu sản phẩm thành chuỗi URL để gửi đi
  const params = new URLSearchParams(productData).toString();

  window.location.href = `/e-commerce/app/views/checkout.php?${params}`;
}

function checkoutCart() {
  fetch("/e-commerce/app/server/get_cart_items.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        const cartItems = data.cart_items
          .map(
            (item) =>
              `product_id[]=${item.product_id}&quantity[]=${item.quantity}`
          )
          .join("&");

        // Điều hướng tới trang checkout với thông tin toàn bộ sản phẩm
        window.location.href = `/e-commerce/app/views/checkout.php?${cartItems}`;
      } else {
        alert("Không thể tải giỏ hàng. Vui lòng thử lại.");
      }
    })
    .catch((error) => {
      console.error("Lỗi:", error);
    });
}
