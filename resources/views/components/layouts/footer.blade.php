<footer 
    id="app-footer" 
    class="w-full bg-zinc-50 dark:bg-zinc-900 border-t border-zinc-200 dark:border-zinc-700 rounded-t-lg shadow-sm py-8 text-center text-sm text-zinc-500 dark:text-zinc-400 mt-auto"
>
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-4 px-4">
        <div>
            <span class="font-semibold text-zinc-700 dark:text-zinc-200">
                {{ config('app.name', 'mi_app') }}
            </span>
            © {{ date('Y') }}. {{ __('All rights reserved.') }}
        </div>
        <div class="flex gap-4 justify-center">
            <a href="{{ url('/about') }}" class="hover:underline">{{ __('About') }}</a>
            <a href="{{ url('/contact') }}" class="hover:underline">{{ __('Contact') }}</a>
            <a href="{{ url('/privacy') }}" class="hover:underline">{{ __('Privacy Policy') }}</a>
        </div>
        <div>
            <span class="text-xs">
                {{ __('Made with') }} <span class="text-red-500">♥</span> {{ __('by your team') }}
            </span>
        </div>
    </div>
</footer>