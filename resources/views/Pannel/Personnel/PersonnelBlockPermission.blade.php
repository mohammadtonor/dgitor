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
                    <div class="card" style="height: 150px">
                        <div class="card-body">
                            <img src="{{asset("/assets/images/block-icon.png")}}" alt="cart"
                                 class="float-left"
                                 width="70" height="70">
                            <h6 class="card-title font-weight-bold">تعداد بلاک ها</h6>
                            <h2>2</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 align-self-center mt-3">
                <div class="card col-12 m-0 p-0">
                    <div class="card-content">
                        <div class="card-body ">
                            <div class="m-5 d-flex flex-column align-items-center">
                                <div class="form-row">
                                    <h2 class="col-12 pt-3">دسترسی های اختصاصی</h2>
                                    <div class="input-group my-3 col-md-3 col-sm-12 pr-0">
                                        <div class="form-group">
                                            <div class="field_wrapper">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">نام کارمند</div>
                                                    </div>
                                                    <input id="cost_rial" disabled type="text" class="form-control" value="نام..."/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 anbar-category-container">
                                        <div class="input-group mb-2">
                                            <select class="anbar-categories" name="category_ids[]" id="anbar-categories" multiple>
                                                <option value="1">مشتری 1</option>
                                                <option value="2">مشتری 2</option>
                                                <option value="3">مشتری 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex my-3 mr-3 ">
                                        <button type="button" class="btn btn-md btn-success">ثبت</button>
                                        <div class="pr-2"><a href="" class="btn btn-md btn-danger ml-2 ">کنسل</a></div>
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
    {{--    <script src="{{asset('./assets/js/Category/category.js')}}"></script>--}}
    <script src="{{asset('./assets/js/dual-listbox.min.js')}}"></script>
    <script>
        //dual list box
        $(document).ready(function () {
            new DualListbox(".anbar-categories", {
                availableTitle: "لیست دسترسی های فعلی",
                selectedTitle: "لیست دسترسی های بلاک",
                addButtonText: "افزودن",
                removeButtonText: "حذف",
                addAllButtonText: "افزودن همه",
                removeAllButtonText: "حذف همه",
            });

            // Change Multiselect Search box To Persian
            // $(".dual-listbox__search").attr("placeholder", "جستجو");
            $(".dual-listbox__search").css("display", "none");
            $(".dual-listbox__button").addClass("bg-primary");
        });
    </script>
@endsection
