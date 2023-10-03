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

{{--                <div class="row">--}}
{{--                    <div class="col-12  align-self-center">--}}
{{--                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">--}}
{{--                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">--}}
{{--                                <li class="breadcrumb-item"><a href="#">خانه</a></li>--}}
{{--                                <li class="breadcrumb-item active">داشبورد</li>--}}
{{--                            </ol>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr/>--}}
                <div class="row categ">
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="../../dist/images/traffic.png" alt="traffic" class="float-left">
                                <h6 class="card-title font-weight-bold"> تعداد علاقه مندی ها </h6>
                                <h2>26476</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <div class="d-flex">
                                    <h5>لیست علاقه مندی کاربر</h5>
                                </div>
                                <button class="btn btn-lg btn-primary  my-2" data-toggle="modal" id="new_sub3"
                                        data-target="#new_sub3_modal">زیر دسته جدید
                                </button>
                                <div class="d-flex flex-row">
                                    <div class="row w-50">
                                        <div class="form-group col-12 col-md-4">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">کاربر</div>
                                                    </div>
                                                    <select class="form-control" name="main_category_id"
                                                            id="main_category_selectbox">
                                                        <option value="">انتخاب کنید</option>
                                                        <option value="">....</option>
                                                        <option value="">........</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">دسته</div>
                                                    </div>
                                                    <select class="form-control" name="main_category_id"
                                                            id="main_category_selectbox">
                                                        <option value="">انتخاب کنید</option>
                                                        <option value="">........</option>
                                                        <option value="">.......</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">دسته 2</div>
                                                    </div>
                                                    <select class="form-control" name="main_category_id"
                                                            id="main_category_selectbox">
                                                        <option value="">انتخاب کنید</option>
                                                        <option value="">......</option>
                                                        <option value="">......</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-danger">جستجو</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableSub3Category">
                                        <thead>
                                        <tr>
                                            <th class="text-center rowcount">ردیف</th>
                                            <th class="text-center category_name">نام کاربر</th>
                                            <th class="text-center desc">نام محصول</th>
                                            <th class="text-center category_parent">قیمت</th>
                                            <th class="text-center created_at">نام مالک</th>
                                            <th class="text-center deleted_at">وضعیت کالا</th>
                                            <th class="no-sort operation text-center">عملیات</th>
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
                                                <button class="btn btn-sm btn-danger ml-2 mt-1"
                                                        data-target="#deletecategory"
                                                        data-toggle="modal">
                                                    <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="حذف"></i>
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
    <!--حذف-->
    <div class="modal" id="del_sub3_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف زیر دسته </h5>
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
                            <button id="delete-sub3" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--بازیابی-->
    <div class="modal" id="res_sub3_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف زیر دسته </h5>
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
                            <button id="restore-sub3" type="button" class="btn btn-success w-100" data-dismiss="modal"
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
    <script src="{{asset('./assets/js/Pannel/Category/sub3.js')}}"></script>
@endsection
