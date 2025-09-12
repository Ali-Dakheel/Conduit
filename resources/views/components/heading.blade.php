<header class="bg-white border-b border-border shadow-sm">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
        <div class="flex lg:flex-1">
            <a href="/" class="-m-1.5 p-1.5 hover:opacity-80 transition-opacity">
                <span class="font-bold text-primary text-xl">conduit</span>
            </a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end gap-6">
            <x-nav-link
                href="/"
                :active="request()->is('/')"
                class="flex items-center">
                Home
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                    </svg>
                </x-slot>
            </x-nav-link>
            @guest()
                <x-nav-link href="/register" :active="request()->is('register')">
                    Sign up
                </x-nav-link>

                <x-nav-link href="/login" :active="request()->is('login')">
                    Sign in
                </x-nav-link>
            @endguest
            @auth()
                <x-nav-link href="/article" :active="request()->is('register')">
                    Create Article
                </x-nav-link>
                <x-nav-link href="/logout" :active="request()->is('register')" class="flex items-center">
                    Log Out
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4 ml-1">
                            <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm10.72 4.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H9a.75.75 0 0 1 0-1.5h10.94l-1.72-1.72a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </x-slot>
                </x-nav-link>
            @endauth
        </div>
    </nav>
</header>
