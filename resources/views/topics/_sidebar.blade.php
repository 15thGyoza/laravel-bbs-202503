<div class="card ">
    <div class="card-body">
        <a href="{{ route('topics.create') }}" class="btn btn-success w-100" aria-label="Left Align">
            <i class="fas fa-pencil-alt mr-2"></i>  {{ __('New Post') }}
        </a>
    </div>
</div>

@if (count($active_users))
    <div class="card mt-4">
        <div class="card-body active-users pt-2">
            <div class="text-center mt-1 mb-0 text-muted">{{ __('Active Users') }}</div>
            <hr class="mt-2">
            @foreach ($active_users as $active_user)
                <a class="d-flex mt-2 text-decoration-none" href="{{ route('users.show', $active_user->id) }}">
                    <div class="media-left media-middle ms-3 me-2 ms-1">
                        <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="media-object" alt="{{ $active_user->name }}">
                    </div>
                    <div class="media-body ms-2">
                        <small class="media-heading text-secondary">{{ $active_user->name }}</small>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

@if (count($links))
    <div class="card mt-4">
        <div class="card-body pt-2">
            <div class="text-center mt-1 mb-0 text-muted">
                {{ __('Recommended Resources') }}
            </div>
            <hr class="mt-2 mb-3">
            @foreach ($links as $link)
                <a class="d-flex mt-1 text-decoration-none" href="{{ $link->link }}">
                    <div class="media-body mt-2">
                        <span class="media-heading text-muted">{{ $link->title }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif
