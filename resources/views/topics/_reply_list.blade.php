<ul class="list-unstyled">
    @foreach ($replies as $index => $reply)
        <li class=" d-flex" name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
            <div class="me-3">
                <a href="{{ route('users.show', [$reply->user_id]) }}">
                    <img class="media-object img-thumbnail" alt="{{ $reply->user->name }}"
                         src="{{ $reply->user->avatar }}" style="width:48px; height:48px;"/>
                </a>
            </div>

            <div class="flex-grow-1">
                <div class="media-heading mt-0 mb-1 text-secondary">
                    <a class="text-decoration-none" href="{{ route('users.show', [$reply->user_id]) }}"
                       title="{{ $reply->user->name }}">
                        {{ $reply->user->name }}
                    </a>
                    <span class="text-secondary"> • </span>
                    <span class="meta text-secondary"
                          title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>

                    {{-- 回复删除按钮 --}}
                    @can('destroy', $reply)
                        <span class="meta float-end">
                        <form action="{{ route('replies.destroy', $reply->id) }}"
                              onsubmit="return confirm('{{ __('Are you sure you want to delete this comment?') }}');"
                              method="post">
                            @csrf
                            @method('DELETE')
                          <button type="submit" class="btn btn-default btn-xs pull-left text-secondary">
                            <i class="far fa-trash-alt"></i>
                          </button>
                        </form>
                    </span>
                    @endcan
                </div>
                <div class="reply-content text-secondary">
                    {!! $reply->content !!}
                </div>
            </div>
        </li>

        @if (!$loop->last)
            <hr>
        @endif

    @endforeach
</ul>
