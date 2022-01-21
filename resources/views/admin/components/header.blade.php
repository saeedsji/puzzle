<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">

                <div class="dropdown d-inline-block d-lg-none ml-2">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                         aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="جستجو ..."
                                           aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>


                @if(auth()->check())
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                 src="/assets/panel/images/custom/user.png" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ml-1">{{auth()->user()->name}}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item" href="#"><i
                                        class="bx bx-user font-size-16 align-middle mr-1"></i>
                                ادمین
                            </a> <a class="dropdown-item" href="#"><i
                                        class="bx bx-mobile font-size-16 align-middle mr-1"></i>
                                {{auth()->user()->phone}}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="/logout"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> خروج</a>
                        </div>
                    </div>
                @endif

            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                                    <span class="logo-sm">
                                        <img src="/assets/panel/images/logo-sm.png" alt="" height="20">
                                    </span>
                        <span class="logo-lg">
                                        <img src="/assets/panel/images/logo-dark.png" alt="" height="17">
                                    </span>
                    </a>
                    <a href="index.html" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="/assets/panel/images/logo-sm.png" alt="" height="20">
                                    </span>
                        <span class="logo-lg">
                                        <img src="/assets/panel/images/logo-light.png" alt="" height="19">
                                    </span>
                    </a>
                </div>
                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                        id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div class="dropdown dropdown-mega d-none d-lg-inline-block ml-2">
                    <button type="button" class="btn header-item waves-effect" data-toggle="dropdown"
                            aria-haspopup="false" aria-expanded="false">
                        دسترسی سریع
                        <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu dropdown-megamenu">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="font-size-14 mt-0">بخش ها</h5>
                                        <div class="px-lg-2">
                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="/assets/panel/images/brands/github.png" alt="Github">
                                                        <span>گیت هاب</span>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="/assets/panel/images/brands/bitbucket.png"
                                                             alt="bitbucket">
                                                        <span>بیت باکت</span>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="/assets/panel/images/brands/dribbble.png"
                                                             alt="dribbble">
                                                        <span>دریبل</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="/assets/panel/images/brands/dropbox.png"
                                                             alt="dropbox">
                                                        <span>دراپ باکس</span>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="/assets/panel/images/brands/mail_chimp.png"
                                                             alt="mail_chimp">
                                                        <span>میل چیمپ</span>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="/assets/panel/images/brands/slack.png" alt="slack">
                                                        <span>اسلک</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div>
                                            <div class="card text-white mb-0 overflow-hidden text-white-50"
                                                 style="background-image: url('/assets/panel/images/megamenu-img.png');background-size: cover;">
                                                <div class="card-img-overlay"></div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <h4 class="text-white mb-3">فروش</h4>

                                                            <h5 class="text-white-50">تا <span
                                                                        class="font-size-24 text-white">50 %</span>
                                                                تخفیف</h5>
                                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی</p>
                                                            <div class="mb-4">
                                                                <a href="#" class="btn btn-success btn-sm">مشاهده
                                                                    بیشتر</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</header>
