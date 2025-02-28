<!-- Updated Table with Tailwind CSS -->
<div class="overflow-x-auto min-w-full bg-white shadow-md sm:rounded-lg">
    <table class="table-default" id="table-departement">
        <thead>
            <tr class="table-header">
                <th class="py-3 px-4 text-left">ID</th>
                <th class="py-3 px-4 text-left">Code</th>
                <th class="py-3 px-4 text-left">Name</th>
                <th class="py-3 px-4 text-left">Description</th>
                <th class="py-3 px-4 text-left">Act</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $user)
                <tr class="table-row" id="row-departement-{{$user->id}}">
                    <td class="table-cell">{{ $user->id }}</td>
                    <td class="table-cell">{{ $user->code }}</td>
                    <td class="table-cell">{{ $user->name }}</td>
                    <td class="table-cell">{{ $user->descriptions }}</td>
                    <td class="table-cell"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="flex justify-end mt-3 mb-4">
        {{ $data->links() }}
    </div>

</div>
