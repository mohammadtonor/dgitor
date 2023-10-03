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
                                <button class="btn btn-lg btn-primary my-2" id="insertNewCategory" data-toggle="modal"
                                        data-target="#btncreatenewcategory">دسته بندی جدید
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableCategory">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="rowcount">ردیف</th>
                                            <th class="nameUpdate">نام دسته بندی</th>
                                            <th class="descUpdate">توضیحات</th>
                                            <th class="subCatCount">تعداد زیر دسته</th>
                                            <th class="createdAtUpdate"> تاریخ ثبت</th>
                                            <th class="deletedAtUpdate"> تاریخ حذف</th>
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
                            <input id="titleInsert" type="text" class="form-control inp" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea id="descInsert" class="form-control inp" rows="3"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="eganamelevel">تعداد زیر دسته</span>
                            </div>
                            <input type="text" id="subCatInsert" class="form-control inp" aria-label="Default"
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
                            <button type="button" id="insertCategoryBtn" class="btn btn-success w-100" data-dismiss="modal">ثبت
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
                            <input type="text" id="titleEdit" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea id="descEdit" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تعداد زیر دسته</span>
                            </div>
                            <input type="text" id="subCatEdit" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <label style="font-size: 16px; margin: 10px">تصویر :</label>
                        <div class="card mt-3 pic" style="align-items: center;">
                            <img class="" id="imgEdit" width="150" height="100" style="width: 200px;height: 200px"
                                 src="">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="editCategoryInfoBtn" class="btn btn-success w-100" data-dismiss="modal" data-recordid>ثبت
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
                            <input disabled id="titleShow" type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea disabled id="descShow" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تعداد زیر دسته</span>
                            </div>
                            <input disabled id="subCatShow" type="text" class="form-control" aria-label="Default"
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
                                    <tbody class="category_tag">
{{--                                    <input type="hidden" data-id="" id="category_tag_id"/>--}}

                                    </tbody>
                                </table>
                            </div>
                            <hr/>
                            <div class="input-group my-2 ">
                                <div class="input-group my-2 col-md-12 ">
                                    <div class="input-group d-flex flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="height: 90%">تگ جدید</span>
                                        </div>
                                        <select id="lessons"
                                                class="form-control multisel selectpicker select2-hidden-accessible multiSelectTag"
                                                name="tags[]" multiple data-live-search="true" style="width:100%;"
                                                data-select2-id="select24-data-bastelist" tabindex="-1"
                                                aria-hidden="true">
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
                                <button type="button" class="btn btn-success w-100" data-dismiss="modal" id="multi_select">ثبت
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

    <!--restore modal-->
    <div class="modal" id="restoremodal">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">بازیابی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 class="text-center py-3">از بازیابی مطمئن هستید؟</h5>

                    <div class="row justify-content-center mt-3">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="restore-modal-btn" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بله
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("pagejs")
    <script src="{{asset("./assets/js/jalali-moment.browser.js")}}"></script>
    <script src="{{asset('./assets/js/select2.min.js')}}"></script>
    <script src="{{asset('./assets/js/Pannel/Category/category.js')}}"></script>
@endsection
