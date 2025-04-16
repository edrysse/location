<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>up</title>

  <!-- تضمين Font Awesome للأيقونات -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* زر الذهاب للأعلى */
    #scrollToTop {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      border: none;
      outline: none;
      background: conic-gradient(#b40202 0deg, red 0deg, #ecf0f1 0deg, #ecf0f1 360deg);
      color: #fff;
      font-size: 24px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s;
      z-index: 9999;
    }

    /* زر واتساب */
    #whatsappBtn {
      position: fixed;
      bottom: 90px; /* فوق زر up */
      right: 30px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      border: none;
      outline: none;
      background: #25D366;
      color: white;
      font-size: 24px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      z-index: 9999;
      text-decoration: none;
    }

    /* إظهار زر up عند التمرير */
    #scrollToTop.show {
      opacity: 1;
      pointer-events: auto;
    }
  </style>
</head>
<body>

  <!-- زر واتساب -->
  <a id="whatsappBtn" title=" call via whatsapp" href="https://wa.me/0660565730" target="_blank">
    <i class="fab fa-whatsapp"></i>
  </a>

  <!-- زر الذهاب للأعلى -->
  <button id="scrollToTop" title="up ">↑</button>

  <script>
    const scrollToTopBtn = document.getElementById("scrollToTop");

    window.addEventListener("scroll", () => {
      let scrollTop = window.scrollY;
      let docHeight = document.documentElement.scrollHeight - window.innerHeight;
      let scrollFraction = scrollTop / docHeight;
      let scrollDegrees = scrollFraction * 360;

      scrollToTopBtn.style.background = `conic-gradient(red 0deg, red ${scrollDegrees}deg, #ecf0f1 ${scrollDegrees}deg, #ecf0f1 360deg)`;

      if (scrollTop > 100) {
        scrollToTopBtn.classList.add("show");
      } else {
        scrollToTopBtn.classList.remove("show");
      }
    });

    scrollToTopBtn.addEventListener("click", () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  </script>
</body>
</html>
