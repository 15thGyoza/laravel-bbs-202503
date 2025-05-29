@php
    use Illuminate\Support\Facades\Request;

    $routeHasQueryOrder = Request::has('order');
    $currentOrder = Request::get('order', 'default'); // 默认值为 'default'

@endphp
@extends('layouts.app')

@section('title', isset($category) ? $category->name : __('Topics'))

@section('content')

    <div class="row mb-5">
        <div class="col-lg-9 col-md-9 topic-list">
            @if (isset($category))
                <div class="alert alert-info" role="alert">
                    {{ $category->name }} ：{{ $category->description }}
                </div>
            @endif

            <div class="card ">

                <div class="card-header bg-transparent">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            @if($routeHasQueryOrder)
                                <a class="nav-link {{ $currentOrder == 'default' ? 'active' : ''}}"
                                   href="{{ Request::url() }}?order=default">{{ __('Last Replied') }}</a>
                            @else
                                <a class="nav-link active"
                                   href="{{ Request::url() }}?order=default">{{ __('Last Replied') }}</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $routeHasQueryOrder && $currentOrder == 'recent' ? 'active' : '' }}"
                               href="{{ Request::url() }}?order=recent">{{ __('New published') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    {{-- 话题列表 --}}
                    @include('topics._topic_list', ['topics' => $topics])
                    {{-- 分页 --}}
                    <div class="mt-5">
                        {!! $topics->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 sidebar">
            @include('topics._sidebar')
        </div>
    </div>

@endsection
