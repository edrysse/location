<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>up</title>

  <!-- Font Awesome للأيقونات -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* زر الرجوع للأعلى */
    #scrollToTop {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s, width 0.2s, height 0.2s;
      z-index: 9999;
      overflow: visible;
    }
    #scrollToTop.show {
      opacity: 1;
      pointer-events: auto;
    }
    #scrollToTop .arrow {
      position: relative;
      z-index: 3;
      color: red;
      font-size: 18px;
    }
    #progressCircle {
      position: absolute;
      top: 0;
      left: 0;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: conic-gradient(red 0deg, #ecf0f1 0deg);
      transform: rotate(-90deg);
      z-index: 1;
    }
    #progressCircle::before {
      content: "";
      position: absolute;
      top: 4px;
      left: 4px;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: #fff;
      z-index: 2;
    }
    /* زر واتساب */
    #whatsappBtn {
      position: fixed;
      bottom: 70px;
      right: 20px;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #25D366;
      color: white;
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      z-index: 9999;
      text-decoration: none;
    }
    @media (max-width: 768px) {
      #scrollToTop {
        right: 10px;
        bottom: 10px;
      }
      #whatsappBtn {
        right: 10px;
        bottom: 50px;
      }
    }
  </style>
</head>
<body>

  <!-- زر واتساب -->
  @if(!auth()->check() || (auth()->check() && auth()->user()->id !== 1))
  <a id="whatsappBtn" title="WhatsApp" href="https://wa.me/212660565730" target="_blank">
    <i class="fab fa-whatsapp"></i>
  </a>
  @endif
  <!-- زر الرجوع للأعلى -->
  <button id="scrollToTop" title="Up">
    <span class="arrow">↑</span>
    <div id="progressCircle"></div>
  </button>

  <script>
    const scrollToTopBtn = document.getElementById("scrollToTop");
    const progressCircle = document.getElementById("progressCircle");

    window.addEventListener("scroll", () => {
      const scrollTop = window.scrollY;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      const scrollPercent = scrollTop / docHeight;
      const scrollDegrees = scrollPercent * 360;

      // تحديث التدرّج الدائري حسب نسبة التمرير
      progressCircle.style.background =
        `conic-gradient(red 0deg, red ${scrollDegrees}deg, #ecf0f1 ${scrollDegrees}deg)`;

      // إظهار أو إخفاء الزر
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
