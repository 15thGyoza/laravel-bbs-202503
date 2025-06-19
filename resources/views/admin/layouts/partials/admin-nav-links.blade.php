{{--
  此文件已重构，删除了 @php 块，
  直接使用内联三元运算符来判断和应用 class，
  以提高可读性和避免潜在的 Blade 解析问题。
--}}

<!-- Dashboard -->
<a href="{{ route('admin.dashboard') }}"
   class="tw-group tw-flex tw-items-center tw-px-2 tw-py-2 tw-text-sm tw-font-medium tw-rounded-md {{ request()->routeIs('admin.dashboard') ? 'tw-bg-indigo-100 tw-text-indigo-800' : 'tw-text-gray-600 hover:tw-bg-gray-50 hover:tw-text-gray-900' }}">
    <svg
        class="tw-mr-3 tw-h-6 tw-w-6 tw-flex-shrink-0 {{ request()->routeIs('admin.dashboard') ? 'tw-text-indigo-600' : 'tw-text-gray-400 group-hover:tw-text-gray-500' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5"/>
    </svg>
    <span>{{ __('admin.sidebar.dashboard') }}</span>
</a>

@if(auth()->user()->hasRole('Founder'))
    <!-- Users -->
    <a href="{{ route('admin.users.index') }}"
       class="tw-group tw-flex tw-items-center tw-px-2 tw-py-2 tw-text-sm tw-font-medium tw-rounded-md {{ request()->routeIs('admin.users.*') ? 'tw-bg-indigo-100 tw-text-indigo-800' : 'tw-text-gray-600 hover:tw-bg-gray-50 hover:tw-text-gray-900' }}">
        <svg
            class="tw-mr-3 tw-h-6 tw-w-6 tw-flex-shrink-0 {{ request()->routeIs('admin.users.*') ? 'tw-text-indigo-600' : 'tw-text-gray-400 group-hover:tw-text-gray-500' }}"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-2.308l.233-.233c.627-.627.627-1.636 0-2.263l-4.744-4.744c-.627-.627-1.636-.627-2.263 0l-4.017 4.017-1.132-1.132c-.627-.627-1.636-.627-2.263 0-.627.627-.627 1.636 0 2.263l4.017 4.017c.627.627 1.636.627 2.263 0l.233-.233zM12.75 12.75l-4.017 4.017c-.627.627-1.636-.627-2.263 0l-4.744-4.744c-.627-.627-.627-1.636 0-2.263l.233-.233c.627-.627 1.636-.627 2.263 0l4.017 4.017c.627.627 1.636.627 2.263 0l1.132-1.132zM4.5 19.5l2.25-2.25"/>
        </svg>
        <span>{{ __('admin.sidebar.users') }}</span>
    </a>
@endif

<!-- Topics -->
<a href="{{ route('admin.topics.index') }}"
   class="tw-group tw-flex tw-items-center tw-px-2 tw-py-2 tw-text-sm tw-font-medium tw-rounded-md {{ request()->routeIs('admin.topics.*') ? 'tw-bg-indigo-100 tw-text-indigo-800' : 'tw-text-gray-600 hover:tw-bg-gray-50 hover:tw-text-gray-900' }}">
    <svg
        class="tw-mr-3 tw-h-6 tw-w-6 tw-flex-shrink-0 {{ request()->routeIs('admin.topics.*') ? 'tw-text-indigo-600' : 'tw-text-gray-400 group-hover:tw-text-gray-500' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
    </svg>
    <span>{{ __('admin.sidebar.topics') }}</span>
</a>

<!-- Replies -->
<a href="{{ route('admin.replies.index') }}"
   class="tw-group tw-flex tw-items-center tw-px-2 tw-py-2 tw-text-sm tw-font-medium tw-rounded-md {{ request()->routeIs('admin.replies.*') ? 'tw-bg-indigo-100 tw-text-indigo-800' : 'tw-text-gray-600 hover:tw-bg-gray-50 hover:tw-text-gray-900' }}">
    <svg
        class="tw-mr-3 tw-h-6 tw-w-6 tw-flex-shrink-0 {{ request()->routeIs('admin.replies.*') ? 'tw-text-indigo-600' : 'tw-text-gray-400 group-hover:tw-text-gray-500' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
    </svg>
    <span>{{ __('admin.sidebar.replies') }}</span>
</a>

<!-- Categories -->
<a href="{{ route('admin.categories.index') }}"
   class="tw-group tw-flex tw-items-center tw-px-2 tw-py-2 tw-text-sm tw-font-medium tw-rounded-md {{ request()->routeIs('admin.categories.*') ? 'tw-bg-indigo-100 tw-text-indigo-800' : 'tw-text-gray-600 hover:tw-bg-gray-50 hover:tw-text-gray-900' }}">
    <svg
        class="tw-mr-3 tw-h-6 tw-w-6 tw-flex-shrink-0 {{ request()->routeIs('admin.categories.*') ? 'tw-text-indigo-600' : 'tw-text-gray-400 group-hover:tw-text-gray-500' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
    </svg>
    <span>{{ __('admin.sidebar.categories') }}</span>
</a>

@if(auth()->user()->hasRole('Founder'))
    <!-- Divider and Settings -->
    <div class="tw-pt-4 tw-mt-4 tw-border-t tw-border-gray-200">
        <a href="{{ route('admin.settings.index') }}"
           class="tw-group tw-flex tw-items-center tw-px-2 tw-py-2 tw-text-sm tw-font-medium tw-rounded-md {{ request()->routeIs('admin.settings.*') ? 'tw-bg-indigo-100 tw-text-indigo-800' : 'tw-text-gray-600 hover:tw-bg-gray-50 hover:tw-text-gray-900' }}">
            <svg
                class="tw-mr-3 tw-h-6 tw-w-6 tw-flex-shrink-0 {{ request()->routeIs('admin.settings.*') ? 'tw-text-indigo-600' : 'tw-text-gray-400 group-hover:tw-text-gray-500' }}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.594 3.94c.09-.542.56-.94 1.11-.94h1.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.438.995a6.473 6.473 0 010 1.91l.438.995c.094.382.248.755.438.995l1.003.827c.486.402.668 1.08.39 1.636l-1.296 2.247a1.125 1.125 0 01-1.37.49l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-1.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a6.52 6.52 0 01-.22-.127c-.324-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.437-.995a6.473 6.473 0 010-1.91l-.438-.995c-.093-.382-.248-.754-.438-.995l-1.004-.827a1.125 1.125 0 01-.39-1.636l1.296-2.247a1.125 1.125 0 011.37-.49l1.217.456c.355.133.75.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span>{{ __('admin.sidebar.settings') }}</span>
        </a>
    </div>
@endif
