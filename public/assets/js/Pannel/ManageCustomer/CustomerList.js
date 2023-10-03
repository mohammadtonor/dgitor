$(document).ready(function () {

    let tableCustomers = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableCustomers').on('draw.dt', () => hideLoader());
    getAllCustomers();



    //========================tooltip on dynamically added element========================
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });



    //==========================show customer info in edit modal===========================
    $(document).on("click", ".editCustomer", async function () {
        let customerId = $(this).attr("data-id");
        $("#editCustomer").find("#editCustomerInfoBtn").attr("data-id", customerId);
        let result = await getData(`/customer/get/${customerId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        console.log(result);
        if(result.status.gender=="female"){
            $("#genderEdit").find("#female").attr("selected","selected");
        }else{
            $("#genderEdit").find("#male").attr("selected","selected");
        }
        $("#firstNameEdit").val(result.status.name);
        $("#lastNameEdit").val(result.status.family);
        $("#ncodeEdit").val(result.status.ncode);
        $("#birthdayEdit").val(result.status.birthday);
        $("#phoneEdit").val(result.status.mobile);
        $("#emailEdit").val(result.status.email);
        getCitiesAndOstans(result.status.ostan_id,result.status.city_id);
    })



    //==========================update customer info===========================
    $("#editCustomerInfoBtn").on("click", async function () {
        let customerId = $("#editCustomerInfoBtn").attr("data-id");

        let data = {
            "name": $("#firstNameEdit").val(),
            "family": $("#lastNameEdit").val(),
            "gender": $("#genderEdit").val(),
            "ncode": $("#ncodeEdit").val(),
            "birthday": $("#birthdayEdit").val(),
            "mobile": $("#phoneEdit").val(),
            "email": $("#emailEdit").val(),
            "ostan_id": $("#ostanEdit").val(),
            "city_id": $("#cityEdit").val(),
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/customer/update/${customerId}`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "success") {
            toastr.success(" مشتری با موفقیت به روزرسانی شد!");
            $("#edit-modal").modal('hide');
            $(`tr#${customerId}`).find(".nameUpdate").html($("#firstNameEdit").val());
            $(`tr#${customerId}`).find(".familyUpdate").html($("#lastNameEdit").val());
            $(`tr#${customerId}`).find(".ncodeUpdate").html($("#ncodeEdit").val());
            $(`tr#${customerId}`).find(".phoneUpdate").html($("#phoneEdit").val());
            $(`tr#${customerId}`).find(".cityUpdate").html($("#cityEdit:selected").val());
            return;
        }
        toastr.error("بروز خطا!");
    });



    //==========================show customer info in show modal===========================
    $(document).on("click", ".showCustomer", async function () {
        let customerId = $(this).attr("data-id");
        let result = await getData(`/customer/get/${customerId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        console.log(result);
        if(result.status.gender=="female"){
            $("#genderEdit").find("#female").attr("selected","selected");
        }else{
            $("#genderEdit").find("#male").attr("selected","selected");
        }
        $("#nameShow").val(result.status.name);
        $("#familyShow").val(result.status.family);
        $("#genderShow").val(result.status.gender);
        $("#ncodeShow").val(result.status.ncode);
        $("#birthdayShow").val(result.status.birthday);
        $("#mobileShow").val(result.status.mobile);
        $("#emailShow").val(result.status.email);
        $("#ostanShow").val(result.status.ostan.name);
        $("#cityShow").val(result.status.city.name);
    })










//=======================search filter data table=====================
    function updateDataTableFiltered(receivedData) {
        tableCustomers.destroy();
        tableCustomers = $('#tableCustomers').DataTable({
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
                    "name": "nameUpdate",
                    "data": "name",
                    "targets": 1,
                    "className": 'nameUpdate'
                },
                {
                    "name": "familyUpdate",
                    "data": "family",
                    "targets": 2,
                    "className": 'familyUpdate'
                },
                {
                    "name": "ncodeUpdate",
                    "data": "ncode",
                    "targets": 3,
                    "className": 'ncodeUpdate'
                },
                {
                    "name": "phoneUpdate",
                    "data": "mobile",
                    "targets": 4,
                    "className": 'phoneUpdate',
                },
                {
                    "name": "cityUpdate",
                    "data": "city.name",
                    "targets": 5,
                    "className": 'cityUpdate',
                },
                {
                    "name": "createdAtUpdate",
                    "data": "created_at",
                    "targets": 6,
                    "className": 'createdAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.created_at != null) ? convertMiladiDateToShamsi(`${row.created_at}`) : null;
                    }
                },
                {
                    "name": "deletedAtUpdate",
                    "data": "deleted_at",
                    "targets": 7,
                    "className": 'deletedAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.deleted_at != null) ? convertMiladiDateToShamsi(`${row.deleted_at}`) : null;
                    }
                },
                {
                    "name": "exchangeCountUpdate",
                    "data": "exchange_count",
                    "targets": 8,
                    "className": 'exchangeCountUpdate'
                },
                {
                    "name": "karshenasiCountUpdate",
                    "data": "karshenasi_count",
                    "targets": 9,
                    "className": 'karshenasiCountUpdate'
                },
                {
                    "name": "operation",
                    "targets": 10,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button data-id="${row.id}" class="btn btn-sm btn-danger ml-2 deleteCustomerBtn"
                                    data-target="#deleteCustomer" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;

                        let restoreBtn = `<button data-id="${row.id}" class="btn btn-sm btn-warning ml-2 restoreCustomer"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;


                        return `

                                          <td class="operation">
                                            ${row.deleted_at != null ? restoreBtn : deleteBtn}
                                              <button class="btn btn-sm btn-info ml-2 editCustomer" data-id="${row.id}" data-target="#editCustomer"
                                                        data-toggle="modal">
                                                    <i class="icon-note" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button data-id="${row.id}" class="btn btn-sm btn-warning ml-2 showCustomer" data-target="#showCustomer"
                                                        data-toggle="modal">
                                                    <i class="icon-film" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2">
                                                    <a href="/user/address/page/${row.id}">
                                                        <i class="icon-location-pin text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="آدرس ها"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-secondary ml-2">
                                                    <a href="/user/phone/page/${row.id}">
                                                        <i class="icon-phone text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="شماره تماس"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2">
                                                    <a href="/user/bank/page/${row.id}">
                                                        <i class="icon-paypal text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="اطلاعات بانکی"></i>
                                                    </a>
                                                </button>
                                            </td>
                                        `;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center').attr("id", data.id);
            },
        });
    }






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
    $(document).on("click",".deleteCustomerBtn", function (evt) {
        let customerId = $(this).attr("data-id");
        $("#deleteCustomer #dodelete").data("recordid", customerId).attr("data-recordid", customerId);
    });
    $("#dodelete").on("click", function () {
        let customerId = $(this).data("recordid");
        fetch(`/customer/del/${customerId}`,{method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status == "success") {
                    toastr.success(" مشتری با موفقیت حذف شد");
                    changeDeleteRestoreButton("deleteCustomerBtn","restoreCustomer",customerId);
                    return;
                }
                toastr.error("بروز خطا");
                return;
            })
            .catch(error => toastr.error("بروز خطا"));
    });





    //========================== restore ==========================
    $(document).on("click",".restoreCustomer", function(){
        let customerId = $(this).attr("data-id");
        $("#restoremodal").find("#restore-modal-btn").attr("data-recordid",customerId).data("recordid",customerId);
    });
    $("#restore-modal-btn").on("click", function (){
        let customerId = $(this).data("recordid");
        fetch(`/customer/restore/${customerId}`,{
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
                    toastr.success(" مشتری با موفقیت بازیابی شد.");
                    changeDeleteRestoreButton("restoreCustomer","deleteCustomerBtn",customerId);
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
        let tableRow = $(document).find("#tableCustomers").find(`tr#${customerId}`);
        let restoreBtn = `<button data-id="${customerId}" class="btn btn-sm btn-warning ml-2 restoreCustomer"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button data-id="${customerId}" class="btn btn-sm btn-danger ml-2 deleteCustomerBtn"
                                    data-target="#deleteCustomer" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;


        $("#tableCustomers")
            .fadeOut(500, function(){
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'restoreCustomer' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deletedAtUpdate").html(`${toElementName == 'restoreCustomer' ? getCurrentDate() : '' }`);
            })
            .fadeIn(500);
    }







//========================== custom functions =========================

    function updateDataTable(receivedData) {

        if (tableCustomers != null)
            tableCustomers.destroy();
            tableCustomers = $('#tableCustomers').DataTable({
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
                    "name": "nameUpdate",
                    "data": "customer.name",
                    "targets": 1,
                    "className": 'nameUpdate'
                },
                {
                    "name": "familyUpdate",
                    "data": "customer.family",
                    "targets": 2,
                    "className": 'familyUpdate'
                },
                {
                    "name": "ncodeUpdate",
                    "data": "customer.ncode",
                    "targets": 3,
                    "className": 'ncodeUpdate'
                },
                {
                    "name": "phoneUpdate",
                    "data": "customer.mobile",
                    "targets": 4,
                    "className": 'phoneUpdate',
                },
                {
                    "name": "cityUpdate",
                    "data": "customer.city.name",
                    "targets": 5,
                    "className": 'cityUpdate',
                },
                {
                    "name": "createdAtUpdate",
                    "data": "customer.created_at",
                    "targets": 6,
                    "className": 'createdAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.customer.created_at!=null) ? convertMiladiDateToShamsi(`${row.customer.created_at}`) : null;
                    }},
                {
                    "name": "deletedAtUpdate",
                    "data": "customer.deleted_at",
                    "targets": 7,
                    "className": 'deletedAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.customer.deleted_at!=null) ? convertMiladiDateToShamsi(`${row.customer.deleted_at}`) : null;
                    }},
                {
                    "name": "exchangeCountUpdate",
                    "data": "exchange_count",
                    "targets": 8,
                    "className": 'exchangeCountUpdate'
                },
                {
                    "name": "karshenasiCountUpdate",
                    "data": "karshenasi_count",
                    "targets": 9,
                    "className": 'karshenasiCountUpdate'
                },
                {
                    "name": "operation",
                    "targets": 10,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button data-id="${row.customer.id}" class="btn btn-sm btn-danger ml-2 deleteCustomerBtn"
                                    data-target="#deleteCustomer" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;

                        let restoreBtn = `<button data-id="${row.customer.id}" class="btn btn-sm btn-warning ml-2 restoreCustomer"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;


                        return `

                                          <td class="operation">
                                            ${row.customer.deleted_at != null ? restoreBtn : deleteBtn}
                                              <button class="btn btn-sm btn-info ml-2 editCustomer" data-id="${row.customer.id}" data-target="#editCustomer"
                                                        data-toggle="modal">
                                                    <i class="icon-note" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button data-id="${row.customer.id}" class="btn btn-sm btn-warning ml-2 showCustomer" data-target="#showCustomer"
                                                        data-toggle="modal">
                                                    <i class="icon-film" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2">
                                                    <a href="/user/address/page/${row.customer.id}">
                                                        <i class="icon-location-pin text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="آدرس ها"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-secondary ml-2">
                                                    <a href="/user/phone/page/${row.customer.id}">
                                                        <i class="icon-phone text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="شماره تماس"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2">
                                                    <a href="/user/bank/page/${row.customer.id}">
                                                        <i class="icon-paypal text-white" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="اطلاعات بانکی"></i>
                                                    </a>
                                                </button>
                                            </td>
                                        `;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center').attr("id", data.customer.id);
            },
        });
    }

    async function getAllCustomers() {
        let result = await getData(`/customer/getall/data`,
            {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        console.log(result);
        if (catchFetch(result)) return;
        // hideLoader();
        if (result.status !== "notFound") {
            console.log(result);
            $("#attrCount").html(result.status.count);
            updateDataTable(result.status.customers);
        }
    }




//=======================search==========================
    $("#searchBtn").on("click", async function () {

        let data = {
            "name": $("#nameSearch").val(),
            "family": $("#familySearch").val(),
            "mobile": $("#mobileSearch").val(),
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/customer/search`, headers, data);
        console.log(result);
            updateDataTableFiltered(result.status);

    });






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



