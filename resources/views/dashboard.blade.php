<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('List Data User') }}
                    @include('message')

                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="block float-end text-white mb-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        + Create
                    </button>

                    <!-- Updated Table with Tailwind CSS -->
                    <div class="overflow-x-auto min-w-full bg-white shadow-md sm:rounded-lg">
                        <table class="table-default">
                            <thead>
                                <tr class="table-header">
                                    <th class="py-3 px-4 text-left">ID</th>
                                    <th class="py-3 px-4 text-left">Name</th>
                                    <th class="py-3 px-4 text-left">Email</th>
                                    <th class="py-3 px-4 text-left">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="table-row">
                                        <td class="table-cell">{{ $user->id }}</td>
                                        <td class="table-cell">{{ $user->name }}</td>
                                        <td class="table-cell">{{ $user->email }}</td>
                                        <td class="table-cell">{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="flex justify-end mt-3 mb-4">
                            {{$users->links()}}
                            {{-- <x-pagination.simple :current="$currentPage" :last="$lastPage" /> --}}
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modal')
    <script>
        function openModal() {
            document.getElementById('addUserModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('addUserModal').style.display = 'none';
        }
    </script>
</x-app-layout>
