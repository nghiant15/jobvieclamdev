@include('templates.vietstar.auth.user.modal_login')
@include('templates.vietstar.auth.user.modal_logup')
<!-- Navigation bar -->
<nav class="navbar navbar-expand-xl navbar-light bg-light shadow-sm fixed-top" id="main-nav">
    <!-- <div class="container-navbar"> -->
    <div class="container nav">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{ asset('/vietstar/imgs/logo-new.svg') }}" alt="vietstar">
        </a>
        <button type="button" id="mobile-sidebarCollapse" class="btn">
            <span class="dark-blue-text f"><i class="fas fa-bars fa-1x"></i></span>
        </button>
        <!-- collapse -->
        <div class="collapse navbar-collapse main-menu" id="navbarNavAltMarkup">
            <div class="navbar-nav flex-grow-1 justify-content-end">
                <ul class="navbar-nav main-menu-static ml-auto">
                    <li>
                        <a class="nav-link  {{ Request::url() == route('index') ? 'header-active' : 'text-main-color' }}" href="{{url('/')}}" style="{{ Request::url() == route('index')  ? 'color:#981B1E;' : '' }}">{{__('Home')}}</a>
                    </li>
                    {{--
                        <li><a class="nav-link " href="{{ url('/companies')}}">{{__('Công ty')}}</a></li> --}}
                    <li>
                        <a href="{{ route('job.list') }}" class="nav-link {{ Request::url() == route('job.list') || strpos(Request::url(),'/job/') > 0 ? 'header-active' : 'text-main-color' }}" style="{{ Request::url() == route('job.list')  || strpos(Request::url(),'job') ? 'color:#981B1E;' : '' }}">{{__('Jobs')}}</a>
                    </li>
                    <!--  <li>
                        <a href="{{ route('products-services') }}" class="nav-link {{ Request::url() == route('products-services') ? 'header-active' : 'text-main-color' }}"
                        style="{{ Request::url() == route('products-services')   ? 'color:#981B1E;' : '' }}">{{__('Products and Services')}}</a>
                    </li> -->
                    <!--  <li>
                        <a href="{{ route('vietnam-salary') }}" class="nav-link {{ Request::url() == route('vietnam-salary')  ? 'header-active' : 'text-main-color' }}"
                        style="{{ Request::url() == route('vietnam-salary')  ? 'color:#981B1E;' : '' }}">{{__('Vietnam Salary')}}</a>
                    </li> -->
                    @if(Auth::user())
                    <li class="has-child">
                        <a href="{{ route('my.profile') }}" class="nav-link nav-link-parent">{{__('Profiles and CVs')}}</a>
                        <button type="button" class="btn-show-sub-menu" data-ref="findJob" data-target="false"><span class="iconmoon icon-p-next"></span></button>
                        <ul class="sub-menu" data-ref="findJob" data-target="false">
                            @php
                            $pointer = Auth::check()==true ? '' : 'style=pointer-events:none;';
                            @endphp
                            <li><a class="sub-item" href="{{route('change.template')}}" {{$pointer}}><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{__('CV Templates')}}
                                </a>
                            </li>
                            @php
                            $pointerCom = Auth::guard('company')->check()==true ? '': 'style=pointer-events:none;';
                            @endphp
                            <li>
                                <a class="sub-item" href="{{route('application.manager')}}" {{$pointerCom}}><span class="iconmoon icon-recruiter-portfolio"></span>
                                    <!--  {{__('Dashboard')}} -->

                                Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="sub-item" href="{{route('cover-letter')}}" {{$pointer}}><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{__('Cover Letter')}}
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endif
                    <li class="has-child">
                        <a href="{{route('company.listing')}}" class="nav-link {{ Request::url() == route('company.listing') ? 'header-active' : 'text-main-color' }}" style="{{ Request::url() == route('company.listing')  || strpos(Request::url(),'job') ? 'color:#981B1E;' : '' }}">{{__('Company')}}</a>
                    </li>
                    {{-- <li class="has-child">
                        <a href="{{ route('my.profile') }}" class="nav-link nav-link-parent">{{__('News')}}</a>
                    <button type="button" class="btn-show-sub-menu" data-ref="findJob2" data-target="false"><span class="iconmoon icon-p-next"></span></button>
                    <ul class="sub-menu" data-ref="findJob2" data-target="false">
                        <li>
                            <a class="sub-item" href="{{route('page-category', ['slug' => 'cam_nang'])}}"><span class="iconmoon icon-recruiter-portfolio"></span>
                                {{__('Pages')}}
                            </a>
                        </li>
                        <li>
                            <a class="sub-item" href="{{route('blogs')}}"><span class="iconmoon icon-recruiter-portfolio"></span>
                                {{__('News')}}
                            </a>
                        </li>

                    </ul>
                    </li> --}}
                    <!-- <li>
                        <a href="#" class="nav-link">{{__('Introduce candidate')}}</a>
                    </li> -->

                    {{-- @foreach($show_in_top_menu as $top_menu) @php $cmsContent = App\CmsContent::getContentBySlug($top_menu->page_slug); @endphp
                    <li>
                        <a href="{{ route('cms', $top_menu->page_slug) }}" class="nav-link
                    {{ Request::url() == route('cms', $top_menu->page_slug) ? 'active' : 'text-main-color' }}"
                    style="{{ Request::url() == route('cms', $top_menu->page_slug)  ? 'color:#981B1E;' : '' }}">{{ $cmsContent->page_title }}</a>
                    </li>
                    @endforeach --}}
                    <li class="has-child">
                        <a href="#" class="nav-link nav-link-parent" {{ Request::url() == route('blogs') ? 'header-active' : 'text-main-color' }}" style="{{ Request::url() == route('blogs')  ? 'color:#981B1E;' : '' }}">{{__('Blog')}}
                        </a>
                        @php($categories = \App\Blog_category::get())
                        <button type="button" class="btn-show-sub-menu" data-ref="findJob_blog" data-target="false"><span class="iconmoon icon-p-next"></span></button>
                        <ul class="sub-menu" data-ref="findJob_blog" data-target="false">
                            @foreach($categories as $category)
                            <li>
                                <a class="sub-item" href="{{ url('/blog/category/') . "/" . $category->slug }}"><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{$category->heading}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>

                    <li><a href="{{ route('contact.us') }}"
                            class="nav-link  {{ Request::url() == route('contact.us') ? 'header-active' : 'text-main-color' }}"
                            style="{{ Request::url() == route('contact.us') ? 'color:#981B1E;' : '' }}">{{__('Contact')}}</a>
                    </li>

                    </li>

                    {{-- <li class="dropdown userbtn"><a href="{{url('/')}}"><img src="{{asset('/')}}images/lang.png" alt="" class="userimg" /></a>
                    <ul class="dropdown-menu">
                        @foreach($siteLanguages as $siteLang)
                        <li><a href="javascript:;" onclick="event.preventDefault(); document.getElementById('locale-form-{{$siteLang->iso_code}}').submit();" class="nav-link">{{$siteLang->native}}</a>
                            <form id="locale-form-{{$siteLang->iso_code}}" action="{{ route('set.locale') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="locale" value="{{$siteLang->iso_code}}" />
                                <input type="hidden" name="return_url" value="{{url()->full()}}" />
                                <input type="hidden" name="is_rtl" value="{{$siteLang->is_rtl}}" />
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    </li> --}}
                </ul>
                


            </div>
            @if(Auth::check())
            <!-- user-badge -->
            <div class="user-badge">
                <!-- navbar-lang PC -->
                <ul class="navbar-nav navbar-lang navbar-lang-pc ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link navbar-lang__link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('/vietstar/imgs/flags/') }}/{{config('app.available_locales')[App::getLocale()]['flag-icon']}}.png" alt="vietstar">
                        </a>
                        <div class="dropdown__lang_menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (config('app.available_locales') as $lang => $language)
                            @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"><img src="{{ asset('/vietstar/imgs/flags/') }}/{{$language['flag-icon']}}.png" alt="vietstar"></span> {{$language['display']}}</a>
                            @endif
                            @endforeach

                        </div>
                    </li>
                </ul>
                <!-- end navbar-lang PC -->
            
                <div class="user-badge__btn">

                    <a class="dropdown_menu__link" href="{{route('home')}}">
                        <span >
                        <i class="bi bi-person-circle fs-18px"></i>
                            {{Auth::user()->name}}
                        </span>
                    </a>
                    <div class="user_menu ">
                        <ul class="">
                            <li class="nav-item"><a href="{{route('home')}}" class="nav-link"><i class="jobicon fa fa-tachometer mx-1" aria-hidden="true"></i> <!-- {{__('Dashboard')}} -->
                                Dashboard
                            </a>
                            </li>
                            <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link"><i class="jobicon fa fa-user mx-1" aria-hidden="true"></i> {{__('My Profile')}}</a>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#modal_user_info"><i class="jobicon fa fa-eye mx-1" aria-hidden="true"></i>
                                    {{__('View Public Profile')}}</a> </li>
                            <li><a href="{{ route('my.job.applications') }}" class="nav-link"><i class="jobicon fa fa-desktop mx-1" aria-hidden="true"></i>
                                    {{__('My Job Applications')}}</a> </li>
                            <li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();" class="nav-link"><i class="jobicon fa fa-sign-out mx-1" aria-hidden="true"></i>
                                    {{__('Logout')}}</a> </li>
                            <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End user-badge  -->


            @endif





            <div class="d-flex  group-button">
                @if(!Auth::check())
                <a class="nav-link login-link" data-toggle="modal" data-target="#user_login_Modal">{{__('Log in')}} / {{__('Đăng ký')}} </a>
                @endif




                <a class="btn_for_em" href="http://tuyendung.jobvieclam.com:9999">
                <!-- <a class="btn_for_em" href="http://tuyendung.jobvieclam.com:9999"> -->

                <div  class="btn_for_em__head">
                {{__('For')}}
                </div> 
                <div  class="btn_for_em__body">
                    {{__('Employer')}}
                </div>    
                </a>
                
          
             

             
            </div>
        </div>
        <!-- end collapse -->
    </div>
