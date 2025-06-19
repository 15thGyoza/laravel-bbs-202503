@extends('admin.layouts.app')

@section('title', __('Site Settings'))
@section('description', __('Settings Management'))

@section('content')
    <div class="tw-bg-white tw-shadow-xl sm:tw-rounded-lg tw-p-6">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')

            {{-- 成功或错误消息 (由 layouts.admin 统一处理) --}}

            {{-- 站点设置表单 --}}
            <div class="tw-space-y-6">
                {{-- 通用设置分组 --}}
                <div class="tw-bg-gray-50 tw-rounded-lg tw-p-6 tw-shadow-inner">
                    <h3 class="tw-text-xl tw-font-semibold tw-text-gray-900 tw-mb-5 tw-border-b tw-pb-3 tw-border-gray-200">{{ __('General Settings') }}</h3>
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                        {{-- 示例：站点名称 --}}
                        <div>
                            <label for="site_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Site Name') }}</label>
                            <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name']->value ?? '') }}"
                                   class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                            <p class="tw-mt-1 tw-text-xs tw-text-gray-500">{{ __('Setting Description') }}: {{ $settings['site_name']->description ?? 'サイトのメインタイトルです。' }}</p>
                            @error('site_name')
                            <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 示例：站点 URL --}}
                        <div>
                            <label for="site_url" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Site URL') }}</label>
                            <input type="url" name="site_url" id="site_url" value="{{ old('site_url', $settings['site_url']->value ?? '') }}"
                                   class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                            <p class="tw-mt-1 tw-text-xs tw-text-gray-500">{{ __('Setting Description') }}: {{ $settings['site_url']->description ?? 'サイトのベースURLです。' }}</p>
                            @error('site_url')
                            <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 示例：管理员邮箱 --}}
                        <div>
                            <label for="admin_email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Admin Email Address') }}</label>
                            <input type="email" name="admin_email" id="admin_email" value="{{ old('admin_email', $settings['admin_email']->value ?? '') }}"
                                   class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                            <p class="tw-mt-1 tw-text-xs tw-text-gray-500">{{ __('Setting Description') }}: {{ $settings['admin_email']->description ?? '管理者のメールアドレス。' }}</p>
                            @error('admin_email')
                            <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 示例：是否开启注册 (boolean) - 美化版 --}}
                        <div class="md:tw-col-span-2"> {{-- 让这个checkbox占据两列宽度，以便有更多空间布局 --}}
                            <div class="tw-relative tw-flex tw-items-start">
                                <div class="tw-flex tw-h-6 tw-items-center">
                                    <input id="enable_registration" name="enable_registration" type="checkbox" value="1" {{ (old('enable_registration', $settings['enable_registration']->value ?? '0') == '1') ? 'checked' : '' }}
                                    class="tw-h-4 tw-w-4 tw-rounded tw-border-gray-300 tw-text-indigo-600 focus:tw-ring-indigo-500" disabled readonly>
                                </div>
                                <div class="tw-ml-3 tw-text-sm">
                                    <label for="enable_registration" class="tw-font-medium tw-text-gray-900">{{ __('Enable Registration') }}</label>
                                    <p class="tw-text-gray-500 tw-text-xs tw-mt-1">
                                        {{ __('Setting Description') }}: {{ $settings['enable_registration']->description ?? 'ユーザー登録を許可するかどうか。' }}
                                    </p>
                                </div>
                            </div>
                            @error('enable_registration')
                            <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- SEO 设置分组 --}}
                <div class="tw-bg-gray-50 tw-rounded-lg tw-p-6 tw-shadow-inner mt-3">
                    <h3 class="tw-text-xl tw-font-semibold tw-text-gray-900 tw-mb-5 tw-border-b tw-pb-3 tw-border-gray-200">{{ __('SEO Settings') }}</h3>
                    <div class="tw-grid tw-grid-cols-1 tw-gap-6">
                        {{-- 示例：SEO 描述 --}}
                        <div>
                            <label for="seo_description" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('SEO Description') }}</label>
                            <textarea name="seo_description" id="seo_description" rows="3"
                                      class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">{{ old('seo_description', $settings['seo_description']->value ?? '') }}</textarea>
                            <p class="tw-mt-1 tw-text-xs tw-text-gray-500">{{ __('Setting Description') }}: {{ $settings['seo_description']->description ?? 'サイトのSEOディスクリプションです。' }}</p>
                            @error('seo_description')
                            <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 示例：SEO 关键词 --}}
                        <div>
                            <label for="seo_keywords" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('SEO Keywords') }}</label>
                            <input type="text" name="seo_keywords" id="seo_keywords" value="{{ old('seo_keywords', $settings['seo_keywords']->value ?? '') }}"
                                   class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                            <p class="tw-mt-1 tw-text-xs tw-text-gray-500">{{ __('Setting Description') }}: {{ $settings['seo_keywords']->description ?? 'サイトのSEOキーワード（カンマ区切り）。' }}</p>
                            @error('seo_keywords')
                            <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- 动作按钮 --}}
            <div class="tw-mt-6 tw-flex tw-gap-3 tw-justify-end">
                <button type="submit" class="tw-inline-flex tw-justify-center tw-py-2.5 tw-px-5 tw-border tw-border-transparent tw-shadow-sm tw-text-sm tw-font-medium tw-rounded-md tw-text-white tw-bg-indigo-600 hover:tw-bg-indigo-700 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-transition-colors tw-duration-200">
                    <svg class="tw-h-5 tw-w-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    {{ __('Save Settings') }}
                </button>
            </div>
        </form>
    </div>
@endsection
