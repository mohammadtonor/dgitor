$(document).ready(function () {


    let tableCategoryAttribute = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableCategoryAttribute').on('draw.dt', () => hideLoader());
    getAllProductServices();



    //========================tooltip on dynamically added element========================
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });



    //==========================show product service info in edit modal===========================
    $(document).on("click", ".editProductService", async function () {
        let productServiceId = $(this).attr("data-id");
        $("#editServiceProduct").find("#editPServiceInfoBtn").attr("data-id", productServiceId);
        let result = await getData(`/product-service/get-one/${productServiceId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        $("#nameEdit").val(result.status.title);
    })



    //==========================update product service info===========================
    $("#editPServiceInfoBtn").on("click", async function () {
        let productServiceId = $("#editPServiceInfoBtn").attr("data-id");

        let data = {
            "title": $("#nameEdit").val(),
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/product-service/update/${productServiceId}`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "success") {
            toastr.success(" خدمات کالا با موفقیت به روزرسانی شد!");
            $("#edit-modal").modal('hide');
            $(`tr#${productServiceId}`).find(".nameUpdate").html($("#nameEdit").val());
            return;
        }
        toastr.error("بروز خطا!");
    });



    //========================= insert product service =========================//
    // clear inputs
    $("#insertPServiceModal").on("hide.bs.modal", () => $(this).find(".inp").val(''));
    $("#insertPServiceBtn").on("click", async function () {
        let data = {
            "title": $("#nameInsert").val(),
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/product-service/insert`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();
        if (result.status == "validation-error") {
            $.each(data.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "duplicate") {
            toastr.error("عنوان تکراری!");
            return;
        }
        if (result.status == "success") {
            toastr.success("خدمات کالا با موفقیت ثبت شد!");
            $("#btncreatenewcategory").modal('hide');
            getAllProductServices();
            return;
        }
        toastr.error("بروز خطا!");
    });






    //===========================delete========================
    $(document).on("click",".deletePService", function (evt) {
        let productServiceId = $(this).attr("data-id");
        $("#deletePService #dodelete").data("recordid", productServiceId).attr("data-recordid", productServiceId);
    });
    $("#dodelete").on("click", function () {
        let productServiceId = $(this).data("recordid");
        fetch(`/product-service/delete/${productServiceId}`,{method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status == "success") {
                    toastr.success(" خدمات کالا با موفقیت حذف شد");
                    changeDeleteRestoreButton("deletePService","restoreAttribute",productServiceId);
                    return;
                }
                toastr.error("بروز خطا");
                return;
            })
            .catch(error => toastr.error("بروز خطا"));
    });





    //========================== restore ==========================
    $(document).on("click",".restoreAttribute", function(){
        let productServiceId = $(this).attr("data-id");
        $("#restoremodal").find("#restore-modal-btn").attr("data-recordid",productServiceId).data("recordid",productServiceId);
    });
    $("#restore-modal-btn").on("click", function (){
        let productServiceId = $(this).data("recordid");
        fetch(`/product-service/restore/${productServiceId}`,{
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
                    toastr.success("  خدمات کالا با موفقیت بازیابی شد.");
                    changeDeleteRestoreButton("restoreAttribute","deletePService",productServiceId);
                    return;
                }
                else{
                    toastr.error("بروز خطا در بازیابی ویژگی ");
                }
            })
        // .catch(error => toastr.error("بروز خطا"));
    });




//===========================change delete restore btn=========================
    function changeDeleteRestoreButton(fromElementName,toElementName,productServiceId)
    {
        let tableRow = $(document).find("#tableCategoryAttribute").find(`tr#${productServiceId}`);
        let restoreBtn = `<button data-id="${productServiceId}" class="btn btn-sm btn-warning ml-2 restoreAttribute"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button data-id="${productServiceId}" class="btn btn-sm btn-danger ml-2 deletePService"
                                    data-target="#deletePService" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;


        $("#tableCategoryAttribute")
            .fadeOut(500, function(){
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'restoreAttribute' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deletedAtUpdate").html(`${toElementName == 'restoreAttribute' ? getCurrentDate() : '' }`);
            })
            .fadeIn(500);
    }










//========================== custom functions =========================

    function updateDataTable(receivedData) {
        if (tableCategoryAttribute != null)
            tableCategoryAttribute.destroy();
        tableCategoryAttribute = $('#tableCategoryAttribute').DataTable({
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
                    "data": "pService.title",
                    "targets": 1,
                    "className": 'nameUpdate'
                },
                {
                    "name": "productCountUpdate",
                    "data": "product_count",
                    "targets": 2,
                    "className": 'productCountUpdate'
                },
                {
                    "name": "createdAtUpdate",
                    "data": "pService.created_at",
                    "targets": 3,
                    "className": 'createdAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.pService.created_at!=null) ? convertMiladiDateToShamsi(`${row.pService.created_at}`) : null;
                    }},
                {
                    "name": "deletedAtUpdate",
                    "data": "pService.deleted_at",
                    "targets": 4,
                    "className": 'deletedAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.pService.deleted_at!=null) ? convertMiladiDateToShamsi(`${row.pService.deleted_at}`) : null;
                    }},
                {
                    "name": "operation",
                    "targets": 5,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button data-id="${row.pService.id}" class="btn btn-sm btn-danger ml-2 deletePService"
                                    data-target="#deletePService" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;

                        let restoreBtn = `<button data-id="${row.pService.id}" class="btn btn-sm btn-warning ml-2 restoreAttribute"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;


                        return `

                                          <td class="operation">
                                            ${row.pService.deleted_at != null ? restoreBtn : deleteBtn}
                                                  <button data-id="${row.pService.id}" class="btn btn-sm btn-info ml-2 editProductService" data-target="#editServiceProduct"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                            </td>
                                        `;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center').attr("id", data.pService.id);
            },
        });
    }

    async function getAllProductServices() {
        let result = await getData("/product-service/get-all",
            {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        console.log(result);
        $("#pServiceCount").html(result.count);
        if (catchFetch(result)) return;
        // hideLoader();
        if (result.status !== "notFound") {
            console.log(result);
            updateDataTable(result.pService);
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




