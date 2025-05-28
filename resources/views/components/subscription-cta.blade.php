{{-- resources/views/components/subscription-cta.blade.php --}}
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16 px-4 rounded-xl shadow-lg">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Stay Updated with Our Newsletter
        </h2>
        <p class="text-lg md:text-xl mb-8 text-blue-100">
            Get the latest news, tips, and exclusive content delivered straight to your inbox.
        </p>
        
        <!-- CTA Button: Login required -->
        <div class="text-center">
            @auth
                <a 
                    href="{{ route('subscription.form') }}" 
                    class="inline-block bg-white text-blue-700 font-semibold px-6 py-3 rounded-full shadow hover:bg-blue-100 transition"
                >
                    Lengkapi Formulir Berlangganan
                </a>
            @else
                <a 
                    href="{{ route('login') }}" 
                    class="inline-block bg-white text-blue-700 font-semibold px-6 py-3 rounded-full shadow hover:bg-blue-100 transition"
                >
                    Login untuk Berlangganan
                </a>
            @endauth
        </div>
        
        <p class="text-sm text-blue-200 mt-4">
            We respect your privacy. Unsubscribe at any time.
        </p>
    </div>
</div>