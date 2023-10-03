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
                    <div class="col-12 col-sm-6 col-xl-3 mt-3" >
                        <div class="card " style="height: 150px">
                            <div class="card-body">
                                <img src="{{asset("./assets/images/numberOfProductIcon.jpg")}}"  alt="cart" class="float-left"
                                     width="75" height="70" >
                                <h6 class="card-title font-weight-bold"> تعداد کالا </h6>
                                <h2>26476</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <h4>ثبت کالا</h4>


                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="navs-determinationProduct-tab" data-toggle="tab" href="#tabs-determinationProduct">تعیین کالا</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="navs-featuresProduct-tab" data-toggle="tab" href="#tabs-featuresProduct">ویژگی های کالا</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="navs-locationDetermining-tab" data-toggle="tab" href="#tabs-locationDetermining">تعیین محل کالا</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="navs-determinationPrice-tab" data-toggle="tab" href="#tabs-determinationPrice">تعیین قیمت</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="navs-barter-tab" data-toggle="tab" href="#tabs-barter">معاوضه</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="tabs-determinationProduct" class="container tab-pane active"><br>

                                        <div class="col-12 align-self-center mt-3">
                                            <div class="card col-12 m-0 p-0">
                                                <div class="card-content">
                                                    <div class="card-body" style="margin: 20px">
                                                        <h3>تعیین کالا</h3>
                                                        <div class="row">
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text" style="width: 100%">دسته بندی</span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%"> زیر دسته </span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%">زیردسته </span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%"> زیر دسته </span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%">کالا </span>
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
                                                            <div class="d-flex flex-row flex-nowrap align-self-baseline my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <h5>کالای جدید :</h5>
                                                                <div class="form-check-inline mx-2">
                                                                    <label class="form-check-label " for="yes-radio">
                                                                        <input type="radio" class="form-check-input mx-2" id="yes-radio" name="optradio" value="option1" checked>بلی
                                                                    </label>
                                                                </div>
                                                                <div class="form-check-inline mx-2">
                                                                    <label class="form-check-label " for="no-radio">
                                                                        <input type="radio" class="form-check-input mx-2" id="no-radio" name="optradio" value="option2">خیر
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="input-group col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group my-2">
                                                                    <div class="input-group-prepend align-self-baseline">
                                                                        <span class="input-group-text align-items-center">نام کالا</span>
                                                                        <input type="text" id="show_active"
                                                                            class="form-control" aria-label="" name="" aria-describedby="" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3" style="justify-content: center">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-success w-100" data-dismiss="modal" href="#tabs-featuresProduct">ثبت</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="tabs-featuresProduct" class="container tab-pane fade"><br>
                                        <div class="col-12 align-self-center mt-3">
                                            <div class="card col-12 m-0 p-0">
                                                <div class="card-content">
                                                    <div class="card-body " style="margin: 20px">
                                                        <h3>ویژگی های کالا</h3>
                                                        <br>

                                                        <ul class="list-style-none">
                                                            <li >
                                                                <div class="row align-self-baseline">
                                                                    <div class="d-flex flex-nowrap align-self-baseline">
                                                                        <h4>ویژگی 1 : </h4>
                                                                        <div class="form-check-inline mx-2">
                                                                            <label class="form-check-label" for="amount1">
                                                                                <input type="checkbox" class="form-check-input mx-2" id="amount1" name="checkBox" value="amount" checked>مقدار 1
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check-inline mx-2">
                                                                            <label class="form-check-label " for="amount2">
                                                                                <input type="checkbox" class="form-check-input mx-2" id="amount2" name="checkBox" value="amount">مقدار 2
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="input-group col-sm-12 col-md-4 col-lg-4 align-self-baseline mr-1">
                                                                        <div class="input-group my-2">
                                                                            <div class="input-group-prepend align-self-baseline">
                                                                                <span class="input-group-text align-items-center">مقدار جدید</span>
                                                                                <input type="text" id="show_active"
                                                                                       class="form-control" aria-label="" name="" aria-describedby="" >
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <button type="submit" class="btn btn-primary btn-md text-white px-3 align-self-baseline mr-2 ">ثبت</button>

                                                                </div>
                                                            </li>
                                                            <li >
                                                                <div class="row align-self-baseline">
                                                                    <div class="d-flex flex-nowrap align-self-baseline">
                                                                        <h4>ویژگی 2 : </h4>
                                                                        <div class="form-check-inline mx-2">
                                                                            <label class="form-check-label" for="amount1">
                                                                                <input type="checkbox" class="form-check-input mx-2" id="amount1" name="checkBox" value="amount" checked>مقدار 1
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check-inline mx-2">
                                                                            <label class="form-check-label " for="amount2">
                                                                                <input type="checkbox" class="form-check-input mx-2" id="amount2" name="checkBox" value="amount">مقدار 2
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="input-group col-sm-12 col-md-4 col-lg-4 align-self-baseline">
                                                                        <div class="input-group my-2">
                                                                            <div class="input-group-prepend align-self-baseline">
                                                                                <span class="input-group-text align-items-center">مقدار جدید</span>
                                                                                <input type="text" id="show_active"
                                                                                       class="form-control" aria-label="" name="" aria-describedby="" >
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <button type="submit" class="btn btn-primary btn-md text-white px-3 align-self-baseline mr-2 ">ثبت</button>

                                                                </div>
                                                            </li>
                                                        </ul>

                                                        <hr>

                                                        <div class="row my-4">
                                                            <div class="input-group col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group my-2">
                                                                    <div class="input-group-prepend align-self-baseline">
                                                                        <span class="input-group-text align-items-center">ویژگی</span>
                                                                        <input type="text" id="show_active"
                                                                               class="form-control" aria-label="" name="" aria-describedby="" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group my-2">
                                                                    <div class="input-group-prepend align-self-baseline">
                                                                        <span class="input-group-text align-items-center">مقدار</span>
                                                                        <input type="text" id="show_active"
                                                                               class="form-control" aria-label="" name="" aria-describedby="" >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row align-self-baseline">
                                                                <div class="mr-2 mt-3">
                                                                    <a type="button" class="bg-info btn-sm rounded-circle">
                                                                      <span data-original-title="اضافه">
                                                                         <img src="{{asset("./assets/images/add-icon.png")}}" alt="add-icon" width="15" height="15" >
                                                                      </span>
                                                                    </a>
                                                                </div>
                                                                <div class=" mr-2 mt-3">
                                                                    <a type="button" class="bg-danger btn-sm rounded-circle">
                                                                        <span data-original-title="حذف">
                                                                         <img src="{{asset("./assets/images/minus-icon.jpg")}}" alt="minus-icon" width="15" height="15" >
                                                                      </span>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="row mt-4" style="justify-content: center">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tabs-locationDetermining" class="container tab-pane fade"><br>
                                        <div class="col-12 align-self-center mt-3">
                                            <div class="card col-12 m-0 p-0">
                                                <div class="card-content">
                                                    <div class="card-body" style="margin: 20px">
                                                        <h3>تعیین محل کالا</h3>

                                                        <div class="row">
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text" style="width: 100%">استان</span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%">شهر</span>
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
                                                            <div class="input-group mt-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">آدرس کامل </span>
                                                                </div>
                                                                <textarea class="form-control" id="update-textarea-en" rows="3"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-4" style="justify-content: center">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل</button>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tabs-determinationPrice" class="container tab-pane fade"><br>
                                        <div class="col-12 align-self-center mt-3">
                                            <div class="card col-12 m-0 p-0">
                                                <div class="card-content">
                                                    <div class="card-body" style="margin: 20px">
                                                        <h3>تعیین قیمت </h3>

                                                        <div class="row">
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text" style="width: 100%">قیمت</span>
                                                                        </div>
                                                                        <input type="text" id="show_active" class="form-control" aria-label="" name="" aria-describedby="" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%">تخفیف</span>
                                                                        </div>
                                                                        <input type="text" id="show_active" class="form-control" aria-label="" name="" aria-describedby="" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row mt-3" style="justify-content: center">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tabs-barter" class="container tab-pane fade"><br>
                                        <div class="col-12 align-self-center mt-3">
                                            <div class="card col-12 m-0 p-0">
                                                <div class="card-content">
                                                    <div class="card-body" style="margin: 20px">
                                                        <h3>معاوضه</h3>

                                                        <div class="row">
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text" style="width: 100%">دسته 1</span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%">  دسته 2 </span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%">دسته 3</span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%"> دسته4 </span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%">کالا </span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%"> قیمت از </span>
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
                                                            <div class="input-group my-2 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group-prepend" style="width: 100%">
                                                                    <div class="input-group my-2">
                                                                        <div class="input-group-prepend ">
                                                                            <span class="input-group-text " style="width: 100%">قیمت تا </span>
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

                                                        <div class="form-check-inline text my-2">
                                                            <label class="form-check-label mx-2" for="newProduct">
                                                                <input type="checkbox" class="form-check-input mx-2 " id="newProduct" name="chechBoxNew" value="something">کالا جدید
                                                            </label>
                                                        </div>

                                                        <div class="row align-self-baseline">
                                                            <div class="input-group col-sm-12 col-md-4 col-lg-4">
                                                                <div class="input-group my-2">
                                                                    <div class="input-group-prepend w-100 align-self-baseline">
                                                                        <span class="input-group-text align-items-center">نام کالا</span>
                                                                        <select class="form-control" name="baste" id="show_country"  style="height: auto" >
                                                                            <option value="1">اول</option>
                                                                            <option value="1">دوم</option>
                                                                            <option value="1"> سوم</option>
                                                                            <option value="1">چهارم</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-md text-white px-3 mt-2 align-self-baseline ">ثبت</button>
                                                        </div>

                                                        <hr>

                                                        <div class="table-responsive t mt-5">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr class="table-info">
                                                                    <th scope="col" class="text-center" >
                                                                        ردیف
                                                                    </th>
                                                                    <th scope="col" class="text-center">
                                                                        نام کالا
                                                                    </th>
                                                                    <th scope="col" class="text-center">
                                                                         قیمت
                                                                    </th>
                                                                    <th scope="col" class="text-center">
                                                                        قیمت کارشناسی
                                                                    </th>
                                                                    <th scope="col" class="text-center">
                                                                        عملیات
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row" class="text-center">1</th>
                                                                    <th scope="row" class="text-center"></th>
                                                                    <th scope="row" class="text-center"></th>
                                                                    <th scope="row" class="text-center"></th>
                                                                    <td class="d-flex justify-content-center">
                                                                        <div class="tooltipdelete mr-2">
                                                                            <a href="#"><span class="btn-small btn-info p-1" data-toggle="tooltip" data-original-title="انتخاب">انتخاب </span></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <hr>

                                                        <ul class="list-style-none">
                                                            <div class="container-fluid px-0">
                                                                <div class="row align-self-baseline ">
                                                                    <div class="d-flex flex-nowrap align-self-baseline col-3">
                                                                        <h4>ویژگی 1 : </h4>
                                                                        <div class="form-check-inline mx-2">
                                                                            <label class="form-check-label" for="amount1">
                                                                                <input type="checkbox" class="form-check-input font-20px mx-3" id="amount1" name="checkBox" value="amount" checked>مقدار 1
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="input-group col-4 align-self-baseline">
                                                                        <div class="input-group my-2">
                                                                            <div class="col-12 input-group-prepend align-self-baseline">
                                                                                <span class="input-group-text align-items-center">جدید</span>
                                                                                <input type="text" id="show_active"
                                                                                       class="form-control" aria-label="" name="" aria-describedby="" >
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </ul>





                                                        <div class="row mt-3 my-3" style="justify-content: center">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-success w-100" data-dismiss="modal">ثبت</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-danger w-100" data-dismiss="modal">کنسل</button>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </main>


