<x-layout>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                 src="{{ $article->author->image ?: 'https://ui-avatars.com/api/?name=' . urlencode($article->author->name) . '&background=6366f1&color=ffffff' }}"
                                 alt="{{ $article->author->name }}">
                            <div>
                                <a href="/profiles/{{ $article->author->name }}" rel="author"
                                   class="text-xl font-bold text-gray-900 hover:text-primary transition-colors">
                                    {{ $article->author->name }}
                                </a>
                                <p class="text-base text-gray-500">{{ $article->author->bio }}</p>
                                <div class="flex items-center gap-4 text-base text-gray-500">
                                    <time pubdate datetime="{{ $article->created_at->format('Y-m-d') }}"
                                          title="{{ $article->created_at->format('F j, Y') }}">
                                        {{ $article->created_at->format('M. j, Y') }}
                                    </time>
                                    <span>•</span>
                                    <span>{{ $article->author->followers_count ?? 0 }} followers</span>
                                </div>
                            </div>
                        </div>

                        <!-- Follow/Favorite Actions -->
                        <div class="ml-auto flex flex-col gap-2">
                            @auth
                                @if(auth()->id() !== $article->author->id)
                                    @if(auth()->user()->isFollowing($article->author))
                                        <form method="POST" action="/profiles/{{ $article->author->username }}/follow"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-sm">
                                                Following
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="/profiles/{{ $article->author->username }}/follow"
                                              class="inline">
                                            @csrf
                                            <button type="submit"
                                                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors text-sm">
                                                Follow
                                            </button>
                                        </form>
                                    @endif
                                @endif

                                @if(auth()->user()->hasFavorited($article))
                                    <form method="POST" action="/articles/{{ $article->slug }}/favorite" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex items-center gap-1 px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors text-sm">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            Favorited ({{ $article->favorites_count }})
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="/articles/{{ $article->slug }}/favorite" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="flex items-center gap-1 px-4 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            Favorite ({{ $article->favorites_count }})
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="/login"
                                   class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors text-sm text-center">
                                    Follow
                                </a>
                                <a href="/login"
                                   class="flex items-center justify-center gap-1 px-4 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    Favorite ({{ $article->favorites_count }})
                                </a>
                            @endauth
                        </div>
                    </address>

                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">
                        {{ $article->title }}
                    </h1>

                    <!-- Tags -->
                    @if($article->tags->count() > 0)
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($article->tags as $tag)
                                <x-tag href="/?tag={{ $tag->name }}">{{ $tag->name }}</x-tag>
                            @endforeach
                        </div>
                    @endif
                </header>

                <!-- Article Description -->
                <p class="lead text-lg text-gray-600 mb-6">{{ $article->description }}</p>

                <!-- Article Body -->
                <div class="prose prose-lg max-w-none">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <!-- Article Stats -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center gap-4">
                            <span>{{ $article->comments_count }} comments</span>
                            <span>•</span>
                            <span>{{ $article->favorites_count }} favorites</span>
                            <span>•</span>
                            <span>{{ $article->created_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <span>5 min read</span>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <section class="not-format mt-12">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900">
                            Discussion ({{ $article->comments_count }})
                        </h2>
                    </div>

                    @auth
                        <form class="mb-6" method="POST" action="/articles/{{ $article->slug }}/comments">
                            @csrf
                            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea id="comment" name="content" rows="6"
                                          class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 resize-none"
                                          placeholder="Write a comment..." required></textarea>
                            </div>
                            <button type="submit"
                                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary rounded-lg focus:ring-4 focus:ring-primary/20 hover:bg-primary-dark transition-colors">
                                Post comment
                            </button>
                        </form>
                    @else
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg text-center">
                            <p class="text-gray-600 mb-3">Join the discussion</p>
                            <a href="/login"
                               class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary rounded-lg hover:bg-primary-dark transition-colors">
                                Sign in to comment
                            </a>
                        </div>
                    @endauth

                    <!-- Comments List -->
                    @forelse($article->comments as $comment)
                        <article class="p-6 mb-6 text-base bg-white rounded-lg border border-gray-200">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900">
                                        <img class="mr-2 w-6 h-6 rounded-full"
                                             src="{{ $comment->author->image ?: 'https://ui-avatars.com/api/?name=' . urlencode($comment->author->name) . '&background=6366f1&color=ffffff' }}"
                                             alt="{{ $comment->author->name }}"> <a
                                            href="/profiles/{{ $comment->author->name }}"
                                            class="hover:text-primary transition-colors">
                                            {{ $comment->author->name }}
                                        </a>
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <time pubdate datetime="{{ $comment->created_at->format('Y-m-d') }}"
                                              title="{{ $comment->created_at->format('F j, Y') }}">
                                            {{ $comment->created_at->format('M. j, Y') }}
                                        </time>
                                    </p>
                                </div>
                                @auth
                                    @if(auth()->id() === $comment->author_id)
                                        <form method="POST"
                                              action="/articles/{{ $article->slug }}/comments/{{ $comment->id }}"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm"
                                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </footer>
                            <p class="text-gray-900">{{ $comment->content }}</p>
                        </article>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500">No comments yet. Be the first to share your thoughts!</p>
                        </div>
                    @endforelse
                </section>
            </article>
        </div>
    </main>

    <!-- Related Articles Section -->
    <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h2 class="mb-8 text-2xl font-bold text-gray-900">Related articles</h2>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($relatedArticles ?? [] as $relatedArticle)
                    <article class="max-w-xs">
                        <a href="/articles/{{ $relatedArticle->slug }}">
                            <div class="mb-5 bg-gray-200 rounded-lg h-32 flex items-center justify-center">
                                <span class="text-gray-500">Article Image</span>
                            </div>
                        </a>
                        <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900">
                            <a href="/articles/{{ $relatedArticle->slug }}"
                               class="hover:text-primary transition-colors">
                                {{ $relatedArticle->title }}
                            </a>
                        </h2>
                        <p class="mb-4 text-gray-500">{{ Str::limit($relatedArticle->description, 100) }}</p>
                        <a href="/articles/{{ $relatedArticle->slug }}"
                           class="inline-flex items-center font-medium underline underline-offset-4 text-primary hover:no-underline">
                            Read article
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </aside>
</x-layout>
