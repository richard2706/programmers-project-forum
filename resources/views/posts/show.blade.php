<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $post->title }}</h2>
    </x-slot>

    
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2 p-2">
                <a class="hover:underline" href="{{ route('home') }}">< Back to All Posts</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <p>Posted by {{ $post->userProfile->username }}</p>
                        <i>{{ $post->date_time_posted }}</i>
                        @if($post->project_link)
                            <p>See project here: <a class="hover:underline" href="{{ $post->project_link }}">{{ $post->project_link }}</a></p>
                        @endif
                        <!-- Insert image here -->
                        <p class="mt-2">{{ $post->content }}</p>
                    </div>

                    @if($comments->count() == 0)
                        <div class="mt-6 p-2 bg-gray-100 rounded">
                            <p class="text-center">No comments</p>
                        </div>
                    @endif

                    @foreach ($comments as $comment)
                        <div class="my-4 p-2 bg-gray-100 rounded" >
                            <p class="text-sm">{{ $comment->userProfile->username }}, <i>{{ $comment->date_time_posted }}</i></p>
                            <p class="mt-1">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
