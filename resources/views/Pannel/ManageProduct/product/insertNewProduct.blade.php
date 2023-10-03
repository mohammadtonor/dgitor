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
                        <div class="card p-1">
                            <div class="card-body">
                                <img src="{{asset("./assets/images/product.png")}}"  alt="cart" class="float-left w-25">
                                <h6 class="card-title font-weight-bold"> تعداد کالاها </h6>
                                <h2>26476</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card p-1">
                            <div class="card-body">
                                <img src="{{asset("./assets/images/category.png")}}"  alt="cart" class="float-left w-25">
                                <h6 class="card-title font-weight-bold"> تعداد دسته ها </h6>
                                <h2>26476</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <button class="btn btn-lg btn-primary my-2 mr-2 mb-5" data-toggle="modal" data-target="#btncreatenewcategory"> ثبت کالای جدید</button>
                                <div class="row">
                                    <div class="input-group mb-4 col-xl-2 col-md-4 col-sm-12">
                                        <span class="input-group-text">دسته</span>
                                        <select class="form-control border-0" style="border: 1px solid #e6e6e7!important;">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-4 col-xl-2 col-md-4 col-sm-12">
                                        <span class="input-group-text">زیر دسته</span>
                                        <select class="form-control border-0" style="border: 1px solid #e6e6e7!important;">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-4 col-xl-2 col-md-4 col-sm-12">
                                        <span class="input-group-text">زیر دسته</span>
                                        <select class="form-control border-0" style="border: 1px solid #e6e6e7!important;">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-4 col-xl-2 col-md-4 col-sm-12">
                                        <span class="input-group-text">زیر دسته</span>
                                        <select class="form-control border-0" style="border: 1px solid #e6e6e7!important;">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-4 col-xl-2 col-md-4 col-sm-12">
                                        <span class="input-group-text">محصولات</span>
                                        <select class="form-control border-0" style="border: 1px solid #e6e6e7!important;">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-success">جستجو</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableCategory">
                                        <thead>
                                        <tr>
                                            <th class="text-center">ردیف</th>
                                            <th class="text-center">عنوان محصول</th>
                                            <th class="text-center">توضیحات</th>
                                            <th class="text-center">نمایش</th>
                                            <th class="text-center">قیمت</th>
                                            <th class="text-center">قیمت کارشناسی شده</th>
                                            <th class="text-center">مالک کالا</th>
                                            <th class="text-center">ثبت کننده</th>
                                            <th class="text-center">عملیات</th>
                                            <th class="text-center">فعال</th>
                                            <th class="text-center">تخفیف</th>
                                            <th class="text-center">شهر</th>
                                            <th class="text-center">استان</th>
                                            <th class="text-center">کشور</th>
                                            <th class="no-sort">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">
                                        <tr>
                                            <td style="padding-right: 34px;">1</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="d-flex">
                                                <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#deleteNewProduct"
                                                        data-toggle="modal">
                                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="حذف"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1" data-target="#editNewProduct"
                                                        data-toggle="modal">
                                                    <i class="icon-note" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1" data-target="#showNewProduct"
                                                        data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1" data-target="#insertAddress"
                                                        data-toggle="modal">
                                                    <i class="icon-location-pin" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="ثبت آدرس"></i>
                                                </button>
                                                <button class="btn btn-sm btn-secondary ml-2 mt-1" data-target="#discount"
                                                        data-toggle="modal">
                                                    <i class="icon-paypal" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="تخفیف"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1" data-target="#images"
                                                        data-toggle="modal">
                                                    <i class="icon-film" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="تصاویر"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1">
                                                    <i class="icon-list" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="خدمات دوره ای"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1">
                                                    <i class="icon-organization" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="معاوضه"></i>
                                                </button>
                                                <button class="btn btn-sm btn-secondary ml-2 mt-1">
                                                    <i class="icon-list" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="درخواست کارشناسی"></i>
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



    <!--MODALS-->


    <!-- show -->
    <div class="modal" id="showNewProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class="px-3">
                        <div class="d-flex mt-4">
                                <h6>وضعیت فعلی:</h6>
                                <h6>............</h6>
                        </div>
                        <div class="input-group mb-5 mt-4">
                            <span class="input-group-text">وضعیت نمایش</span>
                            <select class="form-control border-0" style="border: 1px solid #e6e6e7!important;">
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                            </select>
                        </div>
                    </form>

                    <div class="row mt-3">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">لغو
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

    <!-- address -->
    <div class="modal" id="insertAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش آدرس  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class="px-3">
                        <div class="row">
                            <div class="input-group col-md-4 col-sm-12 mb-3">
                                <span class="input-group-text">کشور</span>
                                <select class="form-control border-0" style="border: 1px solid #e6e6e7!important;">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                </select>
                            </div>
                            <div class="input-group col-md-4 col-sm-12 mb-3">
                                <span class="input-group-text">استان</span>
                                <select class="form-control border-0" style="border: 1px solid #e6e6e7!important;">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                </select>
                            </div>
                            <div class="input-group col-md-4 col-sm-12 mb-3">
                                <span class="input-group-text">شهر</span>
                                <select class="form-control border-0" style="border: 1px solid #e6e6e7!important;">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                </select>
                            </div>
                            <div class="row px-3 w-100">
                                <div class="input-group my-3">
                                    <div class="form-group w-100">
                                        <span class="input-group-text">شرح آدرس</span>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-3 justify-content-end ml-4">
                        <div class="ml-3">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">لغو</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- discount -->
    <div class="modal" id="discount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> اصلاح قیمت </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class="px-3">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel">قیمت</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel">تخفیف</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3 justify-content-end ml-4">
                        <div class="ml-3">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">لغو</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- images -->
    <div class="modal" id="images" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> تصاویر </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div id="carouselExampleControls" class="carousel slide position-relative" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{asset("./assets/images/flowers.webp")}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset("./assets/images/flowers.webp")}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset("./assets/images/flowers.webp")}}" alt="Third slide">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary position-absolute" style="right: 10px;bottom: 10px" data-dismiss="modal">حذف</button>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="row mt-3 ml-4 mb-5">
                        <div class="mr-2">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal">آپلود</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--delete-->
    <div class="modal" id="deleteNewProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف کالا </h5>
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

    <!--MODALS-->

@endsection

@section("pagejs")
    <script src="{{asset('./assets/js/select2.min.js')}}"></script>
        <script src="{{asset('./assets/js/Pannel/Exchange/Product/insertNewProduct.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#tableCategory').DataTable({
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
