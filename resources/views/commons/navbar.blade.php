<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark navbar-pink"> 
        <a class="navbar-brand" href="/"> My Dictionary</a>
         
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item mr-3">{!! link_to_route('cards.create', '単語カード作成', [], ['class' => 'btn btn-lg btn-secondary']) !!}</li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item"><a href="/">ホーム</a></li>
                            <li class="dropdown-item">{!! link_to_route('users.show', 'My cards', ['id' => Auth::id()]) !!}</li>
                            <li class="dropdown-item">{!! link_to_route('users.good_cards', 'Like一覧', ['id' => Auth::id()]) !!}</li>
                            <li class="dropdown-item">{!! link_to_route('users.test_index', '単語テスト', ['id' => Auth::id()]) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('users.account', 'アカウント情報', ['id' => Auth::id()]) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                ログアウト
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>                                
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">{!! link_to_route('register', 'アカウント作成', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>