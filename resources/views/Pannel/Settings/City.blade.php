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
                                <img src="{{asset("./assets/images/country.png")}}" alt="cart" class="float-left"
                                     width="70" height="70">
                                <h6 class="card-title font-weight-bold"> تعداد شهر </h6>
                                <h2>26</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <div class="d-flex">
                                    <h5>کشور :</h5>
                                    <span> ایران </span>
                                </div>
                                <button class="btn btn-lg btn-primary  my-2" data-toggle="modal" id="new_city"
                                        data-target="#btncreatenewcity"> شهر جدید
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableCity">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="rowcount">ردیف</th>
                                            <th class="country_name">نام کشور</th>
                                            <th class="city_name">نام شهر</th>
                                            <th class="ostan_name">نام استان</th>
                                            <th class="created_at"> تاریخ ایجاد</th>
                                            <th class="deleted_at"> تاریخ حذف</th>
                                            <th class="count_user">تعداد کاربر</th>
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
    <!--ایجاد  شهر-->
    <div class="modal" id="btncreatenewcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد شهر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group-prepend mt-2" style="width: 100%">
                            <div class="input-group">
                                <div class="input-group-prepend "><span class="input-group-text " style="width: 100%">نام کشور</span>
                                </div>
                                <select class="form-control" name="baste" style="height: auto" id="create_new_city_country">

                                </select>
                            </div>
                        </div>
                        <div class="input-group-prepend mt-2" style="width: 100%">
                            <div class="input-group">
                                <div class="input-group-prepend "><span class="input-group-text " style="width: 100%">نام استان</span>
                                </div>
                                <select class="form-control" name="baste" style="height: auto" id="name_ostan">

                                </select>
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> نام شهر </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" id="create_new_city_city"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal" id="register">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  ویرایش شهر  --}}
    <div class="modal" id="editcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش شهر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group-prepend mt-2" style="width: 100%">
                            <div class="input-group">
                                <div class="input-group-prepend "><span class="input-group-text " style="width: 100%">نام کشور</span>
                                </div>
                                <select class="form-control" name="baste" style="height: auto" id="edit_name_country">

                                </select>
                            </div>
                        </div>
                        <div class="input-group-prepend mt-2" style="width: 100%">
                            <div class="input-group">
                                <div class="input-group-prepend "><span class="input-group-text " style="width: 100%">نام استان</span>
                                </div>
                                <select class="form-control" name="baste" style="height: auto" id="edit_name_ostan">

                                </select>
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> نام شهر </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" id="edit_name_city"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="edit_city" type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--حذف-->
    <div class="modal" id="deletecity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف شهر</h5>
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
                            <button id="delete-city" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--بازیابی-->
    <div class="modal" id="restorecity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف شهر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از بازیابی مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="restore-city" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("pagejs")
    <script src="{{asset('./assets/js/Pannel/Settings/citiesFetch.js')}}"></script>

@endsection
