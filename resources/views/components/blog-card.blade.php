<article class="flex max-w-xl flex-col items-start justify-between hover:shadow-lg transition-shadow duration-200 p-6 rounded-lg border border-gray-100">
    <div class="flex items-center gap-x-4 text-xs">
        <time datetime="{{ $article->created_at->format('Y-m-d') }}" class="text-gray-500">
            {{ $article->created_at->format('M j, Y') }}
        </time>
        @foreach($article->tags as $tag)
            <x-tag>{{$tag->name}}</x-tag>
        @endforeach
    </div>
    <div class="group relative grow">
        <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-primary transition-colors">
            <a href="#"><span class="absolute inset-0"></span>
                {{$article->title}}
            </a>
        </h3>
        <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">
            {{$article->description}}
        </p>
    </div>

    <div class="mt-4 flex items-center gap-4 text-xs text-gray-500 w-full border-t border-gray-100 pt-4">
        <span>5 min read</span>
        <span>•</span>
        <span>{{$article->comments_count}} comments</span>
        <span class="ml-auto">♥ {{$article->favorites_count}}</span>
    </div>

    <div class="relative mt-4 flex items-center gap-x-4">
        <img src="{{$article->author->image}}" alt="" class="size-10 rounded-full" />
        <div class="text-sm/6">
            <p class="font-semibold text-gray-900">
                <a href="" class="hover:text-primary transition-colors">
                    <span class="absolute inset-0"></span>
                    {{$article->author->name}}
                </a>
            </p>
            <p class="text-gray-500">{{$article->author ->bio}}</p>
        </div>
    </div>
</article>