</nav>
@push('styles')
<style>
    .header-active {
        color: #981B1E;
        text-decoration: underline;
        text-decoration-style: solid;
        text-underline-offset: 3px;
    }

    .login-btn {
        color: #981b1e;
        background-color: transparent !important;
        border-color: #981b1e;

    }

    .dropdown_menu {
        position: absolute;
        z-index: 1000;
        display: none;
        min-width: 10rem;
        padding: 0.5rem 0;
        margin: 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 0.25rem;
    }

    .dropdown_menu.show {
        display: block;
    }

    .navbar-lang .nav-item .dropdown__lang_menu {
        position: absolute;
        z-index: 1000;
        display: none;
        min-width: 10rem;
        padding: 0.5rem 0;
        margin: 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 0.25rem;
    }

    .navbar-lang .nav-item .dropdown__lang_menu.show {
        display: block;
    }
    .dropdown_menu__link  span{
        color: var(--bs-primary);
        font-weight: 500;
    }
    .user-badge__btn {
        position: relative;
        border-left: 1px solid #e8e8e8;
        padding: 3px 11px;
    }
   .user_menu{
        display: none;
        z-index: 5;
        position: absolute;
        top: calc(100% - 1px);
        right: 0;
        width: 100%;
        min-width: 240px;
        padding-top: 26px;
   }
   .user-badge__btn:hover .user_menu{
     display: block;
   }
   
   .user_menu ul {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 0;
        background: #fff;
        box-shadow: 0 2px 14px rgba(46, 46, 46, 0.5);
   }
   .user_menu ul .nav-link {
        font-size: 18px;
        font-weight: 500;
        color: var(--sub-text);
        padding: 12px 14px;

   }
   .user_menu .nav-link:hover ,.user_menu .nav-link:hover i {
        color: var(--bs-primary);
        background: #E9E9E9;
   }


</style>
@endpush


@push('scripts')
<script type="text/javascript">
    // $(document).ready(function() {
    //     $('.user-badge__btn').click(function() {
    //         $('.user-badge__btn').toggleClass('show');
    //         $('.user_menu').toggleClass('show');

    //     });
    // });
    $(document).ready(function() {
        $('.navbar-lang__link').click(function() {
            $('.dropdown__lang_menu').toggleClass('show');
        });
    });
</script>
@endpush