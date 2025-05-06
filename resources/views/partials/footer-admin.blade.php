<footer dir="ltr" class="custom-footer bg-gray-900 text-white py-8 border-t border-gray-800">
  <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
    <div class="mb-4 md:mb-0 flex items-center gap-2">
      <img src="{{ asset('assets/new-logo.png') }}" alt="Logo" class="h-10 w-10 rounded-full shadow-lg">
      <span class="text-lg font-bold tracking-wide">لوحة تحكم الأدمن</span>
    </div>
    <div class="flex flex-col md:flex-row gap-4 md:gap-8 items-center">
      <span class="text-sm">إدارة النظام - جميع الحقوق محفوظة &copy; <span id="footer-year-admin"></span></span>
      <div class="flex gap-3">
        <a href="mailto:admin@diamantinacar.ma" class="hover:text-red-400 transition"><i class="fas fa-envelope"></i></a>
        <a href="https://wa.me/212660565730" class="hover:text-green-400 transition"><i class="fab fa-whatsapp"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100065028038032#" class="hover:text-blue-400 transition"><i class="fab fa-facebook-f"></i></a>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('footer-year-admin').textContent = new Date().getFullYear();
  </script>
</footer>