{{-- modal--}}
    <div class="modal" id="insert-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title"> ثبت کالای جدید </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0">
                        <span aria-hidden="true" class="text-left">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">

                    <ul class="list-style-none">
                        <div class="container-fluid px-0">
                            <div class="row align-self-baseline justify-content-between">
                                <div class="d-flex flex-nowrap align-self-baseline col-6">
                                    <h4>ویژگی 1 : </h4>
                                    <div class="form-check-inline mx-2">
                                        <label class="form-check-label" for="amount1">
                                            <input type="checkbox" class="form-check-input mx-2" id="amount1" name="checkBox" value="amount" checked>مقدار 1
                                        </label>
                                    </div>
                                </div>

                                <div class="input-group col-6 align-self-baseline">
                                    <div class="input-group my-2">
                                        <div class="col-12 input-group-prepend align-self-baseline">
                                            <span class="input-group-text align-items-center">جدید</span>
                                            <input type="text" id="show_active"
                                                   class="form-control" aria-label="" name="" aria-describedby="" >
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </ul>





                    <div class="row mt-3" style="justify-content: center">
                        <div class="col-6">
                            <button id="dodelete" type="button" class="btn btn-success w-100" data-dismiss="modal"
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
    {{--    <script src="{{asset('./assets/js/Category/category.js')}}"></script>--}}
    <script>
        $(document).ready(function () {
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
