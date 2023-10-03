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
                        <div class="card">
                            <div class="card-body">
                                <img src="{{asset("./assets/images/bankinfo.png")}}" alt="cart"
                                     class="float-left"
                                     width="70" height="70">
                                <h6 class="card-title font-weight-bold"> تعداد اطلاعات</h6>
                                <h2 id="bankCount"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <div class="d-flex">
                                    <h4>نام مشتری :</h4>
                                    <h3>{{$result["user"]->name}}</h3>
                                </div>
                                <button class="btn btn-lg btn-primary  my-2" data-toggle="modal" id="new_info_account"
                                        data-target="#btncreatenewbankinfo">ثبت اطلاعات جدید
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableBankAccountInfo">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="text-center">ردیف</th>
                                            <th class="text-center">نام بانک</th>
                                            <th class="text-center">عنوان</th>
                                            <th class="text-center">شماره کارت</th>
                                            <th class="text-center">شماره شبا</th>
                                            <th class="text-center"> تاریخ ایجاد</th>
                                            <th class="text-centert"> تاریخ حذف</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">
                                        <tr class="text-center">
                                            <td class="rowcount"></td>
                                            <td class="bankUpdate"></td>
                                            <td class="titleUpdate"></td>
                                            <td class="cardNumberUpdate"></td>
                                            <td class="shebaUpdate"></td>
                                            <td class="createdAtUpdate"></td>
                                            <td class="deletedAtUpdate"></td>
                                            <td class="operation">
                                                <button class="btn btn-sm btn-danger ml-2 mt-1"
                                                        data-target="#deleteaccount"
                                                        data-toggle="modal">
                                                    <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="حذف"></i>
                                                </button>

                                                <button class="btn btn-sm btn-info ml-2 mt-1"
                                                        data-target="#editaccount"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1"
                                                        data-target="#showaccount"
                                                        data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="نمایش"></i>
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
    <!--ایجاداطلاعات بانکی جدید-->
    <div class="modal" id="btncreatenewbankinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاداطلاعات بانکی جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان بانک </span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="bankInsert"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">عنوان</span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="titleInsert"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">شماره کارت</span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="cardnumberInsert"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">شماره شبا</span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="shebaInsert"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="insertBankBtn" type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ویرایش -->
    <div class="modal" id="editaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش اطلاعات بانکی </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان بانک </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" id="bankEdit"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">عنوان</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" id="titleEdit"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">شماره کارت</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" id="cardnumberEdit"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">شماره شبا</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" id="shebaEdit"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="editBankInfoBtn" type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- نمایش -->
    <div class="modal" id="showaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش اطلاعات بانکی </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان بانک </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" disabled id="bankShow"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">عنوان</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" disabled id="titleShow"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">شماره کارت</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" disabled id="cardnumberShow"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">شماره شبا</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" disabled id="shebaShow"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-12">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    حذف   --}}
    <div class="modal" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف</h5>
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
    <script src="{{asset('./assets/js/Pannel/ManageCustomer/CustomerBankInfo.js')}}"></script>
@endsection
