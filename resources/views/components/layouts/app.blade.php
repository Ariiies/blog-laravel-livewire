@props(['title' => 'mi_app'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="flex flex-col min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="layout-grid" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                {{ __('Home') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />
        
        <flux:navbar class="flex-1 flex justify-center items-center px-4">
            <form action="{{ route('posts.index') }}" method="GET" class="w-full max-w-md flex items-center gap-1">
                <input
                    type="text"
                    name="search"
                    id="search"
                    placeholder="{{ __('Search posts...') }}"
                    value="{{ request('search') }}"
                    class="flex-1 pl-3 pr-2 py-1.5 text-sm bg-zinc-800 border border-zinc-600 rounded-md text-gray-200 placeholder-zinc-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition dark:bg-zinc-800 dark:text-gray-200 dark:border-zinc-600 dark:placeholder-zinc-400"
                >
                <button type="submit" class="flex items-center px-1 py-1">
                    <flux:tooltip :content="__('Search')" position="bottom">
                        <flux:navbar.item class="!h-8 [&>div>svg]:size-4 text-gray-200" icon="magnifying-glass" :label="__('Search')" />
                    </flux:tooltip>
                </button>
            </form>
        </flux:navbar>

        @auth
            <flux:dropdown position="top" align="end">
                <flux:profile
                    class="cursor-pointer"
                    :initials="auth()->user()->initials()"
                />
                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('admin.dashboard')" icon="key" wire:navigate>{{ __('Admin') }}</flux:menu.item>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        @else
            <flux:dropdown position="top" align="end">
                <flux:button
                    class="cursor-pointer"
                    icon="user-circle"
                />
                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('login')" wire:navigate>{{ __('Log In') }}</flux:menu.item>
                    </flux:menu.radio.group>
                    
                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('register')" wire:navigate>{{ __('Register') }}</flux:menu.item>
                    </flux:menu.radio.group>
                </flux:menu>
            </flux:dropdown> 
        @endauth
    </flux:header>

    <div class="flex flex-1 w-full">
        <flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('home') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item icon="layout-grid" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                        {{ __('Home') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>
        </flux:sidebar>

        <div class="flex flex-col flex-1 w-full min-h-[calc(100vh-4rem)]">
            <flux:main class="flex-1 w-full">
                {{ $slot }}
                @include('components.layouts.footer')
            </flux:main>

            

    @fluxScripts
</body>
</html>
