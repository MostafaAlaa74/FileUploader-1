<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Available Function</h1>
                    <ul class="list-disc pl-5">
                        <li><a href="{{ route('files.index') }}" class="text-blue-500 hover:underline">View Files</a></li>
                        <li><a href="{{ route('files.create') }}" class="text-blue-500 hover:underline">Upload File</a></li>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
