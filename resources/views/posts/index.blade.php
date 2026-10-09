<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Post</h2>
            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    + Tulis Post
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif

            @foreach ($posts as $post)
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">
                        oleh {{ $post->user->name }} ({{ $post->user->role }})
                        · {{ $post->created_at->diffForHumans() }}
                    </p>
                    <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($post->body, 150) }}</p>

                    <div class="mt-4 flex items-center gap-2">
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}"
                               class="inline-flex items-center px-4 py-2 bg-yellow-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400">
                                Edit
                            </a>
                        @endcan

                        @can('delete', $post)
                            <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                  onsubmit="return confirm('Yakin hapus post ini?')">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>Hapus</x-danger-button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>