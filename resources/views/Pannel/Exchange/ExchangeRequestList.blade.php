@extends("Pannel.Admin.home")


{{--Page Css--}}
@section("pagecss")

    <link rel="stylesheet" href="{{asset('./assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/GeneralStyle/style.css')}}">

@endsection

@section("content")
    <main>
        <div class="container-fluid">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 justify-content-between d-sm-flex w-100 rounded">
                        <div class="w-sm-100 ml-auto"><h4 class="mb-0">داشبورد</h4>
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
                <div class="container-fluid align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <h4 style="margin: 20px 45px 10px 15px"> درخواست معاوضه کالا [کاربر] </h4>
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <div class="d-flex container mx-0 ">
                                    <div class="row w-100">
                                        <div class="form-group col-sm-12 col-md-2">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"> دسته 1</div>
                                                    </div>
                                                    <select class="form-control Category1" name="Category1"
                                                            id="Category1">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">دسته 2</div>
                                                    </div>
                                                    <select class="form-control Category2" name="Category2"
                                                            id="Category2">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">دسته 3 </div>
                                                    </div>
                                                    <select class="form-control Category3" name="Category3"
                                                            id="Category3">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn btn-md  btn-danger searchOk " id="searchOk">جستجو</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="container-fluid">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="container-fluid card-header" id="headingOne">

                                                <h5 class="mb-0 w-100 mx-0">
                                                    <button class="btn btn-link w-75" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-light table-striped w-100 ">
                                                                <thead>
                                                                <tr class="text-center">
                                                                    <th class="rowcount">ردیف</th>
                                                                    <th class="">کالا</th>
                                                                    <th class="">دسته بندی</th>
                                                                    <th class="">قیمت</th>
                                                                    <th class="">4 پیشنهاد</th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body mt-1">

                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-dark table-striped w-100 myTableExchangeRequestList " id="myTableExchangeRequestList">
                                                            <thead>
                                                            <tr class="text-center">
                                                                <th class="rowcount">ردیف</th>
                                                                <th class="">نام کالا</th>
                                                                <th class="">دسته بندی</th>
                                                                <th class="">مالک</th>
                                                                <th class="">قیمت</th>
                                                                <th class="">علاقمندی</th>
                                                                <th class="">معاوضه قطعی</th>
                                                                <th class="">تاریخ حذف</th>
                                                                <th class="no-sort operation w-25" >عملیات</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody style="margin: 25px">
                                                            <tr class="text-center">
                                                                <td style="padding-right: 34px;">1</td>
                                                                <td ></td>
                                                                <td ></td>
                                                                <td ></td>
                                                                <td ></td>
                                                                <td ></td>
                                                                <td ></td>
                                                                <td ></td>
                                                                <td class="d-flex justify-content-center">
                                                                    <button class="btn btn-sm btn-danger ml-2 mt-1 deleteExchangeRequestList" id="deleteExchangeRequestList" data-target="#deleteExchangeRequestListModal"
                                                                            data-toggle="modal">
                                                                        <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                                           data-placement="top"
                                                                           title="حذف"></i>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-warning ml-2 mt-1 restoreExchangeRequestList" id="restoreExchangeRequestList" data-target="#restoreExchangeRequestListModal"
                                                                            data-toggle="modal">
                                                                        <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
                                                                           data-placement="top"
                                                                           title="بازیابی"></i>
                                                                    </button>

                                                                    <button class="btn btn-sm btn-success ml-2 mt-1"
                                                                            data-target="#"
                                                                            data-toggle="modal">
                                                                        <i class="icon-doc" aria-hidden="true" data-toggle="tooltip"
                                                                           data-placement="top"
                                                                           title="درخواست کارشناسی"></i>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-info ml-2 mt-1">
                                                                        <i class="icon-note" aria-hidden="true"
                                                                           data-toggle="tooltip"
                                                                           data-placement="top"
                                                                           title="پیام"></i>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-warning ml-2 mt-1">
                                                                        <i class="icon-check" aria-hidden="true"
                                                                           data-toggle="tooltip"
                                                                           data-placement="top"
                                                                           title="انتخاب"></i>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-success ml-2 mt-1">
                                                                        <i class="icon-wallet" aria-hidden="true" data-toggle="tooltip"
                                                                           data-placement="top"
                                                                           title="پرداخت قطعی"></i>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--MODAL-->

    <!--حذف-->
    <div class="modal" id="deleteExchangeRequestListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف درخواست معاوضه کالا</h5>
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
                            <button id="deleteOkPersonnel" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--بازیابی-->
    <div class="modal" id="restoreExchangeRequestListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">بازیابی درخواست معاوضه کالا</h5>
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
                            <button id="restoreOkPersonnel" type="button" class="btn btn-success w-100" data-dismiss="modal"
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
    <script src="{{asset('./assets/js/select2.min.js')}}"></script>
    <script src="{{asset('./assets/js/personel/PersonnelList/PersonnelList.js')}}"></script>

    <script >

        //=================Initialize data table==============
        let myTableExchangeRequestList = $('#myTableExchangeRequestList').DataTable({
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }],
            "language": {
                "emptyTable": "هیچ داده ای برای نمایش وجود ندارد",
                "info": "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
                "infoEmpty": "نمایش 0 تا 0 از 0 آیتم",
                "infoFiltered": "(فیلتر شده از جمعا _MAX_ ایتم)",
                "zeroRecords": "داده مشابهی پیدا نشد",
            }
        });


        $('.multisel').select2({
            closeOnSelect: true,
            placeholder: "انتخاب کنید",
            allowHtml: true,
            allowClear: true,
            // theme: "bootstrap",
            // dropdownCssClass: "myFont",
            width: 'resolve',
            "language": {
                "noResults": function () {
                    return "موردی یافت نشد"
                }
            },
        });


    </script>

@endsection
