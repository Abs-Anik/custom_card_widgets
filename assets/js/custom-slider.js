document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('.gallery > img');
    let currentIndex = 0;
  
    function showNextImage() {
      images[currentIndex].style.display = 'none'; // Hide the current image
      currentIndex = (currentIndex + 1) % images.length; // Move to the next image
      images[currentIndex].style.display = 'block'; // Show the next image
    }
  
    // Show the next image every 3 seconds
    setInterval(showNextImage, 3000);
  });
  