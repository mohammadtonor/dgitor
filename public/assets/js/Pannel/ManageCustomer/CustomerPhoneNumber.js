$(document).ready(function () {


    let tableCustomerPhoneNumber = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableCustomerPhoneNumber').on('draw.dt', () => hideLoader());
    getAllPhoneNumbers();



    //========================tooltip on dynamically added element========================
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });



    //==========================show phone info in edit modal===========================
    $(document).on("click", ".editPhone", async function () {
        let phoneId = $(this).attr("data-id");
        $("#editphonenumber").find("#editPhoneInfoBtn").attr("data-id", phoneId);
        let result = await getData(`/user/phone/get-one/${phoneId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        console.log(result);

        $("#titleEdit").val(result.status.title);
        $("#phoneEdit").val(result.status.phone);
    })



    //==========================update phone info===========================
    $("#editPhoneInfoBtn").on("click", async function () {
        let phoneId = $("#editPhoneInfoBtn").attr("data-id");
        let userId = $("meta[name=user_id]").attr("content");

        let data = {
            "title": $("#titleEdit").val(),
            "phone": $("#phoneEdit").val(),
            "user_id": userId,
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/user/phone/update/${phoneId}`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "success") {
            toastr.success(" شماره تماس با موفقیت به روزرسانی شد!");
            $("#edit-modal").modal('hide');
            $(`tr#${phoneId}`).find(".titleUpdate").html($("#titleEdit").val());
            $(`tr#${phoneId}`).find(".phoneUpdate").html($("#phoneEdit").val());
            return;
        }
        toastr.error("بروز خطا!");
    });






    //==========================insert phone info===========================
    // clear inputs
    $("#btncreatenewphonenumber").on("hide.bs.modal", ()=>$(this).find(".inp").val(''));
    $("#insertPhoneBtn").on("click", async function () {
        let userId = $("meta[name=user_id]").attr("content");

        let data = {
            "title": $("#titleInsert").val(),
            "phone": $("#phoneInsert").val(),
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/user/phone/insert/${userId}`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "success") {
            toastr.success(" شماره تماس با موفقیت ثبت شد!");
            $("#edit-modal").modal('hide');
            getAllPhoneNumbers();
            return;
        }
        toastr.error("بروز خطا!");
    });









    //==========================show phone info in show modal===========================
    $(document).on("click", ".showPhone", async function () {
        let phoneId = $(this).attr("data-id");
        let result = await getData(`/user/phone/get-one/${phoneId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        console.log(result);

        $("#titleShow").val(result.status.title);
        $("#phoneShow").val(result.status.phone);
    })








    //===========================delete========================
    $(document).on("click",".deletePhoneBtn", function (evt) {
        let phoneId = $(this).attr("data-id");
        $("#deletephonenumber #dodelete").data("recordid", phoneId).attr("data-recordid", phoneId);
    });
    $("#dodelete").on("click", function () {
        let phoneId = $(this).data("recordid");
        fetch(`/user/phone/del/${phoneId}`,{method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status == "success") {
                    toastr.success(" شماره تماس با موفقیت حذف شد");
                    changeDeleteRestoreButton("deletePhoneBtn","restorePhone",phoneId);
                    return;
                }
                toastr.error("بروز خطا");
                return;
            })
            .catch(error => toastr.error("بروز خطا"));
    });





    //========================== restore ==========================
    $(document).on("click",".restorePhone", function(){
        let phoneId = $(this).attr("data-id");
        $("#restoremodal").find("#restore-modal-btn").attr("data-recordid",phoneId).data("recordid",phoneId);
    });
    $("#restore-modal-btn").on("click", function (){
        let phoneId = $(this).data("recordid");
        fetch(`/user/phone/restore/${phoneId}`,{
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
                    toastr.success(" شماره تماس با موفقیت بازیابی شد.");
                    changeDeleteRestoreButton("restorePhone","deletePhoneBtn",phoneId);
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
        let tableRow = $(document).find("#tableCustomerPhoneNumber").find(`tr#${customerId}`);
        let restoreBtn = `<button data-id="${customerId}" class="btn btn-sm btn-warning ml-2 restorePhone"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button data-id="${customerId}" class="btn btn-sm btn-danger ml-2 deletePhoneBtn"
                                    data-target="#deletephonenumber" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;


        $("#tableCustomerPhoneNumber")
            .fadeOut(500, function(){
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'restorePhone' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deletedAtUpdate").html(`${toElementName == 'restorePhone' ? getCurrentDate() : '' }`);
            })
            .fadeIn(500);
    }







//========================== custom functions =========================

    function updateDataTable(receivedData) {

        if (tableCustomerPhoneNumber != null)
            tableCustomerPhoneNumber.destroy();
        tableCustomerPhoneNumber = $('#tableCustomerPhoneNumber').DataTable({
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
                    "data": "title",
                    "targets": 1,
                    "className": 'titleUpdate'
                },
                {
                    "name": "phoneUpdate",
                    "data": "phone",
                    "targets": 2,
                    "className": 'phoneUpdate'
                },
                {
                    "name": "createdAtUpdate",
                    "data": "created_at",
                    "targets": 3,
                    "className": 'createdAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.created_at!=null) ? convertMiladiDateToShamsi(`${row.created_at}`) : null;
                    }},
                {
                    "name": "deletedAtUpdate",
                    "data": "deleted_at",
                    "targets": 4,
                    "className": 'deletedAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.deleted_at!=null) ? convertMiladiDateToShamsi(`${row.deleted_at}`) : null;
                    }},
                {
                    "name": "operation",
                    "targets": 5,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button data-id="${row.id}" class="btn btn-sm btn-danger ml-2 deletePhoneBtn"
                                    data-target="#deletephonenumber" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;

                        let restoreBtn = `<button data-id="${row.id}" class="btn btn-sm btn-warning ml-2 restorePhone"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;


                        return `

                                          <td class="operation">
                                            ${row.deleted_at != null ? restoreBtn : deleteBtn}
                                                <button data-id="${row.id}" class="btn btn-sm btn-info ml-2 editPhone"
                                                        data-target="#editphonenumber"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button data-id="${row.id}" class="btn btn-sm btn-primary ml-2 showPhone"
                                                        data-target="#showphonenumber"
                                                        data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="نمایش"></i>
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

    async function getAllPhoneNumbers() {
        let userId = $("meta[name=user_id]").attr("content");
        let result = await getData(`/user/phone/get-all/${userId}`,
            {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        console.log(result);
        if (catchFetch(result)) return;
        // hideLoader();
        if (result.status !== "notFound") {
            console.log(result);
            $("#phoneCount").html(result.count);
            updateDataTable(result.tells);
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



