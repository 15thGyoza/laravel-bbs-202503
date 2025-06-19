@extends('admin.layouts.app')

@section('title', __('Edit Topic'))
@section('description', 'トピック情報を編集します')

@section('content')
    <div class="tw-bg-white tw-shadow-xl sm:tw-rounded-lg tw-p-6">
        <form method="POST" action="{{ route('admin.topics.update', $topic) }}">
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

            {{-- 话题基本信息卡片 --}}
            <div class="tw-mb-6 tw-bg-gray-50 tw-rounded-lg tw-p-6 tw-shadow-inner">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-900 tw-mb-5 tw-border-b tw-pb-3 tw-border-gray-200">{{ __('Topic Information') }}</h3>

                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                    {{-- 标题 --}}
                    <div>
                        <label for="title" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Title') }}</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $topic->title) }}" required
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                        @error('title')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 分类 --}}
                    <div>
                        <label for="category_id" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Category') }}</label>
                        <select name="category_id" id="category_id" required
                                class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2 tw-pr-10">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $topic->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 内容 --}}
                    <div class="md:tw-col-span-2">
                        <label for="body" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Content') }}</label>
                        <textarea name="body" id="body" rows="10" required
                                  class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">{{ old('body', $topic->body) }}</textarea>
                        @error('body')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 摘要 --}}
                    <div class="md:tw-col-span-2">
                        <label for="excerpt" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Excerpt') }}</label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                                  class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">{{ old('excerpt', $topic->excerpt) }}</textarea>
                        @error('excerpt')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 别名 --}}
                    <div>
                        <label for="slug" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Slug') }}</label>
                        <input type="text" name="slug" id="slug" value="{{ rawurldecode($topic->link()) }}"
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2" readonly disabled>
                    </div>

                    {{-- 排序 --}}
                    <div>
                        <label for="order" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Order') }}</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $topic->order) }}"
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                        @error('order')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 浏览次数 (只读) --}}
                    <div>
                        <label for="view_count" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('View Count') }}</label>
                        <input type="text" id="view_count" value="{{ $topic->view_count }}" readonly
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-bg-gray-100 tw-cursor-not-allowed tw-text-base tw-px-4 tw-py-2">
                    </div>

                    {{-- 回复次数 (只读) --}}
                    <div>
                        <label for="reply_count" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Reply Count') }}</label>
                        <input type="text" id="reply_count" value="{{ $topic->reply_count }}" readonly
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-bg-gray-100 tw-cursor-not-allowed tw-text-base tw-px-4 tw-py-2">
                    </div>
                </div>
            </div>

            {{-- 动作按钮 --}}
            <div class="tw-flex tw-gap-3 tw-justify-end tw-mt-8">
                <a href="{{ route('admin.topics.index') }}" class="tw-inline-flex tw-items-center tw-px-5 tw-py-2.5 tw-border tw-border-gray-300 tw-text-sm tw-font-medium tw-rounded-md tw-text-gray-700 tw-bg-white hover:tw-bg-gray-50 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-transition-colors tw-duration-200">
                    <svg class="tw-h-5 tw-w-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0A9 9 0 013 12z"></path></svg>
                    {{ __('Back to Topic List') }}
                </a>
                <button type="submit" class="tw-inline-flex tw-justify-center tw-py-2.5 tw-px-5 tw-border tw-border-transparent tw-shadow-sm tw-text-sm tw-font-medium tw-rounded-md tw-text-white tw-bg-indigo-600 hover:tw-bg-indigo-700 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-transition-colors tw-duration-200">
                    <svg class="tw-h-5 tw-w-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
@endsection
