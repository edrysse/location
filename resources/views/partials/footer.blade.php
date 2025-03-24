<footer class="custom-footer">
  <div class="container">
    <div class="footer-content">
      <!-- النصف الأيسر: الخريطة -->
      <div class="footer-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3396.8903034677296!2d-7.997843874640759!3d31.636853741379525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdafee8d0646b1c5%3A0x6b91008ef7884c88!2sDiamantina%20car%20rental!5e0!3m2!1sar!2s!4v1742535516858!5m2!1sar!2s"
          width="100%" height="300" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>

      <!-- النصف الأيمن: النص والمعلومات -->
      <div class="footer-text">
        <h5 class="footer-title">{{ __('messages.footer_title') }}</h5>
        <p class="footer-description">
          {{ __('messages.footer_description') }}
        </p>

        <nav class="footer-nav">
          <a href="/about">{{ __('messages.footer_nav_about') }}</a>
          <a href="/terms">{{ __('messages.footer_nav_terms') }}</a>
          <a href="/contact/create">{{ __('messages.footer_nav_contact') }}</a>
          <a href="/terms">{{ __('messages.footer_nav_privacy') }}</a>
          <a href="/terms">{{ __('messages.footer_nav_general') }}</a>
          <a href="/terms">{{ __('messages.footer_nav_payment') }}</a>
        </nav>

        <div class="footer-contact">
          <p><i class="fas fa-map-marker-alt"></i> {{ __('messages.footer_contact_address') }}</p>
          <p><i class="fas fa-phone"></i> {{ __('messages.footer_contact_phone') }}</p>
          <p>
            <i class="fas fa-envelope"></i>
            <a href="mailto:{{ __('messages.footer_contact_email') }}">{{ __('messages.footer_contact_email') }}</a>
          </p>
        </div>

        <div class="footer-social">
          <a href="https://www.facebook.com/profile.php?id=100065028038032#"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/diamantinacar/"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>

    <p class="footer-copy" id="footer-year"></p>
  </div>
</footer>


<script>
  const currentYear = new Date().getFullYear();
  const footerCopyTemplate = {!! json_encode(__('messages.footer_copy')) !!};
  document.getElementById('footer-year').innerHTML = footerCopyTemplate.replace(':year', currentYear);
</script>

<style>
  .custom-footer {
    background: linear-gradient(135deg, #1a1a1a, #333333);
    color: #e0e0e0;
    text-align: center;
    padding: 40px 20px;
    font-family: 'Arial', sans-serif;
  }

  .footer-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
  }

  .footer-map {
    flex: 1;
    max-width: 45%;
  }

  .footer-map iframe {
    width: 100%;
    border-radius: 8px;
  }

  .footer-text {
    flex: 1;
    max-width: 50%;
    text-align: left;
  }

  .footer-title {
    font-size: 2rem;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 15px;
  }

  .footer-description {
    font-size: 1.1rem;
    margin-bottom: 15px;
  }

  .footer-nav a {
    display: inline-block;
    color: #e0e0e0;
    text-decoration: none;
    margin: 5px 10px;
    font-size: 1rem;
    transition: color 0.3s;
  }

  .footer-nav a:hover {
    color: rgb(1, 135, 224);
  }

  .footer-contact p {
    margin: 5px 0;
    font-size: 1rem;
  }

  .footer-contact i {
    margin-right: 8px;
    color: rgb(1, 135, 224);
  }

  .footer-social {
    margin-top: 15px;
  }

  .footer-social a {
    display: inline-block;
    color: #e0e0e0;
    background: rgba(255, 255, 255, 0.1);
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    margin: 5px;
    border-radius: 50%;
    transition: background 0.3s, transform 0.3s;
  }

  .footer-social a:hover {
    background: rgb(1, 135, 224);
    transform: scale(1.1);
  }

  .footer-copy {
    margin-top: 20px;
    font-size: 0.9rem;
    opacity: 0.8;
    text-align: center;
  }

  @media (max-width: 768px) {
    .footer-map { width: 100% !important; }
    .footer-content {
      flex-direction: column;
      text-align: center;
    }
    .footer-map, .footer-text {
      max-width: 100%;
      text-align: center;
    }
    .footer-map iframe {
      height: 250px;
    }
    .footer-social {
      text-align: center;
    }
  }
</style>
