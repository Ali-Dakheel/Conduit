<x-layout>
    <div class="bg-white py-24 sm:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <x-hero>
                <h2 class="text-4xl font-semibold tracking-tight text-pretty sm:text-5xl text-primary">Conduit</h2>
                <p class="mt-2 text-lg/8 text-gray-500">A place to share your knowledge.</p>
            </x-hero>
            <div class="mt-16 pt-8">
                <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                    <x-feed-tabs
                        :active-tab="'global'"
                        :global-tab-key="'global'"
                        :personal-tab-key="'following'"
                        :show-tags-dropdown="true"
                        :tags="$tags"/>
                    <div data-content="global"
                         class="mx-auto mt-8 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 pt-6 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                        @foreach($articles as $article)
                            <x-blog-card :$article/>
                        @endforeach
                    </div>
                    <div data-content="global" class="mt-8">
                        {{$articles->links()}}
                    </div>

                    <div data-content="following"
                         class="hidden mx-auto mt-8 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 pt-6 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                        <!-- Following articles would go here -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
