@extends("Pannel.Admin.home")


{{--Page Css--}}
@section("pagecss")

    <link rel="stylesheet" href="{{asset('./assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/persian-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/GeneralStyle/style.css')}}">
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
                            <li class="breadcrumb-item active"><a href="#"> ثبت مشتری</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row categ">
                <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{asset("/assets/images/employee-icon-1-removebg-preview.png")}}" alt="cart"
                                 class="float-left"
                                 width="70" height="70">
                            <h6 class="card-title font-weight-bold"> تعداد کل مشتریان</h6>
                            <h2>{{$result["user_count"]}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{asset("/assets/images/employee-icon-1-removebg-preview.png")}}" alt="cart"
                                 class="float-left"
                                 width="70" height="70">
                            <h6 class="card-title font-weight-bold"> تعداد شهر های دارای مشتری </h6>
                            <h2>{{$result["city_count"]}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" align-self-center mt-3">
                <div class="card col-12 m-0 p-0">
                    <div class="card-content">
                        <div class="card-body" data-select2-id="select2-data-3-ntfu">
                            <h4 style="margin: 20px 20px 10px 0"> ثبت مشتری جدید</h4>
                            <div class="container p-5 rounded divstyle">
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
                                                    <select id="genderInsert" class="form-control">
                                                        <option value="زن">زن</option>
                                                        <option value="مرد">مرد</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-3 col-md-4 my-2">
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
                                    <div class="col-sm-12 col-lg-3 col-md-4 my-2">
                                        <div class="form-group">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">تاریخ تولد</div>
                                                    </div>
                                                    <input id="birthdayInsert" type="text" class="form-control persianDatepicker"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-3 col-md-4 my-2">
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
                                    <div class="my-2">
                                        <button class="btn btn-primary">ارسال کد تایید</button>
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
                                                    <select id="ostanInsert" class="form-control"></select>
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
                                                    <select id="cityInsert" class="form-control"></select>
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
                                                        <div class="input-group-text">ایمیل</div>
                                                    </div>
                                                    <input id="emailInsert" type="text" class="form-control"/>
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
                                                    <input type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-group my-3">
                                        <div class="form-group w-100">
                                            <span class="input-group-text">آدرس</span>
                                            <textarea id="addressInsert" type="text" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button id="insertCustomer" type="button" class="btn btn-success">ثبت</button>
                                    <div class="pr-2">
                                        <a href="" class="btn btn-danger ml-2 ">کنسل</a>
                                    </div>
                                </div>
                            </div>
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
    <script src="{{asset('./assets/js/Pannel/ManageCustomer/CustomerInsert.js')}}"></script>

@endsection
