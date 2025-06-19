@extends('admin.layouts.app')

@section('title', __('Edit User'))
@section('description', __('Edit user information, including password'))

@section('content')
    <div class="tw-bg-white tw-shadow-xl sm:tw-rounded-lg tw-p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
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

            {{-- 用户基本信息卡片 --}}
            <div class="tw-mb-6 tw-bg-gray-50 tw-rounded-lg tw-p-6 tw-shadow-inner">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-900 tw-mb-5 tw-border-b tw-pb-3 tw-border-gray-200">{{ __('User Information') }}</h3>

                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                    {{-- 头像显示区域 (只读) --}}
                    <div class="md:tw-col-span-2 tw-mb-4">
                        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Avatar') }}</label>
                        <div class="tw-flex tw-items-center">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }} Avatar" class="tw-w-20 tw-h-20 tw-rounded-full tw-object-cover tw-border tw-border-gray-300 tw-shadow-sm">
                            @else
                                <span class="tw-inline-block tw-h-20 tw-w-20 tw-rounded-full tw-overflow-hidden tw-bg-gray-100 tw-border tw-border-gray-300 tw-shadow-sm">
                                    <svg class="tw-h-full tw-w-full tw-text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                            @endif
                            @if(!$user->avatar)
                                <span class="tw-ml-4 tw-text-gray-500 tw-text-sm">{{ __('No avatar uploaded') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- 姓名 --}}
                    <div>
                        <label for="name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                        @error('name')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 邮箱 --}}
                    <div>
                        <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="email"
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                        @error('email')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 个人简介 --}}
                    <div class="md:tw-col-span-2">
                        <label for="introduction" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Introduction') }}</label>
                        <textarea name="introduction" id="introduction" rows="3"
                                  class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">{{ old('introduction', $user->introduction) }}</textarea>
                        @error('introduction')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 邮箱验证时间 (只读) --}}
                    <div>
                        <label for="email_verified_at" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Email Verified At') }}</label>
                        <input type="text" id="email_verified_at" value="{{ $user->email_verified_at ? $user->email_verified_at->format('Y/m/d H:i:s') : __('Not Verified') }}" readonly
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-bg-gray-100 tw-cursor-not-allowed tw-text-base tw-px-4 tw-py-2">
                    </div>

                    {{-- 通知计数 (只读) - **已经设置为 disabled，这样不会被发送到服务器** --}}
                    <div>
                        <label for="notification_count" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Notification Count') }}</label>
                        <input type="number" name="notification_count" id="notification_count" value="{{ old('notification_count', $user->notification_count) }}"
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2" disabled>
                        {{-- 移除 @error 因为此字段不会提交 --}}
                    </div>
                </div>
            </div>

            {{-- 密码更改卡片 --}}
            <div class="tw-mb-6 tw-bg-gray-50 tw-rounded-lg tw-p-6 tw-shadow-inner">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-900 tw-mb-5 tw-border-b tw-pb-3 tw-border-gray-200">{{ __('Change Password') }}</h3>

                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                    {{-- 新密码 --}}
                    <div>
                        <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('New Password') }}</label>
                        <input type="password" name="password" id="password" autocomplete="new-password" placeholder="{{ __('Leave blank to keep current password') }}"
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                        @error('password')
                        <p class="tw-mt-1 tw-text-sm tw-text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 确认新密码 --}}
                    <div>
                        <label for="password_confirmation" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ __('Confirm Password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                               class="tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-base tw-px-4 tw-py-2">
                    </div>
                </div>
            </div>

            {{-- 动作按钮 --}}
            <div class="tw-flex tw-gap-3 tw-justify-end tw-mt-8">
                <a href="{{ route('admin.users.index') }}" class="tw-inline-flex tw-items-center tw-px-5 tw-py-2.5 tw-border tw-border-gray-300 tw-text-sm tw-font-medium tw-rounded-md tw-text-gray-700 tw-bg-white hover:tw-bg-gray-50 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-transition-colors tw-duration-200">
                    <svg class="tw-h-5 tw-w-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0A9 9 0 013 12z"></path></svg>
                    {{ __('Back to User List') }}
                </a>
                <button type="submit" class="tw-inline-flex tw-justify-center tw-py-2.5 tw-px-5 tw-border tw-border-transparent tw-shadow-sm tw-text-sm tw-font-medium tw-rounded-md tw-text-white tw-bg-indigo-600 hover:tw-bg-indigo-700 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-transition-colors tw-duration-200">
                    <svg class="tw-h-5 tw-w-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
@endsection
