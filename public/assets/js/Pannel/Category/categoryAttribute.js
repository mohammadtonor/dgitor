$(document).ready(function () {


    let tableCategoryAttribute = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableCategoryAttribute').on('draw.dt', () => hideLoader());
    getAllCategories();

    //========================tooltip on dynamically added element========================
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    //==========================show attribute info in edit modal===========================
    $(document).on("click", ".editAttribute", async function () {
        let attributeId = $(this).attr("data-id");
        $("#editAttribute").find("#editAttributeInfoBtn").attr("data-id", attributeId);
        let result = await getData(`/attribute/get-one/${attributeId}`, {
            "Accept": "application/json", "X-Requested-With": "XMLHttpRequest",
        });
        $("#nameEdit").val(result.status.title);
    })

    //==========================update attribute info===========================
    $("#editAttributeInfoBtn").on("click", async function () {
        let attributeId = $("#editAttributeInfoBtn").attr("data-id");
        let categoryId = $("meta[name=category_id]").attr("content");

        let data = {
            "title": $("#nameEdit").val(),
            "category_id": categoryId,
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/attribute/update/${attributeId}/${categoryId}`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "success") {
            toastr.success(" ویژگی با موفقیت به روزرسانی شد!");
            $("#edit-modal").modal('hide');
            $(`tr#${attributeId}`).find(".attrUpdate").html($("#nameEdit").val());
            return;
        }
        toastr.error("بروز خطا!");
    });

    //========================= insert attribute =========================//
    // clear inputs
    $("#insertAttributeModal").on("hide.bs.modal", () => $(this).find(".inp").val(''));
    $("#insertAttributeBtn").on("click", async function () {
        let categoryId = $("meta[name=category_id]").attr("content");
        let data = {
            "title": $("#nameInsert").val(),
            "category_id": categoryId,
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/attribute/insert/${categoryId}`, headers, data);
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
        if (result.status !== "failed") {
            toastr.success("ویژگی با موفقیت ثبت شد!");
            // $("#btncreatenewcategory").modal('hide');
            getAllCategories();
            return;
        }
        toastr.error("بروز خطا!");
    });

    //===========================delete========================
    $(document).on("click",".deleteAttribute", function (evt) {
        let attributeId = $(this).attr("data-id");
        $("#deleteattr #dodelete").data("recordid", attributeId).attr("data-recordid", attributeId);
    });
    $("#dodelete").on("click", function () {
        let attributeId = $(this).data("recordid");
        fetch(`/attribute/delete/${attributeId}`,{method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status == "success") {
                    toastr.success(" ویژگی با موفقیت حذف شد");
                    changeDeleteRestoreButton("deleteAttribute","restoreAttribute",attributeId);
                    return;
                }
                toastr.error("بروز خطا");
                return;
            })
            .catch(error => toastr.error("بروز خطا"));
    });

    //========================== restore ==========================
    $(document).on("click",".restoreAttribute", function(){
        let attributeId = $(this).attr("data-id");
        $("#restoremodal").find("#restore-modal-btn").attr("data-recordid",attributeId).data("recordid",attributeId);
    });
    $("#restore-modal-btn").on("click", function (){
        let attributeId = $(this).data("recordid");
        fetch(`/attribute/restore/${attributeId}`,{
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
                    toastr.success(" ویژگی با موفقیت بازیابی شد.");
                    changeDeleteRestoreButton("restoreAttribute","deleteAttribute",attributeId);
                    return;
                }
                else{
                    toastr.error("بروز خطا در بازیابی ویژگی ");
                }
            })
        // .catch(error => toastr.error("بروز خطا"));
    });

//===========================change delete restore btn=========================
    function changeDeleteRestoreButton(fromElementName,toElementName,categoryId)
    {
        let tableRow = $(document).find("#tableCategoryAttribute").find(`tr#${categoryId}`);
        let restoreBtn = `<button data-id="${categoryId}" class="btn btn-sm btn-warning ml-2 restoreAttribute"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button data-id="${categoryId}" class="btn btn-sm btn-danger ml-2 deleteAttribute"
                                    data-target="#deleteattr" data-toggle="modal">
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

    $(document).on("click",".valuesBtn", function (){
        let attributeId = $(this).attr("data-id");
        $("#values").find("#valuesTable").attr("data-id",attributeId);
        getAllDefaultValuesTable(attributeId);
    })

    //==========================getAllDefaultValues===========================
    function getAllDefaultValuesTable(attributeId){
        fetch(`/default-val/get-all/${attributeId}`, {method: "GET",headers: {"X-Requested-With": "XMLHttpRequest","Accept": "application/json"}})
            .then(response => response.json())
            .then(data =>{
                console.log(data);

                if(data.status.count==0){
                    $("#valuesTable tbody").empty();
                    $("#valuesTable").append(`<tr>
                        <td class="text-center" colspan="4">برای این ویژگی مقداری تعریف نشده</td>
                    </tr>`)
                    return;
                }else {
                    $("#valuesTable tbody").empty();

                    $.each(data.status.values, function (key,value){
                        $("#valuesTable").append(`<tr class="text-center" id="${value.id}">
                        <td class="align-middle">${++key}</td>
                        <td class="align-middle">${value.value}</td>
                       <td class="align-middle">
                            <button class="btn btn-sm btn-danger ml-2 deleteValue" data-toggle="modal"
                                    data-id="${value.id}"
                                    data-recordid="${value.id}"
                                    data-target="#deleteValue">
                                <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                   data-placement="top"
                                   title="حذف"></i>
                            </button>
                       </td>
                    </tr>`)
                    });
                }
            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });
    }

//===========================delete default value========================
    $(document).on("click",".deleteValue", function (evt) {
        let valueId = $(this).attr("data-id");
        $("#deleteValue #dodeleteValue").data("recordid", valueId).attr("data-recordid", valueId);
    });
    $("#dodeleteValue").on("click", function () {
        let valueId = $(this).data("recordid");
        fetch(`/default-val/delete/${valueId}`,{method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status == "success") {
                    toastr.success(" مقدار با موفقیت حذف شد");
                    let tableRow = $("#valuesTable").find(`tr#${valueId}`);
                    $("#valuesTable").fadeOut().fadeIn(1000,function (){
                        $(tableRow).remove();
                    });
                    return;
                }
                toastr.error("بروز خطا");
                return;
            })
    });

    //========================= insert default value =========================//
    // clear inputs
    $(document).on("click",".valuesBtn", function (){
        $("#values").find("#featureNameEdit").val("");
    })
    $("#insertDefaultValueBtn").on("click", async function () {
        let categoryId = $("#valuesTable").attr("data-id");
        let data = {
            "title": $("#featureNameEdit").val(),
            "attr_id": $("#valuesTable").attr("data-id"),
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData("/default-val/insert", headers, data);
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
            toastr.success("مقدار با موفقیت ثبت شد!");
            $("#btncreatenewcategory").modal('hide');
            getAllDefaultValuesTable(categoryId);
            $(document).find("#featureNameEdit").val('');

            return;
        }
        toastr.error("بروز خطا!");
    });

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
                    "name": "catNameUpdate",
                    "data": "attr.category.title",
                    "targets": 1,
                    "className": 'catNameUpdate'
                },
                {
                    "name": "attrUpdate",
                    "data": "attr.title",
                    "targets": 2,
                    "className": 'attrUpdate'
                },
                {
                    "name": "valueCountUpdate",
                    "data": "value_count",
                    "targets": 3,
                    "className": 'valueCountUpdate'
                },
                {
                    "name": "valueCount",
                    "data": "value_count",
                    "targets": 4,
                    "className": 'valueCount'
                },
                {
                    "name": "createdAtUpdate",
                    "data": "attr.created_at",
                    "targets": 5,
                    "className": 'createdAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.attr.created_at!=null) ? convertMiladiDateToShamsi(`${row.attr.created_at}`) : null;
                     }
                    },
                {
                    "name": "deletedAtUpdate",
                    "data": "attr.deleted_at",
                    "targets": 6,
                    "className": 'deletedAtUpdate',
                    render: function (data, type, row, meta) {
                        return (row.attr.deleted_at!=null) ? convertMiladiDateToShamsi(`${row.attr.deleted_at}`) : null;
                    }},
                {
                    "name": "operation",
                    "targets": 7,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button data-id="${row.attr.id}" class="btn btn-sm btn-danger ml-2 deleteAttribute"
                                    data-target="#deleteattr" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;

                        let restoreBtn = `<button data-id="${row.attr.id}" class="btn btn-sm btn-warning ml-2 restoreAttribute"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;


                        return `

                                          <td class="operation">
                                            ${row.attr.deleted_at != null ? restoreBtn : deleteBtn}
                                                <button data-id="${row.attr.id}" class="btn btn-sm btn-info ml-2 editAttribute" data-target="#editAttribute" data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                </button>
                                                <button data-id="${row.attr.id}" class="btn btn-sm btn-primary ml-2 valuesBtn" data-target="#values" data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip"data-placement="top"title="مقادیر"></i>
                                                </button>
                                            </td>
                                        `;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center').attr("id", data.attr.id);
            },
        });
    }

    async function getAllCategories() {
        let categoryId = $("meta[name=category_id]").attr("content");
        let result = await getData(`/attribute/get-all/${categoryId}`,
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
            updateDataTable(result.status.attrs);
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



