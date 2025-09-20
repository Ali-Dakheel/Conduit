<article class="relative flex max-w-xl flex-col items-start justify-between hover:shadow-lg transition-shadow duration-200 p-6 rounded-lg border border-gray-100">
    <a href="/articles/{{$article->slug}}" class="absolute inset-0 z-10"></a>

    <div class="flex items-center gap-x-4 text-xs relative z-20">
        <time datetime="{{ $article->created_at->format('Y-m-d') }}" class="text-gray-500">
            {{ $article->created_at->format('M j, Y') }}
        </time>
        @foreach($article->tags as $tag)
            <x-tag>{{$tag->name}}</x-tag>
        @endforeach
    </div>

    <div class="group relative grow">
        <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-primary transition-colors">
            {{$article->title}}
        </h3>
        <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">
            {{$article->description}}
        </p>
    </div>

    <div class="mt-4 flex items-center justify-between text-xs text-gray-500 w-full border-t border-gray-100 pt-4 relative z-20">
        <div class="flex items-center gap-4">
            <span>5 min read</span>
            <span>•</span>
            <span>{{$article->comments_count}} comments</span>
        </div>

        @auth
            @if(auth()->user()->hasFavorited($article))
                <form method="POST" action="/articles/{{ $article->slug }}/favorite" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center gap-1 text-red-500 hover:text-red-600 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        {{$article->favorites_count}}
                    </button>
                </form>
            @else
                <form method="POST" action="/articles/{{ $article->slug }}/favorite" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 text-gray-500 hover:text-red-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        {{$article->favorites_count}}
                    </button>
                </form>
            @endif
        @else
            <a href="/login" class="flex items-center gap-1 text-gray-500 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                {{$article->favorites_count}}
            </a>
        @endauth
    </div>

    <div class="relative mt-4 flex items-center gap-x-4 z-20">
        <img src="{{$article->author->image}}" alt="" class="size-10 rounded-full" />
        <div class="text-sm/6">
            <p class="font-semibold text-gray-900">
                <a href="/profiles/{{$article->author->name}}" class="hover:text-primary transition-colors">
                    {{$article->author->name}}
                </a>
            </p>
            <p class="text-gray-500">{{$article->author->bio}}</p>
        </div>
    </div>
</article>
