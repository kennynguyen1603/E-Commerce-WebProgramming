document.addEventListener("DOMContentLoaded", () => {
  let currentIndex = 0;

  function updateCarousel() {
    const carouselInner = document.querySelector(".carousel-inner");
    const itemWidth = document.querySelector(".carousel-item").clientWidth;
    carouselInner.style.transform = `translateX(-${
      currentIndex * itemWidth
    }px)`;
  }

  function nextSlide() {
    const totalItems = document.querySelectorAll(".carousel-item").length;
    if (currentIndex < totalItems - 4) {
      currentIndex += 4;
    } else {
      currentIndex = 0;
    }
    updateCarousel();
  }

  function prevSlide() {
    const totalItems = document.querySelectorAll(".carousel-item").length;
    if (currentIndex > 0) {
      currentIndex -= 4;
    } else {
      currentIndex = totalItems - 3;
    }
    updateCarousel();
  }

  document.querySelector(".next-btn").addEventListener("click", nextSlide);
  document.querySelector(".prev-btn").addEventListener("click", prevSlide);

  updateCarousel();
});
