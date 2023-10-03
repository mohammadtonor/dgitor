$(document).ready(function () {

    $('.multisel').select2({
        closeOnSelect: true,
        placeholder: "انتخاب کنید",
        allowHtml: true,
        allowClear: true,
        width: 'resolve',
        "language": {
            "noResults": function () {
                return "موردی یافت نشد"
            }
        },
    });

    //========================tooltip on dynamically added element========================
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    let tableTags = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableTags').on('draw.dt', () => hideLoader());
    getAllTags();



    ////===========================حذف تگ===========================
    $(document).on("click", ".btn-delete-tag", function (evt) {
        let id = $(this).data("id");
        $("#deletetag #dodeletetag").data("recordid", id).attr("data-recordid", id);
    });
    $("#dodeletetag").on("click", async function () {
        showLoader();  // show loader
        let id = $(this).data("recordid");

        // console.log(id)
        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
        };
        let result = await getData(`/tag/del/${id}`, headers);
        hideLoader(); //hide loader

        if (result.status =="success") {
            toastr.success("تگ با موفقیت حذف شد");
            changeDeleteRestoreButton("btn-delete-tag", " btn-restore-tag", id);
            return;
        }
        toastr.error("بروز خطا");
    });

    //========================= restore category =========================//
    $(document).on("click", ".btn-restore-tag", function (evt) {
        let id = $(this).attr("data-id");
        $("#restoremodal #restore-modal-btn").data("recordid", id).attr("data-recordid", id);
    });
    $("#restore-modal-btn").on("click", async function () {
        showLoader();  // show loader
        let id = $(this).data("recordid");

        let result = await getData(`/tag/restore/${id}`,
            {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });

        hideLoader(); // hide loader

        if (result.status !=="notDeleted") {
            toastr.success("اطلاعات تگ با موفقیت بازیابی شد");
            changeDeleteRestoreButton("btn-restore-tag", "btn-delete-tag", id)
            return;
        }
        toastr.error("بروز خطا");
    });


    ////==================================ثبت تگ========================
    $("#btncreatenewtag").on("hide.bs.modal", () => $(this).find(".inp").val(''));
    $("#insertTag").on("click", async function () {
        let tagName = $("#tagNameinsert").val();

        let data = {
            "title": tagName,
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/tag/insert`, headers, data);
        hideLoader();
        if (result.status == "validation-error") {
            $.each(data.errors, (index, err) => toastr.error(err));
            console.log("validation-error")
            return;
        }
        if (result.status == "duplicate") {
            toastr.error("نام تگ واردشده تکراری است.");
            console.log("duplicate")
            return;
        }
        if (result.status== "failed") {
            toastr.error("بروز خطا در ثبت دسته بندی");
            console.log("failed")
            return;
        }
        if (result.status == "success") {
            toastr.success("تگ با موفقیت ثبت شد!");
            console.log("success")
            getAllTags();   // get all answers and refresh dataTable
            return;
        }

        toastr.error("بروز خطا!");
    });



    //========================= آپدیت تگ =========================//
    $(document).on("click", ".edittagbtn", async function (evt) {
        let tag_id = $(this).attr("data-id");
        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await getData(`/tag/get-one/${tag_id}`, headers)
        hideLoader(); //hide loader

        if (result.status == "notFound") {
            toastr.error("بروز خطا در دریافت اطلاعات تگ ");
            return;
        }
        $("#edittag").find("#doedittag").data("recordid", tag_id).attr("data-recordid", tag_id);
        // fill data to edit modal
        $("#edittag").find("#tagnameeedit").val(result.status.title);
        // show modal
        $("#edittag").modal("show");
    });
    $("#doedittag").on("click", async function (evt) {
        showLoader();  // show loader
        let TableRowId = $(this).attr("data-recordid");
        let title = $("#tagnameeedit").val();

        let data = {
            "title": title,
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/tag/update/${TableRowId}`, headers, data);
        hideLoader();
        console.log(result)
        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }

        if (result.status == "duplicate") {
            toastr.errors("نام وارد شده تکراری می باشد")
            return;
        }

        if (result.status !== "notFound") {
            toastr.success("ویرایش تگ با موفقیت انجام شد!");
            $(document).find("#tableTags").find(`tr#${TableRowId}`).find(".tagName").html(title);

            return;
        }

    });


    //========================= نمایش  تگ =========================//

    $(document).on("click", ".showtaginfo", async function (evt) {
        let tag_id = $(this).attr("data-id");
        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await getData(`/tag/get-one/${tag_id}`, headers)
        hideLoader(); //hide loader

        if (result.status == "notFound") {
            toastr.error("بروز خطا در دریافت اطلاعات تگ ");
            return;
        }
        // $("#showtag").find("#doedittag").data("recordid", tag_id).attr("data-recordid", tag_id);
        // fill data to edit modal
        $("#showtag").find("#tagNmaeshow").val(result.status.title);
        // show modal
        $("#showtag").modal("show");
    });
    //========================== custom functions =========================

    //===========================change delete restore btn=========================
    function changeDeleteRestoreButton(fromElementName,toElementName,id)
    {
        let tableRow = $(document).find("#tableTags").find(`tr#${id}`);
        let restoreBtn = `<button data-id="${id}" class="btn btn-sm btn-warning ml-2 btn-restore-tag"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button data-id="${id}" class="btn btn-sm btn-danger ml-2 btn-delete-tag"
                                    data-target="#deletetag" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;


        $("#tableTags")
            .fadeOut(500, function(){
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'btn-restore-tag' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deleted_at").html(`${toElementName == 'btn-restore-tag' ? getCurrentDate() : '' }`);
            })
            .fadeIn(500);
    }
    function updateDataTable(receivedData) {
        if (tableTags != null)
            tableTags.destroy();
            tableTags = $('#tableTags').DataTable({
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
                    "name": "tagName",
                    "data": "tag.title",
                    "targets": 1,
                    "className": 'tagName'
                },

                {
                    "name": "category_count",
                    "data": "category_count",
                    "targets": 2,
                    "className": 'category_count'
                },
                {
                    "name": "product_count",
                    "data": "product_count",
                    "targets": 3,
                    "className": 'product_count'
                },
                {
                    "name": "created_at",
                    "data": "tag.created_at",
                    "targets": 4,
                    "className": 'created_at'
                },
                {
                    "name": "deleted_at",
                    "data": "tag.deleted_at",
                    "targets": 5,
                    "className": 'deleted_at'
                },
                {
                    "name": "operation",
                    "targets": 6,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button data-id="${row.tag.id}" class="btn btn-sm btn-danger ml-2 btn-delete-tag"
                                    data-target="#deletetag" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;

                        let restoreBtn = `<button data-id="${row.tag.id}" class="btn btn-sm btn-warning ml-2 btn-restore-tag"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;


                        return `

                                          <td class="operation">
                                            ${row.tag.deleted_at != null ? restoreBtn : deleteBtn}
                                                   <button class="btn btn-sm btn-info ml-2 mt-1 edittagbtn" data-target="#edittag" data-id="${row.tag.id}"
                                                        data-toggle="modal">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                 <button class="btn btn-sm btn-primary ml-2 mt-1 showtaginfo" data-id="${row.tag.id}"
                                                     >
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1" data-target="#categories" data-id="${row.tag.id}"
                                                        data-toggle="modal">
                                                    <i class="icon-list" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="دسته بندی ها"></i>
                                                </button>
                                               <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#products"data-id="${row.tag.id}"
                                                        data-toggle="modal">
                                                    <i class="icon-wallet" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="محصولات"></i>
                                                </button>

                                            </td>
                                        `;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center ').attr("id", data.tag.id);
            },
        });
    }
    async function getAllTags() {
        let result = await getData(`/tag/get-all`,
            {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        if (catchFetch(result)) return;

        if (result.status !== "refused") {
            updateDataTable(result.tags);
        }

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
    function getCurrentDate() {
        const m = moment();
        m.locale('fa');
        return m.format('DD  MMMM  YYYY ');
    }
});

