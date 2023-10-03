@extends("Pannel.Admin.home")


{{--Page Css--}}
@section("pagecss")

    <link rel="stylesheet" href="{{asset('./assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/GeneralStyle/style.css')}}">

    <style>
        .h350{
            height: 350px;
        }
        .picState{
            bottom:20px;
            right:40px;
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
                                <h6 class="card-title font-weight-bold"> تعداد دسته بندی </h6>
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
                                        data-target="#btnServiceRequest">درخواست خدمات
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableCategory">
                                        <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>عنوان</th>
                                            <th>دسته بندی</th>
                                            <th>نام خدمات</th>
                                            <th>قیمت خدمات</th>
                                            <th>وضعیت</th>
                                            <th>معاوضه</th>
                                            <th>بدهی مالی</th>
                                            <th> تاریخ ایجاد</th>
                                            <th> تاریخ حذف</th>
                                            <th> تاریخ لغو</th>
                                            <th class="no-sort">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">
                                        <tr>
                                            <td style="padding-right: 34px;">1</td>
                                            <td class="product-title"></td>
                                            <td class="product-salecount">1</td>
                                            <td class="product-salecount">1</td>
                                            <td class="product-salecount">1</td>
                                            <td class="product-salecount">1</td>
                                            <td class="product-salecount">1</td>
                                            <td class="product-salecount">1</td>
                                            <td class="product-salecount">1</td>
                                            <td class="product-salecount">1</td>
                                            <td class="product-salecount">1</td>
                                            <td class="d-flex">
                                                <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#deletePerService"
                                                        data-toggle="modal">
                                                    <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="حذف"></i>
                                                </button>

                                                <button class="btn btn-sm btn-warning ml-2 mt-1" data-target="#editPerService"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success ml-2 mt-1" data-target="#showPerService"
                                                        data-toggle="modal">
                                                    <i class="icon-eye" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1" data-target="#switchingPerService"
                                                        data-toggle="modal">
                                                    <i class="icon-loop" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="تغییر وضعیت "></i>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1" data-target="#appDisapprovalPerService"
                                                        data-toggle="modal">
                                                        <i class="icon-check" aria-hidden="true" data-toggle="tooltip "
                                                           data-placement="top"
                                                           title="تایید/عدم تایید"></i></a>
                                                </button>
                                                <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#endPerService"
                                                        data-toggle="modal">
                                                        <i class="icon-ban" aria-hidden="true" data-toggle="tooltip "
                                                           data-placement="top"
                                                           title="پایان"></i></a>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1" data-target="#picPerService"
                                                        data-toggle="modal">
                                                    <i class="icon-picture" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="تصاویر"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success ml-2 mt-1" data-target="#cancellPerService"
                                                        data-toggle="modal">
                                                    <i class="icon-ban" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="لغو"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1" data-target="#servicePerService"
                                                        data-toggle="modal">
                                                    <i class="icon-docs" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="دوره های خدمات"></i>
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

    <!--  درخواست خدمات :START -->
    <div class="modal" id="btnServiceRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">درخواست خدمات </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fanamelevel"> عنوان</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fanamelevel"> کالا </span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <label for=""> نوع خدمات : </label>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دسته 1</span>
                                        </div>
                                        <select class="form-control">
                                                <option value="1">دسته 1</option>
                                                <option value="1">دسته 2</option>
                                                <option value="1">دسته 3</option>
                                                <option value="1">دسته 4</option>
                                                <option value="1">دسته 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دسته 2</span>
                                        </div>
                                        <select class="form-control">
                                            <option value="1">دسته 1</option>
                                            <option value="1">دسته 2</option>
                                            <option value="1">دسته 3</option>
                                            <option value="1">دسته 4</option>
                                            <option value="1">دسته 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دسته 3</span>
                                        </div>
                                        <select class="form-control">
                                            <option value="1">دسته 1</option>
                                            <option value="1">دسته 2</option>
                                            <option value="1">دسته 3</option>
                                            <option value="1">دسته 4</option>
                                            <option value="1">دسته 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دسته 4</span>
                                        </div>
                                        <select class="form-control ">
                                            <option value="1">دسته 1</option>
                                            <option value="1">دسته 2</option>
                                            <option value="1">دسته 3</option>
                                            <option value="1">دسته 4</option>
                                            <option value="1">دسته 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <hr/>

                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="mt-3">
                                    <label for="">خدمات یافت نشد: </label>
                                    <input type="checkbox">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">خدمات </span>
                                        </div>
                                        <select class="form-control">
                                            <option value="1">خدمات 1</option>
                                            <option value="1">خدمات 2</option>
                                            <option value="1">خدمات 3</option>
                                            <option value="1">خدمات 4</option>
                                            <option value="1">خدمات 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">خدمات جدید </span>
                                        </div>
                                        <select class="form-control">
                                            <option value="1">خدمات 1</option>
                                            <option value="1">خدمات 2</option>
                                            <option value="1">خدمات 3</option>
                                            <option value="1">خدمات 4</option>
                                            <option value="1">خدمات 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline ">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">بازه تکرار </span>
                                        </div>
                                        <input type="number" min="0" max="100" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" > از</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> تا</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دفعات تکرار </span>
                                        </div>
                                        <input type="number" min="0" max="100" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" />
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">توضیحات </span>
                                </div>
                                <textarea id="fadescalevel" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container my-4">
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
    </div>
    <!--  درخواست خدمات : END -->

    <!-- START:  حدف -->
    <div class="modal" id="deletePerService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف خدمات</h5>
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
                            <button id="deleteoK" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: حذف -->

    <!--  ویرایش :START -->
    <div class="modal" id="editPerService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش خدمات </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fanamelevel"> عنوان</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline ">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">بازه تکرار </span>
                                        </div>
                                        <input type="number" min="0" max="100" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" > از</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> تا</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دفعات سرویس </span>
                                        </div>
                                        <input type="number" min="0" max="100" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" />
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">توضیحات </span>
                                </div>
                                <textarea id="fadescalevel" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container my-4">
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
    </div>
    <!--  ویرایش : END -->

    <!--  نمایش :START -->
    <div class="modal" id="showPerService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش خدمات </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fanamelevel"> عنوان</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fanamelevel"> کالا </span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <label for=""> نوع خدمات : </label>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دسته 1</span>
                                        </div>
                                        <select class="form-control" disabled>
                                            <option value="1">دسته 1</option>
                                            <option value="1">دسته 2</option>
                                            <option value="1">دسته 3</option>
                                            <option value="1">دسته 4</option>
                                            <option value="1">دسته 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دسته 2</span>
                                        </div>
                                        <select class="form-control" disabled>
                                            <option value="1">دسته 1</option>
                                            <option value="1">دسته 2</option>
                                            <option value="1">دسته 3</option>
                                            <option value="1">دسته 4</option>
                                            <option value="1">دسته 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دسته 3</span>
                                        </div>
                                        <select class="form-control" disabled>
                                            <option value="1">دسته 1</option>
                                            <option value="1">دسته 2</option>
                                            <option value="1">دسته 3</option>
                                            <option value="1">دسته 4</option>
                                            <option value="1">دسته 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دسته 4</span>
                                        </div>
                                        <select class="form-control " disabled>
                                            <option value="1">دسته 1</option>
                                            <option value="1">دسته 2</option>
                                            <option value="1">دسته 3</option>
                                            <option value="1">دسته 4</option>
                                            <option value="1">دسته 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <hr/>

                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="mt-3">
                                    <label for="">خدمات یافت نشد: </label>
                                    <input type="checkbox" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">خدمات </span>
                                        </div>
                                        <select class="form-control" disabled>
                                            <option value="1">خدمات 1</option>
                                            <option value="1">خدمات 2</option>
                                            <option value="1">خدمات 3</option>
                                            <option value="1">خدمات 4</option>
                                            <option value="1">خدمات 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">خدمات جدید </span>
                                        </div>
                                        <select class="form-control" disabled>
                                            <option value="1">خدمات 1</option>
                                            <option value="1">خدمات 2</option>
                                            <option value="1">خدمات 3</option>
                                            <option value="1">خدمات 4</option>
                                            <option value="1">خدمات 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline ">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">بازه تکرار </span>
                                        </div>
                                        <input type="number" min="0" max="100" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" > از</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> تا</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group my-2 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">دفعات تکرار </span>
                                        </div>
                                        <input type="number" min="0" max="100" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" disabled/>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">توضیحات </span>
                                </div>
                                <textarea id="fadescalevel" class="form-control" rows="3" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container my-4">
                        <div class="row mt-3" style="justify-content: center">
                            <div class="col-6">
                                <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  نمایش : END -->

    <!-- تغییروضعیت :START -->
    <div class="modal" id="switchingPerService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تغییر وضعیت </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="container">
                        <div class="col-12">
                            <div class=" mt-2 clearfix">
                                <label class="d-inline-block">وضعیت فعلی :  </label>
                                <h4 class="stateNow d-inline-block">----------- </h4>
                            </div>
                        </div>
                        <div class="col-12 d-flex align-self-baseline ">
                            <div class="input-group my-2 ">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">وضعیت جدید </span>
                                    </div>
                                    <select class="form-control">
                                        <option value="1">وضعیت 1</option>
                                        <option value="1">وضعیت 2</option>
                                        <option value="1">وضعیت 3</option>
                                        <option value="1">وضعیت 4</option>
                                        <option value="1">وضعیت 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container my-4">
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
    </div>
    <!-- تغییروضعیت : END -->

    <!-- تایید/ عدم تایید :START -->
    <div class="modal" id="appDisapprovalPerService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تایید/ عدم تایید </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="container">
                        <div class="col-12">
                            <div class=" mt-2 clearfix">
                                <label class="d-inline-block">وضعیت فعلی :  </label>
                                <h4 class="stateNow d-inline-block">----------- </h4>
                            </div>
                        </div>
                        <div class="col-12 d-flex align-self-baseline ">
                            <div class="input-group my-2 ">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">وضعیت جدید </span>
                                    </div>
                                    <select class="form-control">
                                        <option value="1">وضعیت 1</option>
                                        <option value="1">وضعیت 2</option>
                                        <option value="1">وضعیت 3</option>
                                        <option value="1">وضعیت 4</option>
                                        <option value="1">وضعیت 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container my-4">
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
    </div>
    <!-- تایید/ عدم تایید : END -->

    <!-- START:  پایان -->
    <div class="modal" id="endPerService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">پایان خدمات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از پایان خدمات مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="cancellOk" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: پایان -->

    <!--  تصاویر :START -->
    <div class="modal" id="picPerService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تصاویر </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="container position-relative">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 img-fluid h350" src="{{asset("./assets/images/servicepic1.jpg")}}" alt="First picture">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 img-fluid h350" src="{{asset("./assets/images/servicepic2.jpg")}}" alt="Second picture">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 img-fluid h350" src="{{asset("./assets/images/servicepic3.webp")}}" alt="Third picture">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <button class="btn btn-sm btn-danger position-absolute picState">حذف</button>
                    </div>
                    <hr/>
                    <div class="container my-4">
                        <div class="mt-3" style="justify-content: start">
                            <div class="form-control align-self-baseline  h-25">
                                <input type="file" class="align-content-center "  />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  تصاویر : END -->

    <!-- START:  لغو -->
    <div class="modal" id="cancellPerService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">لغو خدمات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از لغو مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="cancellOk" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: لغو -->

    <!--  دوره های خدمات :START -->
    <div class="modal" id="servicePerService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">درخواست خدمات </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="container">
                        <div class="col-12 align-self-center mt-3">
                            <div class="col-12 m-0 p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-light table-striped" id="tableCategory">
                                        <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>زمان خدمات</th>
                                            <th>خدمات دهنده</th>
                                            <th>شماره تماس</th>
                                            <th class="no-sort">عملیات</th>
                                            <th>توضیحات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">
                                        <tr>
                                            <td style="padding-right: 34px;">1</td>
                                            <td ></td>
                                            <td >1</td>
                                            <td >1</td>
                                            <td>
                                                <button class="btn btn-sm btn-success ml-2 mt-1">
                                                    <i class="icon-check" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="انجام شد"></i>
                                                </button>
                                            </td>
                                            <td >1</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 d-flex align-self-baseline">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" > زمان جدید </span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Default"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">توضیحات </span>
                                    </div>
                                    <textarea class="form-control d-flex align-self-baseline" style="height: 38px" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container my-4">
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
    </div>
    <!--  دوره های خدمات : END -->


































    <!--ایجاد دسته بندی-->

    <div class="modal" id="btncreatenewcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد دسته بندی </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="fanamelevel"> عنوان</span>
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

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="eganamelevel">تعداد زیر دسته</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <label style="font-size: 16px; margin: 10px">تصویر :</label>
                        <div class="card mt-3 pic" style="align-items: center;">
                            <img class="" width="150" height="100" style="width: 200px;height: 200px"
                                 src="">
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
                    <h5 class="modal-title">ویرایش دسته بندی </h5>
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

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تعداد زیر دسته</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <label style="font-size: 16px; margin: 10px">تصویر :</label>
                        <div class="card mt-3 pic" style="align-items: center;">
                            <img class="" width="150" height="100" style="width: 200px;height: 200px"
                                 src="">
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
    <div class="modal" id="showcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش دسته بندی </h5>
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

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تعداد زیر دسته</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <label style="font-size: 16px; margin: 10px">تصویر :</label>
                        <div class="card mt-3 pic" style="align-items: center;">
                            <img class="" width="150" height="100" style="width: 200px;height: 200px"
                                 src="">
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
    <!--تصویر لوگو-->
    <div class="modal" id="logoimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> تصویر لوگو </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="card mt-3 pic" style="align-items: center;">
                            <img class="" width="150" height="100" style="width: 200px;height: 200px"
                                 src="">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">حذف
                            </button>
                        </div>
                        <div class="col-6">
                            <label class="file-upload-btn w-100 text-center">
                                <input type="file" name="slideimg1" accept="image/*" onchange="chooseimg('#pic',event)"
                                       class="" value="آپلود عکس">
                                آپلود
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- تگ-->
    <div class="modal" id="tags">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col">تگ ها</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="row">
                            <div class="col">
                                <table class="table table-hover" data-id="" id="subcat3table">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            ردیف
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            نام تگ
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            عملیات
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td scope="col" class="text-center">1</td>
                                        <td scope="col" class="text-center">نام تگ</td>
                                        <td scope="col" class="text-center">
                                            <button class="btn btn-sm btn-danger ml-2">
                                                <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="حذف"></i>
                                            </button>
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                            <hr/>
                            <div class="input-group my-2 ">
                                <div class="input-group my-2 col-md-12 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">تگ جدید</span>
                                        </div>
                                        <select id="lessons"
                                                class="form-control multisel selectpicker select2-hidden-accessible"
                                                name="addr" multiple="" data-live-search="true" style="width:73%;"
                                                data-select2-id="select24-data-bastelist" tabindex="-1"
                                                aria-hidden="true">
                                            <option value="1" data-select2-id="select2-data-8-4jh1">نوع 1</option>
                                            <option value="1" data-select2-id="select2-data-9-4gz5">نوع 2</option>
                                            <option value="1" data-select2-id="select2-data-10-wvml">نوع 3</option>
                                            <option value="1" data-select2-id="select2-data-11-2lpk">نوع 4</option>
                                            <option value="1" data-select2-id="select2-data-12-2lpk">نوع 5</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row m-3" style="justify-content: end">
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
    </div>
    <!--حذف-->
    <div class="modal" id="deletecategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف دسته بندی</h5>
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
