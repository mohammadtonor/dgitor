@extends("Pannel.Admin.home")
@section('pagemeta')

@endsection

{{--Page Css--}}
@section("pagecss")
    <link rel="stylesheet" href="{{asset('./assets/css/GeneralStyle/style.css')}}">
@endsection

@section("content")
    <main>
        <div class="container-fluid">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 justify-content-between d-sm-flex w-100 rounded">
                        <div class="w-sm-100 ml-auto"><h4 class="mb-0">داشبورد</h4> <b>خوش آمدید به پنل داشبورد</b></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">داشبورد</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->

            <!-- END: Card DATA-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><a href="#">خانه</a></li>
                                <li class="breadcrumb-item active">داشبورد</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row categ">
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{asset("./assets/images/country.png")}}"  alt="cart" class="float-left"
                                     width="70" height="70" >
                                <h6 class="card-title font-weight-bold"> تعداد کشور </h6>
                                <h2 id="countriesCount"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <button class="btn btn-lg btn-primary  my-2" data-toggle="modal"
                                        data-target="#btncreatenewcountry">ثبت کشور
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableCountries">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="text-center rowcount">ردیف</th>
                                            <th class="text-center countryNameUpdate">نام کشور</th>
                                            <th class="text-center ostansCountUpdate">تعداد استان</th>
                                            <th class="text-center citiesCountUpdate">تعداد شهر</th>
                                            <th class="text-center createdAtUpdate"> تاریخ ایجاد</th>
                                            <th class="text-center deletedAtUpdate"> تاریخ حذف</th>
                                            <th class="no-sort operation">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--MODAL-->

    <!--ایجاد کشور-->
    <div class="modal" id="btncreatenewcountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد کشور</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> نام کشور </span>
                            </div>
                            <input type="text" id="countryNameInsert" class="form-control inp" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="insertNewCountryBtn" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ویرایش -->
    <div class="modal" id="editcountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش کشور </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> نام کشور </span>
                            </div>
                            <input type="text" class="form-control" id="countryName" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="editCountryInfoBtn" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--حذف-->
    <div class="modal" id="deletecountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف کشور</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از حذف مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="dodelete" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--restore modal-->
    <div class="modal" id="restoremodal">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">بازیابی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 class="text-center py-3">از بازیابی مطمئن هستید؟</h5>

                    <div class="row justify-content-center mt-3">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="restore-modal-btn" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بله
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("pagejs")
    <script src="{{asset("./assets/js/jalali-moment.browser.js")}}"></script>
    <script src="{{asset('./assets/js/Pannel/Settings/country.js')}}"></script>
@endsection
