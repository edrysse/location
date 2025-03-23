<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>up</title>
  <style>

    /* محتوى تجريبي لتمرير الصفحة */
  
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
      background: conic-gradient(#3498db 0deg, #3498db 0deg, #ecf0f1 0deg, #ecf0f1 360deg);
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
      z-index: 9999; /* تأكد من أن هذه القيمة أعلى من قيم z-index للعناصر الأخرى */

    }


    /* إظهار الزر عند التمرير */
    #scrollToTop.show {
      opacity: 1;
      pointer-events: auto;
    }
  </style>
</head>
<body>
  <div class="content">
    <!-- محتوى الصفحة -->
  </div>
  
  <!-- زر الذهاب للأعلى -->
  <button id="scrollToTop" title="scroll To Top ">↑</button>
  
  <script>
    const scrollToTopBtn = document.getElementById("scrollToTop");
    
    window.addEventListener("scroll", () => {
      // حساب نسبة التمرير من 0 إلى 360 درجة
      let scrollTop = window.scrollY;
      let docHeight = document.documentElement.scrollHeight - window.innerHeight;
      let scrollFraction = scrollTop / docHeight;
      let scrollDegrees = scrollFraction * 360;
      
      // تحديث خلفية الزر باستخدام conic-gradient
      scrollToTopBtn.style.background = `conic-gradient(#3498db 0deg, #3498db ${scrollDegrees}deg, #ecf0f1 ${scrollDegrees}deg, #ecf0f1 360deg)`;
      
      // إظهار أو إخفاء الزر بناءً على التمرير
      if (scrollTop > 100) {
        scrollToTopBtn.classList.add("show");
      } else {
        scrollToTopBtn.classList.remove("show");
      }
    });
    
    // عند النقر على الزر يتم التمرير بسلاسة إلى الأعلى
    scrollToTopBtn.addEventListener("click", () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  </script>
</body>
</html>
