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
                                <img src="{{asset("/assets/images/cost.png")}}" alt="cart"
                                     class="float-left"
                                     width="130" height="70">
                                <h6 class="card-title font-weight-bold">تعداد </h6>
                                <h2>26476</h2>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <button class="btn  btn-primary my-2" data-toggle="modal"
                                        data-target="#btncreatenewcost">ثبت هزینه
                                </button>
                                <div class="mt-3 mb-2">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-3">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">دسته</div>
                                                    </div>
                                                    <select class="form-control" name="main_category_id"
                                                            id="main_category_selectbox">
                                                        <option value="">انتخاب کنید</option>
                                                        <option value="">دسته 1</option>
                                                        <option value="">دسته 2</option>
                                                        <option value="">دسته 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-3">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"> دسته 1</div>
                                                    </div>
                                                    <select class="form-control" name="main_category_id"
                                                            id="main_category_selectbox">
                                                        <option value="">انتخاب کنید</option>
                                                        <option value="">دسته 1</option>
                                                        <option value="">دسته 2</option>
                                                        <option value="">دسته 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <button class="btn btn-danger">جستجو</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table table-hover table-dark table-striped w-100 "
                                        id="tableInsertKarshenasCost">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="rowcount">ردیف</th>
                                            <th class="firstName">عنوان</th>
                                            <th class="lastName">هزینه</th>
                                            <th class="insertTime">تاریخ ثبت</th>
                                            <th class="deleteTime">تاریخ تغییر</th>
                                            <th class="no-sort operation w-25">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody style="margin: 25px">
                                        <tr class="text-center">
                                            <td style="padding-right: 34px;">1</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button
                                                    class="btn btn-sm btn-danger ml-2 mt-1 delete"
                                                    data-target="#delete"
                                                    data-toggle="modal">
                                                    <i class="icon-trash " aria-hidden="true"
                                                       data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="حذف"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1"
                                                        data-target="#edit"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true"
                                                       data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1"
                                                        data-target="#show"
                                                        data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true"
                                                       data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="نمایش"></i>
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
    <!-- ثبت هزینه -->
    <div class="modal" id="btncreatenewcost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ثبت هزینه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" class="container">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان هزینه</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> مبلغ </span>
                            </div>
                            <input type="number" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="field_wrapper mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> دسته 1</div>
                                </div>
                                <select class="form-control" name="main_category_id"
                                        id="main_category_selectbox">
                                    <option value="">انتخاب کنید</option>
                                    <option value="">دسته 1</option>
                                    <option value="">دسته 2</option>
                                    <option value="">دسته 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="field_wrapper mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> دسته 2</div>
                                </div>
                                <select class="form-control" name="main_category_id"
                                        id="main_category_selectbox">
                                    <option value="">انتخاب کنید</option>
                                    <option value="">دسته 1</option>
                                    <option value="">دسته 2</option>
                                    <option value="">دسته 3</option>
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
    <!-- ویرایش -->
    <div class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش هزینه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" class="container">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان هزینه</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> مبلغ </span>
                            </div>
                            <input type="number" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="field_wrapper mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> دسته 1</div>
                                </div>
                                <select class="form-control" name="main_category_id"
                                        id="main_category_selectbox">
                                    <option value="">انتخاب کنید</option>
                                    <option value="">دسته 1</option>
                                    <option value="">دسته 2</option>
                                    <option value="">دسته 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="field_wrapper mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> دسته 2</div>
                                </div>
                                <select class="form-control" name="main_category_id"
                                        id="main_category_selectbox">
                                    <option value="">انتخاب کنید</option>
                                    <option value="">دسته 1</option>
                                    <option value="">دسته 2</option>
                                    <option value="">دسته 3</option>
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
    <!-- نمایش -->
    <div class="modal" id="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش هزینه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form id="form" class="container">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> عنوان هزینه</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> مبلغ </span>
                            </div>
                            <input type="number" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="field_wrapper mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> دسته 1</div>
                                </div>
                                <select class="form-control" name="main_category_id"
                                        id="main_category_selectbox">
                                    <option value="">انتخاب کنید</option>
                                    <option value="">دسته 1</option>
                                    <option value="">دسته 2</option>
                                    <option value="">دسته 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="field_wrapper mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> دسته 2</div>
                                </div>
                                <select class="form-control" name="main_category_id"
                                        id="main_category_selectbox">
                                    <option value="">انتخاب کنید</option>
                                    <option value="">دسته 1</option>
                                    <option value="">دسته 2</option>
                                    <option value="">دسته 3</option>
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
                            <button id="deleteOkPersonnel" type="button" class="btn btn-success w-100"
                                    data-dismiss="modal"
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
        $(document).ready(function () {
            $('#tableInsertKarshenasCost').DataTable({
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
@endsection
