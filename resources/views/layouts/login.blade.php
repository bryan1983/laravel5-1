<ul class="nav navbar-nav navbar-right">
    @if (Auth::guest())
        <li><a href="{{ url('/auth/login') }}">{{ trans('auth.buttons.login') }}</a></li>
        <li><a href="{{ url('/auth/register') }}">{{ trans('auth.buttons.register') }}</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->full_name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/auth/logout') }}">{{ trans('auth.buttons.logout') }}</a></li>
            </ul>
        </li>
    @endif
</ul>