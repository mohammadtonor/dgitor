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
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">داشبورد</li>
                        </ol>
                    </div>
                </div>
            </div>
            <hr/>

            <div class="col-12 align-self-center mt-3">
                <div class="card col-12 m-0 p-0">
                    <div class="card-content">
                        <div class="card-body m-2">
                            <div class="m-3 d-flex flex-column align-items-center">

                                <div class="form-row">
                                    <h2 class="col-12 pt-3">اختصاص مشترک به کارمند</h2>
                                    <div class="input-group my-3 col-md-3 col-sm-12 pr-0">
                                        <div class="input-group-prepend" style="width: 100%">
                                            <div class="input-group my-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width: 100%">{{$result["customer"]->name}}}}</span>
                                                </div>
                                                <div class="form-group col-md-12 anbar-category-container">
                                                    <div class="input-group mb-2">
                                                        <select
                                                            class="vippermissions"
                                                            name="vippermission_ids[]"
                                                            id="vippermissions"
                                                            multiple>
                                                            @if($result['karshenasCanAssign']!=null)
                                                                @foreach($result['karshenasCanAssign'] as $canPermission)
                                                                    <option
                                                                        value="{{$canPermission->id}}">{{$canPermission->name}}</option>
                                                                @endforeach
                                                            @endif

                                                            @if($result['karshenases']!=null)
                                                                @foreach($result['karshenases'] as $userPermission)
                                                                    <option value="{{$userPermission->id}}"
                                                                            selected>{{$userPermission->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-success btn-lg mb-4 text-center" style="width: 110px;">ثبت
                                    </button>


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
    <script src="{{asset('./assets/js/dual-listbox.min.js')}}"></script>
    <script src="{{asset('./assets/js/Pannel/AssignMoshtarakToEmployee/AssignMoshtarakToEmployee.js')}}"></script>

@endsection
