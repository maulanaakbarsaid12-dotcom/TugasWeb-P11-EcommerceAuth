<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Editor</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                Halaman ini bisa dibuka oleh <strong>admin</strong> dan <strong>editor</strong>.
                Total post: {{ \App\Models\Post::count() }}.
            </div>
        </div>
    </div>
</x-app-layout>