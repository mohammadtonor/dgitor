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
                            <div class="card-body">
                                <img src="{{asset("/assets/images/employee-icon-1-removebg-preview.png")}}" alt="cart"
                                     class="float-left"
                                     width="130" height="70">
                                <h6 class="card-title font-weight-bold">تعداد کل پرسنل</h6>
                                <h2>26476</h2>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card" style="height:150px">
                            <div class="card-body">
                                <img src="{{asset("/assets/images/employee-icon-1-removebg-preview.png")}}" alt="cart"
                                     class="float-left"
                                     width="130" height="70">
                                <h6 class="card-title font-weight-bold">تعداد پرسنل فعال</h6>
                                <h2>26476</h2>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <div class="row">
                                    <div class="d-flex">
                                        <div class="row">
                                            <div class="form-group col-sm-12 col-md-2">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">نام</div>
                                                        </div>
                                                        <input id="searchName" type="text" class="searchName form-control" name="searchName"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-2">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">نام خانوادگی</div>
                                                        </div>
                                                        <input id="searchLastName" type="text" class="searchLastName form-control"
                                                               name="searchLastName"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-2">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">کدملی</div>
                                                        </div>
                                                        <input id="searchCodeNum" type="text" class="searchCodeNum form-control"
                                                               name="searchCodeNum"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-2">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">شماره موبایل</div>
                                                        </div>
                                                        <input id="" type="text" class=" form-control" name=""/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-2">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">استان</div>
                                                        </div>
                                                        <select class="form-control searchOstan" name="searchOstan"
                                                                id="searchOstan">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-2">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">شهر</div>
                                                        </div>
                                                        <select class="form-control searchCity" name="searchCity" id="searchCity"></select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary searchOk" id="searchOk">جستجو</button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover table-dark table-striped w-100 myTablePersonnelList" id="myTablePersonnelList">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="rowcount">ردیف</th>
                                            <th class="firstName">نام</th>
                                            <th class="lastName">نام خانوادگی</th>
                                            <th class="codeNum">کد ملی</th>
                                            <th class="cellNum">شماره تماس</th>
                                            <th class="city">شهر</th>
                                            <th class="statusPersonnel">وضعیت</th>
                                            <th class="created_at">تاریخ ثبت</th>
                                            <th class="deleted_at">تاریخ حذف</th>
                                            <th class="no-sort operation w-25" >عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody style="margin: 25px">
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
    <!-- ویرایش - نداریم -->
    <div class="modal" id="editPersonnelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش پرسنل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form id="form" class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 ">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">نام</div>
                                            </div>
                                            <input id="editNamePersonnel" type="text" class="form-control editNamePersonnel"
                                                   name="editNamePersonnel"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 ">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">نام خانوادگی</div>
                                            </div>
                                            <input id="editLastNamePersonnel" type="text" class="form-control editLastNamePersonnel"
                                                   name="editLastNamePersonnel"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">کد ملی</div>
                                            </div>
                                            <input id="editNcodePersonnel" type="text" class="form-control editNcodePersonnel"
                                                   name="editNcodePersonnel"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">تاریخ تولد</div>
                                            </div>
                                            <input id="editBirthdayPersonnel" type="text" class="form-control editBirthdayPersonnel"
                                                   name="editBirthdayPersonnel"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">شماره موبایل</div>
                                            </div>
                                            <input id="editMobilePersonnel" type="text" class="form-control editMobilePersonnel"
                                                   name="editMobilePersonnel"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">جنسیت</div>
                                            </div>
                                            <select class="form-control editGenderPersonel" name="editGenderPersonel"
                                                    id="editGenderPersonel" value="">
                                                <option value="male">مرد</option>
                                                <option value="female">زن</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">ایمیل</div>
                                            </div>
                                            <input id="editEmailPersonnel" type="text" class="form-control editEmailPersonnel"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text prepend-w-55px custom-middle pb-0">سمت ها</span>
                                        </div>
                                        <select class="form-control multisel editSematPersonnel" id="editSematPersonnel" name="editSematPersonnel" multiple="multiple"
                                                style="width:75%">
{{--                                            <option value="">fgfg</option>--}}
{{--                                            <option value="">fgfg</option>--}}
{{--                                            <option value="">fdgfdg</option>--}}
{{--                                            <option value="">fhfh</option>--}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">کشور</div>
                                            </div>
                                            <select class="form-control editCountryPersonnel" name="editCountryPersonnel"
                                                    id="editCountryPersonnel">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">استان</div>
                                            </div>
                                            <select class="form-control editOstanPersonnel" name="editOstanPersonnel"
                                                    id="editOstanPersonnel">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">شهر</div>
                                            </div>
                                            <select class="form-control editCityPersonnel" name="editCityPersonnel"
                                                    id="editCityPersonnel">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">کد تایید موبایل</div>
                                            </div>
                                            <input id="editTaeedCodePersonnel" type="text" class="editTaeedCodePersonnel form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary my-2 justify-content-end editErsalCodeButton" id="editErsalCodeButton">ارسال کد تایید
                        </button>
                    </form>
                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100 editPersonnelOk" id="editPersonnelOk" data-dismiss="modal" data-recordid="">ثبت
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
    <div class="modal" id="showpersonnelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">نمایش پرسنل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form id="form" class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 ">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">نام</div>
                                            </div>
                                            <input id="showNamePersonnel" type="text" class="form-control showNamePersonnel" name="showNamePersonnel" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 ">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">نام خانوادگی</div>
                                            </div>
                                            <input id="showLastNamePersonnel" type="text" class="form-control showLastNamePersonnel" name="showLastNamePersonnel" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">کد ملی</div>
                                            </div>
                                            <input id="showNcodePersonnel" type="text" class="form-control showNcodePersonnel" name="showNcodePersonnel" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">تاریخ تولد</div>
                                            </div>
                                            <input id="showBirthdayPersonnel" type="text" class="form-control showBirthdayPersonnel" name="showBirthdayPersonnel" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">شماره موبایل</div>
                                            </div>
                                            <input id="showMobilePersonnel" type="text" class="form-control showMobilePersonnel" name="showMobilePersonnel" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">جنسیت</div>
                                            </div>
                                            <input id="showGenderPersonnel" type="text" class="form-control showNamePersonnel" name="showGenderPersonnel" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">ایمیل</div>
                                            </div>
                                            <input id="showEmailPersonnel" type="text" class="form-control showEmailPersonnel" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 my-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text prepend-w-55px custom-middle pb-0">سمت ها</span>
                                    </div>
                                    <input id="showSematsPersonnel" type="text" class="form-control showEmailPersonnel" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">استان</div>
                                            </div>
                                            <input id="showOstanPersonnel" type="text" name="showOstanPersonnel" class="form-control showOstanPersonnel" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">شهر</div>
                                            </div>
                                            <input id="showCityPersonnel" type="text"  name="showCityPersonnel" name="showOstanPersonnel" class="form-control showCityPersonnel" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 my-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">آدرس</div>
                                            </div>
                                            <textarea id="personnelAdress" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-danger w-25" data-dismiss="modal">بستن
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- سمت ها -->
    <div class="modal" id="sematsModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col">سمت ها</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="row">
                            <div class="col">
                                <table class="table table-info table-hover sematsListTable" data-id="" id="sematsListTable">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            ردیف
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            نام سمت
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            تاریخ ایجاد
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
                        </div>
                        <hr/>
                        <div class="input-group ">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text pb-0">سمت های جدید</span>
                                </div>
                                <select id="lessons"
                                        class="form-control multisel selectpicker select2-hidden-accessible"
                                        name="semats" multiple="" data-live-search="true" style="width:80%;"
                                        data-select2-id="select124-data-bastelist" tabindex="-1"
                                        aria-hidden="true">
                                    <option value="11" data-select2-id="select21-data-81-4jh1">نوع 1</option>
                                    <option value="12" data-select2-id="select22-data-92-4gz5">نوع 2</option>
                                    <option value="13" data-select2-id="select23-data-103-wvml">نوع 3</option>
                                    <option value="14" data-select2-id="select24-data-114-2lpk">نوع 4</option>
                                    <option value="15" data-select2-id="select25-data-125-2lpk">نوع 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="row m-3" style="justify-content: end">
                            <div class="col-6">
                                <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- آپلود مدارک  --}}
    <div class="modal" id="uploaddocumentsModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col">آپلود مدارک</h5>
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
                                            نام مدرک
                                        </th>
                                        <th scope="col" class="text-center"
                                            style="background-color: rgba(205,203,203,0.55);color:black">
                                            تاریخ ثبت
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
                                        <td scope="col" class="text-center">8/3/2023</td>
                                        <td scope="col" class="text-center">
                                            <button class="btn btn-sm btn-danger ml-2">
                                                <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="حذف"></i>
                                            </button>
                                            <button class="btn btn-sm px-2 btn-warning ml-2">
                                                <i class="icon-cloud-upload" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="آپلود"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr/>
                        <div class="row my-4">
                            <div class="form-group col-sm-12 col-md-6">
                                <div class="field_wrapper">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">نام مدرک</div>
                                        </div>
                                        <input id="course_farsi_name" type="text" class="form-control"
                                               name="coursefarsiname"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label class="file-upload-btn text-center">
                                    <input type="file" name="slideimg1" accept="image/*" onchange="chooseimg('#pic',event)"
                                           class="" value="آپلود عکس">
                                    آپلود
                                </label>
                            </div>
                        </div>


                        <div class="row m-3" style="justify-content: end">
                            <div class="col-6">
                                <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت
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
    <!--حذف-->
    <div class="modal" id="deletePersonnelListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">حذف پرسنل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از حذف مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="deleteOkPersonnel" type="button" class="btn btn-success w-100" data-dismiss="modal" data-recordid="">بلی </button>
                        </div>
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--بازیابی-->
    <div class="modal" id="restorePersonnelListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">بازیابی پرسنل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h5 style="text-align: center">از بازیابی مطمئن هستید؟</h5>

                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="restoreOkPersonnel" type="button" class="btn btn-success w-100" data-dismiss="modal" data-recordid="">بلی </button>
                        </div>
                        <div class="col-6">
                            <button id="" type="button" class="btn btn-danger w-100" data-dismiss="modal">خیر </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("pagejs")
    <script src="{{asset('./assets/js/select2.min.js')}}"></script>
    <script src="{{asset('./assets/js/Pannel/personel/PersonnelList.js')}}"></script>
@endsection
