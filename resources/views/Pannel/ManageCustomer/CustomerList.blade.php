@extends("Pannel.Admin.home")


{{--Page Css--}}
@section("pagecss")
    <link rel="stylesheet" href="{{asset('./assets/css/GeneralStyle/style.css')}}">
    <style>
            @media (max-width: 1450px) {
                .customWidth {
                    width: 100%!important;
                }
            }
    </style>
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
                                <img src="{{asset("/assets/images/employee-icon-1-removebg-preview.png")}}"  alt="cart" class="float-left"
                                     width="70" height="70" >
                                <h6 class="card-title font-weight-bold"> تعداد کل مشتریان </h6>
                                <h2 id="countriesCount"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <div class="row w-75 customWidth">
                                    <div class="input-group mb-3 col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">نام</div>
                                                    </div>
                                                    <input id="nameSearch" type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">نام خانوادگی</div>
                                                    </div>
                                                    <input id="familySearch" type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">شماره موبایل</div>
                                                    </div>
                                                    <input id="mobileSearch" type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 pr-2">
                                        <button id="searchBtn" class="btn btn-success">جستجو</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableCustomers">
                                        <thead>
                                        <tr class="text-center">
                                            <th>ردیف</th>
                                            <th>نام</th>
                                            <th>نام خانوادگی</th>
                                            <th>کد ملی</th>
                                            <th>شماره تماس</th>
                                            <th>شهر</th>
                                            <th>تاریخ ثبت</th>
                                            <th>تاریخ حذف</th>
                                            <th>تعداد معاوضه</th>
                                            <th>تعداد کارشناسی</th>
                                            <th class="no-sort">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">
                                        <tr class="text-center">
                                            <td class="rowcount"></td>
                                            <td class="nameUpdate"></td>
                                            <td class="familyUpdate"></td>
                                            <td class="ncodeUpdate"></td>
                                            <td class="phoneUpdate"></td>
                                            <td class="cityUpdate"></td>
                                            <td class="createdAtUpdate"></td>
                                            <td class="deletedAtUpdate"></td>
                                            <td class="exchangeCountUpdate"></td>
                                            <td class="karshenasiCountUpdate"></td>
                                            <td class="operation d-flex justify-content-center">
                                                <button class="btn btn-sm btn-danger ml-2 mt-1 deleteCustomerBtn" data-target="#deleteCustomer"
                                                        data-toggle="modal">
                                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="حذف"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1" data-target="#editCustomer"
                                                        data-toggle="modal">
                                                    <i class="icon-note" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1" data-target="#showCustomer"
                                                        data-toggle="modal">
                                                    <i class="icon-film" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1">
                                                    <a>
                                                        <i class="icon-location-pin text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="آدرس ها"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-secondary ml-2 mt-1">
                                                    <a>
                                                        <i class="icon-phone text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="شماره تماس"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1">
                                                    <a>
                                                        <i class="icon-paypal text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="اطلاعات بانکی"></i>
                                                    </a>
                                                </button>
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
        </div>
    </main>
    <!--MODAL-->

    <!-- ویرایش -->
    <div class="modal" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش مشتری </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                            <div class="row">
                                <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">نام</div>
                                                </div>
                                                <input id="firstNameEdit" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">نام خانوادگی</div>
                                                </div>
                                                <input id="lastNameEdit" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">جنسیت</div>
                                                </div>
                                                <select id="genderEdit" class="form-control">
                                                    <option id="female" value="زن">زن</option>
                                                    <option id="male" value="مرد">مرد</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                                <div class="col-sm-12 col-md-5 my-2">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">کد ملی</div>
                                                </div>
                                                <input id="ncodeEdit" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5 my-2">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">تاریخ تولد</div>
                                                </div>
                                                <input id="birthdayEdit" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">شماره موبایل</div>
                                            </div>
                                            <input id="phoneEdit" type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="my-2">
                                <button class="btn btn-primary">ارسال کد تایید</button>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">استان</div>
                                                </div>
                                                <select id="ostanEdit" class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">شهر</div>
                                                </div>
                                                <select id="cityEdit" class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5 my-2">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">ایمیل</div>
                                                </div>
                                                <input id="emailEdit" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5 my-2">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">کد تایید موبایل</div>
                                                </div>
                                                <input type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">لغو
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="editCustomerInfoBtn" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- نمایش -->
    <div class="modal" id="showCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش مشتری </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="row">
                            <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">نام</div>
                                            </div>
                                            <input id="nameShow" disabled type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">نام خانوادگی</div>
                                            </div>
                                            <input id="familyShow" disabled type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">جنسیت</div>
                                            </div>
                                            <input id="genderShow" disabled type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">کد ملی</div>
                                            </div>
                                            <input id="ncodeShow" disabled type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">تاریخ تولد</div>
                                            </div>
                                            <input id="birthdayShow" disabled type="text" class="form-control persianDatepicker"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">شماره موبایل</div>
                                            </div>
                                            <input id="mobileShow" disabled type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="my-2">
                                <button class="btn btn-primary">ارسال کد تایید</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">ایمیل</div>
                                            </div>
                                            <input id="emailShow" type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">استان</div>
                                            </div>
                                            <input disabled id="ostanShow" type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 col-md-6 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">شهر</div>
                                            </div>
                                            <input disabled id="cityShow" type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">کد تایید موبایل</div>
                                            </div>
                                            <input type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-3 justify-content-end">
                        <div class="col-2">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">لغو
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--حذف-->
    <div class="modal" id="deleteCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف مشتری</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از حذف مطمئن هستید؟</h5>

                    <div class="row mt-3 justify-content-center">
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
    <script src="{{asset('./assets/js/persian-date.min.js')}}"></script>
    <script src="{{asset('./assets/js/persian-datepicker.min.js')}}"></script>


    <script src="{{asset("./assets/js/jalali-moment.browser.js")}}"></script>
    <script src="{{asset('./assets/js/Pannel/ManageCustomer/CustomerList.js')}}"></script>
@endsection
