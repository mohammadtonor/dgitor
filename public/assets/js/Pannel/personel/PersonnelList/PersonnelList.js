$(document).ready(function(){

    //=================Initialize data table==============
    let myTablePersonnelList = $('#myTablePersonnelList').DataTable({
        "order": [],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "language": {
            "emptyTable": "هیچ داده ای برای نمایش وجود ندارد",
            "info": "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
            "infoEmpty": "نمایش 0 تا 0 از 0 آیتم",
            "infoFiltered": "(فیلتر شده از جمعا _MAX_ ایتم)",
            "zeroRecords": "داده مشابهی پیدا نشد",
        }
    });


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




    //-------------------- getAllPersonnelList ----------------//
    getAllPersonnelList();

    getAllCountries();
    getAllCities();
    getAllOstanes();

    //---------------------- search PersonnelList -----------//
    $("#searchName").val("");
    $("#searchLastName").val("");
    $("#searchCodeNum").val("");
    $("#searchCountry").val("");
    $("#searchCity").val("");
    $("#searchOstan").val("");

    $(document).on("click","#searchOk",function(){
        let formData = new FormData();
        formData.append("name",$("#searchName").val());
        formData.append("family",$("#searchLastName").val());
        formData.append("ncode",$("#searchCodeNum").val());
        formData.append("country_id",$("#searchCountry").val());
        formData.append("city_id",$("#searchCity").val());
        formData.append("ostan_id",$("#searchOstan").val());

        let data = {
            "name":$("#searchName").val(),
            "family":$("#searchLastName").val(),
            "ncode":$("#searchCodeNum").val(),
            "country_id":$("#searchCountry").val(),
            "city_id":$("#searchCity").val(),
            "ostan_id":$("#searchOstan").val(),
        };

        fetch(`/personnel/search`,{
            method:"POST",
            body:formData,
            headers: {
                "accept": "application/json",
                "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response =>response.json())
            .then(data =>{
                console.log(data);
                if(data.status == "validation-error"){
                    $.each(data.errors, (index, err) => toastr.error(err));
                    return;
                }
                if(data.status == "refused"){
                    toastr.erroe("خطا");
                    return;
                }
            });


        // myTablePersonnelList.destroy();
        // myTablePersonnelList = $('#myTablePersonnelList').DataTable({
        //     data: data,
        //     "language": {
        //         "emptyTable": "هیچ داده ای برای نمایش وجود ندارد",
        //         "info": "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
        //         "infoEmpty": "نمایش 0 تا 0 از 0 آیتم",
        //         "zeroRecords": "داده مشابهی پیدا نشد"
        //     },
        //     "columnDefs": [
        //         {
        //             "name": "rowcount",
        //             "targets": 0,
        //             "data": null,
        //             "searchable": false,
        //             "orderable": false,
        //             render: function (data, type, row, meta) {
        //                 return meta.row + meta.settings._iDisplayStart + 1;
        //             }
        //         },
        //         {
        //             "name": "firstName",
        //             "data": "personnel.name",
        //             "targets": 1,
        //             "className": 'firstName'
        //         },
        //         {
        //             "name": "lastName",
        //             "data": "personnel.family",
        //             "targets": 2,
        //             "className": 'lastName'
        //         },
        //         {
        //             "name": "codeNum",
        //             "data": "personnel.ncode",
        //             "targets": 3,
        //             "className": 'codeNum'},
        //         {
        //             "name": "cellNum",
        //             "data": "personnel.mobile",
        //             "targets": 4,
        //             "className": 'cellNum'},
        //         {
        //             "name": "city",
        //             "data": "personnel.city.name",
        //             "targets": 5,
        //             "className": 'city'},
        //         {
        //             "name": "statusPersonnel",
        //             "data": "personnel.mobile",
        //             "targets": 6,
        //             "className": 'statusPersonnel'},
        //         {
        //             "name": "insertTime",
        //             "data": "personnel.created_at",
        //             "targets": 7,
        //             "className": 'insertTime'},
        //         {
        //             "name": "deleteTime",
        //             "data": "personnel.deleted_at",
        //             "targets": 8,
        //             "className": 'deleteTime'},
        //         {
        //             "name": "operation",
        //             "targets": 9,
        //             "className": 'operation',
        //             "render": function(data,type,row,meta){
        //
        //                 let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 mt-1 deletePersonnelList" data-target="#deletePersonnelList"
        //                                                            data-toggle="modal" data-id="${row["personnel"]["id"]}">
        //                                                 <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
        //                                                        data-placement="top" title="حذف"></i>
        //                                               </button>`;
        //
        //                 let restoreBtn = `<button class="btn btn-sm btn-warning ml-2 mt-1 restorePersonnelList" data-target="#restorePersonnelList"
        //                                                          data-toggle="modal" data-id="${row["personnel"]["id"]}">
        //                                                    <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
        //                                                          data-placement="top" title="بازیابی"></i>
        //                                                  </button>`;
        //                 return `
        //                            <td>
        //                                 ${row.personnel.deleted_at!=null ? restoreBtn : deleteBtn}
        //
        //                                         <button class="btn btn-sm btn-warning ml-2 mt-1"
        //                                                 data-target="#personneledit"
        //                                                 data-toggle="modal" data-id="${row["personnel"]["id"]}" data-recordid="${row["personnel"]["id"]}">
        //                                             <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip "
        //                                                data-placement="top"
        //                                                title="ویرایش"></i>
        //                                         </button>
        //                                         <button class="btn btn-sm btn-primary ml-2 mt-1"
        //                                                 data-target="#showpersonnel"
        //                                                 data-toggle="modal" data-id="${row["personnel"]["id"]}" data-recordid="${row["personnel"]["id"]}">
        //                                             <i class="icon-camera" aria-hidden="true" data-toggle="tooltip "
        //                                                data-placement="top"
        //                                                title="نمایش"></i>
        //                                         </button>
        //                                         <button class="btn btn-sm btn-info ml-2 mt-1">
        //                                             <a href=/addrsperonnel">
        //                                                 <i class="icon-directions" aria-hidden="true"
        //                                                    data-toggle="tooltip "
        //                                                    data-placement="top"
        //                                                    title="ادرس ها"></i></a>
        //                                         </button>
        //                                         <button class="btn btn-sm btn-warning ml-2 mt-1"><a
        //                                                 href="/personnelcontacts">
        //                                                 <i class="icon-call-end" aria-hidden="true"
        //                                                    data-toggle="tooltip "
        //                                                    data-placement="top"
        //                                                    title="شماره تماس"></i></a>
        //                                         </button>
        //                                         <button class="btn btn-sm btn-success ml-2 mt-1"><a
        //                                                 href="/personnelbankaccount">
        //                                                 <i class="icon-basket" aria-hidden="true" data-toggle="tooltip "
        //                                                    data-placement="top"
        //                                                    title="اطلاعات بانکی"></i></a>
        //                                         </button>
        //                                         <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#semats"
        //                                                 data-toggle="modal" data-id="${row["personnel"]["id"]}" data-recordid="${row["personnel"]["id"]}">
        //                                             <i class="icon-list" aria-hidden="true" data-toggle="tooltip "
        //                                                data-placement="top"
        //                                                title="سمت ها"></i>
        //                                         </button>
        //                                         <button class="btn btn-sm btn-info ml-2 mt-1"
        //                                                 data-target="#uploaddocuments"
        //                                                 data-toggle="modal" data-id="${row["personnel"]["id"]}" data-recordid="${row["personnel"]["id"]}">
        //                                             <i class="icon-cloud-upload" aria-hidden="true" data-toggle="tooltip "
        //                                                data-placement="top"
        //                                                title="آپلود مدارک"></i>
        //                                         </button>
        //                                         <button class="btn btn-sm btn-success ml-2 mt-1"><a
        //                                                 href="/personnelvippermission">
        //                                                 <i class="fa fa-arrow-circle-left text-center pb-0 mb-0" aria-hidden="true" data-toggle="tooltip " style="color: white"
        //                                                    data-placement="top"
        //                                                    title="دسترسی اختصاصی"></i></a>
        //                                         </button>
        //                                         <button class="btn btn-sm btn-primary ml-2 mt-1"><a
        //                                                 href="/personnelblockpermission">
        //                                                 <i class="icon-ban" aria-hidden="true" data-toggle="tooltip " style="color: white"
        //                                                    data-placement="top"
        //                                                    title=" سلب دسترسی"></i></a>
        //                                         </button>
        //                                     </td>
        //                                 `;
        //             }},
        //     ],
        //     createdRow: function (row, data, dataIndex) {
        //         $(row).addClass('data text-center').attr("id",data.personnel.id);
        //     },
        // });
        //

    });

    //-------------------- delete PersonnelList ----------------//
    $(document).on("click",".deletePersonnelList", function(evt){
        let id =$(this).data('id');

        $("#deletePersonnelList #deleteOkPersonnel").data("recordid", id).attr("data-recordid", id);
    });
    $("#deleteOkPersonnel").on("click",async function(){
        let personnelId= $(this).attr("data-recordid");

        fetch(`/personnel/del/${personnelId}`,{
            // headers:{
            //     "accept": "application/json",
            //     "X-Requested-With": "XMLHttpRequest"
            // },
            method:"GET"
        })
            .then(response => response.json())
            .then(data => {
                if(data.status == "success"){
                    toastr.success("پرسنل با موفقیت حذف شد!");
                    changeDeleteRestoreButton("deletePersonnelList", "restorePersonnelList",personnelId )

                    getAllPersonnelList(data.status.data);
                }
                else{
                    toastr.error("بروز خطا در حذف پرسنل")
                }
            })
    });

    //----------------- restore PersonnelList ------------------//
    $(document).on("click",".restorePersonnelList", function(evt){
        let id = $(this).attr("data-id");

        $("#restorePersonnelList #restoreOkPersonnel").data("recordid",id).attr("data-recordid",id);
    });
    $("#restoreOkPersonnel").on("click", function(){
        let personnelId = $(this).data("recordid");

        console.log(personnelId);

        fetch(`/personnel/restore/${personnelId}`,{
            // headers:{
            //     "accept":"application/json",
            //     "X-Requested-With":"XMLHttpRequest",
            //     "Content-Type":"application/json"
            // },
            method: "GET"
        })
            .then(response => response.json())
            .then(data =>{
                if(data.status == "success"){
                    toastr.success("پرسنل با موفقیت بازیابی شد.");
                    changeDeleteRestoreButton("deletePersonnelList", "restorePersonnelList",personnelId);
                    getAllPersonnelList(data.status.data);
                    return;
                }
                else{
                    toastr.error("بروز خطا در بازیابی پرسنل");
                }

            })
            .catch(error => {
                return{
                    'Error':erroe,
                    'statusText':error.statusText,
                    'status':error.status
                }
            });
    });

    //------------------- edit PersonnelList -----------------//
    $(document).on("click",".editPersonnelList",async function(evt){
        let editPersonnelId = $(this).attr("data-id");

        console.log(editPersonnelId);
        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await getData(`/personnel/get/${editPersonnelId}` , headers)
        if(data.status == "notFound")
        {
            toastr.error("بروز خطا در دریافت پرسنل");
            return;
        }
        $("#editPersonnelModal").find("#editPersonnelOk").data("recordid",editPersonnelId).attr("data-recordid",editPersonnelId);

        //------> fill data in edit modal ----//

        $("#editPersonnelModal").find("#editNamePersonnel").val(data.status.name);
        $("#editPersonnelModal").find("#editLastNamePersonnel").val(data.status.family);
        $("#editPersonnelModal").find("#editNcodePersonnel").val(data.status.ncode);
        $("#editPersonnelModal").find("#editBirthdayPersonnel").val(data.status.birthday);
        $("#editPersonnelModal").find("#editMobilePersonnel").val(data.status.mobile);
        $("#editPersonnelModal").find("#editGenderPersonel").val(data.status.gender);
        console.log(data.status.gender);
        $("#editPersonnelModal").find("#editEmailPersonnel").val(data.status.email);

        $("#editPersonnelModal").find("#editSematPersonnel :selected").val(data.status.roles[0].name);
        console.log(data.status.roles[0].name);
        getAllRoles(data.status.roles[0].name);

        getCountriesOstansCitiesEdit(data.status.country_id,data.status.ostan_id,data.status.city_id);

        // $("#editPersonnelModal").find("#editCountryPersonnel :selected").val(data.status.country_id);
        // console.log(data.status.country_id);
        // $("#editPersonnelModal").find("#editOstanPersonnel :selected").val(data.status.ostan_id);
        // console.log(data.status.ostan_id);
        // $("#editPersonnelModal").find("#editCityPersonnel :selected").val(data.status.city_id);
        // console.log(data.status.city_id);

        $("#editPersonnelModal").find("#editTaeedCodePersonnel").val(data.status.mobile_verification_code);

        //----> show modal------//
        $("#editPersonnelModal").modal("show");

    });
    $("#editPersonnelOk").on("click", async function(evt){
        let editPersonnelId = $(this).data("recordid");

        let editNamePersonnel=$("#editPersonnelModal").find("#editNamePersonnel").val();
        let editLastNamePersonnel=$("#editPersonnelModal").find("#editLastNamePersonnel").val();
        let editNcodePersonnel=$("#editPersonnelModal").find("#editNcodePersonnel").val();
        let editBirthdayPersonnel=$("#editPersonnelModal").find("#editBirthdayPersonnel").val();
        let editMobilePersonnel=$("#editPersonnelModal").find("#editMobilePersonnel").val();
        let editGenderPersonel=$("#editPersonnelModal").find("#editGenderPersonel :selected").val();
        let editEmailPersonnel=$("#editPersonnelModal").find("#editEmailPersonnel").val();
        let editSematPersonnel=$("#editPersonnelModal").find("#editSematPersonnel :selected").val();
        let editCountryPersonnel=$("#editPersonnelModal").find("#editCountryPersonnel :selected").val();
        let editOstanPersonnel=$("#editPersonnelModal").find("#editOstanPersonnel :selected").val();
        let editCityPersonnel=$("#editPersonnelModal").find("#editCityPersonnel :selected").val();
        let editTaeedCodePersonnel=$("#editPersonnelModal").find("#editTaeedCodePersonnel").val();

        let csrfToken = $(document).find("meta[name=csrf_token]").attr("content");
        let TableRowId = $(this).attr("data-recordid");


        let data ={
            "name" : editNamePersonnel,
            "family" : editLastNamePersonnel,
            "gender" : editGenderPersonel,
            "ncode" : editNcodePersonnel,
            "birthday" : editBirthdayPersonnel,
            "mobile" : editMobilePersonnel,
            "email" : editEmailPersonnel,
            "role_ids" : editSematPersonnel,
            "country_id" : editCountryPersonnel,
            "ostan_id" : editOstanPersonnel,
            "city_id" : editCityPersonnel,
            "mobile_verification_code" : editTaeedCodePersonnel,
        };
        let headers= {
            "Accept": "application/json",
            "Content-Type": "application/json",
            // "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest"
        };

        let res = await postData(`/personnel/update/${editPersonnelId}`, headers , data);
        if(res.status == "validation-error"){
            $(document).each(data.errors, (index, err) => toastr.error(err));
            return;
        }
        if(res.status == "success"){

            $(document).find(`tr#${TableRowId}`).find(".firstName").html(editNamePersonnel);
            $(document).find(`tr#${TableRowId}`).find(".lastName").html(editLastNamePersonnel);
            $(document).find(`tr#${TableRowId}`).find(".codeNum").html(editNcodePersonnel);
            $(document).find(`tr#${TableRowId}`).find(".cellNum").html(editMobilePersonnel);
            $(document).find(`tr#${TableRowId}`).find(".city").html(editCityPersonnel);
            $(document).find(`tr#${TableRowId}`).find(".statusPersonnel").html(editSematPersonnel)

            //clear all input for next edit
            $(".editPersonnelList").on("click", function(){
                $("#editPersonnelModal").find("#editNamePersonnel").val("");
                $("#editPersonnelModal").find("#editLastNamePersonnel").val("");
                $("#editPersonnelModal").find("#editNcodePersonnel").val("");
                $("#editPersonnelModal").find("#editBirthdayPersonnel").val("");
                $("#editPersonnelModal").find("#editMobilePersonnel").val("");
                $("#editPersonnelModal").find("#editGenderPersonel :selected").val("");
                $("#editPersonnelModal").find("#editEmailPersonnel").val("");
                $("#editPersonnelModal").find("#editSematPersonnel :selected").val("");
                $("#editPersonnelModal").find("#editCountryPersonnel :selected").val("");
                $("#editPersonnelModal").find("#editOstanPersonnel :selected").val("");
                $("#editPersonnelModal").find("#editCityPersonnel :selected").val("");
                $("#editPersonnelModal").find("#editTaeedCodePersonnel").val("");
            });
            toastr.success("ویرایش با مموفقیت انجام شد");
            $("#editPersonnelModal").modal('toggle');
            getAllPersonnelList(res.status.data);
            return;
        }
        if(res.status == "duplicate"){
            $('#editPersonnelModal').modal('toggle');
            toastr.error("پرسنل تکراری وارد کرده اید...!");
            return;
        }

    });

    //------------------- show PersonnelList -----------------//

    $(document).on("click",".showPersonnelList",async function(evt){
        let showPersonnelId = $(this).attr("data-id");
        console.log(showPersonnelId);

        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await getData(`/personnel/get/${showPersonnelId}` , headers)
        if(data.status == "notFound")
        {
            toastr.error("بروز خطا در دریافت پرسنل");
            return;
        }

        //------> fill data in show modal ----//

        $("#showPersonnelModal").find("#showNamePersonnel").val(data.status.name);
        $("#showPersonnelModal").find("#showLastNamePersonnel").val(data.status.family);
        $("#showPersonnelModal").find("#showNcodePersonnel").val(data.status.ncode);
        $("#showPersonnelModal").find("#showBirthdayPersonnel").val(data.status.birthday);
        $("#showPersonnelModal").find("#showMobilePersonnel").val(data.status.mobile);
        $("#showPersonnelModal").find("#showGenderPersonnel ").val(data.status.gender);
        $("#showPersonnelModal").find("#showEmailPersonnel").val(data.status.email);

        $("#showPersonnelModal").find("#showSematPersonnel :selected").val(data.status.roles[0].name);
        console.log(data.status.roles.name);
        console.log(data.status.roles[0].name);

        getCountriesOstanscitiesShow(data.status.country_id,data.status.ostan_id,data.status.city_id);

        // $("#showPersonnelModal").find("#showCountryPersonnel :selected").val(data.status.country_id);
        // getAllCountriesShow(data.status.country_id);
        // $("#showPersonnelModal").find("#showOstanPersonnel :selected").val(data.status.ostan_id);
        // getAllOstanesShow(data.status.ostan_id);
        // $("#showPersonnelModal").find("#showCityPersonnel :selected").val(data.status.city_id);
        // getAllCitiesShow(data.status.city_id);

        $("#showPersonnelModal").find("#showTaeedCodePersonnel").val(data.status.mobile_verification_code);

        //----> show modal------//
        $("#showPersonnelModal").modal("show");

    });

   //------------------------------- function PersonnelList -------------------------//

    //-------- get All --------//
    async function getAllPersonnelList(){
        let data = await getData(`/personnel/getall/data`,{
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json"
        });

        updateDatatable(data.status.data);
    }
    //--------- Post Data ------//
    async function postData(url,headers,data,stringifyBody =true){
        let response =await fetch(url,{
            headers: headers,
            method:"POST",
            body:stringifyBody ? JSON.stringify(data) : data
        })
        return response.json();
    }
    //--------- get Data -------------//
    async function getData(url,headers){
        let response= await fetch(url ,{
            headers:headers,
            method:"GET"
        })
        return response.json();
    }
    //-------- get currentData --------//
    function getCurrentData(){
        const m =moment();
        m.local('fa');
        return m.format('DD MMMM YYYY');
    }
    //------------- Roles function multi selected list ---------//
-    async function getAllRoles(){
        let result = await getData("/role/get-all",{ "Accept": "application/json", "X-Requested-With": "XMLHttpRequest"});
        console.log(result);
        $("#rolesInsert").empty();
        $.each(result.roles, function(key,value){
            $("#rolesInsert").append(`<option value="${value.role.id}">${value.role.name}</option>`)
        });
        $('#rolesInsert').select2({
            closeOnSelect : true,
            placeholder : "انتخاب کنید",
            allowClear: Boolean($(this).data('allow-clear')),
            "language": {
                "noResults": function(){
                    return "داده ای یافت نشد!";
                }
            },
        });
    }





    //---------------- show function selected list -------------//
    function getCountriesOstanscitiesShow(userCountryId=null,userOstanId=null,userCityId=null) {
        fetch("/country/getall", {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method: "GET"
        }).then(response=>response.json())
            .then(data => {
                console.log(data);
                $("#showCountryPersonnel").empty();
                // $("#showCountryPersonnel").append('<option value="">انتخاب کنید</option>');
                $.each(data.countries, function (key, value){
                    $("#showCountryPersonnel").append(`<option value="${value.country.id}" ${(userCountryId==value.country.id)?"selected":""}>${value.country.name}</option>`);
                });
            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });

        fetch(`/ostan/get-all/${userCountryId}`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method: "GET"
        }).then(response => response.json())
            .then(data => {
                console.log(data);
                $("#showOstanPersonnel").empty();
                // $("#showOstanPersonnel").append('<option value="">انتخاب کنید</option>');
                $.each(data.status.ostans, function (key, value){
                    $("#showOstanPersonnel").append(`<option value="${value.ostan.id}" ${(userOstanId==value.ostan.id)?"selected":""}>${value.ostan.name}</option>`);
                })
            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });

        fetch(`/city/get-all/${userCountryId}/${userOstanId}`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method: "GET"
        }).then(response => response.json())
            .then(data => {
                console.log(data);
                $("#showCityPersonnel").empty();
                // $("#showCityPersonnel").append('<option value="">انتخاب کنید</option>');
                $.each(data.status.cities, function (key, value){
                    $("#showCityPersonnel").append(`<option value="${value.id}" ${(userCityId==value.id)?"selected":""}>${value.name}</option>`);
                })
            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });
    }

    //--------------- edit function selected list ---------------//
    function getCountriesOstansCitiesEdit(userCountryId=null,userOstanId=null,userCityId=null) {
        fetch("/country/getall", {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method: "GET"
        }).then(response=>response.json())
            .then(data => {
                console.log(data);
                $("#editCountryPersonnel").empty();
                $("#editCountryPersonnel").append('<option value="">انتخاب کنید</option>');
                $.each(data.countries, function (key, value){
                    $("#editCountryPersonnel").append(`<option value="${value.country.id}" ${(userCountryId==value.country.id)?"selected":""}>${value.country.name}</option>`);
                });
            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });

        fetch(`/ostan/get-all/${userCountryId}`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method: "GET"
        }).then(response => response.json())
            .then(data => {
                console.log(data);
                $("#editOstanPersonnel").empty();
                $("#editOstanPersonnel").append('<option value="">انتخاب کنید</option>');
                $.each(data.status.ostans, function (key, value){
                    $("#editOstanPersonnel").append(`<option value="${value.ostan.id}" ${(userOstanId==value.ostan.id)?"selected":""}>${value.ostan.name}</option>`);
                })
            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });

        fetch(`/city/get-all/${userCountryId}/${userOstanId}`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method: "GET"
        }).then(response => response.json())
            .then(data => {
                console.log(data);
                $("#editCityPersonnel").empty();
                $("#editCityPersonnel").append('<option value="">انتخاب کنید</option>');
                $.each(data.status.cities, function (key, value){
                    $("#editCityPersonnel").append(`<option value="${value.id}" ${(userCityId==value.id)?"selected":""}>${value.name}</option>`);
                })

            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });

        $("#editCountryPersonnel").on("change",function (){

            let id = $("#editCountryPersonnel option:selected").val();

            fetch(`/ostan/get-all/${id}`, {
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                method: "GET"
            }).then(response => response.json())
                .then(data => {
                    $("#editOstanPersonnel").empty();
                    $("#editOstanPersonnel").append('<option value="">انتخاب کنید</option>');
                    $.each(data.status.ostans, function (key, value){
                        $("#editOstanPersonnel").append(`<option value="${value.ostan.id}">${value.ostan.name}</option>`);
                    })
                })
                .catch(error => {
                    return {
                        'Error:': error,
                        'statusText:': error.statusText,
                        'status:': error.status
                    }
                });
        })

        $("#editCountryPersonnel").on("change",function (){

            let id = $("#editCountryPersonnel option:selected").val();

            fetch(`/ostan/get-all/${id}`, {
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                method: "GET"
            }).then(response => response.json())
                .then(data => {
                    $("#editOstanPersonnel").empty();
                    $("#editOstanPersonnel").append('<option value="">انتخاب کنید</option>');
                    $.each(data.status.ostans, function (key, value){
                        $("#editOstanPersonnel").append(`<option value="${value.ostan.id}">${value.ostan.name}</option>`);
                    })
                })
                .catch(error => {
                    return {
                        'Error:': error,
                        'statusText:': error.statusText,
                        'status:': error.status
                    }
                });
        })
    }

    //------------ get country search ---------//
    async function getAllCountries() {
        let result = await getData("/country/getall",{ "Accept": "application/json", "X-Requested-With": "XMLHttpRequest"});
        $("#searchCountry").empty();
        $("#searchCountry").append('<option value="">انتخاب کنید</option>');

        $.each(result.countries, function (key,value) {
            $("#searchCountry").append(`<option value="${value.country.id}">${value.country.name}</option>`)
        })
    }

    //------------ get ostan search ---------//
    function getAllOstanes() {
        $("#searchCountry").on("change", async function (){
            let countryId = $("#searchCountry option:selected").val();
            let result = await getData(`/ostan/get-all/${countryId}`,{ "Accept": "application/json", "X-Requested-With": "XMLHttpRequest"});
            console.log(result.status.ostans);
            $("#searchOstan").empty();
            $("#searchOstan").append('<option value="">انتخاب کنید</option>');
            $.each(result.status.ostans, function (key,value) {
                $("#searchOstan").append(`<option value="${value.ostan.id}">${value.ostan.name}</option>`)
            })
        })
    }

    //------------ get city search -----------//
    async function getAllCities() {
        $("#searchOstan").on("change", async function (){
            let countryId = $("#searchCountry option:selected").val();
            let ostanId = $("#searchOstan option:selected").val();
            console.log(ostanId);
            let result = await getData(`/city/get-all/${countryId}/${ostanId}`,{ "Accept": "application/json", "X-Requested-With": "XMLHttpRequest"});
            console.log(result);
            $("#searchCity").empty();
            $("#searchCity").append('<option value="">انتخاب کنید</option>');
            $.each(result.status.cities, function (key,value) {
                $("#searchCity").append(`<option value="${value.city.id}">${value.city.name}</option>`)
            })
        })
    }

    //-------------- change Button ------------//
    function changeDeleteRestoreButton(fromElementName, toElementName, personnelListId){

        let tableRow= $(document).find("#myTablePersonnelList").find(`tr#${personnelListId}`);

        let restoreBtn = `<button class="btn btn-sm btn-warning ml-2 mt-1 restorePersonnelList" data-target="#restorePersonnelList"
                                                                 data-toggle="modal" data-id="${personnelListId}">
                                                           <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
                                                                 data-placement="top" title="بازیابی"></i>
                                                         </button>`;
        let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 mt-1 deletePersonnelList" data-target="#deletePersonnelList"
                                                                   data-toggle="modal" data-id="${personnelListId}">
                                                        <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                               data-placement="top" title="حذف"></i>
                                                      </button>`;
        $("#myTablePersonnelList")
            .fadeOut(500,function(){
                tableRow
                    .find(`#${fromElementName}`)
                    .replaceWith(`.${toElementName == 'restorePersonnelList' ? restoreBtn : deleteBtn }`);

                //manage delete-at column to empty or currentTime
                tableRow.find(".deleteTime").html(`${toElementName == 'restorePersonnelList' ? getCurrentData() : '' }`)
            })

            .fadeIn(500);
    }

    //--------------- updateDataTable --------------//
    function updateDatatable(receivedData)
    {
        if(receivedData == "notFound"){
            receivedData == [];
        }
        myTablePersonnelList.destroy();
        myTablePersonnelList = $('#myTablePersonnelList').DataTable({
              data: receivedData,
              "language": {
                        "emptyTable": "هیچ داده ای برای نمایش وجود ندارد",
                        "info": "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
                        "infoEmpty": "نمایش 0 تا 0 از 0 آیتم",
                        "zeroRecords": "داده مشابهی پیدا نشد"
                    },
               "columnDefs": [
                        {
                            "name": "rowcount",
                            "targets": 0,
                            "data": null,
                            "searchable": false,
                            "orderable": false,
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            "name": "firstName",
                            "data": "personnel.name",
                            "targets": 1,
                            "className": 'firstName'
                        },
                        {
                            "name": "lastName",
                            "data": "personnel.family",
                            "targets": 2,
                            "className": 'lastName'
                        },
                        {
                            "name": "codeNum",
                            "data": "personnel.ncode",
                            "targets": 3,
                            "className": 'codeNum'},
                        {
                            "name": "cellNum",
                            "data": "personnel.mobile",
                            "targets": 4,
                            "className": 'cellNum'},
                        {
                            "name": "city",
                            "data": "personnel.city.name",
                            "targets": 5,
                            "className": 'city'},
                        {
                            "name": "statusPersonnel",
                            "data": "personnel.mobile",
                            "targets": 6,
                            "className": 'statusPersonnel'},
                        {
                            "name": "insertTime",
                            "data": "personnel.created_at",
                            "targets": 7,
                            "className": 'insertTime'},
                        {
                            "name": "deleteTime",
                            "data": "personnel.deleted_at",
                            "targets": 8,
                            "className": 'deleteTime'},
                        {
                            "name": "operation",
                            "targets": 9,
                            "className": 'operation',
                            "render": function(data,type,row,meta){

                                let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 mt-1 deletePersonnelList" data-target="#deletePersonnelList"
                                                                   data-toggle="modal" data-id="${row["personnel"]["id"]}">
                                                        <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                                               data-placement="top" title="حذف"></i>
                                                      </button>`;

                                let restoreBtn = `<button class="btn btn-sm btn-warning ml-2 mt-1 restorePersonnelList" data-target="#restorePersonnelList"
                                                                 data-toggle="modal" data-id="${row["personnel"]["id"]}">
                                                           <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
                                                                 data-placement="top" title="بازیابی"></i>
                                                         </button>`;
                                return `
                                   <td>
                                        ${row.personnel.deleted_at!=null ? restoreBtn : deleteBtn}

                                                <button class="btn btn-sm btn-warning ml-2 mt-1 editPersonnelList" id="editPersonnelList"
                                                        data-target="#editPersonnelModal"
                                                        data-toggle="modal" data-id="${row["personnel"]["id"]}" data-recordid="${row["personnel"]["id"]}">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1 showPersonnelList" id="showPersonnelList"
                                                        data-target="#showPersonnelModal"
                                                        data-toggle="modal" data-id="${row["personnel"]["id"]}" data-recordid="${row["personnel"]["id"]}">
                                                    <i class="icon-eye" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1">
                                                    <a href=/addrsperonnel">
                                                        <i class="icon-directions" aria-hidden="true"
                                                           data-toggle="tooltip "
                                                           data-placement="top"
                                                           title="ادرس ها"></i></a>
                                                </button>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1"><a
                                                        href="/personnelcontacts">
                                                        <i class="icon-call-end" aria-hidden="true"
                                                           data-toggle="tooltip "
                                                           data-placement="top"
                                                           title="شماره تماس"></i></a>
                                                </button>
                                                <button class="btn btn-sm btn-success ml-2 mt-1"><a
                                                        href="/personnelbankaccount">
                                                        <i class="icon-basket" aria-hidden="true" data-toggle="tooltip "
                                                           data-placement="top"
                                                           title="اطلاعات بانکی"></i></a>
                                                </button>
                                                <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#semats"
                                                        data-toggle="modal" data-id="${row["personnel"]["id"]}" data-recordid="${row["personnel"]["id"]}">
                                                    <i class="icon-list" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="سمت ها"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1"
                                                        data-target="#uploaddocuments"
                                                        data-toggle="modal" data-id="${row["personnel"]["id"]}" data-recordid="${row["personnel"]["id"]}">
                                                    <i class="icon-cloud-upload" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="آپلود مدارک"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success ml-2 mt-1"><a
                                                        href="/personnelvippermission">
                                                        <i class="fa fa-arrow-circle-left text-center pb-0 mb-0" aria-hidden="true" data-toggle="tooltip " style="color: white"
                                                           data-placement="top"
                                                           title="دسترسی اختصاصی"></i></a>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1"><a
                                                        href="/personnelblockpermission">
                                                        <i class="icon-ban" aria-hidden="true" data-toggle="tooltip " style="color: white"
                                                           data-placement="top"
                                                           title=" سلب دسترسی"></i></a>
                                                </button>
                                            </td>
                                        `;
                            }},
                    ],
                    createdRow: function (row, data, dataIndex) {
                        $(row).addClass('data text-center').attr("id",data.personnel.id);
                    },
                });
    }

}); //end ready document function
