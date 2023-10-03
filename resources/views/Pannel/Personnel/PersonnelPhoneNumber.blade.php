@extends("Pannel.Admin.home")


@section('pagemeta')
    @if (isset($result))
        <meta name="user_id" content="{{$result["user"]->id}}"/>
    @endif
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
                        <div class="card" style="height: 150px">
                            <div class="card-body">
                                <img src="{{asset("./assets/images/phoneNumber.png")}}" alt="cart"
                                     class="float-left"
                                     width="70" height="70">
                                <h6 class="card-title font-weight-bold"> تعداد شماره تماس</h6>
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
                                    <h4>نام کارمند : </h4>
                                    @if($result["user"]!=null)
                                        <h4 class="d-inline-block px-2">{{$result["user"]->name}}</h4>
                                    @endif
                                </div>
                                <button class="btn btn-lg btn-primary my-4" data-toggle="modal" id="insertPhoneNumberBtn"
                                        data-target="#createNewPhoneNumberModal">ثبت شماره جدید
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped myTablePersonnelPhoneNumber" id="myTablePersonnelPhoneNumber">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="text-center rowcount" >ردیف</th>
                                            <th class="text-center title" >عنوان تماس </th>
                                            <th class="text-center phoneNumber" >شماره تماس </th>
                                            <th class="text-center created_at" > تاریخ ثبت</th>
                                            <th class="text-center deleted_at" > تاریخ حذف</th>
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
    <!--ایجاد ادرس جدید-->
    <div class="modal" id="createNewPhoneNumberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد شماره تماس جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان </span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="newTitle"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">شماره تماس </span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="newPhone"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="doNewPersonnelPhoneNumber" type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ویرایش -->
    <div class="modal" id="editPhoneNumberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش شماره تماس </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان </span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="editPhoneNumberModalTitle"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">شماره تماس </span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="editPhoneNumberModalPhone"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="doEditePhoneNumberModal" type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
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
    <!-- نمایش -->
    <div class="modal" id="showPhoneNumberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش شماره تماس </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان </span>
                            </div>
                            <input disabled type="text" class="form-control inp" aria-label="Default" id="showTitle"
                                   aria-describedby="inputGroup-sizing-default" >
                        </div>
                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">شماره تماس </span>
                            </div>
                            <input disabled type="text" class="form-control inp" aria-label="Default" id="showPhone"
                                   aria-describedby="inputGroup-sizing-default" >
                        </div>

                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">بستن
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    حذف   --}}
    <div class="modal" id="deletePhoneNumberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف شماره تماس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از حذف مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="doDeleteModal" type="button" class="btn btn-success w-100" data-dismiss="modal"
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
    {{--    بازیابی   --}}
    <div class="modal" id="restorePhoneNumberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف شماره تماس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از بازیابی مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="dorestoreModal" type="button" class="btn btn-success w-100" data-dismiss="modal"
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

@endsection

@section("pagejs")

    <script src="{{asset('./assets/js/Pannel/personel/PersonnelPhoneNumber.js')}}"></script>

@endsection
