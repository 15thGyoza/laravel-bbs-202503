<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('admin.default_title')) - {{ config('app.name', 'Laravel') }}</title>

    {{-- Google Fonts - Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite for SASS and JS --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Alpine.js for interactivity --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- Page specific styles --}}
    @stack('styles')

    <style>
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
</head>
<body class="tw-bg-gray-100 tw-font-sans tw-antialiased">

<div x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false" class="tw-flex tw-min-h-screen">
    {{-- Mobile sidebar --}}
    @include('admin.layouts.partials.sidebar')

    <div class="tw-flex tw-flex-1 tw-flex-col lg:tw-pl-64">
        {{-- Static sidebar for desktop --}}
        @include('admin.layouts.partials.header')

        <main class="tw-flex-1">
            <div class="tw-py-6">
                <div class="tw-mx-auto tw-max-w-screen-2xl tw-px-4 sm:tw-px-6 lg:tw-px-8">
                    <div class="tw-mb-6">
                        <h1 class="tw-text-2xl tw-font-bold tw-text-gray-900">@yield('title')</h1>
                        @hasSection('description')
                            <p class="tw-mt-1 tw-text-sm tw-text-gray-600">@yield('description')</p>
                        @endif
                    </div>
                    {{-- 引入 Flash Message Partial --}}
                    @include('admin.layouts.partials.flash-messages')
                </div>
                <div class="tw-mx-auto tw-max-w-screen-2xl tw-px-4 sm:tw-px-6 lg:tw-px-8">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</div>
{{-- @stack('scripts') 会将子视图中的脚本推送到这里 --}}
@stack('scripts')
</body>
</html>
