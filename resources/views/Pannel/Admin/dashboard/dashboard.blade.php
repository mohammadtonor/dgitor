@extends("Admin.home")


{{--Page Css--}}
@section("pagecss")
    <link rel="stylesheet" href={{asset('./assets/vendors/morris/morris.css')}}>
    <link rel="stylesheet" href={{asset('./assets/vendors/weather-icons/css/pe-icon-set-weather.min.css')}}>
    <link rel="stylesheet" href={{asset('./assets/vendors/chartjs/Chart.min.css')}}>
    <link rel="stylesheet" href={{asset('./assets/vendors/starrr/starrr.css')}}>
    <link rel="stylesheet" href={{asset('./assets/vendors/bootstrap-tour/css/bootstrap-tour-standalone.min.css')}} >
    <link rel="stylesheet" href={{asset('./assets/vendors/fontawesome/css/all.min.css')}}>
    <link rel="stylesheet" href={{asset('./assets/vendors/ionicons/css/ionicons.min.css')}}>

    {{--Custom Css--}}
    <link rel="stylesheet" href={{asset('./assets/css/main.css')}}>
    {{--Custom Css--}}

@endsection

{{--Page JS --}}
@section("pagejs")

    <script src="{{asset('./assets/vendors/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('./assets/vendors/morris/morris.min.js')}}"></script>
    <script src="{{asset('./assets/vendors/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('./assets/vendors/starrr/starrr.js')}}"></script>
    <script src="{{asset('./assets/vendors/jquery-flot/jquery.canvaswrapper.js')}}"></script>
    <script src="{{asset('./assets/vendors/jquery-flot/jquery.colorhelpers.js')}}"></script>
    <script src="{{asset('./assets/vendors/jquery-flot/jquery.flot.js')}}"></script>
    <script src="{{asset('./assets/vendors/jquery-flot/jquery.flot.saturated.js')}}"></script>
    <script src="{{asset('./assets/vendors/jquery-flot/jquery.flot.browser.js')}}"></script>
    <script src="{{asset('./assets/vendors/jquery-flot/jquery.flot.drawSeries.js')}}"></script>
    <script src="{{asset('./assets/vendors/jquery-flot/jquery.flot.uiConstants.js')}}"></script>
    <script src="{{asset('./assets/vendors/jquery-flot/jquery.flot.legend.js')}}"></script>
    <script src="{{asset('./assets/vendors/jquery-flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('./assets/vendors/bootstrap-tour/js/bootstrap-tour-standalone.min.js')}}"></script>

    <!-- START: Page JS-->
    <script src="{{asset('./assets/js/home.script.js')}}"></script>
    <!-- END: Page JS-->
@endsection



