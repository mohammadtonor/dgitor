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
                <div class="row categ">
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card" style="height: 150px">
                            <div class="card-body" >
                                <img src="{{asset("./assets/images/requestCount-icon.png")}}" alt="cart"
                                     class="float-left"
                                     width="70" height="70">
                                <h6 class="card-title font-weight-bold mt-2"> تعداد درخواست </h6>
                                <h2 class="mt-3">26</h2>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card" style="height: 150px">
                            <div class="card-body" >
                                <img src="{{asset("./assets/images/requestAccept-icon.png")}}" alt="cart"
                                     class="float-left"
                                     width="70" height="70">
                                <h6 class="card-title font-weight-bold mt-2"> تعداد درخواست های انجام ده </h6>
                                <h2 class="mt-3">26</h2>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <button class="btn btn-lg btn-primary insertNew my-3" data-toggle="modal" id="insertNew"
                                        data-target="#insertNewModal">ثبت درخواست جدید
                                </button>


                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped myTableexpertRequest" id="myTableexpertRequest">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="rowcount">ردیف</th>
                                            <th class="">دسته بندی</th>
                                            <th class="">محصول</th>
                                            <th class="">نوع کارشناسی</th>
                                            <th class="">قیمت</th>
                                            <th class="">تصویب شده</th>
                                            <th class=""> تاریخ ثبت</th>
                                            <th class=""> زمان کارشناسی </th>
                                            <th class="no-sort operation">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productuser-table-tbody" style="margin: 25px">

                                        <tr class="text-center">
                                            <td style="padding-right: 34px;">1</td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1 text-white" data-target="#editModal" data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success ml-2 mt-1" data-target="#showModal" data-toggle="modal">
                                                    <i class="icon-eye" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#repealModal" data-toggle="modal">
                                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="لغو"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1">
                                                    <a><i class="icon-tag" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="نتیجه"></i></a>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1" data-target="#expertAssignModal" data-toggle="modal">
                                                    <i class="icon-people" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="اختصاص کارشناس"></i>
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
    <!--ایجاد درخواست جدید-->
    <div class="modal" id="insertNewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد درخواست جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">  دسته 1 </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">دسته 2 </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">  دسته 3 </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">دسته 4 </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6 align-self-baseline">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%"> نوع کارشناسی  </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 align-self-baseline">
                               <h6>قیمت :.......</h6>
                            </div>

                        </div>
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%"> محصول </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" >
                                    </div>
                                </div>
                            </div>
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%"> زمان </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" >
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> آدرس </span>
                                </div>
                                <textarea class="form-control" rows="3" id="" ></textarea>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" id="doInsert" data-dismiss="modal">ثبت
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
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش درخواست </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">  دسته 1 </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">دسته 2 </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">  دسته 3 </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">دسته 4 </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6 align-self-baseline">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%"> نوع کارشناسی  </span>
                                        </div>
                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                            <option value="1">اول</option>
                                            <option value="1">دوم</option>
                                            <option value="1"> سوم</option>
                                            <option value="1">چهارم</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 align-self-baseline">
                                <h6>قیمت :.......</h6>
                            </div>

                        </div>
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%"> محصول </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" >
                                    </div>
                                </div>
                            </div>
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%"> زمان </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" >
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> آدرس </span>
                                </div>
                                <textarea class="form-control" rows="3" id="" ></textarea>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal" id="doEditeAddressModal">ثبت</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- نمایش -->
    <div class="modal" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش درخواست </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form class=" ">
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">  دسته 1 </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">دسته 2 </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">  دسته 3 </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%">دسته 4 </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6 align-self-baseline">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%"> نوع کارشناسی  </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="my-2 col-sm-12 col-md-6 col-lg-6 align-self-baseline">
                                <h6>قیمت :.......</h6>
                            </div>

                        </div>
                        <div class="row">
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%"> محصول </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group my-2 col-sm-12 col-md-6 col-lg-6">
                                <div class="input-group-prepend" style="width: 100%">
                                    <div class="input-group my-2">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text " style="width: 100%"> زمان </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default"
                                               aria-describedby="inputGroup-sizing-default" id="" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> آدرس </span>
                                </div>
                                <textarea class="form-control" rows="3" id="" disabled></textarea>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="">
                            <button type="button" class="btn btn-success w-100" data-dismiss="modal">بستن
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- لغو --}}
    <div class="modal" id="repealModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title"> لغو درخواست</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">ایا از لغو این درخواست اطمینان دارید ؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="doDeleteModal" type="button" class="btn btn-success w-100" data-dismiss="modal"
                                    data-recordid="">بلی
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--   اختصاص کارشناس  --}}
    <div class="modal" id="expertAssignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title"> اختصاص کارشناس </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="table-responsive t mt-5">
                        <table class="table table-hover">
                            <thead>
                            <tr class="table-info">
                                <th scope="col" class="text-center" > ردیف </th>
                                <th scope="col" class="text-center">نام </th>
                                <th scope="col" class="text-center">  نام خانوادگی</th>
                                <th scope="col" class="text-center">  عملیات  </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row" class="text-center">1</th>
                                <th scope="row" class="text-center"></th>
                                <th scope="row" class="text-center"></th>
                                <td class="d-flex justify-content-center">
                                    <div class="tooltipdelete mr-2">
                                        <a href="#"><span class="btn-small btn-danger p-1" data-toggle="tooltip" data-original-title="حذف">حذف </span></a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="input-group my-2 ">
                        <div class="input-group my-2 col-md-12 ">
                            <div class="input-group">
                                <div class="input-group-prepend align-self-baseline">
                                    <span class="input-group-text"> کارشناسی </span>
                                </div>
                                <select id="lessons"
                                        class="form-control multisel2 selectpicker select2-hidden-accessible align-self-baseline py-1 flex-nowrap"
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


                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="doExpertAssignModal" type="button" class="btn btn-success w-100" data-dismiss="modal"
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
    <script src="{{asset('./assets/js/personel/Address/AddressPersonal.js')}}"></script>


    <script>
        $(document).ready(function () {
            $('#myTableexpertRequest').DataTable({
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

            $('.multisel2').select2({
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
