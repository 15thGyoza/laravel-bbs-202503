@php use Illuminate\Support\Facades\Request; @endphp
@if (count($replies))

    <ul class="list-group mt-4 border-0">
        @foreach ($replies as $reply)
            <li class="list-group-item pl-2 pr-2 border-start-0 border-end-0 @if($loop->first) border-top-0 @endif @if($loop->last) border-bottom-0 @endif">
                <a class="text-decoration-none" href="{{ $reply->topic->link(['#reply' . $reply->id]) }}">
                    {{ $reply->topic->title }}
                </a>

                <div class="reply-content text-secondary mt-2 mb-2">
                    {!! \Illuminate\Support\Str::limit($reply->content) !!}
                </div>

                <div class="text-secondary" style="font-size:0.9em;">
                    <i class="far fa-clock"></i> {{ __('Replied at') }} {{ $reply->created_at->diffForHumans() }}
                </div>
            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block">{{ __('No data available. 📭') }}</div>
@endif

{{-- 分页 --}}
<div class="mt-5 pt-1">
    {!! $replies->appends(Request::except('page'))->render() !!}
</div>
