<div class="bravo_topbar">
    <div class="container">
        <div class="content">
            <div class="topbar-left">

                {!! setting_item_with_lang("topbar_left_text") !!}


            </div>
            <div class="topbar-right">
                <ul class="topbar-items">
                @if(!Auth::id())
                        <li class="login-item">
                            <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                        </li>
                        <li class="signup-item">
                            <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                        </li>
                    @else
                        <li class="login-item dropdown">
                            <a href="#" data-toggle="dropdown" class="login">{{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu text-left">
                                @if(Auth::user()->hasPermissionTo('dashboard_vendor_access'))
                                <li><a href="{{route('vendor.dashboard')}}"><i class="icon ion-md-analytics"></i> {{__("Vendor Dashboard")}}</a></li>
                                @endif
                                <li class="@if(Auth::user()->hasPermissionTo('dashboard_vendor_access')) menu-hr @endif">
                                    <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a>
                                </li>
                                <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Booking History")}}</a></li>
                                <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>
                                @if(Auth::user()->hasPermissionTo('dashboard_access'))
                                    <li class="menu-hr"><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a></li>
                                @endif
                                <li class="menu-hr">
                                    <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                </li>
                            </ul>
                            <form id="logout-form-topbar" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                    @include('Core::frontend.currency-switcher')
                    @include('Language::frontend.switcher')
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="bravo_topbar second_topbar" style="display: none;">
    <div class="container">
        <div class="content">
            <div class="topbar-left">
                {!! setting_item_with_lang("topbar_left_text") !!}
            </div>
            <div class="filter-icon__mobi">
                <i class="fa fa-search-plus" aria-hidden="true" onclick="showHideMobileFilter();"></i>
            </div>
            <div class="bravo-menu">
                <?php generate_menu('primary') ?>
            </div>
            <div class="topbar-right">
                <ul class="topbar-items">
                    @if(!Auth::id())
                    <li class="login-item">
                        <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                    </li>
                    <li class="signup-item">
                        <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                    </li>
                    @else
                    <li class="login-item dropdown">
                        <a href="#" data-toggle="dropdown" class="login">{{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu text-left">
                            @if(Auth::user()->hasPermissionTo('dashboard_vendor_access'))
                            <li><a href="{{route('vendor.dashboard')}}"><i class="icon ion-md-analytics"></i> {{__("Vendor Dashboard")}}</a></li>
                            @endif
                            <li class="@if(Auth::user()->hasPermissionTo('dashboard_vendor_access')) menu-hr @endif">
                                <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a>
                            </li>
                            <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Booking History")}}</a></li>
                            <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>
                            @if(Auth::user()->hasPermissionTo('dashboard_access'))
                            <li class="menu-hr"><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a></li>
                            @endif
                            <li class="menu-hr">
                                <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                            </li>
                        </ul>
                        <form id="logout-form-topbar" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endif
                    @include('Core::frontend.currency-switcher')
                    @include('Language::frontend.switcher')
                </ul>
            </div>
        </div>
    </div>
    <style>
        .bravo_form_search_map {
            border: solid 1px #e0e0e0;
            flex-shrink: 0;
            background : white;
            padding: 12px;
        }
        .bravo_form_search_map .filter-item {
            padding: 0px 8px;
            flex-grow: 1;
        }
        @media (max-width: 990px) {
            .bravo_form_search_map .filter-item {
                border-bottom: 1px solid #e0e0e0;
            }
            .bravo_form_search_map .filter-item:last-child {
                border-bottom: none;
            }
        }
        .bravo_form_search_map .filter-item .dropdown-menu {
            margin-top: -1px;
            box-shadow: 1px 1px 4px rgba(0, 0, 0, .2);
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            min-width: 250px;
            border-radius: 0px;
        }
        .bravo_form_search_map .filter-item .dropdown-toggle:after {
            display: none;
        }
        .bravo_form_search_map .bravo_form {
            background: #fff;
            box-shadow: none;
        }
        @media (max-width: 990px) {
            .bravo_form_search_map .bravo_form {
                display: block !important;
                border: solid 1px #ccc;
                border-bottom: none;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .2);
            }
        }
        .bravo_form_search_map .bravo_form .form-group {
            margin-bottom: 0;
            border: 1px solid #e0e0e0;
            height: 42px;
            position: relative;
        }
        @media (max-width: 990px) {
            .bravo_form_search_map .bravo_form .form-group {
                border: none;
            }
        }
        .bravo_form_search_map .bravo_form .border-right {
            border-right: 1px solid #d7dce3;
        }
        .bravo_form_search_map .bravo_form .field-detination {
            position: relative;
            padding: 8px;
            transition: all 0.3s;
        }
        .bravo_form_search_map .bravo_form .field-detination #dropdown-destination {
            padding-left: 40px;
        }
        .bravo_form_search_map .bravo_form .field-detination #dropdown-destination .form-control {
            border: none;
            box-shadow: none;
            padding: 0;
            font-size: 14px;
            color: #4b4b4b;
            position: relative;
            left: -5px;
            height: 25px !important;
        }
        .bravo_form_search_map .bravo_form .field-detination #dropdown-destination .form-control option {
            color: #000;
        }
        .bravo_form_search_map .bravo_form label {
            font-size: 14px;
            color: #5e6d77;
            font-weight: 400;
            margin-bottom: 0px;
        }
        .bravo_form_search_map .bravo_form .render {
            font-size: 14px;
            color: #4b4b4b;
        }
        .bravo_form_search_map .bravo_form .field-icon {
            position: absolute;
            top: 50%;
            margin-top: -12px;
            font-size: 23px;
            color: #5e6d77;
            left: 8px;
        }
        .bravo_form_search_map .bravo_form .form-date-search, .bravo_form_search_map .bravo_form .form-guest-search, .bravo_form_search_map .bravo_form .form-date-search-hotel {
            padding: 10px 15px 8px;
            position: relative;
            transition: all 0.3s;
        }
        .bravo_form_search_map .bravo_form .form-date-search .date-wrapper, .bravo_form_search_map .bravo_form .form-guest-search .date-wrapper, .bravo_form_search_map .bravo_form .form-date-search-hotel .date-wrapper {
            padding-left: 15px;
        }
        .bravo_form_search_map .bravo_form .form-date-search .start_date, .bravo_form_search_map .bravo_form .form-guest-search .start_date, .bravo_form_search_map .bravo_form .form-date-search-hotel .start_date {
            position: absolute;
        }
        .bravo_form_search_map .bravo_form .form-date-search .check-in-wrapper, .bravo_form_search_map .bravo_form .form-guest-search .check-in-wrapper, .bravo_form_search_map .bravo_form .form-date-search-hotel .check-in-wrapper, .bravo_form_search_map .bravo_form .form-date-search .guest-wrapper, .bravo_form_search_map .bravo_form .form-guest-search .guest-wrapper, .bravo_form_search_map .bravo_form .form-date-search-hotel .guest-wrapper {
            padding-left: 10px;
        }
        .bravo_form_search_map .bravo_form .form-date-search .check-in-wrapper .check-in-render, .bravo_form_search_map .bravo_form .form-guest-search .check-in-wrapper .check-in-render, .bravo_form_search_map .bravo_form .form-date-search-hotel .check-in-wrapper .check-in-render, .bravo_form_search_map .bravo_form .form-date-search .guest-wrapper .check-in-render, .bravo_form_search_map .bravo_form .form-guest-search .guest-wrapper .check-in-render, .bravo_form_search_map .bravo_form .form-date-search-hotel .guest-wrapper .check-in-render, .bravo_form_search_map .bravo_form .form-date-search .check-in-wrapper .check-out-render, .bravo_form_search_map .bravo_form .form-guest-search .check-in-wrapper .check-out-render, .bravo_form_search_map .bravo_form .form-date-search-hotel .check-in-wrapper .check-out-render, .bravo_form_search_map .bravo_form .form-date-search .guest-wrapper .check-out-render, .bravo_form_search_map .bravo_form .form-guest-search .guest-wrapper .check-out-render, .bravo_form_search_map .bravo_form .form-date-search-hotel .guest-wrapper .check-out-render {
            display: inline-block;
            width: auto;
        }
        .bravo_form_search_map .bravo_form .form-date-search .check-in-wrapper span, .bravo_form_search_map .bravo_form .form-guest-search .check-in-wrapper span, .bravo_form_search_map .bravo_form .form-date-search-hotel .check-in-wrapper span, .bravo_form_search_map .bravo_form .form-date-search .guest-wrapper span, .bravo_form_search_map .bravo_form .form-guest-search .guest-wrapper span, .bravo_form_search_map .bravo_form .form-date-search-hotel .guest-wrapper span {
            color: #5e6d77;
            position: relative;
            padding: 0px 5px;
        }
        .bravo_form_search_map .bravo_form .form-date-search .check-in-wrapper label, .bravo_form_search_map .bravo_form .form-guest-search .check-in-wrapper label, .bravo_form_search_map .bravo_form .form-date-search-hotel .check-in-wrapper label, .bravo_form_search_map .bravo_form .form-date-search .guest-wrapper label, .bravo_form_search_map .bravo_form .form-guest-search .guest-wrapper label, .bravo_form_search_map .bravo_form .form-date-search-hotel .guest-wrapper label {
            display: block;
        }
        .bravo_form_search_map .bravo_form .form-date-search .check-in-out, .bravo_form_search_map .bravo_form .form-guest-search .check-in-out, .bravo_form_search_map .bravo_form .form-date-search-hotel .check-in-out {
            position: absolute;
            left: -15px;
            bottom: 1px;
            z-index: -1;
            opacity: 0;
        }
        .bravo_form_search_map .bravo_form .filter-simple .form-group .filter-title {
            padding: 10px 15px;
            justify-content: space-between;
            align-items: center;
            display: flex;
        }
        .bravo_form_search_map .bravo_form .g-button-submit {
            position: relative;
            min-height: 66px;
            margin: 0 -1px 0 -15px;
        }
        .bravo_form_search_map .bravo_form .g-button-submit button {
            position: absolute;
            left: 0;
            top: 0;
            display: block;
            height: 100%;
            width: 100%;
            margin-right: -15px;
            border-radius: 0;
            background: #5191fa;
            border: none;
            text-transform: uppercase;
            font-weight: 500;
            cursor: pointer;
        }
        .bravo_form_search_map .bravo_form .form-content {
            padding: 8px 8px 8px 40px;
        }
        .bravo_form_search_map .bravo_form .form-content .smart-search {
            position: initial;
        }
        .bravo_form_search_map .bravo_form .form-content .smart-search .parent_text {
            font-size: 14px;
            color: #4b4b4b;
        }
        .bravo_form_search_map .bravo_form .form-content .smart-search .parent_text::-webkit-input-placeholder {
            color: #4b4b4b;
        }
        .bravo_form_search_map .bravo_form .form-content .smart-search .parent_text::-moz-placeholder {
            color: #4b4b4b;
        }
        .bravo_form_search_map .bravo_form .form-content .smart-search .parent_text:-ms-input-placeholder {
            color: #4b4b4b;
        }
        .bravo_form_search_map .bravo_form .form-content .smart-search .parent_text:-moz-placeholder {
            color: #4b4b4b;
        }
        .bravo_form_search_map .bravo_form .form-content .smart-search .parent_text::placeholder {
            color: #4b4b4b;
        }
        .bravo_form_search_map .bravo_form .form-content .smart-search:after {
            color: #4b4b4b;
            top: 18px;
            right: 15px;
        }
        .bravo_form_search_map .bravo_form .form-content .bravo-autocomplete {
            margin-top: 1px;
            right: -1px;
            left: -1px;
        }
        .second_topbar .bravo-menu ul li a {
            font-size: 11px;
        }
    </style>
    @unless(str_contains(url()->current(), '/page'))
    @unless(str_contains(url()->current(), '/user'))

        @if(Request::is('*/hotel') or Request::is('hotel'))
            <div class="bravo_form_search_map">
                @include('Hotel::frontend.layouts.search-map.form-search-map')
            </div>
        @endif

        @if(Request::is('*/space') or Request::is('space'))
            <div class="bravo_form_search_map">
                @include('Space::frontend.layouts.search-map.form-search-map')
            </div>
        @endif

        @if(Request::is('*/event') or Request::is('event'))
            <div class="bravo_form_search_map">
                @include('Event::frontend.layouts.search-map.form-search-map')
            </div>
        @endif

        @if(Request::is('*/car') or Request::is('car'))
            <style>
                .bravo_banner {
                    margin-top : -174px;
                }
            </style>
            <div class="bravo_form_search_map">
                @include('Car::frontend.layouts.search-map.form-search-map')
            </div>
        @endif

        @if(Request::is('*/tour') or Request::is('tour'))
            <div class="bravo_form_search_map">
                @include('Tour::frontend.layouts.search-map.form-search-map')
            </div>
        @endif

    @endunless
    @endunless
</div>
