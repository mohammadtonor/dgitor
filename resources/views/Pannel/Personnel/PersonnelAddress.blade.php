@extends("Pannel.Admin.home")


@section('pagemeta')
    @if (isset($result))
        <meta name="user_id" content="{{$result["user"]->id}}"/>
    @endif
    {{--    @if (isset($result["addrs"]["city"]))--}}
    {{--        <meta name="ostan_id" content="{{$result->addrs->city->ostan_id}}"/>--}}
    {{--    @endif--}}



    {{--    @if (isset($result["addrs"]))--}}
    {{--        @foreach($result["addrs"] as $addr)--}}
    {{--            {{$result["city"]->ostan_id ? : 0}}--}}
    {{--        @endforeach--}}
    {{--    @endif--}}

@endsection
{{--@section('pagemeta')--}}
{{--    @if (isset($result["addrs"]["city"]))--}}
{{--        <meta name="ostan_id" content="{{$result["ostan_id"]}}"/>--}}
{{--    @endif--}}
{{--@endsection--}}

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
                                <img src="{{asset("./assets/images/addr.png")}}" alt="cart"
                                     class="float-left"
                                     width="70" height="70">
                                <h6 class="card-title font-weight-bold mt-2"> تعداد ادرس</h6>
                                <h2 class="mt-3">26</h2>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <h4 class="d-inline-block">نام کارمند:</h4>
                                @if($result["user"]!=null)
                                    <h4 class="d-inline-block px-2">{{$result["user"]->name}}</h4>
                                @endif
                                <br>
                                <button class="btn btn-lg btn-primary insertSub2Btn my-4" data-toggle="modal"
                                        id="insertSub2Btn"
                                        data-target="#insertAddressModal">ثبت آدرس جدید
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped myTableAddressPersonal"
                                           id="myTableAddressPersonal">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="rowcount">ردیف</th>
                                            <th class="titleAdress">عنوان آدرس</th>
                                            <th class="PostalCode">کد پستی</th>
                                            <th class="City">شهر</th>
                                            <th class="regDate"> تاریخ ایجاد</th>
                                            <th class="DelDate"> تاریخ حذف</th>
                                            <th class="no-sort operation">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">

                                        {{--                                        <tr class="text-center">--}}
                                        {{--                                            <td style="padding-right: 34px;">1</td>--}}
                                        {{--                                            <td class="product-title"></td>--}}
                                        {{--                                            <td class="product-salecount"></td>--}}
                                        {{--                                            <td class="product-salecount"></td>--}}
                                        {{--                                            <td class="product-salecount"></td>--}}
                                        {{--                                            <td class="product-salecount"></td>--}}
                                        {{--                                            <td>--}}
                                        {{--                                                <button class="btn btn-sm btn-danger ml-2 mt-1"data-target="#deleteaddr"data-toggle="modal">--}}
                                        {{--                                                    <i class="icon-trash " aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>--}}
                                        {{--                                                </button>--}}

                                        {{--                                                <button class="btn btn-sm btn-info ml-2 mt-1" data-target="#editaddr" data-toggle="modal">--}}
                                        {{--                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>--}}
                                        {{--                                                </button>--}}
                                        {{--                                                <button class="btn btn-sm btn-primary ml-2 mt-1" data-target="#showaddr"data-toggle="modal">--}}
                                        {{--                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="نمایش"></i>--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </td>--}}
                                        {{--                                        </tr>--}}
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
                                   aria-describedby="inputGroup-sizing-default" id="titleAdress">
                        </div>
                        <div class="form-group mt-2 mb-0">
                            <div class="field_wrapper">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">شهر</div>
                                    </div>
                                    <select class="form-control inp city-selectbox" name="main_category_id"
                                            id="InsertCity_selectbox">
                                        {{--                                        <option value="">انتخاب کنید</option>--}}
                                        {{--                                        <option value="">اردبیل</option>--}}
                                        {{--                                        <option value="">قم</option>--}}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">کد پستی</span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="postal_code"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">آدرس کامل </span>
                            </div>
                            <textarea class="form-control inp" id="complateAdress" rows="3"></textarea>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" id="doInsertAdress"
                                    data-dismiss="modal">ثبت
                            </button>
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
                                   aria-describedby="inputGroup-sizing-default" id="editAddresModalTitle">
                        </div>
                        <div class="form-group mt-2 mb-0">
                            <div class="field_wrapper">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">شهر</div>
                                    </div>
                                    <select class="form-control city-selectbox" name="main_category_id"
                                            id="cityEdit_selectbox">
{{--                                        <option value="">انتخاب کنید</option>--}}
{{--                                        <option value="">اردبیل</option>--}}
{{--                                        <option value="">قم</option>--}}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">کد پستی</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="editAddresModalPostalCode">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">آدرس کامل </span>
                            </div>
                            <textarea class="form-control" id="editAddresModalAddress" rows="3"></textarea>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    id="doEditeAddressModal">ثبت
                            </button>
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
                                   aria-describedby="inputGroup-sizing-default" id="showAddresModalTitle" disabled>
                        </div>
                        <div class="form-group mt-2 mb-0">
                            <div class="field_wrapper">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">شهر</div>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default" id="showAddresModalCity"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="input-group  mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">کد پستی</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="showAddresModalPostalCode" disabled>
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">آدرس کامل </span>
                            </div>
                            <textarea class="form-control" rows="3" id="showAddresModalFullAdress"></textarea>
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
                            <button id="doDeleteModal" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--   restore  --}}
    <div class="modal" id="restoreAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">restore</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از restore مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="dorestoreModal" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("pagejs")
    <script src="{{asset('./assets/js/Pannel/personel/Address/AddressPersonal.js')}}"></script>

{{--    <script>--}}
{{--        let myTableAddressPersonal = $("#myTableAddressPersonal").DataTable({--}}
{{--            "order": [],--}}
{{--            "columnDefs": [{--}}
{{--                "targets": 'no-sort',--}}
{{--                "orderable": false,--}}
{{--            }],--}}
{{--            "language": {--}}
{{--                "emptyTable": "هیچ داده ای برای نمایش وجود ندارد",--}}
{{--                "info": "نمایش _START_ تا _END_ از _TOTAL_ آیتم",--}}
{{--                "infoEmpty": "نمایش 0 تا 0 از 0 آیتم",--}}
{{--                "infoFiltered": "(فیلتر شده از جمعا _MAX_ ایتم)",--}}
{{--                "zeroRecords": "داده مشابهی پیدا نشد",--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
