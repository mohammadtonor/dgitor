$(document).ready(function () {
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
    //========================= Initialize DataTable =========================//


    let tableRole = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableSemat').on('draw.dt', () => hideLoader());

    //========================= Get All question at the Beginning =============//
    getAllRoles();


    async function postData(url, headers, data, stringifyBody = true) {
        try {
            let response = await fetch(url, {
                headers: headers,
                method: "POST",
                body: stringifyBody ? JSON.stringify(data) : data
            });
            return response.json();
        } catch (err) {
            hideLoader(); // if loader is shown, hide it.
            return {"status": "network error", "err": err};
        }
    }

    ////==================================ثبت سمت========================
    $("#btncreatenewsemat").on("hide.bs.modal", () => $(this).find(".inp").val(''));
    $("#insertsemat").on("click", async function () {
        let sematName = $("#insertsematname").val();
        let status = $("#statusselect").find(":selected").val();
        console.log(status)
        let data = {
            "name": sematName,
            "status": status
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/role/insert`, headers, data);
        hideLoader();
        if (result.status == "validation-error") {
            $.each(data.errors, (index, err) => toastr.error(err));
            return;
        }
        if (result.status == "duplicate") {
            toastr.error("نام  واردشده تکراری است.");
            return;
        }
        if (result.status == "notFound") {
            toastr.error("بروز خطا در ثبت سمت");
            return;
        }
        if (data.status !== "refused") {
            toastr.success("سمت با موفقیت ثبت شد!");
            getAllRoles();   // get all answers and refresh dataTable
            return;
        }

        toastr.error("بروز خطا!");
    });


    ////===========================حذف سمت===========================
    $(document).on("click", ".delete-role-btn", function (evt) {
        let id = $(this).attr("data-id");
        console.log(id)
        $("#deleterole #dodelete").data("recordid", id).attr("data-recordid", id);
    });
    $("#dodelete").on("click", async function () {
        showLoader();  // show loader
        let role_id = $(this).data("recordid");
        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await getData(`/role/del/${role_id}`, headers);
        hideLoader(); //hide loader

        if (result.status.status !== "notFound") {
            toastr.success("سمت با موفقیت حذف شد");
            changeDeleteRestoreButton("delete-role-btn", "restore-role-btn", role_id)
            return;
        }
        toastr.error("بروز خطا");
    });


    //========================= restore ostan =========================//
    $(document).on("click", ".restore-role-btn", function (evt) {
        let id = $(this).attr("data-id");
        $("#restoremodal #dorestore").data("recordid", id).attr("data-recordid", id);
    });
    $("#dorestore").on("click", async function () {
        showLoader();  // show loader
        let role_id = $(this).data("recordid");

        let result = await getData(`/role/restore/${role_id}`,
            {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        hideLoader(); // hide loader
        if (result.status !== "notFound") {
            toastr.success("اطلاعات سمت با موفقیت بازیابی شد");
            changeDeleteRestoreButton("restore-role-btn", "delete-role-btn", role_id)
            return;
        }
        toastr.error("بروز خطا");
    });


    //========================= آپدیت سمت =========================//
    $(document).on("click", ".editsemat", async function (evt) {
        let role_id = $(this).attr("data-id");
        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await getData(`/role/get/${role_id}`, headers)
        hideLoader(); //hide loader

        if (result.result == "notFound") {
            toastr.error("بروز خطا در دریافت اطلاعات سمت");
            return;
        }

        $("#editsemat").find("#doeditsemat").data("recordid", role_id).attr("data-recordid", role_id);
        // fill data to edit modal
        $("#editsemat").find("#sematnameedit").val(result.status.name);

        $("#editsemat").find("#statusselectedit ").val(result.status.status);
        // show modal
        $("#editsemat").modal("show");
    });
    $("#doeditsemat").on("click", async function (evt) {
        showLoader();  // show loader

        let farsiNameSemat = $("#editsemat").find("#sematnameedit").val();
        let status = $("#editsemat").find("#statusselectedit :selected").val();

        let TableRowId = $(this).attr("data-recordid");

        let data = {
            "name": farsiNameSemat,
            "status": status
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/role/update/${TableRowId}`, headers, data);
        // if(catchFetch(result)) return;
        hideLoader();

        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }

        if (result.status == "duplicate") {
            toastr.errors("نام سمت وارد شده تکراری می باشد")
            return;
        }

        if (result.status == "success") {
            toastr.success("ویرایش استان با موفقیت انجام شد!");
            $(document).find("#tableSemat").find(`tr#${TableRowId}`).find(".rowcount").html(farsiNameSemat);
            $(document).find("#tableSemat").find(`tr#${TableRowId}`).find(".status").html(status);

        }

    });


    /////////////////////////////custom functions////////////////////////////////////
    function updateDataTable(receivedData) {

        if (tableRole != null)
            tableRole.destroy();
        tableRole = $('#tableSemat').DataTable({
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
                    "name": "nameSemat",
                    "data": "role.name",
                    "targets": 1,
                    "className": 'nameSemat'
                },

                {
                    "name": "status",
                    render: function (data, type, row, meta) {
                        // return row["role"]["status"] ? 0 : "غیر فعال" ? 1 : " فعال";
                        return (row["role"]["status"] == 0) ? "غیر فعال" : " فعال";
                    },
                    "targets": 2,
                    "className": 'status'
                },
                {
                    "name": "userCount",
                    "data": "user_count",
                    "targets": 3,
                    "className": 'userCount'
                },
                {
                    "name": "createdAt",
                    "data": "role.created_at",
                    "targets": 4,
                    "className": 'createdAt'
                },
                {
                    "name": "deletedAt",
                    "data": "role.deleted_at",
                    "targets": 5,
                    "className": 'deletedAt'
                },
                {
                    "name": "operation",
                    "targets": 6,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 delete-role-btn" data-target="#deleterole" data-toggle="modal" data-id="${row.role.id}">
                                                            <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="حذف"></i>
                                                        </button>`;

                        let restoreBtn = `<button type="button" class="btn btn-sm btn-warning ml-2 restore-role-btn" data-target="#restoremodal" data-toggle="modal" data-id="${row.role.id}">
                                                            <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="بازیابی"></i>
                                                        </button>`;


                        return `

                                          <td class="operation">
                                            ${row.role.deleted_at != null ? restoreBtn : deleteBtn}

                                                <button class="btn btn-sm btn-info ml-2 mt-1 editsemat" data-id="${row.role.id}">
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1" data-target="#accesses"
                                                        data-toggle="modal"  data-id="${row.role.id}">
                                                    <i class="icon-options" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="دسترسی ها"></i>
                                                </button>
                                            </td>
                                        `;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center').attr("id", data.role.id);
            },
        });
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

    async function getAllRoles() {
        let result = await getData(`/role/get-all`,
            {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        if (result.status !== "notFound") {
            updateDataTable(result.roles);
        }

    }

    function changeDeleteRestoreButton(fromElementName, toElementName, sematId) {
        let tableRow = $(document).find("#tableSemat").find(`tr#${sematId}`);
        let restoreBtn = `<button type="button" class="btn btn-sm btn-warning ml-2 restore-role-btn" data-target="#restoremodal" data-toggle="modal" data-id="${sematId}">
                                                            <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="بازیابی"></i>
                                                        </button>`;

        let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 delete-role-btn" data-target="#deleterole" data-toggle="modal" data-id="${sematId}">
                                                            <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="حذف"></i>
                                                        </button>`;

        $("#tableSemat")
            .fadeOut(500, function () {
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'restore-role-btn' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deletedAt").html(`${toElementName == 'restore-role-btn' ? getCurrentDate() : ''}`);
            })
            .fadeIn(500);
    }

    function getCurrentDate() {
        const m = moment();
        m.locale('en');
        return m.format('Y-m-d H:i:s');
    }


})
