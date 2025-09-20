<x-layout>
    <x-hero>
        <!-- Profile Hero Section -->
        <div class="bg-gradient-to-r from-primary/10 to-primary/5 -mx-6 px-6 py-12 mb-8 mt-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                    <!-- Profile Image -->
                    <div class="relative">
                        <img src="{{ $author->image }}"
                             alt="{{ $author->name }}"
                             class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-white shadow-lg">
                        <div class="absolute -bottom-2 -right-2 bg-green-500 w-8 h-8 rounded-full border-4 border-white flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $author->name }}</h1>
                                <p class="text-lg text-gray-600 mt-1">{{ $author->bio }}</p>
                                <p class="text-sm text-gray-500 mt-2">
                                    <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Joined {{ $author->created_at->format('F Y') }}
                                </p>
                            </div>

                            <!-- Follow Button -->
                            <div class="flex gap-3">
                                @auth
                                    @if(auth()->id() !== $author->id)
                                        @if(auth()->user()->isFollowing($author))
                                            <form method="POST" action="/profiles/{{ $author->name }}/follow" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Following
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="/profiles/{{ $author->name }}/follow" class="inline">
                                                @csrf
                                                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    Follow
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @else
                                    <a href="/login" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                                        Follow
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="flex gap-6 mt-6">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $author->articles_count ?? 0 }}</div>
                                <div class="text-sm text-gray-500">Articles</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $author->followers_count ?? 0 }}</div>
                                <div class="text-sm text-gray-500">Followers</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $author->following_count ?? 0 }}</div>
                                <div class="text-sm text-gray-500">Following</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $author->favorite_articles_count ?? 0 }}</div>
                                <div class="text-sm text-gray-500">Favorites</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-hero>

    <!-- Profile Content Section -->
    <div class="bg-white py-8">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Feed Navigation -->
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                <x-feed-tabs
                    :active-tab="'articles'"
                    :global-tab-key="'articles'"
                    :personal-tab-key="'favorites'"
                    :global-feed-label="'My Articles'"
                    :personal-feed-label="'Favorited Articles'" />
            </div>

            <!-- Articles Grid -->
            <div class="mx-auto mt-8 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 pt-6 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @if(request()->get('tab') === 'favorites')
                    @forelse($author->favoriteArticles as $article)
                        <x-blog-card :$article />
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No favorite articles yet</h3>
                            <p class="mt-2 text-gray-500">{{ $author->name }} hasn't favorited any articles yet.</p>
                        </div>
                    @endforelse
                @else
                    @forelse($author->articles as $article)
                        <x-blog-card :$article />
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No articles yet</h3>
                            <p class="mt-2 text-gray-500">{{ $author->name }} hasn't published any articles yet.</p>
                        </div>
                    @endforelse
                @endif
            </div>
        </div>
    </div>
</x-layout>
