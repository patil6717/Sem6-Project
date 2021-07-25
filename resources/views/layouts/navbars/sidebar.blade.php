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
                    <img src="https://img.icons8.com/windows/24/ffffff/around-the-globe.png"/>
                    <span class="nav-link-text" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Trip') }}</span>
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
                        <li @if ($pageSlug == 'station') class="active " @endif>
                            <a href="{{ route('admin.station')  }}">
                                <img src="https://img.icons8.com/ios/24/ffffff/bus-stop.png"/>&nbsp;&nbsp;&nbsp; &nbsp; {{ _('Station') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
          
          
          
            <li @if ($pageSlug == 'tour') class="active bg-info " @endif>
                <a href="{{ route('admin.tourmanage') }}">
                    <img src="https://img.icons8.com/ios/24/ffffff/boarding-pass.png"/>&nbsp;&nbsp;&nbsp; {{ _('Tour') }}
                </a>
            </li>
            <li @if ($pageSlug == 'bushire') class="active bg-info" @endif>
                <a href="{{ route('bushiremanage') }}">
                    <i class="tim-icons icon-pin"></i>
                    <p>{{ _('Bus Hire') }}</p>
                </a>
            </li> 
            <li>
                <a data-toggle="collapse" href="#bus" aria-expanded="false">
                    <img src="https://img.icons8.com/ios/24/ffffff/bus.png"/>
                    <span class="nav-link-text" >&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Bus') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse show" id="bus">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'allbus') class="active bg-info" @endif>
                            <a href="{{ route('admin.buses')  }}">
                                <img src="https://img.icons8.com/material-rounded/24/ffffff/show-all-views.png"/>&nbsp;&nbsp;&nbsp; {{ _('All Bus') }}           
                            </a>
                        </li>
                        <li @if ($pageSlug == 'busmaintanance') class="active bg-info" @endif>
                            <a href="{{ route('admin.busmaintanance')  }}">
                                <img src="https://img.icons8.com/ios/24/ffffff/maintenance.png"/>&nbsp;&nbsp;&nbsp; {{ _('In Maintanance') }}                
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
           
            
            <li @if ($pageSlug == 'alldriver') class="active bg-info" @endif>
                <a href="{{ route('admin.drivers') }}">
                    <img src="https://img.icons8.com/ios/24/ffffff/user.png"/>{{ _('Driver') }}
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
