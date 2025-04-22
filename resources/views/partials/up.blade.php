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
      bottom: 30px;
      right: 30px;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      /* نزيل الخلفية البيضاء لأننا سنرسمها داخل الدائرة */
      background: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s;
      z-index: 9999;
      overflow: visible; /* لعرض إطار التقدم بالكامل */
    }

    #scrollToTop.show {
      opacity: 1;
      pointer-events: auto;
    }

    /* السهم داخل الزر */
    #scrollToTop .arrow {
      position: relative;
      z-index: 3; /* فوق كل شيء */
      color: red;
      font-size: 24px;
    }

    /* الإطار الدائري المتحرك */
    #progressCircle {
      position: absolute;
      top: 0;
      left: 0;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      /* تدرّج دائري بناءً على نسبة التمرير */
      background: conic-gradient(red 0deg, #ecf0f1 0deg);
      transform: rotate(-90deg); /* يبدأ التدرج من أعلى */
      z-index: 1;
    }

    /* لإخفاء وسط الدائرة وترك الإطار فقط */
    #progressCircle::before {
      content: "";
      position: absolute;
      top: 6px;
      left: 6px;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: #fff; /* نفس لون خلفية الصفحة */
      z-index: 2;
    }

    /* زر واتساب */
    #whatsappBtn {
      position: fixed;
      bottom: 100px;
      right: 30px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: #25D366;
      color: white;
      font-size: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      z-index: 9999;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <!-- زر واتساب -->
  <a id="whatsappBtn" title="WhatsApp" href="https://wa.me/212660565730" target="_blank">
    <i class="fab fa-whatsapp"></i>
  </a>

  <!-- زر الرجوع للأعلى -->
  <button id="scrollToTop" title="Up">
    <!-- نغلف السهم في عنصر لتعيين z-index -->
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
