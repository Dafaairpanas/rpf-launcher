@extends('layouts.admin')

@section('title', 'Users')
@section('header', 'Users')

@section('header-actions')
    <button onclick="openUserModal()"
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
        @forelse($users as $user)
            <div class="bg-white rounded-2xl border border-gray-200 p-4 relative shadow-sm">
                <div class="absolute -top-2 -left-2 w-7 h-7 bg-gray-800 text-white text-[11px] font-bold rounded-full flex items-center justify-center border-2 border-white shadow-sm z-10">
                    {{ $loop->iteration }}
                </div>
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white font-semibold text-lg flex-shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
                    </div>
                    @if($user->role)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $user->role->name }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                            No Role
                        </span>
                    @endif
                </div>
                <div class="flex items-center justify-end gap-2 pt-3 border-t border-gray-100">
                    <button onclick="openUserModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', '{{ $user->role_id ?? '' }}')"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </button>
                    @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-200 p-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <p class="text-gray-600 font-medium mb-1">Belum ada user</p>
                <p class="text-gray-500 text-sm">Tambahkan user pertama Anda</p>
            </div>
        @endforelse
    </div>

    {{-- Desktop: Table Layout --}}
    <div class="hidden md:block bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">No.</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-gray-600">{{ $user->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->role)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $user->role->name }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    No Role
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="openUserModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', '{{ $user->role_id ?? '' }}')"
                                    class="p-2 text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <p class="text-gray-600 font-medium mb-1">Belum ada user</p>
                                <p class="text-gray-500 text-sm">Tambahkan user pertama Anda</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Form -->
    <div id="userModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm" onclick="closeUserModal()"></div>
        <div class="relative bg-white rounded-2xl w-full max-w-lg p-6 md:p-8 shadow-xl transform transition-all scale-95 opacity-0 duration-200" id="userModalContent">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800" id="userModalTitle">Tambah User Baru</h3>
                <button type="button" onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="userForm" method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <input type="hidden" name="_method" id="userMethod" value="POST">
                
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required maxlength="100" class="w-full px-4 py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent outline-none transition-all">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" required maxlength="255" class="w-full px-4 py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent outline-none transition-all">
                    </div>

                    <div>
                        <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="role_id" name="role_id" class="w-full">
                            <option value="">Pilih Role...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2" id="passwordLabel">Password <span class="text-red-500" id="passwordAsterisk">*</span></label>
                        <input type="password" id="password" name="password" minlength="8" class="w-full px-4 py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent outline-none transition-all">
                        <p class="mt-1 text-sm text-gray-500" id="passwordHint">Password minimal 8 karakter</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <button type="button" onclick="closeUserModal()" class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-medium px-5 py-2.5 rounded-xl hover:from-amber-700 hover:to-amber-800 transition-all shadow-sm">
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('userModal');
    const modalContent = document.getElementById('userModalContent');
    const form = document.getElementById('userForm');
    const methodInput = document.getElementById('userMethod');
    const title = document.getElementById('userModalTitle');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const roleSelect = document.getElementById('role_id');
    let tomSelectInstance = null;
    
    document.addEventListener('DOMContentLoaded', function() {
        tomSelectInstance = new TomSelect('#role_id', {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    });

    const passwordInput = document.getElementById('password');
    const passwordAsterisk = document.getElementById('passwordAsterisk');
    const passwordHint = document.getElementById('passwordHint');

    function openUserModal(id = null, name = '', email = '', roleId = '') {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        if (id) {
            title.textContent = 'Edit User';
            form.action = `/admin/users/${id}`;
            methodInput.value = 'PUT';
            nameInput.value = name;
            emailInput.value = email;
            if (tomSelectInstance) {
                tomSelectInstance.setValue(roleId);
            }
            
            passwordInput.required = false;
            passwordAsterisk.classList.add('hidden');
            passwordHint.textContent = 'Biarkan kosong jika tidak ingin mengubah password';
        } else {
            title.textContent = 'Tambah User Baru';
            form.action = "{{ route('admin.users.store') }}";
            methodInput.value = 'POST';
            nameInput.value = '';
            emailInput.value = '';
            if (tomSelectInstance) {
                tomSelectInstance.clear();
            }
            
            passwordInput.required = true;
            passwordAsterisk.classList.remove('hidden');
            passwordHint.textContent = 'Password minimal 8 karakter';
        }
    }

    function closeUserModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            passwordInput.value = ''; // clear password
        }, 200);
    }
</script>
@endpush
