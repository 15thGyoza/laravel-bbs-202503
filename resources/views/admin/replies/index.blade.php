@php use Illuminate\Support\Str; @endphp
@extends('admin.layouts.app')

@section('title', __('Reply Management'))
@section('description', __('Replies Overview'))

@section('content')
    <div class="tw-bg-white tw-shadow-xl sm:tw-rounded-lg tw-p-6">
        <div class="tw-mb-6 tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-center tw-gap-4">
            {{-- 搜索框 --}}
            <div class="tw-flex-1 tw-w-full md:tw-w-auto">
                <form action="{{ route('admin.replies.index') }}" method="GET" class="tw-flex tw-items-center tw-gap-2">
                    <label for="search" class="tw-sr-only">{{ __('Search') }}</label>
                    <div class="tw-relative tw-flex-1">
                        <div
                            class="tw-absolute tw-inset-y-0 tw-left-0 tw-pl-3 tw-flex tw-items-center tw-pointer-events-none">
                            <svg class="tw-h-5 tw-w-5 tw-text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input type="text"
                               name="search"
                               id="search"
                               placeholder="{{ __('Search by content, topic title or user name') }}"
                               value="{{ request('search') }}"
                               class="tw-block tw-w-full tw-rounded-lg tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-py-2 tw-pl-10 tw-pr-4 tw-text-base tw-transition-all tw-duration-150">
                    </div>
                    <button type="submit"
                            class="tw-inline-flex tw-items-center tw-px-5 tw-py-2 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-lg tw-shadow-sm tw-text-white tw-bg-indigo-600 hover:tw-bg-indigo-700 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-transition-all tw-duration-200 ease-in-out">
                        {{ __('Search') }}
                    </button>
                </form>
            </div>

            {{-- 排序选择 (如果需要) --}}
            {{-- 回复模块通常按时间排序，如果不需要其他排序方式可以省略 --}}
            {{--
            <div>
                <form action="{{ route('admin.replies.index') }}" method="GET">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <label for="sort_by" class="tw-sr-only">{{ __('Sort by') }}</label>
                    <select name="sort_by"
                            id="sort_by"
                            onchange="this.form.submit()"
                            class="tw-block tw-w-full tw-rounded-lg tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-py-2 tw-px-4 tw-text-base tw-pr-10 tw-transition-all tw-duration-150">
                        <option value="latest" {{ request('sort_by', 'latest') == 'latest' ? 'selected' : '' }}>{{ __('Latest Registered') }}</option>
                        <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>{{ __('Oldest') }}</option>
                    </select>
                </form>
            </div>
            --}}
        </div>

        @if ($replies->isEmpty())
            <p class="tw-text-center tw-text-gray-500 tw-mt-8 tw-py-4 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-200">{{ __('No replies found.') }}</p>
        @else
            <div class="tw-overflow-x-auto tw-shadow-md tw-rounded-lg tw-border tw-border-gray-200">
                <table class="tw-min-w-full tw-divide-y tw-divide-gray-200 tw-table-auto">
                    <thead class="tw-bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="tw-px-6 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                            ID
                        </th>
                        <th scope="col"
                            class="tw-px-6 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                            {{ __('Content') }}
                        </th>
                        <th scope="col"
                            class="tw-px-6 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                            {{ __('Topic Title') }}
                        </th>
                        <th scope="col"
                            class="tw-px-6 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                            {{ __('Author') }}
                        </th>
                        <th scope="col"
                            class="tw-px-6 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                            {{ __('Replied At') }}
                        </th>
                        <th scope="col"
                            class="tw-px-6 tw-py-3 tw-text-right tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody class="tw-bg-white tw-divide-y tw-divide-gray-200">
                    @foreach ($replies as $reply)
                        <tr class="hover:tw-bg-gray-50 tw-transition-colors tw-duration-150">
                            <td class="tw-px-6 tw-py-4 tw-whitespace-nowrap tw-text-sm tw-font-medium tw-text-gray-900">
                                {{ $reply->id }}
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-whitespace-nowrap tw-text-sm tw-font-medium tw-text-gray-900">
                                {!! Str::limit($reply->content, 30, '...') !!}
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-whitespace-nowrap tw-text-sm tw-text-gray-500">
                                <a href="{{ route('admin.topics.show', $reply->topic) }}"
                                   class="tw-text-indigo-600 hover:tw-text-indigo-900 hover:tw-underline">
                                    {{ Str::limit($reply->topic->title ?? __('N/A'), 30, '...') }}
                                </a>
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-whitespace-nowrap tw-text-sm tw-text-gray-500">
                                {{ $reply->user->name ?? __('N/A') }}
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-whitespace-nowrap tw-text-sm tw-text-gray-500">
                                {{ $reply->created_at ? $reply->created_at->format('Y/m/d H:i:s') : __('N/A') }}
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-whitespace-nowrap tw-text-right tw-text-sm tw-font-medium">
                                <a href="{{ route('admin.replies.show', $reply) }}"
                                   class="tw-text-indigo-600 hover:tw-text-indigo-900 tw-mr-3 tw-inline-flex tw-items-center tw-gap-1">
                                    <svg class="tw-h-4 tw-w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ __('Details') }}
                                </a>
                                <a href="{{ route('admin.replies.edit', $reply) }}"
                                   class="tw-text-green-600 hover:tw-text-green-900 tw-mr-3 tw-inline-flex tw-items-center tw-gap-1">
                                    <svg class="tw-h-4 tw-w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('admin.replies.destroy', $reply) }}" method="POST"
                                      class="tw-inline"
                                      onsubmit="return confirm('{{ __('Are you sure you want to delete this reply?') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="tw-text-red-600 hover:tw-text-red-900 tw-inline-flex tw-items-center tw-gap-1">
                                        <svg class="tw-h-4 tw-w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tw-mt-4">
                {{ $replies->links() }}
            </div>
        @endif
    </div>
@endsection
