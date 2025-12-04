<x-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-2xl">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new post</h2>
            <form method="post" action="/posts">
                @csrf

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <x-form-label for="title">Post title</x-form-label>
                        <x-form-input type="text" name="title" id="title" placeholder="Type product name" required></x-form-input>
                        <x-form-error name="title" />
                    </div>
                    <div class="sm:col-span-2">
                        <x-form-label for="body">Contents</x-form-label>
                        <x-form-textarea name="body" id="body" rows="8" placeholder="Your description here" required></x-form-textarea>
                        <x-form-error name="body" />
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Publish
                </button>
            </form>
        </div>
    </section>
</x-layout>
