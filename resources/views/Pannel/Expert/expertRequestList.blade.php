@extends("Pannel.Admin.home")


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
                        <div class="card p-3">
                            <div class="card-body">
                                <img src="{{asset("/assets/images/expertRequest.png")}}"  alt="cart" class="float-left"
                                     width="70" height="70" >
                                <h6 class="card-title font-weight-bold"> تعداد کل درخواست ها </h6>
                                <h2 id="countriesCount"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{asset("/assets/images/checkmark.png")}}"  alt="cart" class="float-left"
                                     width="100" height="100" >
                                <h6 class="card-title font-weight-bold"> انجام شده </h6>
                                <h2 id="countriesCount"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card p-3">
                            <div class="card-body">
                                <img src="{{asset("/assets/images/failed.png")}}"  alt="cart" class="float-left"
                                     width="70" height="70" >
                                <h6 class="card-title font-weight-bold"> لغو شده </h6>
                                <h2 id="countriesCount"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <h4>لیست درخواست کارشناسی</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableExpertRequest">
                                        <thead>
                                        <tr class="text-center">
                                            <th>ردیف</th>
                                            <th>دسته بندی</th>
                                            <th>محصول</th>
                                            <th>نوع کارشناسی</th>
                                            <th>قیمت</th>
                                            <th>تسویه شده</th>
                                            <th>تاریخ کارشناسی</th>
                                            <th>تاریخ ثبت</th>
                                            <th> کارشناس</th>
                                            <th class="no-sort">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">
                                        <tr class="text-center">
                                            <td class="rowcount"></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class="operation d-flex justify-content-center">
                                                <button class="btn btn-sm btn-warning ml-2 mt-1" data-target="#showExperRequest"
                                                        data-toggle="modal">
                                                    <i class="icon-film" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#cancelExpertRequest"
                                                        data-toggle="modal">
                                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="لغو"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1">
                                                    <a href="">
                                                        <i class="icon-star text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="نتایج"></i>
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

    <!-- نمایش -->
    <div class="modal" id="showExperRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش لیست درخواست کارشناسی </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h6>دسته 1: ......</h6>
                    <h6>دسته 2: ......</h6>
                    <h6>دسته 3: ......</h6>
                    <h6>دسته 4: ......</h6>
                    <h6>نوع کارشناسی: ......</h6>
                    <h6>قیمت کارشناسی: ......</h6>
                    <h6>محصول: ......</h6>
                    <h6>زمان: ......</h6>
                    <h6>آدرس: ......</h6>
                    <h6>شماره تماس: ......</h6>
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

    <!--لغو-->
    <div class="modal" id="cancelExpertRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">لغو</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از لغو مطمئن هستید؟</h5>

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


@endsection

@section("pagejs")
    <script>
        $(document).ready(function (){
            let tableExpertRequest = $('#tableExpertRequest').DataTable({
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
        })
    </script>
    <script src="{{asset("./assets/js/jalali-moment.browser.js")}}"></script>
    <script src="{{asset('./assets/js/Pannel/Settings/Customer.js')}}"></script>
@endsection
