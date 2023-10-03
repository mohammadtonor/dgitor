@extends("Pannel.Admin.home")

@section('pagemeta')
    @if (isset($result))
        <meta name="category_id" content="{{$result["parent_category"]["id"]}}"/>
    @endif
@endsection



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
                <div class="row categ">
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{asset("./assets/images/category-removebg-preview.png")}}" alt="cart"
                                     class="float-left"
                                     width="130" height="70">
                                <h6 class="card-title font-weight-bold"> تعداد دسته بندی </h6>
                                <h2>{{$result["count"]}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <div class="d-flex">
                                    <h5>نام دسته اصلی :</h5>
                                    <span>{{$result['parent_category']['title']}}</span>

                                </div>
                                <button class="btn btn-lg btn-primary my-2" data-toggle="modal"
                                        data-target="#insertSub2Modal" id="insertSub2Btn">زیر دسته جدید
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped myTableSub2"
                                           id="myTableSub2">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="rowcount">ردیف</th>
                                            <th class="titleCategory">نام دسته بندی</th>
                                            <th class="Desc">توضیحات</th>
                                            <th class="subcatcount">تعداد زیر دسته</th>
                                            <th class="regDate"> تاریخ ثبت</th>
                                            <th class="DelDate"> تاریخ حذف</th>
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
    <!--ایجاد زیر دسته -->
    <div class="modal" id="insertSub2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد زیر دسته </h5>
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
                            <input type="text" class="form-control inp sub2Title" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="sub2Title">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea class="form-control sub2Desc inp" rows="3" id="sub2Desc"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="eganamelevel">تعداد زیر دسته</span>
                            </div>
                            <input type="text" class="form-control sub2Count inp" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="sub2Count">
                        </div>
                        <label style="font-size: 16px; margin: 10px">تصویر :</label>
                        <div class="card mt-3 pic sub2Img" style="align-items: center;">
                            <img class="" width="150" height="100" style="width: 200px;height: 200px"
                                 src="" id="sub2Img">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal" id="doInsertsub2">
                                ثبت
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ویرایش -->
    <div class="modal" id="editSub2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش زیر دسته </h5>
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
                            <input type="text" class="form-control editTitleSub2" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="editTitleSub2">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea class="form-control editDescSub2" rows="3" id="editDescSub2"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تعداد زیر دسته</span>
                            </div>
                            <input type="text" class="form-control editCountSub2" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="editCountSub2">
                        </div>
                        <label style="font-size: 16px; margin: 10px">تصویر :</label>
                        <div class="card mt-3 pic" style="align-items: center;">
                            <img class="editImgSub2" width="150" height="100" style="width: 200px;height: 200px" src=""
                                 id="editImgSub2">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100 doEditSub2Modal" data-dismiss="modal"
                                    id="doEditSub2Modal">ثبت
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- نمایش -->
    <div class="modal" id="showSub2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش زیر دسته </h5>
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
                                   aria-describedby="inputGroup-sizing-default" id="showSub2Title">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea class="form-control" rows="3" id="showSub2Desc"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تعداد زیر دسته</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" id="showSub2Count">
                        </div>
                        <label style="font-size: 16px; margin: 10px">تصویر :</label>
                        <div class="card mt-3 pic" style="align-items: center;">
                            <img class="" width="150" height="100" style="width: 200px;height: 200px"
                                 src="">
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">بستن
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--تصویر لوگو-->
    <div class="modal" id="logoimageSub2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
    <div class="modal" id="tagsSub2Modal">
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
                                <table class="table table-hover sub2TagsTable" data-id="" id="sub2TagsTable">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black"
                                            id="tagRowCount">
                                            ردیف
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black" id="tagTitle">
                                            نام تگ
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            عملیات
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <hr/>

                            <div class="input-group my-2 ">
                                <div class="input-group my-2 col-md-12 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text align-self-baseline py-1 ">تگ جدید</span>
                                        </div>
                                        <select id="sub2Tags-selectbox w-100"
                                                class="form-control multisel selectpicker select2-hidden-accessible p-0 m-0 align-self-baseline sub2Tags-selectbox"
                                                name="addr" multiple="" data-live-search="true" style="width:87%;"
                                                data-select2-id="select24-data-bastelist" tabindex="-1"
                                                aria-hidden="true">

                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row m-3" style="justify-content: end">
                            <div class="col-6">
                                <button type="button" class="btn btn-success w-100 doTagsModal" data-dismiss="modal"
                                        id="doTagsModal">ثبت
                                </button>
                            </div>
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

    <!-- حذف تگ -->
    <div class="modal" id="deleteTagsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <h5 style="text-align: center">از حذف این تگ مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="doDeleteTagModal" type="button" class="btn btn-success w-100"
                                    data-dismiss="modal"
                                    data-recordid data-tagId>بلی
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--حذف-->
    <div class="modal" id="deleteSub2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                            <button id="doDeleteModal" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--restore-->
    <div class="modal" id="restoreSub2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">restore دسته بندی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از restore مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="doRestoreModal" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر
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
    <script src="{{asset('./assets/js/Pannel/Category/Sub2.js')}}"></script>
@endsection
