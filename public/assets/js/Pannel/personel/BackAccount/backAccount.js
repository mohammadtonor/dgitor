$(document).ready(function () {

    //=========================== getAllPersonnelBankAccountInfo =======================//

    let myTablePersonnelBankAccountInfo = null;

    $('#myTablePersonnelBankAccountInfo').on('draw.dt', () => hideLoader());
    getAllPersonnelBankAccountInfo();


    //=========================== deletePersonnelBankAccountInfo =======================//
    $(document).on("click",".deleteBankAccountInfoBtn",function(evt){

        // let BankAccountInfoId = $(this).closest("tr").attr("data-id");
        let BankAccountInfoId = $(this).attr("data-id");
        console.log(BankAccountInfoId + "#####");

        $("#deleteBankInfoModal #doDeleteModal").data("recordid",BankAccountInfoId).attr("data-recordid",BankAccountInfoId);
    });

    $("#doDeleteModal").on("click",async function(){
        let BankAccountInfoId = $(this).attr("data-recordid");

        fetch(`/user/bank/del/${BankAccountInfoId}`,{

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

                    changeDeleteRestoreButton("deletePhoneNumberBtn","restorePhoneNumberBtn",BankAccountInfoId);
                    getAllPersonnelBankAccountInfo(data.bank_accounts);
                }

                else if(data.status == "failed"){
                    toastr.error(" عدم حذف این شماره حساب");
                }

                else{
                    toastr.error("بروز خطا درحذف این شماره حساب ");
                }
            })

    });

    //============================ restorePersonnelBankAccountInfo =======================//
    $(document).on("click",".restoreBankAccountInfoBtn",function (evt){

        let BankAccountInfoId = $(this).attr("data-id");

        // let BankAccountInfoId= $(this).data("recordid");

        console.log(BankAccountInfoId+"@@@@@@@");

        $("#restoreBankInfoModal #dorestoreModal").data("recordid",BankAccountInfoId).attr("data-recordid",BankAccountInfoId);
    });

    $("#dorestoreModal").on("click",function(){

        let BankAccountInfoId= $(this).data("recordid");

        fetch(`/user/bank/restore/${BankAccountInfoId}`,{
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
                    changeDeleteRestoreButton("#deleteBankAccountInfoBtn","#restoreBankAccountInfoBtn",BankAccountInfoId);
                    getAllPersonnelBankAccountInfo(data.bank_accounts);
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
    //============================ insertPersonnelBankAccountInfo =========================//
    $("#createNewBankInfoModal").on("hide.bs.modal", () => $(this).find(".inp").val(''));

    $("#doNewBankInfo").on("click",function(){

        let  user_id = $("meta[name=user_id]").attr("content");

        let bankName = $("#createNewBankInfoModal").find("#bankName").val();
        let bankTitle = $("#createNewBankInfoModal").find("#bankTitle").val();
        let cardNumber = $("#createNewBankInfoModal").find("#cardNumber").val();
        let ShebaNumber = $("#createNewBankInfoModal").find("#shebaNumber").val();


        let data={

            "bank" : bankName,
            "title" : bankTitle,
            "card_number" : cardNumber,
            "sheba" : ShebaNumber,
            "user_id": user_id
        };

        fetch(`/user/bank/insert/${user_id}`,{
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
                    getAllPersonnelBankAccountInfo(data.bank_accounts);
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

    //============================= edit/updatePersonnelBankAccountInfo ======================//
    $(document).on("click",".editBankAccountInfoBtn",async function(evt){

        let BankAccountInfoId = $(this).attr("data-id");

        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await getData(`/user/bank/get-one/${BankAccountInfoId}`,headers)
        if(data.status == "notFound"){
            toastr.error("بروز خطا در دریافت ");
            return;
        }

        $("#editBankInfoModal").find("#doEditeBankInfoModal").data("recordid",BankAccountInfoId).attr("data-recordid",BankAccountInfoId);

        //fill data to edit modal

        $("#editBankInfoModal").find("#editeBankName").val(data.status.bank);
        $("#editBankInfoModal").find("#editeBankTitle").val(data.status.title);
        $("#editBankInfoModal").find("#editeCardNumber").val(data.status.card_number);
        $("#editBankInfoModal").find("#editeShebaNumber").val(data.status.sheba);

        //show modal
        $("#editBankInfoModal").modal("show");
    });


    $("#doEditeBankInfoModal").on("click",async function(evt){
        let BankAccountInfoId = $(this).data("recordid");
        console.log(BankAccountInfoId+"editttttttttttttt");


        let  user_id = $("meta[name=user_id]").attr("content");


        let bankName = $("#editBankInfoModal").find("#editeBankName").val();
        let bankTitle = $("#editBankInfoModal").find("#editeBankTitle").val();
        let cardNumber = $("#editBankInfoModal").find("#editeCardNumber").val();
        let shebaNumber = $("#editBankInfoModal").find("#editeShebaNumber").val();


        let csrfToken = $(document).find("meta[name=csrf_token]").attr("content");
        let TableRowId = $(this).attr("data-recordid");

        let data={
            "bank" : bankName,
            "title" : bankTitle,
            "card_number" : cardNumber,
            "sheba" : shebaNumber,
            "user_id":user_id
        };

        let headers={
            "accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        };

        let res = await postData(`/user/bank/update/${BankAccountInfoId}`,headers,data);

        if(res.status.status == "validation-error"){
            $(document).each(data.errors, (index, err) => toastr.error(err));
            return;
        }

        if(res.status.status == "success"){

            $(document).find(`tr#${TableRowId}`).find(".bankName").html(bankName);
            $(document).find(`tr#${TableRowId}`).find(".bankTitle").html(bankTitle);
            $(document).find(`tr#${TableRowId}`).find(".cardNumber").html(cardNumber);
            $(document).find(`tr#${TableRowId}`).find(".shebaNumber").html(shebaNumber);
            getAllPersonnelBankAccountInfo(data.bank_accounts);

            //clear all inputs for futur
            $("#doEditeBankInfoModal").on("hide.bs.modal", () => $(this).find(".inp").val(''));

            toastr.success("ویرایش با موفقیت انجام شد...");
            return;
        }

        if(res.status.status == "duplicate"){
            toastr.error("حساب تکراری وارد شده است ");
        }


    });

    //============================= showPersonnelBankAccountInfo =============================//
    $(document).on("click",".showBankAccountInfoBtn",async function(evt){
        let BankAccountInfoId = $(this).attr("data-id");

        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await getData(`/user/bank/get-one/${BankAccountInfoId}`,headers)

        if(data.status == "notFound"){
            toastr.error("بروز خطا در دریافت اطلاعات ");
            return;
        }

        //fill data to show modal
        $("#showBankInfoModal").find("#showBankName").val(data.status.bank);
        $("#showBankInfoModal").find("#showBankTitle").val(data.status.title);
        $("#showBankInfoModal").find("#showCardNumber").val(data.status.card_number);
        $("#showBankInfoModal").find("#showShebaNumber").val(data.status.sheba);

        toastr.success("نمایش تماس با موفقیت انجام شد...");

        //show modal
        $("#showBankInfoModal").modal("show");
    });

    //============================ customFunction =============================//

    //============= getAll =========//

    async function getAllPersonnelBankAccountInfo() {

        let  user_id = $("meta[name=user_id]").attr("content");

        let data = await getData(`/user/bank/get-all/${user_id}`, {

            "accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });
        updateDataTable(data.bank_accounts);
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

        let tableRow = $(document).find("#myTablePersonnelBankAccountInfo").find(`tr#${PhoneNumberId}`);

        let restoreBtn =
            `<button type="button" class="btn btn-sm btn-info ml-2 mt-1 restoreBankAccountInfoBtn" data-target="#restorePhoneNumberModal"
                     data-toggle="modal" data-id="${PhoneNumberId}" id="restoreBankAccountInfoBtn">
                <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
                    data-placement="top" title="restore"></i>
            </button>`;

        let deleteBtn =
            `<button type="button" class="btn btn-sm btn-danger ml-2 mt-1 deleteBankAccountInfoBtn" data-target="#deletePhoneNumberModal"
                     data-toggle="modal" data-id="${PhoneNumberId}" id="deleteBankAccountInfoBtn">
               <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                    data-placement="top" title="حذف"></i>
            </button> `;


        $("#myTableAddressPersonal")
            .fadeOut(500, function () {
                tableRow
                    .find(`#${fromElementName}`)
                    .replaceWith(`.${toElementName == 'restoreBankAccountInfoBtn' ? restoreBtn : deleteBtn}`);

                //manage deleteAt column to empty value or current value
                tableRow.find(".deletedAt").html(`${toElementName == 'restoreBankAccountInfoBtn' ? getCurrentData() : ''}`);
            })
            .fadeIn(500);


    } //end changeBtn

    //========= updateDataTable ============//

    async function updateDataTable(receivedData) {

        if (myTablePersonnelBankAccountInfo != null)
            myTablePersonnelBankAccountInfo.destroy();

        myTablePersonnelBankAccountInfo = $('#myTablePersonnelBankAccountInfo').DataTable({
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
                    "name": "bankName",
                    "data": "bank",
                    "targets": 1,
                    "className": 'bankName'
                },
                {
                    "name": "bankTitle",
                    "data": "title",
                    "targets": 2,
                    "className": 'bankTitle'
                },
                {
                    "name": "cardNumber",
                    "data": "card_number",
                    "targets": 3,
                    "className": 'cardNumber'
                },
                {
                    "name": "shebaNumber",
                    "data": "sheba",
                    "targets": 4,
                    "className": 'shebaNumber'
                },
                {
                    "name": "created_at",
                    "data": "created_at",
                    "targets": 5,
                    "className": '' +
                        ''
                },
                {
                    "name": "deleted_at",
                    "data":"deleted_at",
                    "targets": 6,
                    "className": 'deleted_at'
                },
                {
                    "name": "operation",
                    "targets": 7,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let restoreBtn =
                            `<button type="button" class="btn btn-sm btn-info ml-2 mt-1 restoreBankAccountInfoBtn" data-target="#restoreBankInfoModal"
                                     data-toggle="modal" data-id="${row.id}" id="restoreBankAccountInfoBtn">
                                  <i class="icon-loop text-white " aria-hidden="true" data-toggle="tooltip" data-placement="top" title="restore"></i>
                            </button>`;

                        let deleteBtn =
                            `<button type="button" class="btn btn-sm btn-danger ml-2 mt-1 deleteBankAccountInfoBtn" data-target="#deleteBankInfoModal"
                                       data-toggle="modal" data-id="${row.id}" id="deleteBankAccountInfoBtn">
                                  <i class="icon-trash text-white" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>
                             </button> `;

                        return `
                            <td class="operation">

                              ${row.deleted_at != null ? restoreBtn : deleteBtn}

                                <button class="btn btn-sm btn-info ml-2 mt-1 editBankAccountInfoBtn" data-target="#editBankInfoModal" data-toggle="modal" id="editBankAccountInfoBtn"
                                   data-id="${row.id}" data-recordid="${row.id}" >
                                    <i class="icon-pencil text-white" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                </button>
                                <button class="btn btn-sm btn-primary ml-2 mt-1 showBankAccountInfoBtn" data-target="#showBankInfoModal" data-toggle="modal" id="showBankAccountInfoBtn"
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
