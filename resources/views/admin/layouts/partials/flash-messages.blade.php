<div class="tw-mb-4">
    @if (session('success'))
        <div class="tw-bg-green-100 tw-border tw-border-green-400 tw-text-green-700 tw-px-4 tw-py-3 tw-rounded-lg tw-relative tw-shadow-sm" role="alert">
            <span class="tw-block sm:tw-inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="tw-bg-red-100 tw-border tw-border-red-400 tw-text-red-700 tw-px-4 tw-py-3 tw-rounded-lg tw-relative tw-shadow-sm" role="alert">
            <span class="tw-block sm:tw-inline">{{ session('error') }}</span>
        </div>
    @endif

    @if (session('warning'))
        <div class="tw-bg-yellow-100 tw-border tw-border-yellow-400 tw-text-yellow-700 tw-px-4 tw-py-3 tw-rounded-lg tw-relative tw-shadow-sm" role="alert">
            <span class="tw-block sm:tw-inline">{{ session('warning') }}</span>
        </div>
    @endif

    @if (session('info'))
        <div class="tw-bg-blue-100 tw-border tw-border-blue-400 tw-text-blue-700 tw-px-4 tw-py-3 tw-rounded-lg tw-relative tw-shadow-sm" role="alert">
            <span class="tw-block sm:tw-inline">{{ session('info') }}</span>
        </div>
    @endif

    {{-- 针对验证错误，如果希望集中显示 --}}
    @if ($errors->any())
        <div class="tw-bg-red-100 tw-border tw-border-red-400 tw-text-red-700 tw-px-4 tw-py-3 tw-rounded-lg tw-relative tw-shadow-sm" role="alert">
            <ul class="tw-mt-1 tw-list-disc tw-list-inside tw-text-sm tw-text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
