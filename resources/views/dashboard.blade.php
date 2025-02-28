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

                    <!-- Button to open the modal -->
                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-new-user')"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 float-right">
                        + Add New User
                    </button>

                    <!-- Updated Table with Tailwind CSS -->
                    <div class="overflow-x-auto min-w-full bg-white shadow-md sm:rounded-lg">
                        {{-- <table class="min-w-full bg-white dark:bg-gray-700 text-left text-sm text-gray-500 dark:text-gray-300">
                            <thead class="bg-gray-100 dark:bg-gray-600">
                                <tr>
                                    <th class="py-3 px-4 text-gray-700 dark:text-gray-300">ID</th>
                                    <th class="py-3 px-4 text-gray-700 dark:text-gray-300">Name</th>
                                    <th class="py-3 px-4 text-gray-700 dark:text-gray-300">Email</th>
                                    <th class="py-3 px-4 text-gray-700 dark:text-gray-300">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-t dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $user->id }}</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $user->name }}</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $user->email }}</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $user->created_at->format('Y-m-d H:i:s') }}</td> <!-- Date format -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modal')
</x-app-layout>
