@push('styles')
<style type="text/css">
    /* Option 2: Import via CSS */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");

    .wrapper {
        display: flex;
        width: 100%;
        align-items: stretch;
    }

    #sidebar {
        min-width: 0px;
        max-width: 0px;
        background: #063146;
        color: #bcc0c8;
        transition: all 0.3s;
        overflow: hidden;
        max-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 76px;
        left: 0;
        bottom: 0;
        z-index: 1;
    }

    /* PROFILE CSS */
    .profile {
        position: relative;
        padding: 20px 10px;
        border-bottom: 1px solid #ccc;
    }

    .profile .avatar {
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
    }

    .profile .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile .username {
        margin-top: 15px;
        font-size: 16px;
        text-align: center;
        text-transform: uppercase;
    }

    .profile .username p a {
        color: #ffffff;
        font-size: 16px;
        text-align: center;
        text-transform: uppercase;
        font-weight: 600;
    }


    .sidebar-btn {
        position: absolute;
        top: 50%;
        left: 20px;
    }

    #sidebar.active {
        min-width: 300px;
        max-width: 300px;
        overflow: hidden;
        display: flex;
        flex-direction: column;

        max-height: 100vh;
    }

    #sidebar.active .sidebar-btn {
        justify-content: end;
    }

    #sidebar .side-bar-content {
        display: none;
    }

    #sidebar.active .side-bar-content {
        display: block;
    }

    #sidebar.active ul.components {
        width: 100%;
    }

    #sidebar.active .sidebar-header {
        display: flex;
        flex-direction: column;
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: #063146;
        width: 100%;
        display: none;
    }

    #sidebar ul.components {
        border-bottom: 1px solid #47748b;
    }

    #sidebar ul p {
        color: #063146;
        padding: 10px;
    }

    #sidebar ul li a {
        padding: 20px 20px;
        font-size: 1.1em;
        display: block;
        background-color: #063146;
    }



    #sidebar ul li a:hover {
        color: #7386D5;
        background: #981b1e;
    }

    #sidebar ul li a:hover span {
        color: white;
    }



    #sidebar ul li a i {
        font-size: 20px;
        color: white;
    }



    #sidebar ul li .dropdown-toggle::after {
        color: #b2bcc6;
        display: none;
    }

    #sidebar.active ul li .dropdown-toggle::after {
        color: #b2bcc6;
        display: block;
        right: 20px;
    }

    #sidebar .sidebar-item.active>a {
        background-color: #981b1e;
        color: white;
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 0px;
        transform: translateY(-50%);
    }

    #sidebar.active .dropdown-toggle::after {
        display: none;
    }


    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #6d7fcc;
    }

    ul.CTAs {
        padding: 20px;
    }

    ul.CTAs a {
        text-align: center;
        font-size: 0.9em !important;
        display: block;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    .list-group-item.active {
        border: unset;
    }

    .list-group-item {
        border: unset;
    }

    ul.list-unstyled.components li {
        margin: 10px 0;
    }

    a.download {
        background: #bcc0c8;
        color: #7386D5;
    }

    a.article,
    a.article:hover {
        background: #6d7fcc !important;
        color: #bcc0c8 !important;
    }

    #sidebar.active ul li a span {
        color: white;
    }


    #sidebarCollapse span i {
        color: #bcc0c8;
    }

    #sidebar ul li a span {
        color: #bcc0c8;
        font-size: 18px;
        font-weight: 600;
    }

    #sidebar ul ul a {
        padding-left: 70px !important;
    }

    #sidebar ul li.active a span {
        color: white;
    }

    ul#pageSubmenu li {
        margin-left: 10px;
    }

    ul#pageSubmenu li a span {
        font-size: 16px !important;
    }

    #sidebar .menu {
        position: relative;
        width: 100%;
    }

    .sidebar-main-nav {

        transform: translateX(0);
        opacity: 1;
        pointer-events: auto;

    }

    .sidebar-user-nav {
        -webkit-transform: translateX(-300px);
        -ms-transform: translateX(-300px);
        transform: translateX(-300px);
    }

    .sidebar-main-nav,
    .sidebar-user-nav {
        position: absolute;
        top: 0px;
        left: 0px;
    }

    .sidebar-main-nav.active {

        -webkit-transform: translateX(-300px);
        -ms-transform: translateX(-300px);
        transform: translateX(-300px);
    }

    .sidebar-user-nav.active {
        transform: translateX(0);
        opacity: 1;
        pointer-events: auto;
    }

    .sidebar-bottom {
        display: none;
    }

    #sidebar.active .sidebar-bottom {
        display: block;
    }
</style>

