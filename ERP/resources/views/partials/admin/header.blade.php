@php
    $users=\Auth::user();
    //$profile=asset(Storage::url('uploads/avatar/'));
    $profile=\App\Models\Utility::get_file('uploads/avatar/');
    $languages=\App\Models\Utility::languages();
   $lang = isset($users->lang)?$users->lang:'en';
    if ($lang == null) {
        $lang = 'en';
    }
    // $LangName = \App\Models\Language::languageData($lang);
    $LangName = cache()->remember('full_language_data_' . $lang, now()->addHours(24), function () use ($lang) {
    return \App\Models\Language::languageData($lang);
    });
    $setting = \App\Models\Utility::settings();

    $unseenCounter=App\Models\ChMessage::where('to_id', Auth::user()->id)->where('seen', 0)->count();
@endphp

{{--<header class="dash-header  {{(isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on')?'transprent-bg':''}}">--}}

@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <header class="dash-header transprent-bg">
        @else
            <header class="dash-header">
                @endif

    <div class="header-wrapper">
        <div class="me-auto dash-mob-drp">
            <ul class="list-unstyled">
                <li class="dash-h-item mob-hamburger">
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>



            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                @if( \Auth::user()->type !='client' && \Auth::user()->type !='super admin' )
                        <li class="dropdown dash-h-item drp-notification">
                            <a class="dash-head-link arrow-none me-0" href="{{ url('chats') }}" aria-haspopup="false"
                               aria-expanded="false">
                                <i class="ti ti-brand-hipchat"></i>
                                <span class="bg-danger dash-h-badge message-toggle-msg  message-counter custom_messanger_counter beep"> {{ $unseenCounter }}<span
                                        class="sr-only"></span></span>
                            </a>

                        </li>
                    @endif

                <li class="dropdown dash-h-item drp-company">
                    <a
                        class="dash-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <span class="theme-avtar">
                             <img src="{{ !empty(\Auth::user()->avatar) ? $profile . \Auth::user()->avatar :  $profile.'avatar.png'}}" class="img-fluid rounded-circle">
                        </span>
                        <span class="hide-mob ms-2">{{__('Hi, ')}}{{\Auth::user()->name }} !</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">

                        <!-- <a href="{{ route('change.mode') }}" class="dropdown-item">
                            <i class="ti ti-circle-plus"></i>
                            <span>{{(Auth::user()->mode == 'light') ? __('Dark Mode') : __('Light Mode')}}</span>
                        </a> -->

                        <a href="{{route('profile')}}" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>{{__('Profile')}}</span>
                        </a>

                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>{{__('Logout')}}</span>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                            {{ csrf_field() }}
                        </form>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
