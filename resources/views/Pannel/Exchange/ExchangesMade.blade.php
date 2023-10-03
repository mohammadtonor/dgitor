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
                <div class="container-fluid align-self-center mt-3">
                    <div class="card col-12 m-0 p-0">
                        <h4 style="margin: 20px 45px 10px 15px"> معاوضه های انجام شده </h4>
                        <div class="card-content">
                            <div class="card-body" style="margin: 20px">
                                <div class="d-flex container mx-0 ">
                                    <div class="row w-100">
                                        <div class="form-group col-sm-12 col-md-2">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"> دسته 1</div>
                                                    </div>
                                                    <select class="form-control Category1" name="Category1"
                                                            id="Category1">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">دسته 2</div>
                                                    </div>
                                                    <select class="form-control Category2" name="Category2"
                                                            id="Category2">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">دسته 3 </div>
                                                    </div>
                                                    <select class="form-control Category3" name="Category3"
                                                            id="Category3">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn btn-md  btn-danger searchOk " id="searchOk">جستجو</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="container-fluid">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="container-fluid card-header" id="headingOne">

                                                <h5 class="mb-0 w-100 mx-0">
                                                    <button class="btn btn-link w-75" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-light table-striped w-100 ">
                                                                <thead>
                                                                <tr class="text-center">
                                                                    <th class="rowcount">ردیف</th>
                                                                    <th class="">کالا</th>
                                                                    <th class="">دسته بندی</th>
                                                                    <th class="">مالک</th>
                                                                    <th class="">قیمت</th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </button>
                                                    <button class="btn btn-md btn-primary"> اطلاعات تماس</button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body mt-1">

                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-dark table-striped w-100 myTableExchangesMade " id="myTableExchangesMade">
                                                            <thead>
                                                            <tr class="text-center">
                                                                <th class="rowcount">ردیف</th>
                                                                <th class=""> کالا</th>
                                                                <th class="">دسته بندی</th>
                                                                <th class="">مالک</th>
                                                                <th class="">قیمت</th>
                                                                <th class="">قیمت کارشناسی</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody style="margin: 25px">
                                                            <tr class="text-center">
                                                                <td style="padding-right: 34px;">1</td>
                                                                <td ></td>
                                                                <td ></td>
                                                                <td ></td>
                                                                <td ></td>
                                                                <td ></td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--MODAL-->


@endsection

@section("pagejs")
    <script src="{{asset('./assets/js/select2.min.js')}}"></script>
    <script src="{{asset('./assets/js/personel/PersonnelList/PersonnelList.js')}}"></script>

@endsection
