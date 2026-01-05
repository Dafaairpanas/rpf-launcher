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
            <div class="bg-white rounded-2xl border border-gray-200 p-4">
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
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-xs text-gray-500 uppercase font-medium">Theme</span>
                    <span class="inline-flex items-center gap-1.5">
                        <span class="w-4 h-4 rounded-full border border-gray-200"
                            style="background-color: {{ $app->theme_color }}"></span>
                        <code class="text-xs text-gray-600 font-mono">{{ $app->theme_color }}</code>
                    </span>
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

    {{-- Desktop: Table Layout --}}
    <div class="hidden md:block bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">App</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">URL</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Theme</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($applications as $app)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 flex items-center justify-center">
                                    @if($app->image_url)
                                        <img src="{{ $app->image_url }}" alt="{{ $app->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-lg font-bold text-gray-400">{{ substr($app->name, 0, 2) }}</span>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 truncate">{{ $app->name }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ $app->description }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ $app->app_url }}" target="_blank"
                                class="text-sm text-blue-600 hover:underline truncate block max-w-xs">
                                {{ $app->app_url }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full border border-gray-200 shadow-sm"
                                    style="background-color: {{ $app->theme_color }}"></span>
                                <code class="text-xs text-gray-500 font-mono">{{ $app->theme_color }}</code>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.applications.edit', $app) }}"
                                    class="p-2 text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
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
                                        class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-600 font-medium mb-1">Belum ada aplikasi</p>
                                <p class="text-gray-500 text-sm">Tambahkan aplikasi pertama Anda</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection