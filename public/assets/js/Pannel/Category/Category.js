$(document).ready(function () {
    let tableCategory = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableCategory').on('draw.dt', () => hideLoader());
    getAllCategories();


    //========================tooltip on dynamically added element========================
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    let selectBox = $('.multiSelectTag').select2({
        closeOnSelect: true, placeholder: "انتخاب کنید", allowHtml: true, allowClear: true, // theme: "bootstrap",
        // dropdownCssClass: "myFont",
        width: 'resolve', "language": {
            "noResults": function () {
                return "موردی یافت نشد"
            }
        },
    });

    ////===========================حذف دسته بندی===========================

    $(document).on("click", ".deleteCategory", function (evt) {
        let id = $(this).data("id");
        $("#deletecategory #dodelete").data("recordid", id).attr("data-recordid", id);
    });
    $("#dodelete").on("click", async function () {
        showLoader();  // show loader
        let category_id = $(this).data("recordid");

        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await getData(`/main-cat/delete/${category_id}`, headers);
        hideLoader(); //hide loader

        if (result.status.status !== "notFound") {
            toastr.success("دسته بندی با موفقیت حذف شد");
            changeDeleteRestoreButton("deleteCategory", "restoreCategory", category_id)
            return;
        }
        toastr.error("بروز خطا");
    });

    //========================= restore category =========================//

    $(document).on("click", ".restoreCategory", function (evt) {
        let id = $(this).attr("data-id");
        $("#restoremodal #restore-modal-btn").data("recordid", id).attr("data-recordid", id);
    });
    $("#restore-modal-btn").on("click", async function () {
        showLoader();  // show loader
        let category_id = $(this).data("recordid");

        let result = await getData(`/main-cat/restore/${category_id}`,
            {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        hideLoader(); // hide loader

        if (result.status !== "notDeleted") {
            toastr.success("اطلاعات دسته بندی با موفقیت بازیابی شد");
            changeDeleteRestoreButton("restoreCategory", "deleteCategory", category_id)
            return;
        }
        toastr.error("بروز خطا");
    });

    ////==================================ثبت دسته بندی========================

    $("#btncreatenewcategory").on("hide.bs.modal", () => $(this).find(".inp").val(''));
    $("#insertCategoryBtn").on("click", async function () {
        let title = $("#titleInsert").val();
        let description = $("#descInsert").val();

        let data = {
            "title": title,
            "description": description
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/main-cat/insert`, headers, data);
        hideLoader();
        if (result.status == "validation-error") {
            $.each(data.errors, (index, err) => toastr.error(err));
            console.log("validation-error")
            return;
        }
        if (result.status == "duplicate") {
            toastr.error("نام دسته بندی یا توضیحات  واردشده تکراری است.");
            console.log("duplicate")
            return;
        }
        if (result.status == "failed") {
            toastr.error("بروز خطا در ثبت دسته بندی");
            console.log("failed")
            return;
        }
        if (result.status == "success") {
            toastr.success("دسته بندی با موفقیت ثبت شد!");
            console.log("success")
            getAllCategories();   // get all answers and refresh dataTable
            return;
        }

        toastr.error("بروز خطا!");
    });

    //========================= آپدیت دسته بندی =========================//

    $(document).on("click", ".editCategory", async function (evt) {
        let category_id = $(this).attr("data-id");
        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await getData(`/main-cat/get-one/${category_id}`, headers)
        hideLoader(); //hide loader

        if (result.status == "notFound") {
            toastr.error("بروز خطا در دریافت اطلاعات ذسته بندی");
            return;
        }
        $("#editcategory").find("#editCategoryInfoBtn").data("recordid", category_id).attr("data-recordid", category_id);
        // fill data to edit modal
        $("#editcategory").find("#titleEdit").val(result.status.title);
        $("#editcategory").find("#descEdit").val(result.status.description);
        $("#editcategory").find("#subCatEdit").val(result.status.child_count);
        // show modal
        $("#editcategory").modal("show");
    });
    $("#editCategoryInfoBtn").on("click", async function (evt) {
        showLoader();  // show loader
        let TableRowId = $(this).attr("data-recordid");
        let title = $("#titleEdit").val();
        let description = $("#descEdit").val();
        let data = {
            "title": title,
            "description": description
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/main-cat/update/${TableRowId}`, headers, data);
        hideLoader();
        console.log(result)
        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }

        if (result.status == "duplicate") {
            toastr.errors("نام یا توضیحات وارد شده تکراری می باشد")
            return;
        }

        if (result.status !== "notFound") {
            toastr.success("ویرایش دسته بندی با موفقیت انجام شد!");
            $(document).find("#tableCategory").find(`tr#${TableRowId}`).find(".nameUpdate").html(title);
            $(document).find("#tableCategory").find(`tr#${TableRowId}`).find(".descUpdate").html(description);

            return;
        }

    });


    ////=====================================نمایش=============================

    $(document).on("click", ".showCategoryBtn", async function (evt) {
        let category_id = $(this).attr("data-id");
        let headers = {
            "X-Requested-With": "XMLHttpRequest",
            "Accept": "application/json",
        };
        let result = await getData(`/main-cat/get-one/${category_id}`, headers)
        hideLoader(); //hide loader
        console.log(result)

        if (result.status == "notFound") {
            toastr.error("بروز خطا در دریافت اطلاعات ذسته بندی");
            return;
        }
        // $("#showcategory").find("#editCategoryInfoBtn").data("recordid", category_id).attr("data-recordid", category_id);
        // fill data to edit modal
        $("#showcategory").find("#titleShow").val(result.status.title);
        $("#showcategory").find("#descShow").val(result.status.description);
        $("#showcategory").find("#subCatShow").val(result.status.child_count);
        // show modal
        $("#showcategory").modal("show");
    });

    ////===========================================================تگ ها============================================


    //  ================   جدول   ======================
    async function getAllTag(category_id) {
        let data = await getData(`/tag/relation/category/get-all/${category_id}`, {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });
        $(".category_tag").empty()
        data.status.forEach(function (object) {
            $(".category_tag").append(
                `<tr data-id="${object.id}">
                    <td data-id="${object.id}" class="text-center">${object.id}</td>
                    <td data-id="${object.id}" class="text-center">${object.title}</td>
                    <td data-id="${object.id}" class="text-center ">
                       <button class="btn btn-sm btn-danger ml-2 delete_tag" data-id="${object.id}">
                            <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                            data-placement="top"
                            title="حذف"></i>
                       </button>
                    </td>
                </tr>`
            )
        })

    }


    //============================== دکمه ی تگ ===========================

    $(document).on("click", ".tags", async function () {
        let tags = [];
        let category_id = $(this).attr("data-id");
        getAllTag(category_id);


        // =============================================    دکمه ی حذف
        $(document).on('click', ".delete_tag", function () {
            let tag_id = $(this).attr('data-id');
            fetch(`/tag/relation/category/deatch/${category_id}/${tag_id}`, {
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                method: "GET"
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // toastr.success('با موفقیت انجام شد')
                    getAllTag(category_id);
                })
        })

        fetch(`/tag/relation/category/can-assign/${category_id}`, {
        headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        },
        method: "GET"
        })
        .then(response => response.json())
        .then(data => {
            $(".multiSelectTag").empty();
            data.status.forEach(function (object) {
                $(".multiSelectTag").append(`<option value="${object.id}">${object.title}</option>`)
            })
        })


        $(document).on('click', "#multi_select", async function () {
            let selectedOptions = $('.multiSelectTag').find('option:selected');
            let tag_id = []
            selectedOptions.each(function () {
                tag_id.push($(this).val())
            });
            let tag = {
                "tag_ids": tag_id
            }
            await fetch(`/tag/relation/category/sync/${category_id}`, {
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(tag),
                method: "POST"
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    getAllTag(category_id);
                })
        })
    })


//========================== custom functions =========================

//===========================change delete restore btn=========================
    function changeDeleteRestoreButton(fromElementName, toElementName, categoryId) {
        let tableRow = $(document).find("#tableCategory").find(`tr#${categoryId}`);
        let restoreBtn = `<button data-id="${categoryId}" class="btn btn-sm btn-warning ml-2 restoreCategory"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button data-id="${categoryId}" class="btn btn-sm btn-danger ml-2 deleteCategory"
                                    data-target="#deletecategory" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;


        $("#tableCategory")
            .fadeOut(500, function () {
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'restoreCategory' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deletedAtUpdate").html(`${toElementName == 'restoreCategory' ? getCurrentDate() : ''}`);
            })
            .fadeIn(500);
    }

    function updateDataTable(receivedData) {

        if (tableCategory != null)
            tableCategory.destroy();
        tableCategory = $('#tableCategory').DataTable({
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
                    "data": "category.title",
                    "targets": 1,
                    "className": 'nameUpdate'
                },

                {
                    "name": "descUpdate",
                    "data": "category.description",
                    "targets": 2,
                    "className": 'descUpdate'
                },
                {
                    "name": "subCatCount",
                    "data": "category.child_count",
                    "targets": 3,
                    "className": 'subCatCount'
                },
                {
                    "name": "createdAtUpdate",
                    "data": "category.created_at",
                    "targets": 4,
                    "className": 'createdAtUpdate'
                },
                {
                    "name": "deletedAtUpdate",
                    "data": "category.deleted_at",
                    "targets": 5,
                    "className": 'deletedAtUpdate'
                },
                {
                    "name": "operation",
                    "targets": 6,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button data-id="${row.category.id}" class="btn btn-sm btn-danger ml-2 deleteCategory"
                                    data-target="#deletecategory" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;

                        let restoreBtn = `<button data-id="${row.category.id}" class="btn btn-sm btn-warning ml-2 restoreCategory"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;


                        return `

                                          <td class="operation">
                                            ${row.category.deleted_at != null ? restoreBtn : deleteBtn}
                                                <button data-id="${row.category.id}" class="btn btn-sm btn-info ml-2 mt-1 editCategory"
                                                        >
                                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button data-id="${row.category.id}" class="btn btn-sm btn-primary ml-2 mt-1 showCategoryBtn"
                                                     >
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger ml-2 mt-1" data-target="#logoimage"
                                                        data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="تصویر لوگو"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1">
                                                    <a href="/sub2-cat/page/${row.category.id}">
                                                    <i class="icon-arrow-down" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="زیر دسته 2"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1">
                                                    <a href="/attribute/page/${row.category.id}">
                                                        <i class="icon-star" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="ویژگی های دسته2"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-success ml-2 mt-1 tags" data-target="#tags" data-toggle="modal" data-id="${row.category.id}">
                                                        <i class="icon-list" aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="تگ ها"></i>
                                                </button>
                                            </td>
                                        `;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center ').attr("id", data.category.id);
            },
        });
    }

    async function getAllCategories() {
        // showLoader();
        let result = await getData(`/main-cat/get-all/`,
            {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        if (result.status !== "refused") {
            updateDataTable(result.status.main_categories);
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


})//end of document ready



