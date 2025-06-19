@extends('admin.layouts.app')

@section('title', __('Topic Details'))
@section('description', __('Topic Information'))

@section('content')
    <div class="tw-bg-white tw-shadow-xl sm:tw-rounded-lg tw-p-6">
        <div class="tw-grid tw-grid-cols-1 tw-gap-6">
            <div>
                <h3 class="tw-text-lg tw-font-medium tw-text-gray-900 tw-mb-4">{{ __('Topic Information') }}</h3>
                <dl class="tw-divide-y tw-divide-gray-200">
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Title') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ $topic->title }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Content') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2 tw-prose tw-max-w-none">{!! $topic->body !!}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Author') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ $topic->user->name ?? __('N/A') }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Category') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ $topic->category->name ?? __('N/A') }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('View Count') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ $topic->view_count }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Reply Count') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ $topic->reply_count }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Last Reply User') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ \App\Models\User::find($topic->last_reply_user_id)?->name ?? __('N/A') }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Order') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ $topic->order }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Excerpt') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ $topic->excerpt ?? __('N/A') }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Slug') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ rawurldecode($topic->link()) ?? __('N/A') }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Created At') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ $topic->created_at->format('Y/m/d H:i:s') }}</dd>
                    </div>
                    <div class="tw-py-4 sm:tw-grid sm:tw-grid-cols-3 sm:tw-gap-4 sm:tw-px-6">
                        <dt class="tw-text-sm tw-font-medium tw-text-gray-500">{{ __('Updated At') }}</dt>
                        <dd class="tw-mt-1 tw-text-sm tw-text-gray-900 sm:tw-mt-0 sm:tw-col-span-2">{{ $topic->updated_at->format('Y/m/d H:i:s') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="tw-mt-6 tw-flex tw-gap-3">
            <a href="{{ route('admin.topics.edit', $topic) }}" class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-border tw-border-transparent tw-text-sm tw-font-medium tw-rounded-md tw-shadow-sm tw-text-white tw-bg-green-600 hover:tw-bg-green-700 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-green-500 tw-transition-colors tw-duration-200">
                <svg class="tw-h-5 tw-w-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                {{ __('Edit') }}
            </a>
            <a href="{{ route('admin.topics.index') }}" class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-text-sm tw-font-medium tw-rounded-md tw-text-gray-700 tw-bg-white hover:tw-bg-gray-50 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-transition-colors tw-duration-200">
                <svg class="tw-h-5 tw-w-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0A9 9 0 013 12z"></path></svg>
                {{ __('Back to Topic List') }}
            </a>
        </div>
    </div>
@endsection
