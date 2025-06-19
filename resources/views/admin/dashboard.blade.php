@php use Illuminate\Support\Str; @endphp
@extends('admin.layouts.app')

{{-- 页面标题和描述 --}}
@section('title', __('admin.dashboard.title'))
@section('description', __('admin.dashboard.description'))

@section('content')
    {{-- 顶部核心数据概览 - 简洁的数字区块 --}}
    <div class="tw-grid tw-grid-cols-1 tw-gap-6 md:tw-grid-cols-3 tw-mb-8">
        {{-- 用户总数区块 --}}
        <div class="tw-bg-white tw-rounded-lg tw-shadow-xl tw-p-6 tw-flex tw-flex-col tw-items-center tw-justify-center tw-text-center">
            <div class="tw-text-indigo-600 tw-mb-3">
                <svg class="tw-h-16 tw-w-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-3-5.197M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('admin.dashboard.users_count') }}</p>
            <p class="tw-mt-2 tw-text-4xl tw-font-extrabold tw-text-gray-900">{{ $userCount }}</p>
        </div>

        {{-- 话题总数区块 --}}
        <div class="tw-bg-white tw-rounded-lg tw-shadow-xl tw-p-6 tw-flex tw-flex-col tw-items-center tw-justify-center tw-text-center">
            <div class="tw-text-green-600 tw-mb-3">
                <svg class="tw-h-16 tw-w-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <p class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('admin.dashboard.topics_count') }}</p>
            <p class="tw-mt-2 tw-text-4xl tw-font-extrabold tw-text-gray-900">{{ $topicCount }}</p>
        </div>

        {{-- 回复总数区块 --}}
        <div class="tw-bg-white tw-rounded-lg tw-shadow-xl tw-p-6 tw-flex tw-flex-col tw-items-center tw-justify-center tw-text-center">
            <div class="tw-text-yellow-600 tw-mb-3">
                <svg class="tw-h-16 tw-w-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h10a8 8 0 018 8v2M3 10l6-6m-6 6l6 6"/>
                </svg>
            </div>
            <p class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('admin.dashboard.replies_count') }}</p>
            <p class="tw-mt-2 tw-text-4xl tw-font-extrabold tw-text-gray-900">{{ $replyCount }}</p>
        </div>
    </div>

    {{-- 主要内容区域 - 左右布局 --}}
    <div class="tw-grid tw-grid-cols-1 tw-gap-8 lg:tw-grid-cols-3">
        {{-- 左侧两列合并: 最新帖子 & 最新回复 - 两个独立的大卡片 --}}
        <div class="tw-space-y-8 lg:tw-col-span-2">
            {{-- 最新帖子卡片 --}}
            <div class="tw-bg-white tw-rounded-lg tw-shadow-xl tw-p-6">
                <h3 class="tw-text-2xl tw-font-bold tw-text-gray-900 tw-mb-6 tw-border-b tw-pb-4 tw-border-gray-200">
                    {{ __('admin.dashboard.latest_posts') }}
                </h3>
                <ul role="list" class="tw-divide-y tw-divide-gray-200">
                    @forelse ($latestPosts as $post)
                        <li class="tw-py-4">
                            <div class="tw-flex tw-items-start tw-space-x-4">
                                <div class="tw-flex-shrink-0 tw-text-gray-400 tw-mt-1">
                                    <svg class="tw-h-6 tw-w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div class="tw-flex-1 tw-min-w-0">
                                    <div class="tw-flex tw-justify-between tw-items-baseline">
                                        <a href="{{ route('admin.topics.show', $post) }}" class="tw-text-base tw-font-medium tw-text-gray-900 tw-truncate hover:tw-text-indigo-600 hover:tw-underline">
                                            {{ $post->title }}
                                        </a>
                                        <p class="tw-ml-2 tw-flex-shrink-0 tw-text-sm tw-text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="tw-mt-1 tw-text-sm tw-text-gray-600 tw-line-clamp-2">{!! Str::limit($post->body, 150) !!}</p>
                                    <p class="tw-mt-1 tw-text-xs tw-text-gray-500">
                                        {{ __('Author') }}: {{ $post->user->name ?? 'N/A' }} |
                                        {{ __('Category') }}: {{ $post->category->name ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="tw-py-4 tw-text-sm tw-text-gray-500 tw-text-center">{{ __('admin.dashboard.no_posts') }}</li>
                    @endforelse
                </ul>
            </div>

            {{-- 最新回复卡片 --}}
            <div class="tw-bg-white tw-rounded-lg tw-shadow-xl tw-p-6">
                <h3 class="tw-text-2xl tw-font-bold tw-text-gray-900 tw-mb-6 tw-border-b tw-pb-4 tw-border-gray-200">
                    {{ __('admin.dashboard.latest_replies') }}
                </h3>
                <ul role="list" class="tw-divide-y tw-divide-gray-200">
                    @forelse ($latestReplies as $reply)
                        <li class="tw-py-4">
                            <div class="tw-flex tw-items-start tw-space-x-4">
                                {{-- **极简头像显示** --}}
                                @if($reply->user->avatar)
                                    <img class="tw-h-10 tw-w-10 tw-rounded-full tw-object-cover tw-flex-shrink-0 tw-shadow"
                                         src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name ?? 'N/A' }}">
                                @else
                                    <span class="tw-inline-flex tw-items-center tw-justify-center tw-h-10 tw-w-10 tw-rounded-full tw-bg-blue-500 tw-text-white tw-text-lg tw-font-bold tw-flex-shrink-0 tw-shadow">
                                        {{ Str::upper(Str::substr($reply->user->name, 0, 1)) }}
                                    </span>
                                @endif
                                <div class="tw-flex-1 tw-min-w-0">
                                    <div class="tw-flex tw-justify-between tw-items-baseline">
                                        <h4 class="tw-text-base tw-font-medium tw-text-gray-900 tw-truncate">{{ $reply->user->name ?? 'N/A' }}</h4>
                                        <p class="tw-ml-2 tw-flex-shrink-0 tw-text-sm tw-text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="tw-mt-1 tw-text-sm tw-text-gray-600">
                                        {{ __('admin.dashboard.replied_to') }}
                                        <a href="{{ route('admin.topics.show', $reply->topic) }}"
                                           class="tw-font-medium tw-text-indigo-600 hover:tw-underline">
                                            {{ $reply->topic->title ?? 'N/A' }}
                                        </a>
                                    </p>
                                    <p class="tw-mt-1 tw-text-sm tw-text-gray-700 tw-line-clamp-2">{!! Str::limit($reply->content, 120) !!}</p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="tw-py-4 tw-text-sm tw-text-gray-500 tw-text-center">{{ __('admin.dashboard.no_replies') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- 右侧一列: 活跃用户卡片 --}}
        <div class="lg:tw-col-span-1">
            <div class="tw-bg-white tw-rounded-lg tw-shadow-xl tw-p-6">
                <h3 class="tw-text-2xl tw-font-bold tw-text-gray-900 tw-mb-6 tw-border-b tw-pb-4 tw-border-gray-200">{{ __('admin.dashboard.active_users') }}</h3>
                <ul role="list" class="tw-divide-y tw-divide-gray-200">
                    @forelse ($activeUsers as $user)
                        <li class="tw-py-4 tw-flex tw-items-start">
                            {{-- **极简头像显示** --}}
                            @if($user->avatar)
                                <img class="tw-h-12 tw-w-12 tw-rounded-full tw-object-cover tw-flex-shrink-0 tw-shadow"
                                     src="{{ $user->avatar }}" alt="{{ $user->name ?? 'N/A' }}">
                            @else
                                <span class="tw-inline-flex tw-items-center tw-justify-center tw-h-12 tw-w-12 tw-rounded-full tw-bg-indigo-500 tw-text-white tw-text-lg tw-font-bold tw-flex-shrink-0 tw-shadow">
                                    {{ Str::upper(Str::substr($user->name, 0, 1)) }}
                                </span>
                            @endif
                            <div class="tw-ml-4 tw-min-w-0 tw-flex-1">
                                <p class="tw-text-base tw-font-medium tw-text-gray-900 tw-truncate">{{ $user->name }}</p>
                                <p class="tw-mt-1 tw-text-sm tw-text-gray-500 tw-truncate">{{ $user->email }}</p>
                                <p class="tw-mt-1 tw-text-xs tw-text-gray-600">
                                    {{ $user->topics_count }} {{ __('admin.dashboard.topics') }}
                                    / {{ $user->replies_count }} {{ __('admin.dashboard.replies') }}
                                    @if ($user->last_active_at)
                                        <span class="tw-block tw-text-gray-500">{{ __('Last Active') }}: {{ $user->last_active_at->diffForHumans() }}</span>
                                    @endif
                                </p>
                            </div>
                        </li>
                    @empty
                        <li class="tw-py-4 tw-text-sm tw-text-gray-500 tw-text-center">{{ __('admin.dashboard.no_active_users') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
