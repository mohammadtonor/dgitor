@extends("Pannel.Admin.home")


{{--Page Css--}}
@section("pagecss")
    <link rel="stylesheet" href="{{asset('./assets/css/GeneralStyle/style.css')}}">

@endsection


@section('pagemeta')
    <meta name="user_id" content="{{$result["user"]->id}}" />
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
                        <div class="card" style="height: 150px">
                            <div class="card-body" >
                                <img src="{{asset("./assets/images/addr.png")}}" alt="cart"
                                     class="float-left"
                                     width="70" height="70">
                                <h6 class="card-title font-weight-bold mt-2"> تعداد ادرس</h6>
                                <h2 id="addressCount" class="mt-3"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <button id="insertNewAddress" class="btn btn-lg btn-primary insertSub2Btn my-2" data-toggle="modal"
                                        data-target="#insertAddressModal">ثبت آدرس جدید
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped myTableAddressPersonal" id="myTableAddressPersonal">
                                        <thead>
                                        <tr class="text-center">
                                            <th>ردیف</th>
                                            <th>عنوان آدرس</th>
                                            <th>آدرس کامل</th>
                                            <th>کد پستی</th>
                                            <th>شهر</th>
                                            <th> تاریخ ثبت</th>
                                            <th> تاریخ حذف</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody style="margin: 25px">
                                        <tr class="text-center">
                                            <td class="rowcount"></td>
                                            <td class="titleUpdate"></td>
                                            <td class="addressUpdate"></td>
                                            <td class="postalcodeUpdate"></td>
                                            <td class="cityUpdate"></td>
                                            <td class="createdAtUpdate"></td>
                                            <td class="deletedAtUpdate"></td>
                                            <td class="operation">
                                                <button class="btn btn-sm btn-danger ml-2 mt-1"
                                                        data-target="#deleteaddr"
                                                        data-toggle="modal">
                                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>
                                                </button>

                                                <button class="btn btn-sm btn-info ml-2 mt-1"
                                                        data-target="#editAddresModal"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1"
                                                        data-target="#showAddresModal"
                                                        data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="نمایش"></i>
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
    <!--ایجاد ادرس جدید-->
    <div class="modal" id="insertAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد ادرس جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان آدرس</span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="titleInsert">
                        </div>
                        <div class="form-group mt-2 mb-0">
                            <div class="field_wrapper">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">استان</div>
                                    </div>
                                    <select class="form-control inp city-selectbox" name="main_category_id"
                                            id="ostanInsert">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2 mb-0">
                            <div class="field_wrapper">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">شهر</div>
                                    </div>
                                    <select class="form-control inp city-selectbox" name="main_category_id"
                                            id="cityInsert">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">کد پستی</span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="postalcodeInsert"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">آدرس کامل </span>
                            </div>
                            <textarea class="form-control inp" id="addressInsert" rows="3"></textarea>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" id="insertAddressBtn" data-dismiss="modal">ثبت
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ویرایش -->
    <div class="modal" id="editAddresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش ادرس </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان آدرس</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="titleEdit">
                        </div>
                        <div class="form-group mt-2 mb-0">
                            <div class="field_wrapper">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">استان</div>
                                    </div>
                                    <select class="form-control city-selectbox" name="main_category_id"
                                            id="ostanEdit" >
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2 mb-0">
                            <div class="field_wrapper">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">شهر</div>
                                    </div>
                                    <select class="form-control city-selectbox" name="main_category_id"
                                            id="cityEdit" >
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">کد پستی</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="postalCodeEdit">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">آدرس کامل </span>
                            </div>
                            <textarea class="form-control" id="addressEdit" rows="3"></textarea>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal" id="editAddressInfoBtn">ثبت</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- نمایش -->
    <div class="modal" id="showAddresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش ادرس </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان آدرس</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="titleShow" disabled>
                        </div>
                        <div class="form-group mt-2 mb-0">
                            <div class="field_wrapper">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">استان</div>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default" id="ostanShow" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2 mb-0">
                            <div class="field_wrapper">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">شهر</div>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default" id="cityShow" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">کد پستی</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="postalCodeShow" disabled>
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">آدرس کامل </span>
                            </div>
                            <textarea disabled class="form-control" rows="3" id="addressShow" ></textarea>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal">بستن
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--   حذف   --}}
    <div class="modal" id="deleteAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف آدرس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از حذف مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="dodelete" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
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
    <script src="{{asset('./assets/js/Pannel/ManageCustomer/CustomerAddr.js')}}"></script>
@endsection
