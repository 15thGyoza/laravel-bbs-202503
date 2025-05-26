@extends('layouts.app')

@section('title', $user->name . ' `s Profile')`')

@section('content')

    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="card ">
                <img class="card-img-top"
                     src="{{ asset('images/avatar.png') }}"
                     alt="{{ $user->name }}">
                <div class="card-body">
                    <h5><strong>{{ __('Profile') }}</strong></h5>
                    <p>{{ $user->introduction }}</p>
                    <hr>
                    <h5><strong>{{ __('Joined on') }}</strong></h5>
                    <p>January 01 1901</p>
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
                    {{ __('No data available. 📭') }}
                </div>
            </div>

        </div>
    </div>
@stop
