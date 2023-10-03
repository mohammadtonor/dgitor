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
                                <img src="../../dist/images/traffic.png" alt="traffic" class="float-left">
                                <h6 class="card-title font-weight-bold"> تعداد دسته ها </h6>
                                <h2>{{$result["count"]}}</h2>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="../../dist/images/traffic.png" alt="traffic" class="float-left">
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
                                <div class="d-flex">
                                    <h5>نام دسته اصلی :</h5>
                                    <span>{{$result['parent_category']['title']}}</span>
                                </div>
                                <button class="btn btn-lg btn-primary  my-2" data-toggle="modal" id="new_sub3"
                                        data-target="#new_sub3_modal">زیر دسته جدید
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped" id="tableSub3Category">
                                        <thead>
                                        <tr>
                                            <th class="text-center rowcount">ردیف</th>
                                            <th class="text-center category_name">نام دسته بندی</th>
                                            <th class="text-center desc">توضیحات</th>
                                            <th class="text-center subcatcount">تعداد زیر دسته</th>
                                            <th class="text-center created_at"> تاریخ ایجاد</th>
                                            <th class="text-center deleted_at"> تاریخ حذف</th>
                                            <th class="no-sort operation text-center">عملیات</th>
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

    <div class="modal" id="new_sub3_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                            <input type="text" class="form-control inp" aria-label="Default" id="new_title"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea id="new_desc" class="form-control inp" rows="3"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="eganamelevel">تعداد زیر دسته</span>
                            </div>
                            <input type="text" class="form-control inp" aria-label="Default" id="new_count"
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
                            <button id="insert_new_sub3" type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ویرایش -->
    <div class="modal" id="edit_sub3_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                            <input type="text" class="form-control" aria-label="Default" id="edit_title"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea class="form-control" id="edit_desc" rows="3"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تعداد زیر دسته</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" id="edit_count"
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
                            <button id="edit-sub3" type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- نمایش -->
    <div class="modal" id="show_sub3_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش  زیر دسته </h5>
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
                            <input type="text" class="form-control" aria-label="Default" id="title_show" disabled
                                   aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات </span>
                            </div>
                            <textarea class="form-control" disabled id="desc_show" rows="3"></textarea>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تعداد زیر دسته</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" id="count_show" disabled
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
    <div class="modal" id="logo_sub3_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
    <div class="modal" id="under_sub3_modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col">زیر دسته ها</h5>
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
                                            نام دسته
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            توضیحات
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            تاریخ حذف
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            عملیات
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="sub3_tag">

                                    </tbody>
                                </table>
                            </div>
                            <hr/>

                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> نام دسته</span>
                                </div>
                                <input type="text" class="title_tag form-control" aria-label="Default"
                                       aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">توضیحات </span>
                                </div>
                                <textarea class="description_tag form-control" rows="3"></textarea>
                            </div>
                            <div class="col-6 my-2 p-0">
                                <label class="file-upload-btn w-50 text-center">
                                    <input type="file" name="slideimg1" accept="image/*" onchange="chooseimg('#pic',event)"
                                           class="" value="آپلود عکس">
                                    آپلود لوگو
                                </label>
                            </div>

                            <div class="row mt-5 mb-2 " style="justify-content: end">
                                <div class="col-6">
                                    <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-success w-100 sabt_tag" >ثبت
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
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
