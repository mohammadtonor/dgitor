@extends("Pannel.Admin.home")


{{--Page Css--}}
@section("pagecss")
    <link rel="stylesheet" href="{{asset('./assets/css/GeneralStyle/style.css')}}">
    <link rel="stylesheet" href={{asset('./assets/css/dual-listbox.css')}}>
@endsection

@section("content")
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 align-self-center">
                    <div
                        class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
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
                            <img src="{{asset("/assets/images/access-removebg-preview.png")}}" alt="cart"
                                 class="float-left"
                                 width="70" height="70">
                            <h6 class="card-title font-weight-bold">تعداد کل دسترسی ها</h6>
                            <h2>2</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shadow">
                <div class="m-5 d-flex flex-column align-items-center">
                    <div class="form-row">
                        <h2 class="col-12 pt-3">دسترسی سمت ها</h2>
                        <div class="input-group my-3 col-md-3 col-sm-12 pr-0">
                            <div class="input-group-prepend" style="width: 100%">
                                <div class="input-group my-2">
                                    <div class="input-group-prepend"><span class="input-group-text" style="width: 100%">سمت</span>
                                    </div>
                                    <select
                                        class="form-control"
                                        name="baste"
                                        id="semat"
                                        style="height: auto">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 anbar-category-container">
                            <div class="input-group mb-2">
                                <select
                                    class="anbar-categories" id="list_access"
                                    name="category_ids[]"
                                    id="list_access"
                                    multiple>
{{--                                    <option value="1">مشتری 1</option>--}}
{{--                                    <option value="2">مشتری 2</option>--}}
{{--                                    <option value="3">مشتری 3</option>--}}
                                </select>
                            </div>
                        </div>
                        <div class="d-flex mb-3 ">
                            <button type="button" class="btn btn-success btn_semat_access">ثبت</button>
                            <div class="pr-2"><a href="" class="btn btn-danger ml-2 ">کنسل</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section("pagejs")
        <script src="{{asset('./assets/js/dual-listbox.min.js')}}"></script>
        <script src="{{asset('./assets/js/Pannel/Settings/sematAccess.js')}}"></script>
@endsection
