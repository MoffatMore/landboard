<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('img') }}/bw-gov-logo.jpg">
            </div>
        </a>
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            {{ __('BW Landboard') }}
        </a>
    </div>
    @if (Auth::user()->hasRole('admin'))
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                        <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                        <p>
                            {{ __('Shortcuts') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.waiting-list') }}">Waiting List</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.ownership-transfer') }}">Plots Transfer</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.appointment.index') }}">Interviews</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.statistics') }}">Archives</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    @else
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                        <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                        <p>
                            {{ __('Shortcuts') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('customer.plots-advert') }}">Adverts</a>
                        </li>
                        <li>
                            <a href="{{ route('customer.application.create') }}">My Applications</a>
                        </li>
                        <li>
                            <a href="{{ route('customer.myPlots') }}">My Plots</a>
                        </li>
                        <li>
                            <a href="{{ route('customer.application.index') }}">Pending Applications</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    @endif
</div>