<x-layout>
    <div class="flex min-h-full flex-col justify-center px-6 lg:px-8 py-12">
        <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
                Create an Article
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-2xl">
            <form action="/articles" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                    <div class="mt-2">
                        <input id="title" type="text" name="title" required value="{{ old('title') }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary sm:text-sm/6"/>
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                    <div class="mt-2">
                        <input id="description" type="text" name="description" required value="{{ old('description') }}"
                               placeholder="Brief summary of your article"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary sm:text-sm/6"/>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="body" class="block text-sm/6 font-medium text-gray-900">Body</label>
                    <div class="mt-2">
                        <textarea id="body" name="body" rows="10" required
                                  placeholder="Write your article body here..."
                                  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary sm:text-sm/6 resize-none">{{ old('body') }}</textarea>
                        @error('body')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm/6 font-medium text-gray-900 mb-2">Tags (optional)</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                       class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary focus:ring-2"
                                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('tags')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                            class="flex-1 justify-center rounded-md bg-primary px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-primary-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors">
                        Create Article
                    </button>
                    <a href="/"
                       class="flex-1 text-center rounded-md bg-gray-200 px-3 py-1.5 text-sm/6 font-semibold text-gray-700 shadow-xs hover:bg-gray-300 transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
