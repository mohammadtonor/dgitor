$(document).ready(function () {


    let myTableAddressPersonal = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#myTableAddressPersonal').on('draw.dt', () => hideLoader());
    getAllAddresses();



    //========================tooltip on dynamically added element========================
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });



    //==========================show address info in edit modal===========================
    $(document).on("click", ".editAddress", async function () {
        let addressId = $(this).attr("data-id");
        $("#editAddresModal").find("#editAddressInfoBtn").attr("data-id", addressId);
        let result = await getData(`/user/address/get-one/${addressId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        console.log(result);

        $("#titleEdit").val(result.status.address.title);
        // $("#cityEdit").val(result.status.city_id);
        $("#postalCodeEdit").val(result.status.address.postal_code);
        $("#addressEdit").val(result.status.address.address);
        getCitiesAndOstans(result.status.ostan.id,result.status.address.city_id);
    })



    //==========================update address info===========================
    $("#editAddressInfoBtn").on("click", async function () {
        let addressId = $("#editAddressInfoBtn").attr("data-id");
        let userId = $("meta[name=user_id]").attr("content");

        let data = {
            "title": $("#titleEdit").val(),
            "postal_code": $("#postalCodeEdit").val(),
            "address": $("#addressEdit").val(),
            "city_id": $("#cityEdit").val(),
            "user_id": userId,
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/user/address/update/${addressId}`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "success") {
            toastr.success(" آدرس با موفقیت به روزرسانی شد!");
            $("#edit-modal").modal('hide');
            $(`tr#${addressId}`).find(".titleUpdate").html($("#titleEdit").val());
            $(`tr#${addressId}`).find(".addressUpdate").html($("#addressEdit").val());
            $(`tr#${addressId}`).find(".postalcodeUpdate").html($("#postalCodeEdit").val());
            $(`tr#${addressId}`).find(".cityUpdate").html($("#cityEdit").val());
            return;
        }
        toastr.error("بروز خطا!");
    });






    //==========================insert address info===========================
    // clear inputs
    $("#insertAddressModal").on("hide.bs.modal", ()=>$(this).find(".inp").val(''));
    $("#insertNewAddress").on("click", function (){
        getAllOstans();
        getAllCities();
    })
    $("#insertAddressBtn").on("click", async function () {
        let userId = $("meta[name=user_id]").attr("content");

        let data = {
            "title": $("#titleInsert").val(),
            "postal_code": $("#postalcodeInsert").val(),
            "address": $("#addressInsert").val(),
            "city_id": $("#cityInsert").val(),
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/user/address/insert/${userId}`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "success") {
            toastr.success(" آدرس با موفقیت ثبت شد!");
            $("#edit-modal").modal('hide');
            getAllAddresses();
            return;
        }
        toastr.error("بروز خطا!");
    });







    //========================== ostans===========================
    async function getAllOstans() {
        let ostanId = $("#ostanInsert option:selected").val();
        console.log(ostanId);
        let result = await getData(`/ostan/get-all/1`,{ "Accept": "application/json", "X-Requested-With": "XMLHttpRequest"});
        console.log(result);
        $("#ostanInsert").empty();
        $("#ostanInsert").append('<option value="">انتخاب کنید</option>');
        $.each(result.status.ostans, function (key,value) {
            $("#ostanInsert").append(`<option value="${value.ostan.id}">${value.ostan.name}</option>`)
        })
    }




    //========================== cities===========================
    function getAllCities() {
        $("#ostanInsert").on("change", async function (){
            let ostanId = $("#ostanInsert option:selected").val();
            console.log(ostanId);
            let result = await getData(`/city/get-all/${ostanId}`,{ "Accept": "application/json", "X-Requested-With": "XMLHttpRequest"});
            console.log(result);
            $("#cityInsert").empty();
            $("#cityInsert").append('<option value="">انتخاب کنید</option>');
            $.each(result.status.cities, function (key,value) {
                $("#cityInsert").append(`<option value="${value.city.id}">${value.city.name}</option>`)
            })
        })
    }







    //==========================show address info in show modal===========================
    $(document).on("click", ".showAddress", async function () {
        let addressId = $(this).attr("data-id");
        let result = await getData(`/user/address/get-one/${addressId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        console.log(result);

        $("#titleShow").val(result.status.address.title);
        $("#postalCodeShow").val(result.status.address.postal_code);
        $("#addressShow").val(result.status.address.address);
        $("#ostanShow").val(result.status.ostan.name);
        $("#cityShow").val(result.status.address.city.name);
    })






    //=====================get cities and ostans=========================
    function getCitiesAndOstans(userOstanId=null,userCityId=null) {

        fetch(`/ostan/get-all/1`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method: "GET"
        }).then(response => response.json())
            .then(data => {
                $("#ostanEdit").empty();
                $("#ostanEdit").append('<option value="">انتخاب کنید</option>');
                $.each(data.status.ostans, function (key, value){
                    $("#ostanEdit").append(`<option value="${value.ostan.id}" ${(value.ostan.id==userOstanId)?"selected":""}>${value.ostan.name}</option>`);
                })

            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });

        let ostanId = $("#ostanEdit option:selected").val();

        fetch(`/city/get-all/${ostanId}`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method: "GET"
        }).then(response => response.json())
            .then(data => {
                $("#cityEdit").empty();
                $("#cityEdit").append('<option value="">انتخاب کنید</option>');
                $.each(data.status.cities, function (key, value){
                    $("#cityEdit").append(`<option value="${value.city.id}" ${(value.city.id==userCityId)?"selected":""}>${value.city.name}</option>`);
                })

            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });



        $("#ostanEdit").on("change",function (){

            let ostanId = $("#ostanEdit option:selected").val();

            fetch(`/city/get-all/${ostanId}`, {
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                method: "GET"
            }).then(response => response.json())
                .then(data => {
                    $("#cityEdit").empty();
                    $("#cityEdit").append('<option value="">انتخاب کنید</option>');
                    $.each(data.status.cities, function (key, value){
                        $("#cityEdit").append(`<option value="${value.city.id}" ${(value.city.id==userCityId)?"selected":""}>${value.city.name}</option>`);
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







    //===========================delete========================
    $(document).on("click",".deleteAddressBtn", function (evt) {
        let addressId = $(this).attr("data-id");
        $("#deleteAddressModal #dodelete").data("recordid", addressId).attr("data-recordid", addressId);
    });
    $("#dodelete").on("click", function () {
        let addressId = $(this).data("recordid");
        fetch(`/user/address/del/${addressId}`,{method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status == "success") {
                    toastr.success(" آدرس با موفقیت حذف شد");
                    changeDeleteRestoreButton("deleteAddressBtn","restoreAddress",addressId);
                    return;
                }
                toastr.error("بروز خطا");
                return;
            })
            .catch(error => toastr.error("بروز خطا"));
    });





    //========================== restore ==========================
    $(document).on("click",".restoreAddress", function(){
        let addressId = $(this).attr("data-id");
        $("#restoremodal").find("#restore-modal-btn").attr("data-recordid",addressId).data("recordid",addressId);
    });
    $("#restore-modal-btn").on("click", function (){
        let addressId = $(this).data("recordid");
        fetch(`/user/address/restore/${addressId}`,{
            method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response=>response.json())
            .then(data=>{
                if(data.status=="success")
                {
                    toastr.success(" آدرس با موفقیت بازیابی شد.");
                    changeDeleteRestoreButton("restoreAddress","deleteAddressBtn",addressId);
                    return;
                }
                else{
                    toastr.error("بروز خطا در بازیابی ویژگی ");
                }
            })
        // .catch(error => toastr.error("بروز خطا"));
    });




//===========================change delete restore btn=========================
    function changeDeleteRestoreButton(fromElementName,toElementName,customerId)
    {
        let tableRow = $(document).find("#myTableAddressPersonal").find(`tr#${customerId}`);
        let restoreBtn = `<button data-id="${customerId}" class="btn btn-sm btn-warning ml-2 restoreAddress"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button data-id="${customerId}" class="btn btn-sm btn-danger ml-2 deleteAddressBtn"
                                    data-target="#deleteAddressModal" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;


        $("#myTableAddressPersonal")
            .fadeOut(500, function(){
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'restoreAddress' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deletedAtUpdate").html(`${toElementName == 'restoreAddress' ? getCurrentDate() : '' }`);
            })
            .fadeIn(500);
    }







//========================== custom functions =========================

    function updateDataTable(receivedData) {

        if (myTableAddressPersonal != null)
            myTableAddressPersonal.destroy();
        myTableAddressPersonal = $('#myTableAddressPersonal').DataTable({
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
                    "name": "titleUpdate",
                    "data": "addr.title",
                    "targets": 1,
                    "className": 'titleUpdate'
                },
                {
                    "name": "addressUpdate",
                    "data": "addr.address",
                    "targets": 2,
                    "className": 'addressUpdate'
                },
                {
                    "name": "postalcodeUpdate",
                    "data": "addr.postal_code",
                    "targets": 3,
                    "className": 'postalcodeUpdate'
                },
                {
                    "name": "cityUpdate",
                    "data": "addr.city.name",
                    "targets": 4,
                    "className": 'cityUpdate'
                },
                {
                    "name": "createdAtUpdate",
                    "data": "addr.created_at",
                    "targets": 5,
                    "className": 'createdAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.addr.created_at!=null) ? convertMiladiDateToShamsi(`${row.addr.created_at}`) : null;
                    }},
                {
                    "name": "deletedAtUpdate",
                    "data": "addr.deleted_at",
                    "targets": 6,
                    "className": 'deletedAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.addr.deleted_at!=null) ? convertMiladiDateToShamsi(`${row.addr.deleted_at}`) : null;
                    }},
                {
                    "name": "operation",
                    "targets": 7,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button data-id="${row.addr.id}" class="btn btn-sm btn-danger ml-2 deleteAddressBtn"
                                    data-target="#deleteAddressModal" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;

                        let restoreBtn = `<button data-id="${row.addr.id}" class="btn btn-sm btn-warning ml-2 restoreAddress"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;


                        return `

                                          <td class="operation">
                                            ${row.deleted_at != null ? restoreBtn : deleteBtn}
                                                <button data-id="${row.addr.id}" class="btn btn-sm btn-info ml-2 editAddress"
                                                        data-target="#editAddresModal"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                </button>
                                                <button data-id="${row.addr.id}" class="btn btn-sm btn-primary ml-2 showAddress"
                                                        data-target="#showAddresModal"
                                                        data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="نمایش"></i>
                                                </button>
                                            </td>
                                        `;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center').attr("id", data.addr.id);
            },
        });
    }

    async function getAllAddresses() {
        let userId = $("meta[name=user_id]").attr("content");
        let result = await getData(`/user/address/get-all/${userId}`,
            {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        console.log(result);
        if (catchFetch(result)) return;
        // hideLoader();
        if (result.status !== "notFound") {
            console.log(result);
            $("#addressCount").html(result.count);
            updateDataTable(result.address);
        }
    }



//=========================convert miladi date to shamsi=========================
    function convertMiladiDateToShamsi (mydate){
        let weekDayFa = moment(mydate).locale('fa').format('dddd');
        let dayNumberFa = moment(mydate).locale('fa').format('DD');
        let monthNameFa = moment(mydate).locale('fa').format('MMMM');
        let yearNumberFa = moment(mydate).locale('fa').format('YY');

        let userBirthday = weekDayFa+","+dayNumberFa+monthNameFa+yearNumberFa;

        return userBirthday;
    }



    function getCurrentDate() {
        const m = moment();
        m.locale('fa');
        return m.format('DD  MMMM  YYYY ');
    }


    async function getData(url, headers) {
        try {
            let response = await fetch(url, {headers: headers, method: "GET"});
            return response.json();
        } catch (err) {
            hideLoader();  // if loader is shown, hide it.
            return {"status": "network error"};
        }
    }


    async function postData(url, headers, data, stringifyBody = true) {
        try {
            let response = await fetch(url, {
                headers: headers, method: "POST", body: stringifyBody ? JSON.stringify(data) : data
            });
            return response.json();
        } catch (err) {
            hideLoader(); // if loader is shown, hide it.
            return {"status": "network error", "err": err};
        }
    }

    function catchFetch(result, err) {
        if (result.status == "network error") {
            toastr.error("بروز خطا در شبکه");
            hideLoader();
            return true;
        }
        return false;
    }



})//end of document ready



