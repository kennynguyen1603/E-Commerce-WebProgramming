let currentIndex = 0;

function updateCarousel() {
  const carouselInner = document.querySelector(".carousel-inner");
  const itemWidth = document.querySelector(".carousel-item").clientWidth;
  carouselInner.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
}

function nextSlide() {
  const totalItems = document.querySelectorAll(".carousel-item").length;
  if (currentIndex < totalItems - 1) {
    currentIndex++;
  } else {
    currentIndex = 0;
  }
  updateCarousel();
}

function prevSlide() {
  const totalItems = document.querySelectorAll(".carousel-item").length;
  if (currentIndex > 0) {
    currentIndex--;
  } else {
    currentIndex = totalItems - 1;
  }
  updateCarousel();
}
