<div id="header-fix" class="header fixed-top">
    <nav class="navbar navbar-expand-lg  p-0">
        <div class="navbar-header h4 mb-0 align-self-center d-flex">
            <a href="#" class="horizontal-logo align-self-center d-flex d-lg-none">
                <img src={{asset('assets/images/logo.png')}} alt="logo" width="23" class="img-fluid"/> <span
                    class="h5 align-self-center mb-0 ">پــولــو</span>
            </a>
            <a href="#" class="sidebarCollapse mr-2" id="collapse"><i class="icon-menu body-color"></i></a>
        </div>
        <div class="d-inline-block position-relative">
            <button id="tourfirst" data-toggle="dropdown" aria-expanded="false"
                    class="btn btn-primary p-2 rounded mx-3 h4 mb-0 line-height-1 d-none d-lg-block">
                <span class="text-white font-weight-bold h4">+</span></button>
            <div class="dropdown-menu dropdown-menu-right left p-0">
                <a href="#" class="dropdown-item px-2">ایجاد صفحه</a>
                <a href="#" class="dropdown-item px-2">افزودن کاربر جدید</a>
                <a href="#" class="dropdown-item px-2">کمپین جدید</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item px-2 text-danger">گزارش تهیه کنید</a>
            </div>
        </div>

        <form class="float-left d-none d-lg-block search-form">
            <div class="form-group mb-0 position-relative">
                <input type="text" class="form-control border-0 rounded bg-search pr-5" placeholder="جستجوی همه چیز...">
                <div class="btn-search position-absolute top-0">
                    <a href="#"><i class="h5 icon-magnifier body-color"></i></a>
                </div>
                <a href="#" class="position-absolute close-button mobilesearch d-lg-none" data-toggle="dropdown"
                   aria-expanded="false"><i class="icon-close h5"></i>
                </a>

            </div>
        </form>
        <div class="navbar-right mr-auto">
            <ul class="ml-auto p-0 m-0 list-unstyled d-flex">
                <li class="mr-1 d-inline-block my-auto d-block d-lg-none">
                    <a href="#" class="nav-link px-2 mobilesearch" data-toggle="dropdown" aria-expanded="false"><i
                            class="icon-magnifier h4"></i>
                    </a>
                </li>
                <li class="mr-1 d-inline-block my-auto">
                    <div id="options" data-input-name="country2" data-selected-country="US"></div>
                </li>
                <li class="dropdown align-self-center mr-1">
                    <a href="#" class="nav-link px-2" data-toggle="dropdown" aria-expanded="false"><i
                            class="icon-reload h4"></i>
                        <span class="badge badge-default"> <span class="ring">
                                    </span><span class="ring-point">
                                    </span> </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-left border  py-0">
                        <li>
                            <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                               href="#">
                                <div class="media">
                                    <img src={{asset('/assets/images/addr.png')}} alt=""
                                         class="d-flex ml-3 img-fluid rounded-circle">
                                    <div class="media-body">
                                        <h6 class="mb-0">جعفر</h6>
                                        <span class="text-warning">کاربر جدید ثبت شده است.</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                               href="#">
                                <div class="media">
                                    <img src={{asset('/assets/images/addr.png')}} alt=""
                                         class="d-flex ml-3 img-fluid rounded-circle">
                                    <div class="media-body">
                                        <h6 class="mb-0">مجتبی</h6>
                                        <span class="text-success">سرور شماره 12 بارگیری شد.</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                               href="#">
                                <div class="media">
                                    <img src={{asset('/assets/images/addr.png')}} alt=""
                                         class="d-flex ml-3 img-fluid rounded-circle">
                                    <div class="media-body">
                                        <h6 class="mb-0">مایکل</h6>
                                        <span class="text-danger">خطای برنامه.</span>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li><a class="dropdown-item text-center py-2" href="#"> <strong>مشاهده همه کارها <i
                                        class="icon-arrow-right pr-2 small"></i></strong></a></li>
                    </ul>

                </li>
                <li class="dropdown align-self-center mr-1 d-inline-block">
                    <a href="#" class="nav-link px-2" data-toggle="dropdown" aria-expanded="false"><i
                            class="icon-bell h4"></i>
                        <span class="badge badge-default"> <span class="ring">
                                    </span><span class="ring-point">
                                    </span> </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-left border   py-0">
                        <li>
                            <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                               href="#">
                                <div class="media">
                                    <img src="{{asset("/assets/images/author.jpg")}}" alt=""
                                         class="d-flex ml-3 img-fluid rounded-circle w-50">
                                    <div class="media-body">
                                        <h6 class="mb-0 text-success">جان پیامی ارسال کرد</h6>
                                        12 دقیقه قبل
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                               href="#">
                                <div class="media">
                                    <img src="{{asset("/assets/images/author2.jpg")}}" alt=""
                                         class="d-flex ml-3 img-fluid rounded-circle">
                                    <div class="media-body">
                                        <h6 class="mb-0 text-danger">پیتر پیام فرستاد</h6>
                                        15 دقیقه قبل
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                               href="#">
                                <div class="media">
                                    <img src="{{asset("/assets/images/author3.jpg")}}" alt=""
                                         class="d-flex ml-3 img-fluid rounded-circle">
                                    <div class="media-body">
                                        <h6 class="mb-0 text-warning">مایکل پیامی فرستاد</h6>
                                        5 دقیقه قبل
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li><a class="dropdown-item text-center py-2" href="#"> <strong>همه پیام هارو بخونید <i
                                        class="icon-arrow-right pr-2 small"></i></strong></a></li>
                    </ul>
                </li>
                <li class="dropdown user-profile d-inline-block py-1 mr-2">
                    <a href="#" class="nav-link px-2 py-0" data-toggle="dropdown" aria-expanded="false">
                        <div class="media">
                            <div class="media-body align-self-center d-none d-sm-block ml-2">
                                <p class="mb-0 text-uppercase line-height-1"><b>جعفر عباسی</b><br/><span> ادمین </span>
                                </p>

                            </div>
                            <img src="{{asset("/assets/images/author.jpg")}}" alt="" class="d-flex img-fluid rounded-circle" width="45">

                        </div>
                    </a>

                    <div class="dropdown-menu  dropdown-menu-left p-0">
                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                            <span class="icon-pencil ml-2 h6 mb-0"></span> ویرایش پروفایل</a>
                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                            <span class="icon-user ml-2 h6 mb-0"></span> نمایش پروفایل</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                            <span class="icon-support ml-2 h6  mb-0"></span> مرکز پشتیبانی</a>
                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                            <span class="icon-globe ml-2 h6 mb-0"></span> انجمن</a>
                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                            <span class="icon-settings ml-2 h6 mb-0"></span> تنظیمات حساب</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                            <span class="icon-logout ml-2 h6  mb-0"></span> خروج</a>
                    </div>

                </li>

            </ul>
        </div>

    </nav>
</div>
