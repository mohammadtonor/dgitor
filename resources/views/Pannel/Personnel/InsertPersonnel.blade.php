@extends("Pannel.Admin.home")


{{--Page Css--}}
@section("pagecss")

    <link rel="stylesheet" href="{{asset('./assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/GeneralStyle/style.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/persian-datepicker.min.css')}}">
@endsection

@section("content")
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item ">داشبورد</li>
                            <li class="breadcrumb-item active"><a href="#"> ثبت کارمند</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row categ course-count-container">
                <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                        <div class="card-body" style="height: 170px">
                            <img src="{{asset("/assets/images/employee-icon-1-removebg-preview.png")}}" alt="cart" class="float-left" width="70" height="70">
                            <h6 class="card-title font-weight-bold my-3"> تعداد کل کارمندان</h6>
                            <h2 class="course-count">11</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" align-self-center mt-3">
                <div class="card col-12 m-0 p-0">
                    <div class="card-content">
                        <div class="card-body" data-select2-id="select2-data-3-ntfu">
                            <h3 style="margin: 20px 20px 30px 0"> ثبت کارمند جدید</h3>
                            <form id="form" class="container my-2">
                                <div class=" divstyle col-sm-12 mt-1 h-25">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">نام</div>
                                                        </div>
                                                        <input id="firstNameInsert" type="text" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">نام خانوادگی</div>
                                                        </div>
                                                        <input id="lastNameInsert" type="text" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">جنسیت</div>
                                                        </div>
                                                        <select class="form-control" id="genderInsert">
                                                            <option value="مرد">مرد</option>
                                                            <option value="زن">زن</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">کد ملی</div>
                                                        </div>
                                                        <input id="ncodeInsert" type="text" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">تاریخ تولد</div>
                                                        </div>
                                                        <input id="birthdayInsert" type="text" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">ایمیل</div>
                                                        </div>
                                                        <input id="emailInsert" type="text" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 my-2">
                                            <div class="">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text prepend-w-55px custom-middle pb-0">سمت ها</span>
                                                    </div>
                                                    <select class="form-control multiselRols" id="rolesInsert" multiple="multiple" style="width:70%"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">استان</div>
                                                        </div>
                                                        <select class="form-control multisel" id="ostanInsert">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">شهر</div>
                                                        </div>
                                                        <select class="form-control multisel" id="cityInsert"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">کدپستی</div>
                                                        </div>
                                                        <input id="postalCodeInsert" type="text" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">شماره موبایل</div>
                                                        </div>
                                                        <input id="phoneInsert" type="text" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">کد تایید موبایل</div>
                                                        </div>
                                                        <input id="verificationCode" type="text" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <button class="btn btn-md btn-primary m-2 mb-4 createcategorbtn" id="verificationCodeBtn">ارسال کد تایید</button>
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
                                                        <textarea id="adressInsert" class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end my-2">
                                        <button type="button" id="insertNewPersonnel" class="btn btn-success">ثبت </button>
                                        <div class="pr-2"><a href=""  class="btn btn-danger ml-2 ">کنسل</a></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection

@section("pagejs")
    <script src="{{asset('./assets/js/persian-date.min.js')}}"></script>
    <script src="{{asset('./assets/js/persian-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        // تاریخ
        // $('#birthdayInsert').persianDatepicker({
        //     months: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
        //     dowTitle: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه"],
        //     shortDowTitle: ["ش", "ی", "د", "س", "چ", "پ", "ج"],
        //     showGregorianDate: !1,
        //     persianNumbers: !0,
        //     format: 'YYYY/MM/DD',
        //     selectedBefore: !1,
        //     selectedDate: null,
        //     startDate: null,
        //     endDate: null,
        //     prevArrow: '\u25c4',
        //     nextArrow: '\u25ba',
        //     theme: 'default',
        //     alwaysShow: !1,
        //     selectableYears: null,
        //     selectableMonths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        //     cellWidth: 25, // by px
        //     cellHeight: 20, // by px
        //     fontSize: 13, // by px
        //     isRTL: !1,
        //     autoClose: true,
        //     initialValue: false,
        // });
    </script>
    <script src="{{asset('./assets/js/select2.min.js')}}"></script>
    <script src="{{asset('../assets/js/Pannel/personel/InsertPersonnel/InsertPersonnel.js')}}"></script>
@endsection
