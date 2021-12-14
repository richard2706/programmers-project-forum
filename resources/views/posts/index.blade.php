<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Posts</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($posts as $post)
                        <a href="{{ route('posts.show', compact('post')) }}">
                            <div class="my-4 p-2 bg-gray-100 rounded hover:bg-gray-200">
                                <b>{{ $post->title }}</b>
                                <p>{{ $post->userProfile->username }}</p>
                                <i>{{ $post->date_time_posted }}</i>
                                <p>{{ substr($post->content, 0, 100) . ((strlen($post->content) > 100) ? '...' : '') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
