<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Posts</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2 p-2">
                <a class="hover:underline" href="{{ route('posts.create') }}">New Post</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('message'))
                        <p>{{ session('message') }}</p>
                    @endif

                    @foreach ($posts as $post)
                        <a href="{{ route('posts.show', compact('post')) }}">
                            <div class="my-4 p-2 bg-gray-100 rounded hover:bg-gray-200">
                                <b>{{ $post->title }}</b>
                                <p class="text-sm">{{ $post->userProfile->username }}, <i>{{ $post->date_time_posted }}</i></p>
                                <p>Tags: 
                                    @if ($post->tags->count() > 0)
                                        @foreach ($post->tags as $tag) {{ $tag->name }},@endforeach
                                    @else
                                        None
                                    @endif
                                </p>
                                <p class="mt-2">{{ substr($post->content, 0, 100) . ((strlen($post->content) > 100) ? '...' : '') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
