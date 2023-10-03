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
                <div class="row categ ">
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card divstyle">
                            <div class="card-body">
                                <img src="{{asset("/assets/images/ListInterests-icon.png")}}" alt="cart"
                                     class="float-left"
                                     width="100" height="90">
                                <h6 class="card-title font-weight-bold">تعداد علاقمندی ها</h6>
                                <h2>26476</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3 ">
                    <div class="card col-12 m-0 p-0 divstyle">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <div class="table-responsive">
                                    <h4 style="margin: 10px 20px 20px 0"> لیست علاقمندی [کاربر] </h4>
                                    <div>
                                        <table class="table table-hover table-dark table-striped w-100 myTableListIntereste " id="myTableListIntereste">
                                            <thead>
                                            <tr class="text-center">
                                                <th class="rowcount">ردیف</th>
                                                <th class=""> نام محصول</th>
                                                <th class="">قیمت</th>
                                                <th class="">نام مالک</th>
                                                <th class="">وضعیت کالا</th>
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
                                                <td class="d-flex justify-content-center">
                                                    <button class="btn btn-sm btn-danger ml-2 mt-1 deleteKalalList" id="deleteKalalList" data-target="#deleteKalalListModal"
                                                            data-toggle="modal">
                                                        <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="حذف"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-warning ml-2 mt-1 restoreKalalList" id="restoreKalalList" data-target="#restoreKalalListModal"
                                                            data-toggle="modal">
                                                        <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="بازیابی"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-info ml-2 mt-1">
                                                        <a href="{{asset("/....")}}">
                                                            <i class="icon-doc" aria-hidden="true"
                                                               data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="نمایش کالا"></i></a>
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
    </main>
    <!--MODAL-->

    <!--حذف-->
    <div class="modal" id="deleteKalalListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف کالا</h5>
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
                            <button id="" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--بازیابی-->
    <div class="modal" id="restoreKalalListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">بازیابی کالا</h5>
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
        let myTablePersonnelList = $('#myTableListIntereste').DataTable({
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
