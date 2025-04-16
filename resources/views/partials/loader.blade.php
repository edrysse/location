<div id="loader" class="fixed inset-0 flex flex-col items-center justify-center bg-white z-50">
    <!-- استخدام الترجمة للـ alt الخاص بالصورة -->
    <img src="{{ asset('assets/new-logo.png') }}" alt="{{ __('messages.logo_alt') }}" class="h-28 animate-pulse-scale">
    <!-- استخدام الترجمة للنص الذي يظهر أثناء التحميل -->
    <p class="mt-4 text-gray-700 text-lg">{{ __('messages.loading') }}</p>
</div>

<style>
    @keyframes pulseScale {
        0% { transform: scale(0.95); opacity: 0.8; }
        50% { transform: scale(1); opacity: 1; }
        100% { transform: scale(0.95); opacity: 0.8; }
    }
    .animate-pulse-scale {
        animation: pulseScale 1.5s ease-in-out infinite;
    }
    .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease-out;
        pointer-events: none;
    }
</style>

<script>
    window.addEventListener('load', function() {
        const loader = document.getElementById('loader');
        loader.classList.add('fade-out');
        setTimeout(() => {
            loader.style.display = 'none';
        }, 500);
    });
</script>
