@if (session('success'))
    <div x-data="{ show: true }" x-show="show"
        class="bg-green-500 text-white p-4 mb-4 rounded flex justify-between items-center">
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

<!-- Error message -->
@if (session('error'))
    <div x-data="{ show: true }" x-show="show"
        class="bg-red-500 text-white p-4 mb-4 rounded flex justify-between items-center">
        <span>{{ session('error') }}</span>
        <button @click="show = false" class="text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

<!-- Validation errors -->
@if ($errors->any())
    <div x-data="{ show: true }" x-show="show" class="bg-red-500 text-white p-4 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button @click="show = false" class="absolute top-0 right-0 p-2 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
