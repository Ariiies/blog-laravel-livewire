<footer 
    id="app-footer" 
    class="w-full bg-black-500 bg-black-500 border-black-500 rounded-t-lg shadow-sm py-8 text-center text-sm text-white-500 dark:text-zinc-400 mt-auto"
>
    <div class="container mx-auto flex flex-col items-center justify-center gap-4 px-4">
        <div class="flex flex-col items-center gap-1">
            <span class="font-semibold text-white-700">
                {{ config('app.name', 'mi_app') }}
            </span>
            <span>
                © {{ date('Y') }}. {{ __('All rights reserved.') }}
            </span>
        </div>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ url('/about') }}" class="hover:underline">{{ __('About') }}</a>
            <a href="{{ url('/contact') }}" class="hover:underline">{{ __('Contact') }}</a>
            <a href="{{ url('/privacy') }}" class="hover:underline">{{ __('Privacy Policy') }}</a>
            <a href="{{ url('/terms') }}" class="hover:underline">{{ __('Terms of Service') }}</a>
            <a href="https://github.com/your-repo" target="_blank" rel="noopener" class="hover:underline flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.48 2 2 6.48 2 12c0 4.42 2.87 8.166 6.84 9.49.5.09.68-.22.68-.48 0-.24-.01-.87-.01-1.71-2.78.6-3.37-1.34-3.37-1.34-.45-1.15-1.1-1.46-1.1-1.46-.9-.62.07-.61.07-.61 1 .07 1.53 1.03 1.53 1.03.89 1.52 2.34 1.08 2.91.83.09-.65.35-1.08.63-1.33-2.22-.25-4.56-1.11-4.56-4.95 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02A9.56 9.56 0 0112 6.8c.85.004 1.71.115 2.51.337 1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.68 0 3.85-2.34 4.7-4.57 4.95.36.31.68.92.68 1.85 0 1.33-.01 2.4-.01 2.73 0 .27.18.58.69.48C19.13 20.16 22 16.42 22 12c0-5.52-4.48-10-10-10z"/>
                </svg>
                GitHub
            </a>
        </div>
        <div class="flex flex-col items-center gap-1">
            <span class="text-xs">
                {{ __('Made with') }} <span class="text-red-500">♥</span> {{ __('by your team') }}
            </span>
            <span class="text-xs">
                {{ __('Follow us:') }}
                <a href="https://twitter.com/yourprofile" target="_blank" rel="noopener" class="hover:underline ml-1">Twitter</a> |
                <a href="https://facebook.com/yourprofile" target="_blank" rel="noopener" class="hover:underline ml-1">Facebook</a> |
                <a href="https://instagram.com/yourprofile" target="_blank" rel="noopener" class="hover:underline ml-1">Instagram</a>
            </span>
        </div>
        <div class="w-full mt-4 text-xs text-zinc-400 text-center">
            {{ __('Powered by Laravel') }} &middot; {{ __('Theme by YourCompany') }}
        </div>
    </div>
</footer>