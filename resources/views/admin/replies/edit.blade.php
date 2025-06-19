@extends('admin.layouts.app')

@section('title', __('Edit Reply'))
@section('description', __('Reply Information'))

@section('content')
    <div class="tw-bg-white tw-shadow-xl sm:tw-rounded-lg tw-p-6">
        <form method="POST" action="{{ route('admin.replies.update', $reply) }}">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="tw-bg-red-100 tw-border tw-border-red-400 tw-text-red-700 tw-px-4 tw-py-3 tw-rounded-lg tw-relative tw-mb-6" role="alert">
                    <ul class="tw-mt-1 tw-list-disc tw-list-inside tw-text-sm tw-text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 回复信息卡片 --}}
            <div class="tw-mb-6 tw-bg-gray-50 tw-rounded-lg tw-p-6 tw-shadow-inner">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-900 tw-mb-5 tw-border-b tw-pb-3 tw-border-gray-200">{{ __('Reply Information') }}</h3>

                <div class="tw-grid tw-grid-cols-1 tw-gap-6">
                    {{-- 回复内容 --}}
                    <div>
                        <label for="content" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Content') }}</label>
                        <textarea name="content" id="content" rows="8" required
                                  class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">{{ old('content', $reply->content) }}</textarea>
                        @error('content')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 所属话题 (只读) --}}
                    <div>
                        <label for="topic_title" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Topic Title') }}</label>
                        <input type="text" id="topic_title" value="{{ $reply->topic->title ?? __('N/A') }}" readonly
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-bg-gray-100 tw-cursor-not-allowed tw-text-base tw-px-4 tw-py-2">
                    </div>

                    {{-- 回复作者 (只读) --}}
                    <div>
                        <label for="author_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Author') }}</label>
                        <input type="text" id="author_name" value="{{ $reply->user->name ?? __('N/A') }}" readonly
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-bg-gray-100 tw-cursor-not-allowed tw-text-base tw-px-4 tw-py-2">
                    </div>

                    {{-- 创建时间 (只读) --}}
                    <div>
                        <label for="created_at" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Created At') }}</label>
                        <input type="text" id="created_at" value="{{ $reply->created_at->format('Y/m/d H:i:s') }}" readonly
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-bg-gray-100 tw-cursor-not-allowed tw-text-base tw-px-4 tw-py-2">
                    </div>

                    {{-- 更新时间 (只读) --}}
                    <div>
                        <label for="updated_at" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Updated At') }}</label>
                        <input type="text" id="updated_at" value="{{ $reply->updated_at->format('Y/m/d H:i:s') }}" readonly
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-bg-gray-100 tw-cursor-not-allowed tw-text-base tw-px-4 tw-py-2">
                    </div>
                </div>
            </div>

            {{-- 动作按钮 --}}
            <div class="tw-mt-6 tw-flex tw-gap-3 tw-justify-end">
                <a href="{{ route('admin.replies.index') }}" class="tw-inline-flex tw-items-center tw-px-5 tw-py-2.5 tw-border tw-border-gray-300 tw-text-sm tw-font-medium tw-rounded-md tw-text-gray-700 tw-bg-white hover:tw-bg-gray-50 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-transition-colors tw-duration-200">
                    <svg class="tw-h-5 tw-w-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0A9 9 0 013 12z"></path></svg>
                    {{ __('Back to Reply List') }}
                </a>
                <button type="submit" class="tw-inline-flex tw-justify-center tw-py-2.5 tw-px-5 tw-border tw-border-transparent tw-shadow-sm tw-text-sm tw-font-medium tw-rounded-md tw-text-white tw-bg-indigo-600 hover:tw-bg-indigo-700 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-transition-colors tw-duration-200">
                    <svg class="tw-h-5 tw-w-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
@endsection
