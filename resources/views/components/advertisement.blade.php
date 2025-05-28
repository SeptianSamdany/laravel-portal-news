<!-- Advertisement Section Component -->
<div class="advertisement-section my-8">
    @php
        // Fetch active advertisements (you can customize the query as needed)
        $advertisements = App\Models\Advertisement::where('is_active', true)->get();
    @endphp

    @if($advertisements->count() > 0)
        {{-- <!-- Single Advertisement Display -->
        @if($advertisements->count() == 1) --}}
            @php 
                $ad = App\Models\Advertisement::where('is_active', true)->inRandomOrder()->first();
            @endphp
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                <div class="text-xs text-gray-500 uppercase font-medium mb-3">Advertisement</div>
                
                <a href="{{ $ad->link }}" 
                   target="_blank" 
                   rel="noopener sponsored"
                   class="block group">
                    
                    <div class="mb-4">
                        <img src="/storage/{{ $ad->image }}" 
                             alt="{{ $ad->title }}"
                             class="w-full h-auto max-h-96 object-contain mx-auto rounded-md shadow-sm">
                    </div>
                    
                    @if($ad->title)
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 group-hover:text-red-600 transition-colors duration-200">
                            {{ $ad->title }}
                        </h3>
                    @endif
                    
                    @if($ad->description)
                        <p class="text-gray-600 text-sm leading-relaxed max-w-2xl mx-auto">
                            {{ $ad->description }}
                        </p>
                    @endif
                </a>
            </div>

        {{-- <!-- Multiple Advertisements Carousel -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6"
                x-data="{
                    currentAd: 0,
                    ads: {{ Illuminate\Support\Js::from($advertisements) }},
                    timer: null,
                    autoplaySpeed: 8000,
                    isHovering: false,
                    
                    init() {
                        if (this.ads.length > 1) {
                            this.startTimer();
                        }
                    },
                    
                    startTimer() {
                        if (!this.isHovering && this.ads.length > 1) {
                            clearInterval(this.timer);
                            this.timer = setInterval(() => {
                                this.nextAd();
                            }, this.autoplaySpeed);
                        }
                    },
                    
                    pauseTimer() {
                        this.isHovering = true;
                        clearInterval(this.timer);
                    },
                    
                    resumeTimer() {
                        this.isHovering = false;
                        this.startTimer();
                    },
                    
                    nextAd() {
                        this.currentAd = (this.currentAd + 1) % this.ads.length;
                    },
                    
                    goToAd(index) {
                        this.currentAd = index;
                        this.resetTimer();
                    },
                    
                    resetTimer() {
                        clearInterval(this.timer);
                        if (!this.isHovering) {
                            this.startTimer();
                        }
                    }
                }"
                @mouseenter="pauseTimer()"
                @mouseleave="resumeTimer()">
            
            <div class="text-xs text-gray-500 uppercase tracking-wider font-medium mb-4 text-center">Advertisement</div>
            
            <div class="relative">
                <template x-for="(ad, index) in ads" :key="index">
                    <div x-show="currentAd === index"
                            x-transition:enter=""
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in-out duration-500"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="text-center">
                        
                        <a :href="ad.link" 
                            target="_blank" 
                            rel="noopener sponsored"
                            class="block group">
                            
                            <div class="mb-4">
                                <img :src="'/storage/' + ad.image" 
                                        :alt="ad.title"
                                        class="w-full h-auto max-h-96 object-contain mx-auto rounded-md shadow-sm">
                            </div>
                            
                            <h3 x-show="ad.title" 
                                x-text="ad.title"
                                class="text-lg font-semibold text-gray-800 mb-2 group-hover:text-red-600 transition-colors duration-200">
                            </h3>
                            
                            <p x-show="ad.description" 
                                x-text="ad.description"
                                class="text-gray-600 text-sm leading-relaxed max-w-2xl mx-auto">
                            </p>
                        </a>
                    </div>
                </template>
                
                <!-- Indicators for multiple ads -->
                <div x-show="ads.length > 1" class="flex justify-center mt-6 space-x-2">
                    <template x-for="(ad, index) in ads" :key="index">
                        <button @click="goToAd(index)"
                                class="w-2 h-2 rounded-full transition-colors duration-200 focus:outline-none"
                                :class="currentAd === index ? 'bg-red-500' : 'bg-gray-300 hover:bg-gray-400'">
                            <span class="sr-only" x-text="`Go to advertisement ${index + 1}`"></span>
                        </button>
                    </template>
                </div>
            </div>
        </div> --}}
    @endif
</div>