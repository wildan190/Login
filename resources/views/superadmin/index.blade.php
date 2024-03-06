<!-- resources/views/superadmin/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Super Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome Super Admin!") }}
                </div>

                <form id="updateRolesForm" method="POST" action="{{ route('superadmin.updateUserRoles') }}" class="p-6">
                    @csrf
                    @method('PATCH')

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama User</th>
                                    <th scope="col" class="px-6 py-3">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->name }}</th>
                                    <td class="px-6 py-4">
                                        <select name="roles[{{ $user->id }}]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="superadmin" {{ $user->role === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Update Roles</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan event listener untuk mengubah role pengguna saat form di-submit
        document.getElementById('updateRolesForm').addEventListener('submit', function() {
            let rolesSelects = document.querySelectorAll('select[name^="roles["]');
            rolesSelects.forEach(function(select) {
                // Update nilai input dengan role yang dipilih pada setiap elemen select
                select.previousElementSibling.value = select.value;
            });
        });
    });
</script>