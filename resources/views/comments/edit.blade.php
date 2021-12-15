<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Comment</h2>
        <i>{{ $post->title }}</i>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2 p-2">
                <a class="hover:underline" href="{{ route('posts.show', compact('post')) }}">< Cancel</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        <p>Errors:</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('comments.update', compact('post', 'comment')) }}">
                        @csrf
                        <div class="mb-4">
                            <p>Comment</p>
                            <input type="text" name="content" value="{{ $comment->content }}"/>
                        </div>
                        <input class="p-2 rounded bg-green-200 hover:bg-green-300 cursor-pointer" type="submit" value="Update comment"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
