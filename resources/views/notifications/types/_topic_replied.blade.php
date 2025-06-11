<li class="d-flex align-items-start py-3 @if (!$loop->last) border-bottom @endif">
    <div class="me-3 flex-shrink-0">
        <a href="{{ route('users.show', $notification->data['user_id']) }}">
            <img class="img-thumbnail" alt="{{ $notification->data['user_name'] }}"
                 src="{{ $notification->data['user_avatar'] }}"
                 style="width:48px; height:48px;" />
        </a>
    </div>

    <div class="flex-grow-1">
        <div class="d-flex justify-content-between mb-1 text-secondary small">
            <div>
                <a class="fw-bold text-decoration-none" href="{{ route('users.show', $notification->data['user_id']) }}">
                    {{ $notification->data['user_name'] }}
                </a>
                {{ __('replied to') }}
                <a class="text-decoration-none" href="{{ $notification->data['topic_link'] }}">
                    {{ $notification->data['topic_title'] }}
                </a>
            </div>
            <span class="text-muted me-2" title="{{ $notification->created_at }}">
                <i class="far fa-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
            </span>
        </div>

        <div class="reply-content text-dark small">
            {!! $notification->data['reply_content'] !!}
        </div>
    </div>
</li>
