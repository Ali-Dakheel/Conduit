<x-layout>
    <div class="bg-white py-24 sm:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-4xl font-semibold tracking-tight text-pretty sm:text-5xl text-primary">Conduit</h2>
                <p class="mt-2 text-lg/8 text-gray-500">A place to share your knowledge.</p>
            </div>

            <div class="mt-16  pt-8">
                <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex items-center space-x-8">
                            <a href="/" class="border-b-2 {{ !request()->get('feed') && !request()->get('tag') ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} py-2 px-1 text-sm font-medium">
                                Global Feed
                            </a>
                            <a href="/?feed=following" class="border-b-2 {{ request()->get('feed') === 'following' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} py-2 px-1 text-sm font-medium">
                                Your Feed
                            </a>
                            @if(request()->get('tag'))
                                <div class="border-b-2 border-primary text-primary py-2 px-1 text-sm font-medium flex items-center gap-1">
                                    # {{ ucfirst(request()->get('tag')) }}
                                    <a href="/" class="ml-1 text-gray-400 hover:text-gray-600">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif

                            <div class="relative ml-auto">
                                <button id="tagsButton" class="flex items-center gap-2 py-2 px-3 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                                    Filter by Tags
                                    <svg id="tagsArrow" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div id="tagsDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                                    <div class="p-4">
                                        <h4 class="text-sm font-semibold text-gray-900 mb-3">Popular Tags</h4>
                                        <div class="flex flex-wrap gap-2 text-xs">
                                            @foreach($tags as $tag)
                                                <x-tag href="/?tag={{$tag}}" class="{{ request()->get('tag') === $tag ? 'bg-primary text-white' : '' }}">
                                                    {{$tag}}
                                                </x-tag>
                                            @endforeach
                                        </div>
                                        @if(request()->get('tag'))
                                            <div class="mt-3 pt-3 border-t border-gray-100">
                                                <a href="/" class="text-xs text-gray-500 hover:text-primary transition-colors">Clear all filters</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="mx-auto mt-8 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 pt-6 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($articles as $article)
                    <x-blog-card :$article/>
                @endforeach
            </div>
            <div class="mt-8">
                {{$articles->links()}}
            </div>
        </div>
    </div>
</x-layout>
