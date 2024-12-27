const hamburger = document.getElementById("hamburger");
const mobileNav = document.getElementById("mobileNav");
const closeBtn = document.getElementById("closeBtn");
const overlay = document.getElementById("overlay");

// Toggle mobile navigation menu and overlay on hamburger icon click
hamburger.addEventListener("click", () => {
  mobileNav.classList.add("active");
  overlay.classList.add("active");
});

// Close the mobile navigation menu and overlay on close button click
closeBtn.addEventListener("click", () => {
  mobileNav.classList.remove("active");
  overlay.classList.remove("active");
});

// Close the menu and overlay when overlay is clicked
overlay.addEventListener("click", () => {
  mobileNav.classList.remove("active");
  overlay.classList.remove("active");
});

// Automatically close the mobile navigation menu and overlay on window resize
window.addEventListener("resize", () => {
  if (window.innerWidth > 768) {
    mobileNav.classList.remove("active");
    overlay.classList.remove("active");
  }
});

//  Slider Start

const slider = document.querySelector(".slider");
const slides = document.querySelectorAll(".slide");
let currentSlide = 0;

function updateSliderPosition() {
  const slideWidth = slides[0].offsetWidth + 20; // Slide width + gap
  slider.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
}

function nextSlide() {
  if (currentSlide < slides.length - 3) {
    // Ensure 3 slides remain visible
    currentSlide++;
    updateSliderPosition();
  }
}

function prevSlide() {
  if (currentSlide > 0) {
    currentSlide--;
    updateSliderPosition();
  }
}

// Initialize the slider to ensure correct positioning
window.addEventListener("resize", updateSliderPosition);

updateSliderPosition();

//  Slider End
