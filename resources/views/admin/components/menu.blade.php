<div class="vertical-menu">
    <div class="h-100">

        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">بخش های اصلی</li>

                <li>
                    <a href="{{route('dashboard')}}"
                       class="{{ (request()->is('admin/dashboard')) ? 'waves-effect' : '' }}">
                        <i class="mdi mdi-airplay"></i>
                        <span>داشبورد</span>
                    </a>
                </li>

                @canany(['مدیریت کاربران'])
                    <li>
                        <a href="javascript:"
                           class="has-arrow waves-effect">
                            <i class="mdi mdi-account-supervisor"></i>
                            <span>کاربران</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('مدیریت کاربران')
                                <li><a href="{{route('user.index')}}"
                                       class="{{ (request()->is('admin/user')) ? 'active' : '' }}">لیست کاربر ها</a>
                                </li>

                                <li><a href="{{route('user.create')}}"
                                       class="{{ (request()->is('admin/user/create')) ? 'active' : '' }}">افزودن
                                        کاربر</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['مدیریت آگهی ها'])
                    <li>
                        <a href="javascript:" class="has-arrow waves-effect">
                            <i class="mdi mdi-cube"></i>
                            <span>آگهی ها</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('مدیریت آگهی ها')
                                <li><a href="{{route('advertise.index')}}"
                                       class="{{ (request()->is('admin/advertise')) ? 'active' : '' }}">لیست آگهی ها</a>
                                </li>

                                <li><a href="{{route('advertise.create')}}"
                                       class="{{ (request()->is('admin/advertise/create')) ? 'active' : '' }}">افزودن آگهی</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany


                @canany(['مدیریت اسلایدر ها'])
                    <li>
                        <a href="javascript:" class="has-arrow waves-effect">
                            <i class="mdi mdi-image"></i>
                            <span>اسلایدر ها</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('مدیریت اسلایدر ها')
                                <li><a href="{{route('slider.index')}}"
                                       class="{{ (request()->is('admin/slider')) ? 'active' : '' }}">لیست اسلایدر ها</a>
                                </li>

                                <li><a href="{{route('slider.create')}}"
                                       class="{{ (request()->is('admin/slider/create')) ? 'active' : '' }}">افزودن اسلایدر</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany


                @canany(['مدیریت دسته بندی ها'])
                    <li>
                        <a href="javascript:"
                           class="has-arrow waves-effect">
                            <i class="mdi mdi-tag"></i>
                            <span>دسته بندی ها</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('مدیریت دسته بندی ها')
                                <li><a href="{{route('category.index')}}"
                                       class="{{ (request()->is('admin/category')) ? 'active' : '' }}">لیست دسته بندی
                                        ها</a>
                                </li>

                                <li><a href="{{route('category.create')}}"
                                       class="{{ (request()->is('admin/category/create')) ? 'active' : '' }}">افزودن
                                        دسته بندی</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['مدیریت شهر ها','مدیریت منطقه ها'])
                    <li>
                        <a href="javascript:"
                           class="has-arrow waves-effect">
                            <i class="mdi mdi-map-marker"></i>
                            <span>لوکیشن</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('مدیریت شهر ها')
                                <li><a href="{{route('city.index')}}"
                                       class="{{ (request()->is('admin/city')) ? 'active' : '' }}">لیست شهر ها</a>
                                </li>

                                <li><a href="{{route('city.create')}}"
                                       class="{{ (request()->is('admin/city/create')) ? 'active' : '' }}">افزودن شهر</a>
                                </li>
                            @endcan

                            @can('مدیریت منطقه ها')
                                <li><a href="{{route('region.index')}}"
                                       class="{{ (request()->is('admin/region')) ? 'active' : '' }}">لیست منطقه ها</a>
                                </li>

                                <li><a href="{{route('region.create')}}"
                                       class="{{ (request()->is('admin/region/create')) ? 'active' : '' }}">افزودن منطقه</a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                @endcanany


                @canany(['مدیریت تنظیمات عمومی'])
                    <li>
                        <a href="javascript:"
                           class="has-arrow waves-effect">
                            <i class="mdi mdi-cogs"></i>
                            <span>تنظیمات</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('مدیریت تنظیمات عمومی')
                                <li><a href="{{route('setting.general')}}"
                                       class="{{ (request()->is('admin/setting/general')) ? 'active' : '' }}">تنظیمات عمومی</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @role('ادمین اصلی')
                <li>
                    <a href="javascript:"
                       class="has-arrow waves-effect {{ (request()->is('admin/user*')) ? 'waves-effect' : '' }}">
                        <i class="mdi mdi-shield-lock-outline"></i>
                        <span>سطح دسترسی کاربران</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('role.index')}}"
                               class="{{ (request()->is('admin/role')) ? 'active' : '' }}">نقش ها</a>
                        </li>
                        <li><a href="{{route('role.create')}}"
                               class="{{ (request()->is('admin/role/create')) ? 'active' : '' }}">افزودن نقش</a>
                        </li>
                        <li><a href="{{route('permission.index')}}"
                               class="{{ (request()->is('admin/permission')) ? 'active' : '' }}">دسترسی ها</a>
                        </li>
                        <li><a href="{{route('permission.create')}}"
                               class="{{ (request()->is('admin/permission/create')) ? 'active' : '' }}">افزودن
                                دسترسی</a>
                        </li>
                    </ul>
                </li>
                @endrole

            </ul>
        </div>

    </div>
</div>
