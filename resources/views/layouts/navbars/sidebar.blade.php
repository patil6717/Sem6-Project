<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo justify-content-center text-center">
            <a href="#" class="simple-text logo-normal">{{ $page ?? __('Dashboard') }} </a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active bg-info" @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ _('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#trip" aria-expanded="false">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('Trip') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="trip">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'route') class="active bg-info" @endif>
                            <a href="{{ route('admin.routes')  }}">
                                <img src="https://img.icons8.com/pastel-glyph/26/ffffff/route--v2.png"/>&nbsp;&nbsp;&nbsp; {{ _('Routes') }}
                              
                            </a>
                        </li>
                        <li @if ($pageSlug == 'shedule') class="active bg-info" @endif>
                            <a href="{{ route('admin.shedules')  }}">
                                <img src="https://img.icons8.com/metro/24/ffffff/overtime.png"/>&nbsp;&nbsp;&nbsp; {{ _('Shedules') }}
                               
                            </a>
                        </li>
                        <li @if ($pageSlug == 'allocation') class="active " @endif>
                            <a href="{{ route('admin.allocation')  }}">
                                  <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('Allocations') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'tour') class="active " @endif>
                <a href="{{ route('pages.icons') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ _('Tour') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'bushire') class="active bg-info" @endif>
                <a href="{{ route('bushiremanage') }}">
                    <i class="tim-icons icon-pin"></i>
                    <p>{{ _('Bus Hire') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'bus') class="active " @endif>
                <a href="{{ route('pages.notifications') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ _('Bus') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'driver') class="active " @endif>
                <a href="{{ route('pages.tables') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ _('Driver') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == '') class="active " @endif>
                <a href="{{ route('pages.typography') }}">
                    <i class="tim-icons icon-align-center"></i>
                    <p>{{ _('Typography') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'rtl') class="active " @endif>
                <a href="{{ route('pages.rtl') }}">
                    <i class="tim-icons icon-world"></i>
                    <p>{{ _('RTL Support') }}</p>
                </a>
            </li>
            <li></li>
        </ul>
    </div>
</div>
