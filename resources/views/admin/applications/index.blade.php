@extends('layouts.admin')

@section('title', 'Applications')
@section('header', 'Applications')

@section('header-actions')
    <a href="{{ route('admin.applications.create') }}"
        class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-medium px-4 py-2 rounded-xl hover:from-amber-700 hover:to-amber-800 transition-all ">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span class="hidden sm:inline">Add New</span>
    </a>
@endsection

@section('content')
    {{-- Mobile: Card Layout --}}
    <div class="space-y-4 md:hidden">
        @forelse($applications as $app)
            <div class="bg-white rounded-2xl border border-gray-200 p-4 relative shadow-sm">
                {{-- Numbering Badge --}}
                <div class="absolute -top-2 -left-2 w-7 h-7 bg-gray-800 text-white text-[11px] font-bold rounded-full flex items-center justify-center border-2 border-white shadow-sm z-10">
                    {{ $loop->iteration }}
                </div>
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 flex items-center justify-center"
                        style="background-color: {{ $app->theme_color }}20">
                        @if($app->image_url)
                            <img src="{{ $app->image_url }}" alt="{{ $app->name }}" class="w-10 h-10 object-contain">
                        @else
                            <span class="text-lg font-bold text-gray-500">{{ substr($app->name, 0, 2) }}</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-800">{{ $app->name }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-1">{{ $app->description }}</p>
                    </div>
                </div>
                <div class="flex flex-col gap-2 mb-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 uppercase font-medium">Theme</span>
                        <span class="inline-flex items-center gap-1.5">
                            <span class="w-4 h-4 rounded-full border border-gray-200"
                                style="background-color: {{ $app->theme_color }}"></span>
                            <code class="text-xs text-gray-600 font-mono">{{ $app->theme_color }}</code>
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 uppercase font-medium">Sort Order</span>
                        <span class="px-2 py-0.5 rounded bg-gray-100 text-gray-700 text-xs font-bold border border-gray-200">
                            {{ $app->sort_order }}
                        </span>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="text-xs text-gray-500 uppercase font-medium mt-1">Tags</span>
                        <div class="flex flex-wrap gap-1 flex-1">
                            @forelse($app->tags as $tag)
                                @php
                                    $hex = ltrim($tag->color ?? '#f59e0b', '#');
                                    $r = hexdec(substr($hex, 0, 2));
                                    $g = hexdec(substr($hex, 2, 2));
                                    $b = hexdec(substr($hex, 4, 2));
                                    $lum = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
                                    $isLight = $lum > 0.6;
                                    $txtColor = $isLight ? '#374151' : ($tag->color ?? '#d97706');
                                    $bgAlpha = $isLight ? '25' : '15';
                                    $bdAlpha = $isLight ? '50' : '30';
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium" 
                                      style="background-color: {{ $tag->color ?? '#f59e0b' }}{{ $bgAlpha }}; color: {{ $txtColor }}; border: 1px solid {{ $tag->color ?? '#f59e0b' }}{{ $bdAlpha }}">
                                    {{ $tag->name }}
                                </span>
                            @empty
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                    All
                                </span>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <a href="{{ $app->app_url }}" target="_blank"
                        class="text-sm text-blue-600 hover:underline truncate max-w-[150px]">
                        {{ parse_url($app->app_url, PHP_URL_HOST) }}
                    </a>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.applications.edit', $app) }}"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.applications.destroy', $app) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus aplikasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-200 p-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <p class="text-gray-600 font-medium mb-1">Belum ada aplikasi</p>
                <p class="text-gray-500 text-sm">Tambahkan aplikasi pertama Anda</p>
            </div>
        @endforelse
    </div>

    {{-- Desktop: Flex List Layout --}}
    <div class="hidden md:block bg-white rounded-2xl border border-gray-200 overflow-x-auto shadow-sm">
        <div class="min-w-[1000px]"> {{-- Ensuring a minimum width to prevent excessive squeezing --}}
            {{-- Header Row --}}
            <div class="flex items-center bg-gray-50 border-b border-gray-200 px-6 py-4">
                <div class="w-12 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">No.</div>
                <div class="w-16 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Sort</div>
                <div class="flex-1 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">App</div>
                <div class="w-48 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">URL</div>
                <div class="w-32 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Theme</div>
                <div class="w-56 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tags</div>
                <div class="w-24 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</div>
            </div>

            {{-- Body Rows --}}
            <div class="divide-y divide-gray-100">
                @forelse($applications as $app)
                    <div class="flex items-center hover:bg-gray-50 transition-colors px-6 py-4">
                        {{-- No. --}}
                        <div class="w-12 text-center text-sm font-medium text-gray-500">
                            {{ $loop->iteration }}
                        </div>

                        {{-- Sort --}}
                        <div class="w-16 text-center">
                            <span class="inline-flex items-center px-2 py-0.5 rounded bg-amber-50 text-amber-700 text-[11px] font-bold border border-amber-200">
                                {{ $app->sort_order }}
                            </span>
                        </div>

                        {{-- App --}}
                        <div class="flex-1 px-4 min-w-0">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 flex items-center justify-center border border-gray-100">
                                    @if($app->image_url)
                                        <img src="{{ $app->image_url }}" alt="{{ $app->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-lg font-bold text-gray-300">{{ substr($app->name, 0, 2) }}</span>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-semibold text-gray-800 truncate">{{ $app->name }}</h4>
                                    <p class="text-[11px] text-gray-500 truncate mt-0.5">{{ $app->description }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- URL --}}
                        <div class="w-48 px-4">
                            <a href="{{ $app->app_url }}" target="_blank"
                                class="text-sm text-blue-600 hover:text-blue-800 hover:underline truncate inline-block max-w-full font-medium">
                                {{ parse_url($app->app_url, PHP_URL_HOST) }}
                            </a>
                        </div>

                        {{-- Theme --}}
                        <div class="w-32 px-4">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full border border-gray-200 shadow-sm flex-shrink-0"
                                    style="background-color: {{ $app->theme_color }}"></span>
                                <code class="text-[11px] text-gray-500 font-mono">{{ strtoupper($app->theme_color) }}</code>
                            </div>
                        </div>

                        {{-- Tags --}}
                        <div class="w-56 px-4">
                            <div class="flex flex-wrap gap-1">
                                @forelse($app->tags as $tag)
                                    @php
                                        $hex = ltrim($tag->color ?? '#f59e0b', '#');
                                        $r = hexdec(substr($hex, 0, 2));
                                        $g = hexdec(substr($hex, 2, 2));
                                        $b = hexdec(substr($hex, 4, 2));
                                        $lum = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
                                        $isLight = $lum > 0.6;
                                        $txtColor = $isLight ? '#374151' : ($tag->color ?? '#d97706');
                                        $bgAlpha = $isLight ? '25' : '15';
                                        $bdAlpha = $isLight ? '50' : '30';
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium" 
                                          style="background-color: {{ $tag->color ?? '#f59e0b' }}{{ $bgAlpha }}; color: {{ $txtColor }}; border: 1px solid {{ $tag->color ?? '#f59e0b' }}{{ $bdAlpha }}">
                                        {{ $tag->name }}
                                    </span>
                                @empty
                                    <span class="text-[10px] text-gray-400">No Tags</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="w-24 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.applications.edit', $app) }}"
                                    class="p-2 text-gray-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.applications.destroy', $app) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus aplikasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                        title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium mb-1">Belum ada aplikasi</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection