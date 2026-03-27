@extends('layouts.admin')

@section('title', 'Tags')
@section('header', 'Tags')

@section('header-actions')
    <button onclick="openTagModal()"
        class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-medium px-4 py-2 rounded-xl hover:from-amber-700 hover:to-amber-800 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span class="hidden sm:inline">Add New Tag</span>
    </button>
@endsection

@section('content')
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">No.</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Color</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tags as $tag)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800">{{ $tag->name }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($tag->color)
                            <span class="inline-flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full border border-gray-200 shadow-sm"
                                    style="background-color: {{ $tag->color }}"></span>
                                <code class="text-xs text-gray-500 font-mono">{{ $tag->color }}</code>
                            </span>
                            @else
                            <span class="text-sm text-gray-400">Default</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="openTagModal({{ $tag->id }}, '{{ addslashes($tag->name) }}', '{{ $tag->color }}')"
                                    class="p-2 text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus tag ini?')">
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
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <p class="text-gray-600 font-medium mb-1">Belum ada tag</p>
                                <p class="text-gray-500 text-sm">Tambahkan tag pertama Anda</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Form -->
    <div id="tagModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm" onclick="closeTagModal()"></div>
        <div class="relative bg-white rounded-2xl w-full max-w-lg p-6 md:p-8 shadow-xl transform transition-all scale-95 opacity-0 duration-200" id="tagModalContent">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800" id="tagModalTitle">Tambah Tag Baru</h3>
                <button type="button" onclick="closeTagModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="tagForm" method="POST" action="{{ route('admin.tags.store') }}">
                @csrf
                <input type="hidden" name="_method" id="tagMethod" value="POST">
                
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Tag <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required maxlength="30" class="w-full px-4 py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent outline-none transition-all">
                    </div>

                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Warna (Hex)</label>
                        <div class="flex items-center gap-4">
                            <input type="color" id="color_picker" class="w-12 h-12 rounded-xl cursor-pointer border-2 border-gray-200 p-0.5" onchange="document.getElementById('color').value = this.value">
                            <input type="text" id="color" name="color" pattern="^#[0-9A-Fa-f]{6}$" maxlength="7" placeholder="#f59e0b" class="flex-1 px-4 py-3 text-base font-mono border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent outline-none transition-all" onchange="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) document.getElementById('color_picker').value = this.value">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <button type="button" onclick="closeTagModal()" class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-medium px-5 py-2.5 rounded-xl hover:from-amber-700 hover:to-amber-800 transition-all shadow-sm">
                        Simpan Tag
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('tagModal');
    const modalContent = document.getElementById('tagModalContent');
    const form = document.getElementById('tagForm');
    const methodInput = document.getElementById('tagMethod');
    const title = document.getElementById('tagModalTitle');
    const nameInput = document.getElementById('name');
    const colorInput = document.getElementById('color');
    const colorPicker = document.getElementById('color_picker');

    function openTagModal(id = null, name = '', color = '') {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        if (id) {
            title.textContent = 'Edit Tag';
            form.action = `/admin/tags/${id}`;
            methodInput.value = 'PUT';
            nameInput.value = name;
            colorInput.value = color;
            colorPicker.value = color ? color : '#f59e0b';
        } else {
            title.textContent = 'Tambah Tag Baru';
            form.action = "{{ route('admin.tags.store') }}";
            methodInput.value = 'POST';
            nameInput.value = '';
            colorInput.value = '';
            colorPicker.value = '#f59e0b';
        }
    }

    function closeTagModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }
</script>
@endpush
