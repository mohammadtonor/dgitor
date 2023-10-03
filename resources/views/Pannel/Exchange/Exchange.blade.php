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
                                <img src="{{asset("./assets/images/exchange-icon.png")}}" alt="cart" class="float-left"
                                     width="70" height="70">
                                <h6 class="card-title font-weight-bold"> تعداد وضعیت </h6>
                                <h2>26476</h2>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <button class="btn btn-lg btn-primary  my-2" data-toggle="modal"
                                        data-target="#btninsertnewstatus">ثبت وضعیت جدید
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableExchange">
                                        <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>نام وضعیت</th>
                                            <th>فعال</th>
                                            <th>تعداد معاوضه</th>
                                            <th> تاریخ ایجاد</th>
                                            <th> تاریخ حذف</th>
                                            <th class="no-sort">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">
                                        <tr>
                                            <td style="padding-right: 34px;">1</td>
                                            <td class="product-title"></td>
                                            <td class="product-salecount"></td>
                                            <td class="product-salecount"></td>
                                            <td class="product-salecount"></td>
                                            <td class="product-salecount"></td>
                                            <td>
                                                <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#delete"
                                                        data-toggle="modal">
                                                    <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="حذف"></i>
                                                </button>

                                                <button class="btn btn-sm btn-info ml-2 mt-1" data-target="#editcategory"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1" data-target="#inactive"
                                                        data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="غیر فعال"></i>
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

    <div class="modal" id="btninsertnewstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد وضعیت جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> نام</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ویرایش -->
    <div class="modal" id="editcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group-prepend my-2" style="width: 100%">
                            <div class="input-group">
                                <div class="input-group-prepend ">
                                    <span class="input-group-text " style="width: 100%">وضعیت</span>
                                </div>
                                <select class="form-control" name="" style="height: auto">
                                    <option value="1">انتخاب کنید</option>
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                </select>
                            </div>
                        </div>

                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- غیر فعال -->
    <div class="modal" id="inactive" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">غیر فعال</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">

                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" > وضعیت فعلی </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group-prepend my-2" style="width: 100%">
                            <div class="input-group">
                                <div class="input-group-prepend ">
                                    <span class="input-group-text " style="width: 100%">وضعیت</span>
                                </div>
                                <select class="form-control" name="" style="height: auto">
                                    <option value="1">انتخاب کنید</option>
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--حذف-->
    <div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف </h5>
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
@endsection

@section("pagejs")
    <script src="{{asset('./assets/js/select2.min.js')}}"></script>
    {{--    <script src="{{asset('./assets/js/Category/category.js')}}"></script>--}}
    <script>
        $(document).ready(function () {
            $('#tableExchange').DataTable({
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
        });
    </script>
@endsection
