$(document).ready(function () {

    //=========================== getAllPersonnelPhoneNumber =======================//

    let myTablePersonnelPhoneNumber = null;

    $('#myTablePersonnelPhoneNumber').on('draw.dt', () => hideLoader());
    getAllPersonnelPhoneNumber();


    //=========================== deletePersonnelPhoneNumber =======================//
    $(document).on("click",".deletePhoneNumberBtn",function(evt){

        let PhoneNumberId = $(this).closest("tr").attr("data-id");

        $("#deletePhoneNumberModal #doDeleteModal").data("recordid",PhoneNumberId).attr("data-recordid",PhoneNumberId);
    });

    $("#doDeleteModal").on("click",async function(){
        let PhoneNumberId = $(this).attr("data-recordid");

        fetch(`/user/phone/del/${PhoneNumberId}`,{

            headers: {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type": "application/json"
            },
            method:"GET"
        })
            .then(response=>response.json())
            .then(data=>{
                if(data.status == "success"){
                    toastr.success(" با موفقیت حذف شد");

                    changeDeleteRestoreButton("deletePhoneNumberBtn","restorePhoneNumberBtn",PhoneNumberId);
                    getAllPersonnelPhoneNumber(data.tells);
                }

                else if(data.status == "failed"){
                    toastr.error(" عدم حذف این شماره تماس");
                }

                else{
                    toastr.error("بروز خطا درحذف این شماره تماس ");
                }
            })

    });

    //============================ restorePersonnelPhoneNumber =======================//
    $(document).on("click",".restorePhoneNumberBtn",function (evt){
        let PhoneNumberId = $(this).closest("tr").attr("data-id");

        $("#restorePhoneNumberModal #dorestoreModal").data("recordid",PhoneNumberId).attr("data-recordid",PhoneNumberId);
    });

    $("#dorestoreModal").on("click",function(){

        let PhoneNumberId= $(this).data("recordid");

        fetch(`/user/phone/restore/${PhoneNumberId}`,{
            headers: {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type": "application/json"
            },
            method:"GET"
        })
            .then(response=>response.json())
            .then(data=>{
                if(data.status == "success"){
                    toastr.success("اطلاعات با موفقیت بازیابی شد");
                    changeDeleteRestoreButton("#deleteNewPhoneNumberBtn","#restorePhoneNumberBtn",PhoneNumberId);
                    getAllPersonnelPhoneNumber(data.tells);
                    return;
                }

                toastr.error("بروز خطا ر بازیابی اطلاعات");
            })
            .catch(error=>{
                return{
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });
    });
    //============================ insertPersonnelPhoneNumber =========================//
    $("#createNewPhoneNumberModal").on("hide.bs.modal", () => $(this).find(".inp").val(''));

    $("#insertPhoneNumberBtn").on("click",function(){

        $("#createNewPhoneNumberModal").modal("show");
    });

    $("#doNewPersonnelPhoneNumber").on("click",function(){

        let  user_id = $("meta[name=user_id]").attr("content");

        let title = $("#createNewPhoneNumberModal").find("#newTitle").val();
        let number = $("#createNewPhoneNumberModal").find("#newPhone").val();

        let data={

            "title": title,
            "phone": number,
            "user_id":user_id
        };

        fetch(`/user/phone/insert/${user_id}`,{
            method:"POST",
            body:JSON.stringify(data),
            headers: {
                "accept": "application/json",
                "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })

            .then(response=>response.json())
            .then(data=>{
                if(data.status == "success") {
                    toastr.success("ثبت با موفقیت انجام شد...");
                    getAllPersonnelPhoneNumber(data.tells);
                    return;
                }
                if(data.status =="validation-error"){
                    $.each(data.errors, (index, err) => toastr.error(err));
                    return;
                }
                if(data.status == "refused"){
                    toastr.error(" خطا ");
                    return;
                }

            });
    });

    //============================= edit/updatePersonnelPhoneNumber ======================//
    $(document).on("click",".editPhoneNumberBtn",async function(evt){

        let PhoneNumberId = $(this).closest("tr").attr("data-id");

        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await getData(`/user/phone/get-one/${PhoneNumberId}`,headers)
        if(data.status == "notFound"){
            toastr.error("بروز خطا در دریافت ");
            return;
        }

        $("#editPhoneNumberModal").find("#doEditePhoneNumberModal").data("recordid",PhoneNumberId).attr("data-recordid",PhoneNumberId);

        //fill data to edit modal
        $("#editPhoneNumberModal").find("#editPhoneNumberModalTitle").val(data.status.title);
        $("#editPhoneNumberModal").find("#editPhoneNumberModalPhone").val(data.status.phone);


        //show modal
        $("#editPhoneNumberModal").modal("show");
    });


    $("#doEditePhoneNumberModal").on("click",async function(evt){
        let PhoneNumberId = $(this).data("recordid");

        let  user_id = $("meta[name=user_id]").attr("content");

        let title = $("#editPhoneNumberModal").find("#editPhoneNumberModalTitle").val();
        let number = $("#editPhoneNumberModal").find("#editPhoneNumberModalPhone").val();


        let csrfToken = $(document).find("meta[name=csrf_token]").attr("content");
        let TableRowId = $(this).attr("data-recordid");

        let data={
            "title": title,
            "phone": number,
            "user_id":user_id
        };

        let headers={
            "accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        };

        let res = await postData(`/user/phone/update/${PhoneNumberId}`,headers,data);

        if(res.status == "validation-error"){
            $(document).each(data.errors, (index, err) => toastr.error(err));
            return;
        }

        if(res.status == "success"){

            $(document).find(`tr#${TableRowId}`).find(".title").html(title);
            $(document).find(`tr#${TableRowId}`).find(".phoneNumber").html(number);

            //clear all inputs for futur
            $("#doEditePhoneNumberModal").on("hide.bs.modal", () => $(this).find(".inp").val(''));

            $("#doEditePhoneNumberModal").on("click",function (){
                $("#editPhoneNumberModal").find("#editPhoneNumberModalTitle").val("");
                $("#editPhoneNumberModal").find("#editPhoneNumberModalPhone").val("");
            });

            getAllPersonnelPhoneNumber(data.tells);

            toastr.success("ویرایش با موفقیت انجام شد...");
            return;
        }

    });

    //============================= showPersonnelPhoneNumber =============================//
    $(document).on("click",".showPhoneNumberBtn",async function(evt){
        let PhoneNumberId = $(this).closest("tr").attr("data-id");

        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await getData(`/user/phone/get-one/${PhoneNumberId}`,headers)

        if(data.status == "notFound"){
            toastr.error("بروز خطا در دریافت اطلاعات ");
            return;
        }

        //fill data to show modal
        $("#showPhoneNumberModal").find("#showTitle").val(data.status.title);
        $("#showPhoneNumberModal").find("#showPhone").val(data.status.phone);

        //show modal
        $("#showPhoneNumberModal").modal("show");

        toastr.success("نمایش تماس با موفقیت انجام شد...");
    });

    //============================ customFunction =============================//

    //============= getAll =========//

    async function getAllPersonnelPhoneNumber() {

        let  user_id = $("meta[name=user_id]").attr("content");

        let data = await getData(`/user/phone/get-all/${user_id}`, {

            "accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });
        updateDataTable(data.tells);
    }

    async function postData(url, headers, data, stringifyBody = true) {
        let response = await fetch(url, {
            headers: headers,
            method: "POST",
            body: stringifyBody ? JSON.stringify(data) : data
        })
        return response.json();
    }

    async function getData(url, headers) {
        let response = await fetch(url, {
            headers: headers,
            method: "GET"
        });

        return response.json();
    }

    function getCurrentData() {
        const m = moment();
        m.local('fa');
        return m.format('DD MMMM YYYY');

    }

    //============ change Button =========//

    function changeDeleteRestoreButton(fromElementName, toElementName, PhoneNumberId) {

        let tableRow = $(document).find("#myTablePersonnelPhoneNumber").find(`tr#${PhoneNumberId}`);

        let restoreBtn =
            `<button type="button" class="btn btn-sm btn-info ml-2 mt-1 restorePhoneNumberBtn" data-target="#restorePhoneNumberModal"
                     data-toggle="modal" data-id="${PhoneNumberId}" id="restorePhoneNumberBtn">
                <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
                    data-placement="top" title="restore"></i>
            </button>`;

        let deleteBtn =
            `<button type="button" class="btn btn-sm btn-danger ml-2 mt-1 deletePhoneNumberBtn" data-target="#deletePhoneNumberModal"
                     data-toggle="modal" data-id="${PhoneNumberId}" id="deletePhoneNumberBtn">
               <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                    data-placement="top" title="حذف"></i>
            </button> `;


        $("#myTableAddressPersonal")
            .fadeOut(500, function () {
                tableRow
                    .find(`#${fromElementName}`)
                    .replaceWith(`.${toElementName == 'restorePhoneNumberBtn' ? restoreBtn : deleteBtn}`);

                //manage deleteAt column to empty value or current value
                tableRow.find(".deletedAt").html(`${toElementName == 'restorePhoneNumberBtn' ? getCurrentData() : ''}`);
            })
            .fadeIn(500);


    } //end changeBtn

    //========= updateDataTable ============//

    async function updateDataTable(receivedData) {

        if (myTablePersonnelPhoneNumber != null)
            myTablePersonnelPhoneNumber.destroy();

        myTablePersonnelPhoneNumber = $('#myTablePersonnelPhoneNumber').DataTable({
            data: receivedData,
            "language": {
                "emptyTable": "هیچ داده ای برای نمایش وجود ندارد",
                "info": "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
                "infoEmpty": "نمایش 0 تا 0 از 0 آیتم",
                "infoFiltered": "(فیلتر شده از جمعا _MAX_ ایتم)",
                "zeroRecords": "داده مشابهی پیدا نشد",
            },
            "columnDefs": [
                {
                    "name": "rowcount",
                    "targets": 0,
                    "data": null,
                    "className": 'rowcount',
                    "searchable": false,
                    "orderable": false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "name": "title",
                    "data": "title",
                    "targets": 1,
                    "className": 'title'
                },
                {
                    "name": "phoneNumber",
                    "data": "phone",
                    "targets": 2,
                    "className": 'phoneNumber'
                },
                {
                    "name": "created_at",
                    "data": "created_at",
                    "targets": 3,
                    "className": '' +
                        ''
                },
                {
                    "name": "deleted_at",
                    "data":"deleted_at",
                    "targets": 4,
                    "className": 'deleted_at'
                },
                {
                    "name": "operation",
                    "targets": 5,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let restoreBtn =
                            `<button type="button" class="btn btn-sm btn-info ml-2 mt-1 restorePhoneNumberBtn" data-target="#restorePhoneNumberModal"
                                     data-toggle="modal" data-id="${row.id}" id="restorePhoneNumberBtn">
                                  <i class="icon-loop text-white " aria-hidden="true" data-toggle="tooltip" data-placement="top" title="restore"></i>
                            </button>`;

                        let deleteBtn =
                            `<button type="button" class="btn btn-sm btn-danger ml-2 mt-1 deletePhoneNumberBtn" data-target="#deletePhoneNumberModal"
                                       data-toggle="modal" data-id="${row.id}" id="deletePhoneNumberBtn">
                                  <i class="icon-trash text-white" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>
                             </button> `;

                        return `
                            <td class="operation">

                              ${row.deleted_at != null ? restoreBtn : deleteBtn}

                                <button class="btn btn-sm btn-info ml-2 mt-1 editPhoneNumberBtn" data-target="#editPhoneNumberModal" data-toggle="modal" id="editPhoneNumberBtn"
                                   data-id="${row.id}" data-recordid="${row.id}" >
                                    <i class="icon-pencil text-white" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                </button>
                                <button class="btn btn-sm btn-primary ml-2 mt-1 showPhoneNumberBtn" data-target="#showPhoneNumberModal" data-toggle="modal" id="showPhoneNumberBtn"
                                      data-id="${row.id}" data-recordid="${row.id}" >
                                    <i class="icon-eye text-white" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="نمایش"></i>
                                </button>
                            </td>
                             `;
                    } },
            ],

            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center').data("id",data.id).attr("data-id",data.id);
            },

        });
    }


});//end document
