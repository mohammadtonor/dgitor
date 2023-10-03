@extends("Pannel.Admin.home")


{{--Page Css--}}
@section("pagecss")

    <link rel="stylesheet" href="{{asset('./assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/GeneralStyle/style.css')}}">

    <style>

        .input-group>.input-group-prepend {
            flex: 0 0 24%;
        }
        .input-group .input-group-text {
            width: 100%;
        }

    </style>

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
                                <img src="{{asset("./assets/images/category-removebg-preview.png")}}"  alt="cart" class="float-left"
                                     width="130" height="70" >
                                <h6 class="card-title font-weight-bold"> تعداد دسته ها </h6>
                                <h2>26476</h2>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{asset("./assets/images/category-removebg-preview.png")}}"  alt="cart" class="float-left"
                                     width="130" height="70" >
                                <h6 class="card-title font-weight-bold"> تعداد کالاها </h6>
                                <h2>26476</h2>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <button class="btn btn-lg btn-primary my-2 text-center insertPreProduct" id="insertPreProduct" data-toggle="modal"
                                        data-target="#insertPreProductModal">ثبت محصول جدید
                                </button>

                                <div class="row">
                                    <div class="col-12 col-md-2 input-group-prepend" style="width: 100%">
                                        <div class="input-group my-2">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text " style="width: 100%">دسته اصلی</span>
                                            </div>
                                            <select class="form-control" name="baste" id="country" style="height: auto">
                                                <option value="1">اول</option>
                                                <option value="1">دوم</option>
                                                <option value="1"> سوم</option>
                                                <option value="1">چهارم</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-2 input-group-prepend" style="width: 100%">
                                        <div class="input-group my-2">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text " style="width: 100%">زیر دسته</span>
                                            </div>
                                            <select class="form-control" name="baste" id="country" style="height: auto">
                                                <option value="1">اول</option>
                                                <option value="1">دوم</option>
                                                <option value="1"> سوم</option>
                                                <option value="1">چهارم</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-2 input-group-prepend" style="width: 100%">
                                        <div class="input-group my-2">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text " style="width: 100%">زیر دسته</span>
                                            </div>
                                            <select class="form-control" name="baste" id="country" style="height: auto">
                                                <option value="1">اول</option>
                                                <option value="1">دوم</option>
                                                <option value="1"> سوم</option>
                                                <option value="1">چهارم</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-2 input-group-prepend" style="width: 100%">
                                        <div class="input-group my-2">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text " style="width: 100%">زیر دسته</span>
                                            </div>
                                            <select class="form-control" name="baste" id="country" style="height: auto">
                                                <option value="1">اول</option>
                                                <option value="1">دوم</option>
                                                <option value="1"> سوم</option>
                                                <option value="1">چهارم</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-2 col-2">
                                        <button class=" btn btn-primary ml-4 mt-2">
                                            جستجو
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped myTablePreProduct" id="myTablePreProduct">
                                        <thead>
                                        <tr>
                                            <th class="text-center rowcount">ردیف</th>
                                            <th class="text-center title">عنوان</th>
                                            <th class="text-center description">توضیحات</th>
                                            <th class="text-center show">نمایش</th>
                                            <th class="text-center registerUser">کاربر ثبت کننده</th>
                                            <th class="text-center category">دسته بندی</th>
                                            <th class="text-center insertAt"> تاریخ ایجاد</th>
                                            <th class="text-center deletedAt"> تاریخ حذف</th>
                                            <th class="no-sort text-center operation">عملیات</th>
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

    <!--ایجاد کالای از پیش تعیین شده-->
    <div class="modal" id="insertPreProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">

        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ثبت کالای جدید </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend ">
                                <span class="input-group-text "> عنوان</span>
                            </div>
                            <input
                                type="text"
                                id="insertTitle"
                                class="form-control"
                                aria-label="Default"
                                aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea
                                id="insertDiscription"
                                class="form-control"
                                rows="3">
                            </textarea>
                        </div>

                        <div class="input-group-prepend" style="width: 100%">
                            <div class="input-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 100%">نوع</span>
                                </div>
                                <select
                                    class="form-control"
                                    name="baste"
                                    id="insertNo"
                                    style="height: auto">
                                    <option value="1">کالا</option>
                                    <option value="1">خدمات</option>

                                </select>
                            </div>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 1</span>
                            </div>
                            <select
                                class="form-control"
                                id="insertDaste1"
                                name="baste"
                                style="height: auto">
                                <option value="1">دسته1</option>
                                <option value="1">دسته2</option>
                            </select>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 2</span>
                            </div>
                            <select
                                class="form-control"
                                id="insertDaste2"
                                name="baste"
                                style="height: auto">
                                <option value="1">دسته1</option>
                                <option value="1">دسته2</option>
                            </select>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 3</span>
                            </div>
                            <select
                                class="form-control"
                                id="insertDaste3"
                                name="baste"
                                style="height: auto">
                                <option value="1">دسته1</option>
                                <option value="1">دسته2</option>
                            </select>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 4</span>
                            </div>
                            <select
                                class="form-control"
                                id="insertDaste4"
                                name="baste"
                                style="height: auto">
                                <option value="1">دسته1</option>
                                <option value="1">دسته2</option>
                            </select>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100 insertPreProductOk" id="insertPreProductOk" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ویرایش -->
    <div class="modal" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">

        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ثبت محصول جدید </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend ">
                                <span class="input-group-text " id="fanamelevel"> عنوان</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea id="fadescalevel" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="input-group-prepend" style="width: 100%">
                            <div class="input-group my-2">
                                <div class="input-group-prepend ">
                                    <span class="input-group-text " style="width: 100%">نوع</span>
                                </div>
                                <select class="form-control" name="baste" id="country" style="height: auto">
                                    <option value="1">کالا</option>
                                    <option value="1">خدمات</option>

                                </select>
                            </div>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 1</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 2</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 3</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 4</span>
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
    <!-- نمایش -->
    <div class="modal" id="showPreProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">

        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ثبت کالای جدید </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend ">
                                <span class="input-group-text " id="fanamelevel"> عنوان</span>
                            </div>
                            <input
                                type="text"
                                id="showTitle"
                                class="form-control"
                                disabled="disabled"
                                aria-label="Default"
                                aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea
                                id="showDiscription"
                                class=" form-control"
                                disabled="disabled"
                                rows="3">
                            </textarea>
                        </div>

                        <div class="input-group-prepend" style="width: 100%">
                            <div class="input-group my-2">
                                <div class="input-group-prepend ">
                                    <span class="input-group-text " style="width: 100%">نوع</span>
                                </div>
                                <select
                                    class=" form-control"
                                    disabled="disabled"
                                    name="baste"
                                    id="showNo"
                                    style="height: auto">
                                    <option value="1">کالا</option>
                                    <option value="1">خدمات</option>

                                </select>
                            </div>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 1</span>
                            </div>
                            <input type="text"  class=" form-control" disabled="disabled" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 2</span>
                            </div>
                            <input type="text"  class=" form-control" disabled="disabled" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 3</span>
                            </div>
                            <input type="text"  class=" form-control" disabled="disabled" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> دسته بندی 4</span>
                            </div>
                            <input
                                   type="text"
                                   id="showDaste4"
                                   class=" form-control"
                                   disabled="disabled"
                                   aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal" id="showPreProductDismiss">کنسل
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--عدم نمایش-->
    <div class="modal" id="dontShowPreProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">عدم نمایش کالای از پیش تعیین شده</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از عدم نمایش مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="dontShowPreProductOk" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--حذف-->
    <div class="modal" id="deletePreProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف کالای از پیش تعریف شده</h5>
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
                            <button id="deletePreProductOk" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--بازیابی-->
    <div class="modal" id="restorePreProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">بازیابی کالای از پیش تعریف شده</h5>
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
                            <button id="restorePreProdeuctOk" type="button" class="btn btn-success w-100" data-dismiss="modal"
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
    <script src="{{asset('./assets/js/Pannel/Exchange/preProduct/preProduct.js')}}"></script>

@endsection
