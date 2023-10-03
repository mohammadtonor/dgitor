$(document).ready(function () {


    let tableBankAccountInfo = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableBankAccountInfo').on('draw.dt', () => hideLoader());
    getAllPhoneNumbers();



    //========================tooltip on dynamically added element========================
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });



    //==========================show bank info in edit modal===========================
    $(document).on("click", ".editBankInfo", async function () {
        let bankId = $(this).attr("data-id");
        $("#editaccount").find("#editBankInfoBtn").attr("data-id", bankId);
        let result = await getData(`/user/bank/get-one/${bankId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        console.log(result);

        $("#bankEdit").val(result.status.bank);
        $("#titleEdit").val(result.status.title);
        $("#cardnumberEdit").val(result.status.card_number);
        $("#shebaEdit").val(result.status.sheba);
    })



    //==========================update bank info===========================
    $("#editBankInfoBtn").on("click", async function () {
        let bankId = $("#editBankInfoBtn").attr("data-id");
        let userId = $("meta[name=user_id]").attr("content");

        let data = {
            "bank": $("#bankEdit").val(),
            "title": $("#titleEdit").val(),
            "card_number": $("#cardnumberEdit").val(),
            "sheba": $("#shebaEdit").val(),
            "user_id": userId,
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/user/bank/update/${bankId}`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status.status == "success") {
            toastr.success(" اطلاعات بانکی با موفقیت به روزرسانی شد!");
            $("#edit-modal").modal('hide');
            $(`tr#${bankId}`).find(".bankUpdate").html($("#bankEdit").val());
            $(`tr#${bankId}`).find(".titleUpdate").html($("#titleEdit").val());
            $(`tr#${bankId}`).find(".cardNumberUpdate").html($("#cardnumberEdit").val());
            $(`tr#${bankId}`).find(".shebaUpdate").html($("#shebaEdit").val());
            return;
        }
        toastr.error("بروز خطا!");
    });






    //==========================insert bank info===========================
    // clear inputs
    $("#btncreatenewbankinfo").on("hide.bs.modal", ()=>$(this).find(".inp").val(''));
    $("#insertBankBtn").on("click", async function () {
        let userId = $("meta[name=user_id]").attr("content");

        let data = {
            "bank": $("#bankInsert").val(),
            "title": $("#titleInsert").val(),
            "card_number": $("#cardnumberInsert").val(),
            "sheba": $("#shebaInsert").val(),
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/user/bank/insert/${userId}`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "success") {
            toastr.success(" اطلاعات بانکی با موفقیت ثبت شد!");
            $("#edit-modal").modal('hide');
            getAllPhoneNumbers();
            return;
        }
        toastr.error("بروز خطا!");
    });









    //==========================show bank info in show modal===========================
    $(document).on("click", ".showBankInfo", async function () {
        let bankId = $(this).attr("data-id");
        let result = await getData(`/user/bank/get-one/${bankId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        console.log(result);

        $("#bankShow").val(result.status.bank);
        $("#titleShow").val(result.status.title);
        $("#cardnumberShow").val(result.status.card_number);
        $("#shebaShow").val(result.status.sheba);
    })








    //===========================delete========================
    $(document).on("click",".deleteBankInfoBtn", function (evt) {
        let bankId = $(this).attr("data-id");
        $("#deleteaccount #dodelete").data("recordid", bankId).attr("data-recordid", bankId);
    });
    $("#dodelete").on("click", function () {
        let bankId = $(this).data("recordid");
        fetch(`/user/bank/del/${bankId}`,{method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status == "success") {
                    toastr.success(" اطلاعات بانکی با موفقیت حذف شد");
                    changeDeleteRestoreButton("deleteBankInfoBtn","restoreBankInfo",bankId);
                    return;
                }
                toastr.error("بروز خطا");
                return;
            })
            .catch(error => toastr.error("بروز خطا"));
    });





    //========================== restore ==========================
    $(document).on("click",".restoreBankInfo", function(){
        let bankId = $(this).attr("data-id");
        $("#restoremodal").find("#restore-modal-btn").attr("data-recordid",bankId).data("recordid",bankId);
    });
    $("#restore-modal-btn").on("click", function (){
        let bankId = $(this).data("recordid");
        fetch(`/user/bank/restore/${bankId}`,{
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
                    toastr.success(" اطلاعات بانکی با موفقیت بازیابی شد.");
                    changeDeleteRestoreButton("restoreBankInfo","deleteBankInfoBtn",bankId);
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
        let tableRow = $(document).find("#tableBankAccountInfo").find(`tr#${customerId}`);
        let restoreBtn = `<button data-id="${customerId}" class="btn btn-sm btn-warning ml-2 restoreBankInfo"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button data-id="${customerId}" class="btn btn-sm btn-danger ml-2 deleteBankInfoBtn"
                                    data-target="#deleteaccount" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;


        $("#tableBankAccountInfo")
            .fadeOut(500, function(){
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'restoreBankInfo' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deletedAtUpdate").html(`${toElementName == 'restoreBankInfo' ? getCurrentDate() : '' }`);
            })
            .fadeIn(500);
    }







//========================== custom functions =========================

    function updateDataTable(receivedData) {

        if (tableBankAccountInfo != null)
            tableBankAccountInfo.destroy();
        tableBankAccountInfo = $('#tableBankAccountInfo').DataTable({
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
                    "name": "bankUpdate",
                    "data": "bank",
                    "targets": 1,
                    "className": 'bankUpdate'
                },
                {
                    "name": "titleUpdate",
                    "data": "title",
                    "targets": 2,
                    "className": 'titleUpdate'
                },
                {
                    "name": "cardNumberUpdate",
                    "data": "card_number",
                    "targets": 3,
                    "className": 'cardNumberUpdate'
                },
                {
                    "name": "shebaUpdate",
                    "data": "sheba",
                    "targets": 4,
                    "className": 'shebaUpdate'
                },
                {
                    "name": "createdAtUpdate",
                    "data": "created_at",
                    "targets": 5,
                    "className": 'createdAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.created_at!=null) ? convertMiladiDateToShamsi(`${row.created_at}`) : null;
                    }},
                {
                    "name": "deletedAtUpdate",
                    "data": "deleted_at",
                    "targets": 6,
                    "className": 'deletedAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.deleted_at!=null) ? convertMiladiDateToShamsi(`${row.deleted_at}`) : null;
                    }},
                {
                    "name": "operation",
                    "targets": 7,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button data-id="${row.id}" class="btn btn-sm btn-danger ml-2 deleteBankInfoBtn"
                                    data-target="#deleteaccount" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;

                        let restoreBtn = `<button data-id="${row.id}" class="btn btn-sm btn-warning ml-2 restoreBankInfo"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;


                        return `

                                          <td class="operation">
                                            ${row.deleted_at != null ? restoreBtn : deleteBtn}
                                                 <button data-id="${row.id}" class="btn btn-sm btn-info ml-2 editBankInfo"
                                                        data-target="#editaccount"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button data-id="${row.id}" class="btn btn-sm btn-primary ml-2 showBankInfo"
                                                        data-target="#showaccount"
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
        let result = await getData(`/user/bank/get-all/${userId}`,
            {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        console.log(result);
        if (catchFetch(result)) return;
        // hideLoader();
        if (result.status !== "notFound") {
            console.log(result);
            $("#bankCount").html(result.count);
            updateDataTable(result.bank_accounts);
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



