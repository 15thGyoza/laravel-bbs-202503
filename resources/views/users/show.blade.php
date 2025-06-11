@php

    use Illuminate\Support\Facades\Request;
    $hasRepliesParam = Request::has('tab') && Request::get('tab') === 'replies';

@endphp

@extends('layouts.app')

@section('title', $user->name . ' のプロフィール')

@section('content')

    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="card ">
                <img class="card-img-top"
                     src="{{ $user->avatar }}"
                     alt="{{ $user->name }}">
                <div class="card-body">
                    <h5><strong>{{ __('Profile') }}</strong></h5>
                    <p>{{ $user->introduction }}</p>
                    <hr>
                    <h5><strong>{{ __('Joined on') }}</strong></h5>
                    <p>{{ $user->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card ">
                <div class="card-body">
                    <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
                </div>
            </div>
            <hr>

            {{-- 用户发布的内容 --}}
            <div class="card ">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link bg-transparent {{ $hasRepliesParam ? '' : 'active' }}" href="{{ route('users.show', $user->id) }}">
                                {{ __('Topics') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $hasRepliesParam ? 'active' : '' }}"
                               href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">
                                {{ __('Replies') }}
                            </a>
                        </li>
                    </ul>
                    @if (request('tab') === 'replies')
                        @include('users._replies', [
                            'replies' => $user->replies()->with('topic')->recent()->paginate(5),
                        ])
                    @else
                        @include('users._topics', [
                            'topics' => $user->topics()->recent()->paginate(5),
                        ])
                    @endif
                </div>
            </div>

        </div>
    </div>
@stop
