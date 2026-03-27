@extends('layouts.admin')

@section('title', 'Roles')
@section('header', 'Roles')

@section('header-actions')
    <button onclick="openRoleModal()"
        class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-medium px-4 py-2 rounded-xl hover:from-amber-700 hover:to-amber-800 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span class="hidden sm:inline">Add New</span>
    </button>
@endsection

@section('content')
    {{-- Mobile: Card Layout --}}
    <div class="space-y-4 md:hidden">
        @forelse($roles as $role)
            <div class="bg-white rounded-2xl border border-gray-200 p-4 relative shadow-sm">
                <div class="absolute -top-2 -left-2 w-7 h-7 bg-gray-800 text-white text-[11px] font-bold rounded-full flex items-center justify-center border-2 border-white shadow-sm z-10">
                    {{ $loop->iteration }}
                </div>
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-semibold text-gray-800 text-lg">{{ $role->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $role->users_count }} user terdaftar</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $role->users_count }}
                    </span>
                </div>
                <div class="flex items-center justify-end gap-2 pt-3 border-t border-gray-100">
                    <button onclick="openRoleModal({{ $role->id }}, '{{ addslashes($role->name) }}')"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </button>
                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus role ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-200 p-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <p class="text-gray-600 font-medium mb-1">Belum ada role</p>
                <p class="text-gray-500 text-sm">Tambahkan role pertama Anda</p>
            </div>
        @endforelse
    </div>

    {{-- Desktop: Table Layout --}}
    <div class="hidden md:block bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">No.</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Users</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($roles as $role)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800">{{ $role->name }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $role->users_count }} user(s)
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="openRoleModal({{ $role->id }}, '{{ addslashes($role->name) }}')"
                                    class="p-2 text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus role ini?')">
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <p class="text-gray-600 font-medium mb-1">Belum ada role</p>
                                <p class="text-gray-500 text-sm">Tambahkan role pertama Anda</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Form -->
    <div id="roleModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm" onclick="closeRoleModal()"></div>
        <div class="relative bg-white rounded-2xl w-full max-w-lg p-6 md:p-8 shadow-xl transform transition-all scale-95 opacity-0 duration-200" id="roleModalContent">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800" id="roleModalTitle">Tambah Role Baru</h3>
                <button type="button" onclick="closeRoleModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="roleForm" method="POST" action="{{ route('admin.roles.store') }}">
                @csrf
                <input type="hidden" name="_method" id="roleMethod" value="POST">
                
                <div class="space-y-5">
                    <div>
                        <label for="role_name" class="block text-sm font-medium text-gray-700 mb-2">Name <span class="text-red-500">*</span></label>
                        <input type="text" id="role_name" name="name" required maxlength="50" class="w-full px-4 py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent outline-none transition-all">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <button type="button" onclick="closeRoleModal()" class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-medium px-5 py-2.5 rounded-xl hover:from-amber-700 hover:to-amber-800 transition-all shadow-sm">
                        Simpan Role
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const roleModal = document.getElementById('roleModal');
    const roleModalContent = document.getElementById('roleModalContent');
    const roleForm = document.getElementById('roleForm');
    const roleMethodInput = document.getElementById('roleMethod');
    const roleTitle = document.getElementById('roleModalTitle');
    const roleNameInput = document.getElementById('role_name');

    function openRoleModal(id = null, name = '') {
        roleModal.classList.remove('hidden');
        setTimeout(() => {
            roleModalContent.classList.remove('scale-95', 'opacity-0');
            roleModalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        if (id) {
            roleTitle.textContent = 'Edit Role';
            roleForm.action = `/admin/roles/${id}`;
            roleMethodInput.value = 'PUT';
            roleNameInput.value = name;
        } else {
            roleTitle.textContent = 'Tambah Role Baru';
            roleForm.action = "{{ route('admin.roles.store') }}";
            roleMethodInput.value = 'POST';
            roleNameInput.value = '';
        }
    }

    function closeRoleModal() {
        roleModalContent.classList.remove('scale-100', 'opacity-100');
        roleModalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            roleModal.classList.add('hidden');
        }, 200);
    }
</script>
@endpush