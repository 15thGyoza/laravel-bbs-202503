{{-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. --}}
<div x-show="sidebarOpen" class="tw-relative tw-z-40 lg:tw-hidden" x-ref="dialog" aria-modal="true">
    {{-- Overlay --}}
    <div x-show="sidebarOpen"
         x-transition:enter="tw-transition-opacity tw-ease-linear tw-duration-300"
         x-transition:enter-start="tw-opacity-0"
         x-transition:enter-end="tw-opacity-100"
         x-transition:leave="tw-transition-opacity tw-ease-linear tw-duration-300"
         x-transition:leave-start="tw-opacity-100"
         x-transition:leave-end="tw-opacity-0"
         class="tw-fixed tw-inset-0 tw-bg-gray-600 tw-bg-opacity-75"></div>

    <div class="tw-fixed tw-inset-0 tw-z-40 tw-flex">
        <div x-show="sidebarOpen"
             x-transition:enter="tw-transition tw-ease-in-out tw-duration-300 tw-transform"
             x-transition:enter-start="-tw-translate-x-full"
             x-transition:enter-end="tw-translate-x-0"
             x-transition:leave="tw-transition tw-ease-in-out tw-duration-300 tw-transform"
             x-transition:leave-start="tw-translate-x-0"
             x-transition:leave-end="-tw-translate-x-full"
             @click.away="sidebarOpen = false"
             class="tw-relative tw-flex tw-w-full tw-max-w-xs tw-flex-1 tw-flex-col tw-bg-white tw-pt-5 tw-pb-4">

            {{-- Close button --}}
            <div class="tw-absolute tw-top-0 tw-right-0 -tw-mr-12 tw-pt-2">
                <button type="button" class="tw-ml-1 tw-flex tw-h-10 tw-w-10 tw-items-center tw-justify-center tw-rounded-full focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-inset focus:tw-ring-white" @click="sidebarOpen = false">
                    <span class="tw-sr-only">Close sidebar</span>
                    <svg class="tw-h-6 tw-w-6 tw-text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            {{-- Logo --}}
            <div class="tw-flex tw-flex-shrink-0 tw-items-center tw-px-4">
                <a href="{{ route('admin.dashboard') }}" class="tw-flex tw-items-center">
                    <svg class="tw-h-8 tw-w-auto tw-text-indigo-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5-10-5-10 5z"></path></svg>
                    <span class="tw-ml-3 tw-text-lg tw-font-bold tw-text-gray-800">{{ config('app.name') }}</span>
                </a>
            </div>

            {{-- Navigation Links --}}
            <div class="tw-mt-5 tw-h-0 tw-flex-1 tw-overflow-y-auto">
                <nav class="tw-space-y-1 tw-px-2">
                    @include('admin.layouts.partials.admin-nav-links')
                </nav>
            </div>
        </div>
        <div class="tw-w-14 tw-flex-shrink-0" aria-hidden="true"></div>
    </div>
</div>

{{-- Static sidebar for desktop --}}
<div class="tw-hidden lg:tw-fixed lg:tw-inset-y-0 lg:tw-flex lg:tw-w-64 lg:tw-flex-col">
    <div class="tw-flex tw-min-h-0 tw-flex-1 tw-flex-col tw-border-r tw-border-gray-200 tw-bg-white">
        <div class="tw-flex tw-flex-1 tw-flex-col tw-overflow-y-auto tw-pt-5 tw-pb-4">
            <div class="tw-flex tw-flex-shrink-0 tw-items-center tw-px-4">
                <a href="{{ route('admin.dashboard') }}" class="tw-flex tw-items-center">
                    <svg class="tw-h-8 tw-w-auto tw-text-indigo-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5-10-5-10 5z"></path></svg>
                    <span class="tw-ml-3 tw-text-lg tw-font-bold tw-text-gray-800">{{ config('app.name') }}</span>
                </a>
            </div>
            <nav class="tw-mt-5 tw-flex-1 tw-space-y-1 tw-bg-white tw-px-2">
                @include('admin.layouts.partials.admin-nav-links')
            </nav>
        </div>
    </div>
</div>
