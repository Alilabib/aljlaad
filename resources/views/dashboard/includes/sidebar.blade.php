<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    @include('dashboard.includes.sidebar-header')
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
            <a class="nav-main-link" href="{{route('admin.index')}}">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">لوحة التحكم</span>
                </a>
            </li>

            <li class="nav-main-heading"> المدن </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">المدن</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('cities.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('cities.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-main-heading"> المستخدمين </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">المديرين</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('admins.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('admins.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الأعضاء</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('users.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('users.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">مندوبين التوصيل</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('providers.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('providers.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>
            
            <li class="nav-main-heading"> الأقسام </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الأقسام الرئيسية</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('categories.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('categories.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الأقسام الفرعية</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('subcategories.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('subcategories.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-main-heading"> المنتجات </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">المنتجات</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('products.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('products.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-main-heading"> الطلبات </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الطلبات</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('orders.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('orders.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>
       
            <li class="nav-main-heading"> البنرات </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">البنرات</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('sliders.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('sliders.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>