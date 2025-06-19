<header class="tw-sticky tw-top-0 tw-z-10 tw-flex tw-h-16 tw-flex-shrink-0 tw-bg-white tw-shadow">
    {{-- Mobile menu button --}}
    <button type="button" class="tw-border-r tw-border-gray-200 tw-px-4 tw-text-gray-500 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-inset focus:tw-ring-indigo-500 lg:tw-hidden" @click="sidebarOpen = true">
        <span class="tw-sr-only">Open sidebar</span>
        <svg class="tw-h-6 tw-w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
    </button>
    <div class="tw-flex tw-flex-1 tw-justify-end tw-px-4 sm:tw-px-6 lg:tw-px-8">
        <div class="tw-flex tw-items-center">
            {{-- User dropdown --}}
            <div x-data="{ dropdownOpen: false }" class="tw-relative">
                <button @click="dropdownOpen = !dropdownOpen" class="tw-flex tw-max-w-xs tw-items-center tw-rounded-full tw-bg-white tw-text-sm focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-ring-offset-2">
                    <span class="tw-sr-only">Open user menu</span>
                    @if(auth()->user()->avatar)
                        <img class="tw-h-8 tw-w-8 tw-rounded-full tw-object-cover" src="{{ auth()->user()->avatar }}" alt="User Avatar">
                    @else
                        <span class="tw-inline-block tw-h-8 tw-w-8 tw-overflow-hidden tw-rounded-full tw-bg-gray-100">
                            <svg class="tw-h-full tw-w-full tw-text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.997A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                    @endif
                </button>
                <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-cloak x-transition:enter="tw-transition tw-ease-out tw-duration-100" x-transition:enter-start="tw-transform tw-opacity-0 tw-scale-95" x-transition:enter-end="tw-transform tw-opacity-100 tw-scale-100" x-transition:leave="tw-transition tw-ease-in tw-duration-75" x-transition:leave-start="tw-transform tw-opacity-100 tw-scale-100" x-transition:leave-end="tw-transform tw-opacity-0 tw-scale-95" class="tw-absolute tw-right-0 tw-z-10 tw-mt-2 tw-w-48 tw-origin-top-right tw-rounded-md tw-bg-white tw-py-1 tw-shadow-lg tw-ring-1 tw-ring-black tw-ring-opacity-5 focus:tw-outline-none" role="menu" aria-orientation="vertical" tabindex="-1">
                    <a href="/" target="_blank" class="tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100" role="menuitem" tabindex="-1">{{ __('admin.main_site') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-text-left tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100" role="menuitem" tabindex="-1">
                            {{ __('admin.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
