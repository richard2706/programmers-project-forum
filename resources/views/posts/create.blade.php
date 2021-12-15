<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Post</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2 p-2">
                <a class="hover:underline" href="{{ route('home') }}">< Cancel</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="mb-4">
                            <p>Title</p>
                            <input type="text" name="title"/>
                        </div>
                        <div class="my-4">
                            <p>Project Link (optional)</p>
                            <input type="text" name="project_link"/>
                        </div>
                        <div class="my-4">
                            <p>Image (optional)</p>
                            <input type="text" name="image_link"/>
                        </div>
                        <div class="my-4">
                            <p>Content</p>
                            <input type="text" name="content"/>
                        </div>
                        <input class="p-2 rounded bg-green-200 hover:bg-green-300 cursor-pointer" type="submit" value="Save post"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
