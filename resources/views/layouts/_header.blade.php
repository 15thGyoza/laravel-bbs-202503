@php
    use App\Models\Category;

    $categories = Category::all();

    // 为了代码清晰和避免在循环中重复调用，可以先获取当前分类ID (如果存在)
    // 假设你的分类路由参数名为 'category' (例如 categories/{category})
    // 如果路由模型绑定生效，request()->route('category') 会是 Category 模型实例
    // 如果没有，它会是 ID
    $currentCategoryParam = request()->route('category');
    $currentCategoryId = null;
    if ($currentCategoryParam) {
        $currentCategoryId = $currentCategoryParam instanceof Category ? $currentCategoryParam->id : $currentCategoryParam;
    }
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand " href="{{ url('/') }}">
            {{ config('app.name', 'Pandaria') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item "><a class="nav-link {{ request()->routeIs('topics.index') ? 'active' : '' }}" href="{{ route('topics.index') }}">Topics</a></li>
                @if($categories->count())
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('categories.show') && $currentCategoryId == $category->id) ? 'active' : '' }}"
                               href="{{ route('categories.show', $category->id) }}">{{ __($category->name) }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('topics.create') }}">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar }}"
                                 class="img-responsive img-circle" width="30px" height="30px" alt="">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               href="{{ route('users.show', auth()->user()) }}">
                                <i class="far fa-user mr-2"></i>&nbsp;
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item"
                               href="{{ route('users.edit', auth()->user()) }}">
                                <i class="far fa-edit mr-2"></i>&nbsp;
                                {{ __('Edit Profile') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="#">
                                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Are you sure you want to log out?');">
                                    @csrf
                                    <button class="btn btn-block btn-danger" type="submit"
                                            name="button">{{ __('Logout') }}</button>
                                </form>
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
