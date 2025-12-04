<x-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-2xl">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new post</h2>
            <form method="post" action="/posts/{{ $post->id }}">
                @csrf
                @method('PATCH')

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <x-form-label for="title">Post title</x-form-label>
                        <x-form-input type="text" name="title" id="title" placeholder="Type product name" value="{{ $post->title }}" required></x-form-input>
                        <x-form-error name="title" />
                    </div>
                    <div class="sm:col-span-2">
                        <x-form-label for="body">Contents</x-form-label>
                        <x-form-textarea name="body" id="body" rows="8" placeholder="Your description here" required>{{ $post->body }}</x-form-textarea>
                        <x-form-error name="body" />
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between gap-x-6">
                    <div class="flex items-center">
                        <button form="delete-form" class="w-full justify-center text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 cursor-pointer">
                            <svg aria-hidden="true" class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Delete
                        </button>
                    </div>

                    <div class="flex items-center gap-x-6">
                        <a href="/posts/{{ $post->id }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>

                        <div>
                            <button type="submit" class="w-full px-5 py-2.5 text-sm font-medium inline-flex text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 cursor-pointer">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                                </svg>
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <form action="/posts/{{ $post->id }}" method="post" id="delete-form" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </section>
</x-layout>
