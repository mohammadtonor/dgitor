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
            <div class="shadow">
                <div class="m-5 d-flex flex-column align-items-center">
                    <div class="form-row">
                        <h2 class="col-12 pt-3">کارشناسان مشترک</h2>
                        <div class="form-group col-md-12 anbar-category-container">
                            <div class="input-group mb-2">
                                <select
                                    class="karshenas"
                                    name="karshenas_ids[]"
                                    multiple>
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
    <script src="{{asset('./assets/js/Pannel/ManageCustomer/KarshenasanMoshtarak.js')}}"></script>
@endsection
