<footer @if(app()->getLocale()==='ar') dir="ltr" @endif class="custom-footer bg-[#4b5a66] text-white pt-6 pb-0 flex flex-col justify-between">
  <div class="container w-full max-w-screen-xl mx-auto px-2 py-6 flex-1 flex flex-col justify-center">
    <div class="flex flex-col sm:flex-col md:flex-row justify-between items-center md:items-start gap-4 md:gap-20 pb-4">
      <!-- À PROPOS DE NOUS -->
      <div class="w-full md:w-1/3 mb-6 md:mb-0 text-left">
        <h4 class="font-extrabold uppercase mb-2 text-lg md:text-xl tracking-widest">{{ __('messages.footer_about_title') }}</h4>
        <p class="text-sm md:text-base leading-relaxed">{{ __('messages.footer_professional_about') }}</p>
        
      </div>
      <!-- CONTACTEZ-NOUS -->
      <div class="w-full md:w-1/3 mb-6 md:mb-0 text-left">
        <h4 class="font-extrabold uppercase mb-2 text-lg md:text-xl tracking-widest">{{ __('messages.footer_contact_title') }}</h4>
        <ul class="space-y-2 text-sm md:text-base">
          <li><i class="fas fa-map-marker-alt mr-1 text-base md:text-xl"></i> {{ __('messages.footer_contact_address') }}</li>
          <li><i class="fas fa-phone mr-1 text-base md:text-xl"></i> {{ __('messages.footer_contact_phone') }}</li>
          <li><i class="fas fa-envelope mr-1 text-base md:text-xl"></i> <a href="mailto:{{ __('messages.footer_contact_email') }}" class="hover:text-red-600 transition">{{ __('messages.footer_contact_email') }}</a></li>
        </ul>
      </div>
      <!-- RÉSEAU SOCIAL -->
      <div class="w-full md:w-1/3 flex flex-col items-start md:items-center mb-2 md:mb-0 text-left md:text-center">
        <h4 class="font-extrabold uppercase mb-2 text-lg md:text-xl tracking-widest">{{ __('messages.footer_social_title') }}</h4>
        <div class="flex flex-row gap-3 justify-center" style="flex-direction: row !important;">
          <a href="https://www.facebook.com/profile.php?id=100065028038032#" class="bg-gray-500 hover:bg-red-600 rounded-full w-9 h-9 flex items-center justify-center transition text-xl md:w-12 md:h-12 md:text-2xl" title="{{ __('messages.facebook') }}"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/diamantinacar.ma/" class="bg-gray-500 hover:bg-red-600 rounded-full w-9 h-9 flex items-center justify-center transition text-xl md:w-12 md:h-12 md:text-2xl" title="{{ __('messages.instagram') }}"><i class="fab fa-instagram"></i></a>
          
          <a href="https://wa.me/212660565730" class="bg-gray-500 hover:bg-[#25D366] rounded-full w-9 h-9 flex items-center justify-center transition text-xl md:w-12 md:h-12 md:text-2xl" title="{{ __('messages.whatsapp') }}"><i class="fab fa-whatsapp"></i></a>
          
          
        </div>
      </div>
    </div>
    <!-- أزرار الصفحات الثابتة -->
    <div class="w-full flex flex-row justify-center gap-4 mt-6">
      <a href="{{ route('nav.about') }}" class="footer-link-plain">{{ __('messages.about_us') }}</a>
      <a href="{{ route('nav.terms') }}" class="footer-link-plain">{{ __('messages.terms_conditions') }}</a>
    </div>
  </div>
  <div class="text-center text-xs text-gray-200 py-5 bg-[#2d3840] w-full tracking-wider">
    Copyright {{ date('Y') }} {{ __('messages.footer_rights') }}
  </div>
</footer>

<style>
  .custom-footer {
    background-color: #4b5a66;
    color: #ffffff;
    font-family: var(--bs-body-font-family), Arial, sans-serif;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .custom-footer h4, .custom-footer p, .custom-footer li, .custom-footer a, .custom-footer ul {
    font-family: var(--bs-body-font-family), Arial, sans-serif;
  }
  .custom-footer ul li i {
    color: #e53e3e;
    min-width: 18px;
    text-align: center;
    font-size: 1.4rem;
    vertical-align: middle;
  }
  .custom-footer a {
    color: inherit;
    transition: color 0.2s, background 0.2s;
  }
  .custom-footer a:hover, .custom-footer .footer-social a:hover {
    color: #e53e3e !important;
    background: none !important;
  }
  .footer-social a {
    background: #6b7280;
    color: #fff;
    font-size: 1.7rem;
    margin-right: 1rem;
    transition: background 0.2s, color 0.2s;
    width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .footer-social a:hover {
    background: #25D366 !important;
    color: #fff !important;
  }
  .footer-social a:hover {
    background: #e53e3e !important;
    color: #fff !important;
  }
  .custom-footer .text-xs {
    font-size: 1rem;
    letter-spacing: 1px;
  }
  .footer-link {
    color: #25D366;
    font-weight: bold;
    margin-bottom: 0.2rem;
    display: inline-block;
    transition: color 0.2s;
    background: none;
    padding: 0;
  }
  .footer-link:hover {
    color: #e53e3e;
    text-decoration: underline;
  }
  .footer-link-plain {
    display: inline-block;
    color: #fff;
    font-weight: 500;
    font-size: 1.08rem;
    border: 1.2px solid rgba(255,255,255,0.25);
    border-radius: 18px;
    padding: 0.35rem 1.25rem;
    margin: 0 0.4rem;
    background: transparent;
    transition: color 0.18s, border 0.18s, background 0.18s;
    letter-spacing: 0.5px;
    text-decoration: none;
    box-shadow: none;
  }
  .footer-link-plain:hover {
    color: #25D366;
    border: 1.2px solid #25D366;
    background: rgba(255,255,255,0.06);
    text-decoration: none;
  }
  .custom-footer .flex-col.md\:flex-row {
    gap: 3rem !important;
  }
  @media (max-width: 768px) {
    .custom-footer .flex {
      flex-direction: column !important;
      text-align: center;
    }
    .custom-footer .md\:w-1\/3 {
      width: 100% !important;
      max-width: 100% !important;
      margin-bottom: 1.2rem !important;
    }
    .custom-footer .footer-social {
      justify-content: center;
    }
    .custom-footer .container {
      padding: 1.25rem 0.5rem !important;
    }
  }
</style>
