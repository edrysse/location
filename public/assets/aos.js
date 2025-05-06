// Animation on Scroll (AOS) minimal script
// Adds aos-animate class when element is in viewport
(function(){
  function animateOnScroll() {
    var elements = document.querySelectorAll('[data-aos]');
    var windowHeight = window.innerHeight;
    elements.forEach(function(el) {
      var rect = el.getBoundingClientRect();
      if(rect.top < windowHeight - 50) {
        el.classList.add('aos-animate');
      }
    });
  }
  window.addEventListener('scroll', animateOnScroll);
  window.addEventListener('resize', animateOnScroll);
  document.addEventListener('DOMContentLoaded', animateOnScroll);
})();
