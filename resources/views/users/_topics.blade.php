@if (count($topics))

    <ul class="list-group mt-4 border-0">
        @foreach ($topics as $topic)
            <li class="list-group-item pl-2 pr-2 border-start-0 border-end-0 @if($loop->first) border-top-0 @endif @if($loop->last) border-bottom-0 @endif">
                <a class="text-decoration-none" href="{{ $topic->link() }}">
                    {{ $topic->title }}
                </a>
                <span class="meta float-end text-secondary me-1">
                    {{ $topic->reply_count }} {{ __('Reply') }}
                <span> ⋅ </span>
                    {{ $topic->created_at->diffForHumans() }}
                </span>
            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block">
        {{ __('No data available. 📭') }}
    </div>
@endif

{{-- 分页 --}}
<div class="mt-5 pt-1">
    {!! $topics->render() !!}
</div>
