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
                            <img src="{{asset("/assets/images/employee-icon-1-removebg-preview.png")}}" alt="cart"
                                 class="float-left"
                                 width="130" height="70">
                            <h6 class="card-title font-weight-bold">تعداد دسترسی ها</h6>
                            <h2 class="userName">{{$result["count"]}}</h2>

                        </div>
                    </div>
                </div>
            </div>
            <div class="shadow">
                <div class="m-5 d-flex flex-column align-items-center">
                    <div class="form-row">
                        <h2 class="col-12 pt-3">دسترسی های اختصاصی</h2>
                        <div class="input-group my-3 col-md-3 col-sm-12 pr-0">
                            <div class="input-group-prepend" style="width: 100%">
                                <div class="input-group my-2">
                                    <div class="d-flex">
                                        <h2 class="my-3">نام کارمند :</h2>
{{--                                        <h2 class="userName">{{$result["user"]->name}}</h2>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 anbar-category-container">
                            <div class="input-group mb-2">
                                <select
                                    class="vippermissions"
                                    name="vippermission_ids[]"
                                    id="vippermissions"
                                    multiple>
{{--                                    @if($result['canpermissions']!=null)--}}
{{--                                        @foreach($result['canpermissions'] as $canPermission)--}}
{{--                                            <option value="{{$canPermission->id}}">{{$canPermission->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}

{{--                                    @if($result['permissions']!=null)--}}
{{--                                        @foreach($result['permissions'] as $userPermission)--}}
{{--                                            <option value="{{$userPermission->id}}" selected>{{$userPermission->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
                                </select>
                            </div>
                        </div>
                        <button id="sendnewpermission" class="btn btn-success btn-lg mb-4 ">ثبت</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section("pagejs")
    <script src="{{asset('./assets/js/dual-listbox.min.js')}}"></script>
    <script src="{{asset('./assets/js/Pannel/Settings/vippermission.js')}}"></script>
@endsection