@section("content")
    <main>
        <div class="container-fluid">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 ml-auto"><h4 class="mb-0">داشبورد</h4> <b>خوش آمدید به پنل داشبورد</b>
                        </div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">داشبورد</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="dist/images/traffic.png" alt="traffic" class="float-left"/>
                            <h6 class="card-title font-weight-bold">ترافیک سایت</h6>
                            <h6 class="card-subtitle mb-2 text-muted">امروز</h6>
                            <h2>26476</h2>
                            <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> 15% بالاتر</span> از
                            دیروز
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="dist/images/cart.png" alt="cart" class="float-left"/>
                            <h6 class="card-title font-weight-bold">سفارشات جدید</h6>
                            <h6 class="card-subtitle mb-2 text-muted">این هفته</h6>
                            <h2>14957</h2>
                            <span class="text-danger"><i class="ion ion-android-arrow-dropdown"></i> 4% پایین تر</span>
                            از
                            هفته گذشته
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="dist/images/money.png" alt="money" class="float-left"/>
                            <h6 class="card-title font-weight-bold">مجموع فروش</h6>
                            <h6 class="card-subtitle mb-2 text-muted">ماه اخیر</h6>
                            <h2>38524 تومان</h2>
                            <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> 8% بالاتر</span> از
                            هفته
                            گذشته
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="dist/images/wallet.png" alt="wallet" class="float-left"/>
                            <h6 class="card-title font-weight-bold">سود کل</h6>
                            <h6 class="card-subtitle mb-2 text-muted">در فوریه-2019</h6>
                            <h2>78245 تومان</h2>
                            <span class="text-success"><i class="ion ion-android-arrow-dropdown"></i> 18% بالاتر</span>
                            از
                            ماه گذشته
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 col-xl-8 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">آمار</h4>
                            <ul class="nav nav-pills p-0" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-week-tab" data-toggle="pill" href="#pills-week"
                                       role="tab" aria-controls="pills-week" aria-selected="true">هفته</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-month-tab" data-toggle="pill" href="#pills-month"
                                       role="tab" aria-controls="pills-month" aria-selected="false">ماه</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-year-tab" data-toggle="pill" href="#pills-year"
                                       role="tab"
                                       aria-controls="pills-year" aria-selected="false">سال</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-content">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12 col-md-4 border border border-top-0 border-left-0 p-3 "><span
                                            class="text-muted">درآمد امروز</span>
                                        <h3 class="d-flex  align-items-center">432345 تومان <span
                                                class="h6 ml-3 bg-success text-white p-1 rounded line-height-1">+30</span>
                                        </h3>
                                    </div>
                                    <div class="col-12 col-md-4 border border-top-0 border-left-0 p-3"><span
                                            class="text-muted">درآمد دیروز</span>
                                        <h3 class="d-flex  align-items-center">332345 تومان </h3>
                                    </div>
                                    <div
                                        class="col-12 col-md-4 border border-top-0 border-left-0 border-right-0 p-3"><span
                                            class="text-muted">درآمد ماه گذشته</span>
                                        <h3 class="d-flex  align-items-center">1432345 تومان </h3>
                                    </div>
                                    <div class="col-12">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-week" role="tabpanel"
                                                 aria-labelledby="pills-week-tab">
                                                <div id="week_statistics"></div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-month" role="tabpanel"
                                                 aria-labelledby="pills-month-tab">
                                                <div id="month_statistics"></div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-year" role="tabpanel"
                                                 aria-labelledby="pills-year-tab">
                                                <div id="year_statistics"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4 mt-3">
                    <div class="twitter-gradient p-5 text-center">
                        <div id="demo" class="carousel slide" data-ride="carousel">
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <div class="carousel-item py-3 active">
                                    <i class="icon-social-twitter p-3 border-white border rounded-circle h1 mb-4 mx-auto d-table"></i>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک
                                    است..
                                    <br/><small>بهمن 1398</small><br/><br/>
                                    <div class="love px-2 py-1 d-inline-block"><i class="ion ion-heart"></i> 200 <i
                                            class="ml-3 ion ion-chatboxes"></i> 192
                                    </div>
                                </div>
                                <div class="carousel-item py-3">
                                    <i class="icon-social-twitter p-3 border-white border rounded-circle h1 mb-4 mx-auto d-table"></i>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک
                                    است..
                                    <br/><small>بهمن 1398</small><br/><br/>
                                    <div class="love px-2 py-1 d-inline-block"><i class="ion ion-heart"></i> 200 <i
                                            class="ml-3 ion ion-chatboxes"></i> 192
                                    </div>
                                </div>
                                <div class="carousel-item py-3">
                                    <i class="icon-social-twitter p-3 border-white border rounded-circle h1 mb-4 mx-auto d-table"></i>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک
                                    است..
                                    <br/><small>بهمن 1398</small><br/><br/>
                                    <div class="love px-2 py-1 d-inline-block"><i class="ion ion-heart"></i> 200 <i
                                            class="ml-3 ion ion-chatboxes"></i> 192
                                    </div>
                                </div>

                            </div>
                            <!-- Indicators -->
                            <ul class="carousel-indicators position-relative mb-0">
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                                <li data-target="#demo" data-slide-to="1"></li>
                                <li data-target="#demo" data-slide-to="2"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">لیست کارها</h4>
                            <ul class="nav nav-tabs p-0" id="tabs-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active font-weight-bold" id="tabs-day-tab" data-toggle="tab"
                                       href="#tabs-day" role="tab" aria-controls="tabs-day" aria-selected="true">روز</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" id="tabs-week-tab" data-toggle="tab"
                                       href="#tabs-week" role="tab" aria-controls="tabs-week"
                                       aria-selected="false">هفته</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" id="tabs-month-tab" data-toggle="tab"
                                       href="#tabs-month" role="tab" aria-controls="tabs-month"
                                       aria-selected="false">ماه</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-content">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tabs-day" role="tabpanel"
                                                 aria-labelledby="tabs-day-tab">
                                                <ul class="tasks mt-3">
                                                    <li class="task d-flex py-3 px-2 border-right border-primary">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>

                                                    <li class="task py-3 px-2 d-flex border-right border-secondary">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم از صنعت چاپ و با استفاده.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 d-flex px-2 border-right border-success">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم از صنعت چاپ و با استفاده.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>

                                                    <li class="task py-3 px-2 d-flex border-right border-danger">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 px-2 d-flex border-right border-warning">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 px-2 d-flex border-right border-info">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="tabs-week" role="tabpanel"
                                                 aria-labelledby="tabs-week-tab">
                                                <ul class="tasks mt-3">
                                                    <li class="task py-3 d-flex px-2 d-flex border-right border-primary">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>

                                                    <li class="task py-3 d-flex px-2 border-right border-secondary">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم از صنعت چاپ و با استفاده.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 d-flex px-2 border-right border-success">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم از صنعت چاپ و با استفاده.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>

                                                    <li class="task py-3 d-flex px-2 border-right border-danger">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 d-flex px-2 border-right border-warning">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 px-2 border-right border-info">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="ml-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 d-flex px-2 border-right border-info">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="tabs-month" role="tabpanel"
                                                 aria-labelledby="tabs-month-tab">
                                                <ul class="tasks mt-3">
                                                    <li class="task py-3 d-flex px-2 border-right border-primary">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>

                                                    <li class="task py-3 d-flex px-2 border-right border-secondary">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم از صنعت چاپ و با استفاده.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 d-flex px-2 border-right border-success">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم از صنعت چاپ و با استفاده.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>

                                                    <li class="task py-3 d-flex px-2 border-right border-danger">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 d-flex px-2 border-right border-warning">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 d-flex px-2 border-right border-info">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                    <li class="task py-3 d-flex px-2 border-right border-info">
                                                        <label class="chkbox"><b>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم.</b> <br/><span
                                                                class="text-muted">توسط: جعفر</span>
                                                            <input type="checkbox">
                                                            <span class="checkmark mt-2"></span>
                                                        </label>
                                                        <div class="mr-auto d-flex"><a href="#"><i
                                                                    class="ion ion-edit"></i></a>
                                                            <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">فعالیت های اخیر</h4>

                        </div>
                        <div class="card-content">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="activities mt-4 mb-2">
                                            <li class="activity py-2 px-2 border-right">
                                                <label class="bg-primary"></label>
                                                <span>11:30 قبل ظهر</span><br/>
                                                <p class="mt-3"><b>افزودن کاربر جدید</b><br/>لورم ایپسوم متن ساختگی با
                                                    تولید
                                                    سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است..</p>
                                            </li>
                                            <li class="activity py-2 px-2 border-right">
                                                <label class="bg-success"></label>
                                                <span>12:15 قبل ظهر</span><br/>
                                                <p class="mt-3"><b>نوشتن نظر</b><br/>لورم ایپسوم متن ساختگی با تولید
                                                    سادگی
                                                    نامفهوم.</p>
                                            </li>
                                            <li class="activity py-2 px-2 border-right">
                                                <label class="bg-danger"></label>
                                                <span>13:30 قبل ظهر</span><br/>
                                                <p class="mt-3"><b>افزودن کاربر جدید</b><br/>لورم ایپسوم متن ساختگی با
                                                    تولید
                                                    سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است..</p>
                                            </li>
                                            <li class="activity py-2 px-2 border-right">
                                                <label class="bg-warning"></label>
                                                <span>14:30 قبل ظهر</span><br/>
                                                <p class="mt-3"><b>نوشتن نظر</b><br/>لورم ایپسوم متن ساختگی با تولید
                                                    سادگی
                                                    نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است..</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4 mt-3">
                    <div class="card h-100">
                        <div class="card-content h-100">
                            <div class="card-body h-100 p-0">
                                <div class="info-card h-100">
                                    <div class="background-image-maker"></div>
                                    <div class="holder-image">
                                        <img src="" alt="" class="img-fluid">
                                    </div>
                                    <div class="date  text-white">22<span>بهمن</span></div>
                                    <div class="like"><i class="ion ion-heart"></i> 200 <i
                                            class="mr-3 ion ion-chatboxes"></i> 192
                                    </div>
                                    <div class="title px-4 text-white mb-3">
                                        <h3 class="text-white">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                                            و
                                            با استفاده.</h3>
                                        <img src="" alt="" class="border ml-2 img-fluid rounded-circle" width="35"> توسط عباسی
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="weather-info">
                                    <h3>ایران، تهران </h3>
                                    <b>دوشنبه 22 بهمن <br/>هوا ابریست</b>
                                    <div class="row mt-4">
                                        <div class="col-12 col-lg-6 text-center">
                                        <span
                                            class="pe-is-w-partly-cloudy-1-f large color-primary display-1"></span><br/>
                                            <span class="display-4 font-weight-bold color-primary">23.1<sup class="h1">&#8451;</sup></span>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <table class="table table-borderless table-responsive">

                                                <tbody>
                                                <tr>
                                                    <td class="py-1 text-right">ته نشینی:</td>
                                                    <td class="py-1"><b>20%</b></td>

                                                </tr>
                                                <tr>
                                                    <td class="py-1  text-right">رطوبت:</td>
                                                    <td class="py-1"><b>28%</b></td>

                                                </tr>
                                                <tr>
                                                    <td class="py-1  text-right">باد:</td>
                                                    <td class="py-1 pr-0"><b>23 km/h</b></td>

                                                </tr>
                                                <tr>
                                                    <td class="py-1  text-right">دید:</td>
                                                    <td class="py-1"><b>16km</b></td>

                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <canvas id="js-chart-weather" height="42" class="my-2"></canvas>
                                    <div class="row mt-3">
                                        <div class="col text-center">
                                            <span class="h6"> 5 صبح<br/>شنبه</span><br/>
                                            <span class="pe-is-w-partly-cloudy-1-f large color-primary h2"></span><br/>
                                            239<sup>&#8451;</sup>
                                        </div>
                                        <div class="col text-center">
                                            <span class="h6"> 5 صبح<br/>بکشنبه</span><br/>
                                            <span class="pe-is-w-heavy-rain-1-f large color-primary h2"></span><br/>
                                            238<sup>&#8451;</sup>
                                        </div>
                                        <div class="col text-center">
                                            <span class="h6"> 12 ظهر<br/>دوشنبه</span><br/>
                                            <span class="pe-is-w-thunderstorm-f large color-primary h2"></span><br/>
                                            245<sup>&#8451;</sup>
                                        </div>
                                        <div class="col text-center">
                                            <span class="h6"> 10 صبح<br/>سه شنبه</span><br/>
                                            <span class="pe-is-w-partly-cloudy-3-f large color-primary h2"></span><br/>
                                            249<sup>&#8451;</sup>
                                        </div>
                                        <div class="col text-center">
                                            <span class="h6"> 12 ظهر<br/>چهارشنبه</span><br/>
                                            <span class="pe-is-w-sun-1-f large color-primary h2"></span><br/>
                                            263<sup>&#8451;</sup>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-content">


                            <div class="card-image business-card">
                                <div class="background-image-maker"></div>
                                <div class="holder-image">
                                    <img src="dist/images/ceif.jpg" alt="" class="img-fluid">
                                </div>
                                <div class="like"><i class="ion ion-clock"></i> 10:30قبل ظهر تا 11:00 قبل ظهر</div>
                                <div class="rating-block">
                                    <div class='starrr'></div>
                                    <h6 class="text-warning">3.5<small>(85 امتیاز)</small></h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mb-3 mt-2">رستوران پرنعمت ایتالیایی</h5>
                                <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                    استفاده
                                    از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم
                                    است.</p>
                                <div class="row mt-4 mb-3">
                                    <div class="col-6">
                                        <b><i class="ion ion-android-call"></i> تلفن</b><br/>
                                        +88 123 123 1234
                                    </div>
                                    <div class="col-6">
                                        <b><i class="ion ion-android-pin"></i> محل</b><br/>
                                        ایتالیا
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">تبلیغات</h4>
                                <div class="float-right">

                                    <a href="#" class="py-1 px-2 rounded  line-height-1 border body-color"><i
                                            class="ion ion-gear-a"></i> تنظیمات</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="text-center float-right"><h3 class="line-height-1 mb-0">45%</h3>
                                        <h6>پیشرفت</h6></div>
                                </div>
                            </div>
                            <div id="social-chart"></div>
                            <div class="card-body">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <td class="border-top-0"><span class="social-dot google ml-2"></span><b>تبلیغات
                                                گوگل</b></td>
                                        <td class="border-top-0">324,859</td>
                                        <td class="text-success border-top-0">25.8% <i
                                                class="ion ion-arrow-graph-up-right"></i></td>
                                    </tr>
                                    <tr>
                                        <td><span class="social-dot facebook ml-2"></span><b>فیس بوک</b></td>
                                        <td>3,35957</td>
                                        <td class="text-success">164% <i class="ion ion-arrow-graph-up-right"></i></td>
                                    </tr>
                                    <tr>
                                        <td><span class="social-dot twitter ml-2"></span><b>توییتر</b></td>
                                        <td>1,65594</td>
                                        <td class="text-warning">19.2% <i class="ion ion-arrow-graph-down-right"></i>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-8 mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">پیشرفت پروژه</h4>
                                <div class="float-right">
                                    <div class="d-inline-block position-relative">
                                        <a href="#" data-toggle="dropdown" aria-expanded="false"
                                           class="bg-primary py-1 px-2 rounded text-white"><i
                                                class="ion ion-plus-round text-white"></i> چیزی اضافه کن</a>
                                        <div class="dropdown-menu left p-0">
                                            <a href="#" class="dropdown-item px-2">صفحه جدید</a>
                                            <a href="#" class="dropdown-item px-2">افزودن کاربر جدید</a>
                                            <a href="#" class="dropdown-item px-2">کمپین جدید</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item px-2 text-danger">گزارش تهیه کنید</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-nowrap">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0" scope="col">پروژه/کار</th>
                                            <th class="border-top-0" scope="col">مدیر</th>
                                            <th class="border-top-0" scope="col">تاریخ</th>
                                            <th class="border-top-0" scope="col">وضعیت</th>
                                            <th class="border-top-0" scope="col">پیشرفت</th>
                                            <th class="border-top-0" scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">توسعه پروژه<br/><small class="text-muted">وردپرس، اچ تی ام
                                                    ال،
                                                    جاوا</small></th>
                                            <td>جعفر عباسی <br/><small class="text-muted">توسعه دهنده</small></td>
                                            <td>24-1-2018</td>
                                            <td>در حال اجرا</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="float-left d-flex"><a href="#"><i class="ion ion-edit"></i></a>
                                                    <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">طراحی لوگو<br/><small class="text-muted">فتوشاپ،
                                                    تصویرگر</small>
                                            </th>
                                            <td>مجتبی شاهی <br/><small class="text-muted">طراح</small></td>
                                            <td>28-1-2018</td>
                                            <td>تکمیل شده</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar w-100" role="progressbar"
                                                         aria-valuenow="100"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="float-left d-flex"><a href="#"><i class="ion ion-edit"></i></a>
                                                    <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">بازاریابی<br/><small class="text-muted">فیس بوک،
                                                    گوگل</small>
                                            </th>
                                            <td>طاهر خان <br/><small class="text-muted">متخصص سئو</small></td>
                                            <td>28-11-2017</td>
                                            <td>نامعلوم</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar w-50" role="progressbar" aria-valuenow="50"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="float-left d-flex"><a href="#"><i class="ion ion-edit"></i></a>
                                                    <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">پی اس دی به وردپرس<br/><small class="text-muted">وردپرس، اچ
                                                    تی
                                                    ام ال، جاوا</small></th>
                                            <td>جعفر خان <br/><small class="text-muted">توسعه دهنده</small></td>
                                            <td>24-1-2018</td>
                                            <td>در حال اجرا</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="float-left d-flex"><a href="#"><i class="ion ion-edit"></i></a>
                                                    <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">توسعه دهنده وردپرس<br/><small class="text-muted">وردپرس، اچ
                                                    تی
                                                    ام ال، جاوا</small></th>
                                            <td>John Faulkner <br/><small class="text-muted">توسعه دهنده</small></td>
                                            <td>24-1-2018</td>
                                            <td>در حال اجرا</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar w-50" role="progressbar" aria-valuenow="50"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="float-left d-flex"><a href="#"><i class="ion ion-edit"></i></a>
                                                    <a href="#" class="mr-2"><i class="ion ion-trash-a"></i></a></div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
@endsection
