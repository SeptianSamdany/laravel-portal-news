<div class="sidebar-advertisement">
    @php
        $sidebarAds = App\Models\Advertisement::where('is_active', true)->limit(3)->get();
    @endphp

    @if($sidebarAds->count() > 0)
        <div class="space-y-6">
            <div class="text-xs text-gray-500 uppercase tracking-wider font-medium border-b border-gray-200 pb-2">
                Sponsored
            </div>
            
            @foreach($sidebarAds as $ad)
                <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                    <a href="{{ $ad->link }}" 
                       target="_blank" 
                       rel="noopener sponsored"
                       class="block group">
                        
                        <div class="mb-3">
                            <img src="/storage/{{ $ad->image }}" 
                                 alt="{{ $ad->title }}"
                                 class="w-full h-32 object-cover rounded-md">
                        </div>
                        
                        @if($ad->title)
                            <h4 class="font-semibold text-gray-800 text-sm mb-2 group-hover:text-red-600 transition-colors duration-200 line-clamp-2">
                                {{ $ad->title }}
                            </h4>
                        @endif
                        
                        @if($ad->description)
                            <p class="text-gray-600 text-xs leading-relaxed line-clamp-3">
                                {{ Str::limit($ad->description, 80) }}
                            </p>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>