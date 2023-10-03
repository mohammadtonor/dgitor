@extends("Pannel.Admin.home")

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

                <hr/>
{{--                <div class="row categ">--}}
{{--                    <div class="col-12 col-sm-6 col-xl-3 mt-3">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <img src="{{asset("./assets/images/category-removebg-preview.png")}}" alt="cart"--}}
{{--                                     class="float-left"--}}
{{--                                     width="130" height="70">--}}
{{--                                <h6 class="card-title font-weight-bold"> تعداد دسته بندی </h6>--}}
{{--                                <h2>26476</h2>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-12 align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <h4 class="modal-title">نتیجه کارشناسی</h4>
                                <button class="btn btn-lg btn-primary  my-2" data-toggle="modal"
                                        data-target="#btncreatenewsubcategory">دریافت pdf
                                </button>
                                <hr/>
                                <h6 class="modal-title">بخش عمومی</h6>
                                <ol>
                                    <li class="mt-2"> متن سوال شماره 1
                                        <ul style="list-style-type: disc">
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                        </ul>
                                    </li>
                                     <li class="mt-2"> متن سوال شماره 2
                                        <ul style="list-style-type: disc">
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                        </ul>
                                    </li>
                                    <li class="mt-2"> متن سوال شماره3
                                        <ul style="list-style-type: disc">
                                            <li>پاسخ 1</li>
                                            <li>پاسخ 2</li>
                                            <li>پاسخ 3</li>
                                            <li>پاسخ 4</li>
                                        </ul>
                                    </li>
                                </ol>
                                <hr/>
                                <h6 class="modal-title">بخش اختصاصی</h6>
                                <ol>
                                    <li class="mt-2"> متن سوال شماره 1
                                        <ul style="list-style-type: disc">
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                        </ul>
                                    </li>
                                    <li class="mt-2"> متن سوال شماره 2
                                        <ul style="list-style-type: disc">
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                            <li>پاسخ </li>
                                        </ul>
                                    </li>
                                    <li class="mt-2"> متن سوال شماره3
                                        <ul style="list-style-type: disc">
                                            <li>پاسخ 1</li>
                                            <li>پاسخ 2</li>
                                            <li>پاسخ 3</li>
                                            <li>پاسخ 4</li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </main>
@endsection