@endpush
<nav id="sidebar" class="active">
    <!-- <div class="sidebar-btn">
        <button type="button" id="sidebarCollapse" class="btn">
            <span class="dark-blue-text"><i class="fas fa-bars fa-1x"></i></span>
        </button>
    </div> -->
    <div class="sidebar-header">
        <div class="profile" bis_skin_checked="1">
            <div class="avatar" bis_skin_checked="1"><a href="#">
                    <img class="lazy-bg" src="{{ auth()->user()->avatar() }}" alt="avatar" style=""></a>
            </div>
            <div class="username" bis_skin_checked="1">
                <p><a href="#">{{auth()->user()->name}}</a></p>
            </div>
            <div class="back-menu-normal" bis_skin_checked="1"><em class="mdi mdi-arrow-left"></em></div>
        </div>

        <div class="menu">
            <ul class="list-unstyled components sidebar-main-nav" id="sidebar-main-nav">
                <li class="sidebar-item {{ Request::url() == route('index') ? 'active' : '' }}">
                    <a href="{{url('/')}}" class="list-group-item list-group-item-action {{ Request::url() == route('index') ? 'active' : '' }}">
                        <div class="d-flex w-100">
                            <i class="bi bi-house fs-24px me-2"></i>
                            <span class="side-bar-content"> {{__('Home')}}</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::url() == route('job.list') || strpos(Request::url(),'/job/') > 0 ? 'active' : '' }}">
                    <a href="{{ route('job.list') }}" class="list-group-item list-group-item-action {{ Request::url() == route('job.list') || strpos(Request::url(),'/job/') > 0 ? 'active' : '' }}">

                        <div class="d-flex w-100">
                            <i class="bi bi-card-list fs-24px me-2"></i>
                            <span class="side-bar-content"> {{__('Jobs')}}</span>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="#cv_sub_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="d-flex w-100">
                            <i class="bi bi-file-person fs-24px me-2"></i>
                            <span class="side-bar-content"> {{__('Profiles and CVs')}}</span>
                        </div>
                    </a>
                    <ul class="collapse list-unstyled" data-ref="findJob" data-target="false" id="cv_sub_list">
                        @php
                        $pointer = Auth::check()==true ? '' : 'style=pointer-events:none;';
                        @endphp
                        <li>
                            <a class="{{ Request::url() == route('my.job.applications') ? 'active' : '' }}" href="{{route('change.template')}}" {{$pointer}}>
                                <div class="d-flex w-100">

                                    <span class="side-bar-content"> {{__('CV Templates')}}</span>
                                </div>
                            </a>
                        </li>
                        @php
                        $pointer = Auth::check()==true ? '' : 'style=pointer-events:none;';
                        @endphp
                        <li>
                            <a class="sub-item" href="{{route('application.manager')}}" {{$pointer}}>
                                <div class="d-flex w-100">

                                    <span class="side-bar-content"> {{__('CV Management')}}</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="sub-item" href="{{route('cover-letter')}}" {{$pointer}}>
                                <div class="d-flex w-100">

                                    <span class="side-bar-content"> {{__('Cover Letter')}}</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>



                <li>
                    <a href="#company_sub_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="d-flex w-100">
                            <i class="bi bi-building fs-24px me-2"></i>
                            <span class="side-bar-content">{{__('Company')}}</span>
                        </div>
                    </a>

                    <ul class="collapse list-unstyled" data-ref="findJob1" data-target="false" id="company_sub_list">
                        <li>
                            <a class="sub-item" href="{{route('about_us')}}">
                                <div class="d-flex w-100">

                                    <span class="side-bar-content"> {{__('About us')}}
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="sub-item" href="{{route('top-companies')}}">
                                <div class="d-flex w-100">

                                    <span class="side-bar-content"> {{__('Top companies')}}
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="sub-item" href="{{route('company.listing')}}">
                                <div class="d-flex w-100">

                                    <span class="side-bar-content"> {{__('Companies')}}
                                    </span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="has-child">
                    <a href="#blog_sub_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="d-flex w-100">
                            <i class="bi bi-newspaper fs-24px me-2"></i>
                            <span class="side-bar-content">{{__('Blog')}}</span>
                        </div>
                    </a>
                    @php($categories = \App\Blog_category::get())

                    <ul class="collapse list-unstyled" data-ref="findJob_blog" data-target="false" id="blog_sub_list">
                        @foreach($categories as $category)
                        <li>
                            <a class="sub-item" href="{{ url('/blog/category/') . "/" . $category->slug }}">

                                <div class="d-flex w-100">

                                    <span class="side-bar-content">{{$category->heading}}</span>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>


            </ul>
            <!-- user nav -->
            <ul class="list-unstyled components sidebar-user-nav" id="sidebar-user-nav">
                <li class="sidebar-item {{ Request::url() == route('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="list-group-item list-group-item-action {{ Request::url() == route('home') ? 'active' : '' }}">
                        <div class="d-flex w-100">
                            <span class="icon-dashboard-icon fs-24px me-2"></span>
                            <span class="side-bar-content">{{__('Dashboard')}}</span>
                        </div>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::url() == route('my.profile') ? 'active' : '' }}">
                    <a href="{{ route('my.profile') }}" class="list-group-item list-group-item-action {{ Request::url() == route('my.profile') ? 'active' : '' }}">
                        <div class="d-flex w-100">
                            <span class="icon-edit-icon fs-24px me-2"></span>
                            <span class="side-bar-content"> {{__('Edit Profile')}}</span>

                        </div>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::url() == route('change.template') ? 'active' : '' }}">
                    <a href="{{ route('change.template') }}" class="list-group-item list-group-item-action {{ Request::url() == route('change.template') ? 'active' : '' }}">
                        <div class="d-flex w-100">
                            <span class="icon-edit-icon fs-24px me-2"></span>
                            <span class="side-bar-content"> {{__('Change Template')}}</span>
                        </div>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('view.public.profile', Auth::user()->id) }}" class="list-group-item list-group-item-action {{ route('view.public.profile', Auth::user()->id) }}">
                        <div class="d-flex w-100">
                            <span class="icon-eye-icon fs-24px me-2"></span>
                            <span class="side-bar-content">{{__('View Public Profile')}}</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::url() == route('my.job.applications') || Request::url() == route('my.favourite.jobs')  ? 'active' : '' }}">
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="d-flex w-100">
                            <span class="icon-edit-icon fs-24px me-2"></span>
                            <span class="side-bar-content"> Việc làm của tôi</span>
                        </div>
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li class="{{ Request::url() == route('my.job.applications') ? 'active' : '' }}">
                            <a href="{{ route('my.job.applications') }}" class="list-group-item list-group-item-action {{ Request::url() == route('my.job.applications') ? 'active' : '' }}">
                                <div class="d-flex w-100">
                                    <span class="icon-doc-check-icon fs-24px me-2"></span>
                                    <span class="side-bar-content"> {{__('My Job Applications')}}</span>
                                </div>
                            </a>
                        </li>
                        <li class="{{ Request::url() == route('my.favourite.jobs') ? 'active' : '' }}">
                            <a href="{{ route('my.favourite.jobs') }}" class="list-group-item list-group-item-action {{ Request::url() == route('my.favourite.jobs') ? 'active' : '' }}">
                                <div class="d-flex w-100">
                                    <span class="icon-heart-icon fs-24px me-2"></span>
                                    <span class="side-bar-content">{{__('My Favourite Jobs')}}</spant>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ Request::url() == route('my-alerts') ? 'active' : '' }}">
                    <a href="{{ route('my-alerts') }}" class="list-group-item list-group-item-action {{ Request::url() == route('my-alerts') ? 'active' : '' }}">
                        <div class="d-flex w-100">
                            <span class="icon-bell-icon fs-24px me-2"></span>
                            <span class="side-bar-content"> {{__('My Job Alerts')}}</span>
                        </div>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::url() == route('my.messages') ? 'active' : '' }}">
                    <a href="{{route('my.messages')}}" class="list-group-item list-group-item-action {{ Request::url() == route('my.messages') ? 'active' : '' }}">
                        <div class="d-flex w-100">
                            <span class="icon-message-icon fs-24px me-2 box-message-icon">
                                <span class="badge">{{\App\CompanyMessage::where('seeker_id', Auth::user()->id)->where('status','unviewed')->where('type','reply')->count()}}</span>
                            </span>
                            <span class="side-bar-content"> {{__('My Messages')}}</span>

                        </div>
                    </a>
                </li>
                <li class="{{ Request::url() == route('my.followings') ? 'active' : '' }}">
                    <a href="{{route('my.followings')}}" class="list-group-item list-group-item-action {{ Request::url() == route('my.followings') ? 'active' : '' }}">
                        <div class="d-flex w-100">
                            <span class="icon-office-building-icon fs-24px me-2"></span>
                            <span class="side-bar-content"> {{__('My Followings')}}</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('site_user.logout') }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100">
                            <span class="icon-logout-icon fs-24px me-2"></span>
                            <span class="side-bar-content"> {{__('Logout')}}</span>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>


    <div class="sidebar-bottom">
        <div class="sidebar-bottom__item">
            <h3>Thông Tin Hồ Sơ</h3>
        </div>
        <div class="sidebar-bottom__item">
            <h3>Thông Tin Hồ Sơ</h3>
        </div>
        <div class="sidebar-bottom__item">
            <h3>Thông Tin Hồ Sơ</h3>
        </div>
    </div>


</nav>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });


        $('.sidebar-item').click(function() {
            // Remove 'active' class from all li elements
            $('.sidebar-item').removeClass('active');
            // Add 'active' class to the clicked li element
            $(this).toggleClass('active');
        });





    });
</script>
@endpush