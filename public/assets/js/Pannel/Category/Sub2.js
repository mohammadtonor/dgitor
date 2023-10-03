$(document).ready(function () {

    //================== Initialize select2 for tags ==================
    $('.multisel').select2({
        closeOnSelect: true,
        placeholder: "انتخاب کنید",
        allowHtml: true,
        allowClear: Boolean($(this).data('allow-clear')),
        "language": {
            "noResults": function () {
                return "داده ای یافت نشد!";
            }
        },
    });


    //=========================== getAllSubCategory =======================//

    let myTableSub2 = null;

    // each time dataTable is drawn, hide loader if it is displayed
    $('#myTableSub2').on('draw.dt', () => hideLoader());
    getAllSub2();

    //for tooltips
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    //=========================== deleteSubCategory =======================//
    $(document).on("click", ".deleteSub2Btn", function (evt) {

        let Sub2Id = $(this).closest("tr").attr("data-id");

        $("#deleteSub2Modal #doDeleteModal").data("recordid", Sub2Id).attr("data-recordid", Sub2Id);
    });

    $("#doDeleteModal").on("click", async function () {
        let Sub2Id = $(this).attr("data-recordid");

        fetch(`/sub2-cat/delete/${Sub2Id}`, {

            headers: {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type": "application/json"
            },
            method: "GET"
        })
            .then(response => response.json())
            .then(data => {
                if (data.status == "success") {
                    toastr.success("این نوع برگزاری دوره با موفقیت حذف شد");
                    changeDeleteRestoreButton("deleteSub2Btn", "restoreSub2Btn", Sub2Id);
                    // location.reload();
                    getAllSub2(data.status.sub_cat);
                } else if (data.status == "failed") {
                    toastr.error(" عدم حذف این آدرس");
                } else {
                    toastr.error("بروز خطا درحذف این آدرس");
                }
            })

    });

    //=========================== restoreSubCategory =======================//
    $(document).on("click", ".restoreSub2Btn", function (evt) {
        let Sub2Id = $(this).closest("tr").attr("data-id");

        $("#restoreSub2Modal #doRestoreModal").data("recordid", Sub2Id).attr("data-recordid", Sub2Id);

    });

    $("#doRestoreModal").on("click", function () {

        let Sub2Id = $(this).data("recordid");

        fetch(`/sub2-cat/restore/${Sub2Id}`, {
            headers: {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type": "application/json"
            },
            method: "GET"
        })
            .then(response => response.json())
            .then(data => {
                if (data.status == "success") {
                    toastr.success("اطلاعات با موفقیت بازیابی شد");
                    changeDeleteRestoreButton("#deleteSub2Btn", "#restoreSub2Btn", Sub2Id);
                    getAllSub2(data.parent_category);
                    // location.reload();
                    return;
                }

                toastr.error("بروز خطا ر بازیابی اطلاعات");
            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });
    });

    //=========================== insertSubCategory =======================//
    $("#insertSub2Modal").on("hide.bs.modal", () => $(this).find(".inp").val(''));

    $("#doInsertsub2").on("click", async function () {
        let titleSub2 = $("#insertSub2Modal").find("#sub2Title").val();
        let descSub2 = $("#insertSub2Modal").find("#sub2Desc").val();
        let countSub2 = $("#insertSub2Modal").find("#sub2Count").val();

        let parent_cat_id = $("meta[name=category_id]").attr("content");
        let data = {
            "title": titleSub2,
            "description": descSub2,
            "child_count": countSub2,
            // "doc_file":ImgSub2,
            "parent_cat_id": 1,
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/sub2-cat/insert/${parent_cat_id}`, headers, data);
        if (result.status == "validation-error") {
            $.each(data.errors, (index, err) => toastr.error(err));
            console.log("validation-error")
            return;
        }
        if (result.status == "duplicate") {
            toastr.error("مقادیر واردشده تکراری است.");
            console.log("duplicate")
            return;
        }
        if (result.status == "failed") {
            toastr.error("بروز خطا در ثبت زیر دسته");
            console.log("failed")
            return;
        }
        if (result.status == "success") {
            toastr.success("زیر دسته با موفقیت ثبت شد!");
            console.log("success")
            getAllSub2();   // get all answers and refresh dataTable
            return;
        }


        toastr.error("بروز خطا!");


    });

    //=========================== edit/updateSubCategory =======================//

    $(document).on("click", ".editSub2Btn", async function (evt) {

        // let sub2Id =$(this).closest("tr").attr("data-id");
        let sub2Id = $(this).attr("data-id");

        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await getData(`/sub2-cat/get-one/${sub2Id}`, headers)
        if (data.status == "notFound") {
            toastr.error("بروز خطا در دریافت ");
            return;
        }

        $("#editSub2Modal").find("#doEditSub2Modal").data("recordid", sub2Id).attr("data-recordid", sub2Id);

        //fill data to edit modal

        $("#editSub2Modal").find("#editTitleSub2").val(data.status.title);
        $("#editSub2Modal").find("#editDescSub2").val(data.status.description);
        $("#editSub2Modal").find("#editCountSub2").val(data.status.child_count);
        // $("#editSub2Modal").find("").val(data.parent_category.cat_pic);

        //show modal
        $("#editSub2Modal").modal("show");

    });

    $("#doEditSub2Modal").on("click", async function (evt) {
        showLoader();
        let sub2Id = $(this).attr("data-recordid");

        let titleSub2 = $("#editSub2Modal").find("#editTitleSub2").val();
        let DescSub2 = $("#editSub2Modal").find("#editDescSub2").val();
        let countSub2 = $("#editSub2Modal").find("#editCountSub2").val();
        // let imgSub2 = $("#editSub2Modal").find("#editImgSub2").val();

        let csrfToken = $(document).find("meta[name=csrf_token]").attr("content");
        let TableRowId = $(this).attr("data-recordid");


        let data = {
            "title": titleSub2,
            "description": DescSub2,
            "child_count": countSub2,
            // "doc_file":picFile
        }

        //upload_file

        //updata_data

        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        };

        let res = await postData(`/sub2-cat/update/${sub2Id}`, headers, data);
        hideLoader();

        if (res.status == "validation-error") {
            $(document).each(data.errors, (index, err) => toastr.error(err));
            return;
        }

        if (res.status == "duplicate") {
            toastr.errors("نام یا توضیحات وارد شده تکراری می باشد")
            return;
        }
        if (res.status !== "notFound") {
            toastr.success("ویرایش زیردسته با موفقیت انجام شد!");
            $(document).find("#myTableSub2").find(`tr#${TableRowId}`).find(".titleCategory").html(titleSub2);
            $(document).find("#myTableSub2").find(`tr#${TableRowId}`).find(".Desc").html(DescSub2);

            //============ updatapic ========//
            // let picMe=URL.createObjectURL(imgSub2);
            // $(`.modal#${sub2Id}`).find(".picUpdate").attr('src',picMe)

            //clear all inputs for futurFas
            $("#editSub2Modal").on("hide.bs.modal", () => $(this).find(".inp").val(''));
            location.reload();

            return;
        }


    })
    //=========================== showSubCategory =======================//
    $(document).on("click", ".showSub2Btn", async function (evt) {
        let sub2Id = $(this).attr("data-id");

        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };

        let res = await getData(`/sub2-cat/get-one/${sub2Id}`, headers)
        hideLoader(); //hide loader

        if (res.status == "notFound") {

            toastr.error("بروز خطا در دریافت اطلاعات دسته بندی");
            return;
        }

        // fill data to edit modal
        $("#showSub2Modal").find("#showSub2Title").val(res.status.title);
        $("#showSub2Modal").find("#showSub2Desc").val(res.status.description);
        $("#showSub2Modal").find("#showSub2Count").val(res.status.child_count);

        // toastr.success("نمایش زیر دسته با موفقیت انجام شد.");

        // show modal
        $("#showSub2Modal").modal("show");

    });


    //============================ customFunction =============================//
    //============= getAll =========//
    async function getAllSub2() {

        let parent_cat_id = $("meta[name=category_id]").attr("content");

        let data = await getData(`/sub2-cat/get-all/${parent_cat_id}`, {

            "accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });
        if (data.status !== "refused") {
            updateDataTable(data.status.sub_cat);
        }
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
    function changeDeleteRestoreButton(fromElementName, toElementName, Sub2Id) {


        let tableRow = $(document).find("#myTableSub2").find(`tr#${Sub2Id}`);

        let restoreBtn =
            `<button type="button" class="btn btn-sm btn-info ml-2 mt-1 restoreSub2Btn" data-target="#restoreSub2Modal"
                                     data-toggle="modal" data-id="${Sub2Id}" >
                                <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
                                     data-placement="top" title="بازیابی"></i>
                            </button>`;

        let deleteBtn =
            `<button type="button" class="btn btn-sm btn-danger ml-2 mt-1 deleteSub2Btn" data-target="#deleteSub2Modal"
                                       data-toggle="modal" data-id="${Sub2Id}" >
                                  <i class="icon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>
                             </button> `;

        $("#myTableSub2")
            .fadeOut(500, function () {
                tableRow
                    .find(`#${fromElementName}`)
                    .replaceWith(`.${toElementName == 'restoreSub2Btn' ? restoreBtn : deleteBtn}`);

                //manage deleteAt column to empty value or current value
                tableRow.find(".deletedAt").html(`${toElementName == 'restoreSub2Btn' ? getCurrentData() : ''}`);
            })
            .fadeIn(500);


    } //end changeBtn

    //========= updateDataTable ============//
    function updateDataTable(receivedData) {
        if (myTableSub2 != null)
            myTableSub2.destroy();

        myTableSub2 = $('#myTableSub2').DataTable({
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
                    "name": "titleCategory",
                    render: function (data, type, row, meta) {
                        return row['category']['title']
                    },
                    "targets": 1,
                    "className": 'titleCategory'
                },
                {
                    "name": "Desc",
                    render: function (data, type, row, meta) {
                        return row['category']["description"]
                    },
                    // "data": "category.description",
                    "targets": 2,
                    "className": 'Desc'
                },
                {
                    "name": "subcatcount",
                    // "data": row['category']["category_id"],
                    render: function (data, type, row, meta) {
                        return row["child_count"]
                    },
                    // "data": "category.category_id",
                    "targets": 3,
                    "className": 'subcatcount'
                },
                {
                    "name": "mainCat",
                    // "data": row['category']["category_id"],
                    render: function (data, type, row, meta) {
                        return row['category']["category_id"]
                    },
                    // "data": "category.category_id",
                    "targets": 4,
                    "className": 'mainCat'
                },
                {
                    "name": "DelDate",
                    // "data": row['category']["deleted_at"],
                    render: function (data, type, row, meta) {
                        return row['category']["deleted_at"]
                    },
                    // "data": "category.deleted_at",
                    "targets": 5,
                    "className": 'DelDate'
                },
                {
                    "name": "operation",
                    "targets": 6,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let restoreBtn =
                            `<button type="button" class="btn btn-sm btn-info ml-2 mt-1 restoreSub2Btn" data-target="#restoreSub2Modal"
                                     data-toggle="modal" data-id="${row.category.id}" >
                                <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
                                     data-placement="top" title="بازیابی"></i>
                            </button>`;

                        let deleteBtn =
                            `<button type="button" class="btn btn-sm btn-danger ml-2 mt-1 deleteSub2Btn" data-target="#deleteSub2Modal"
                                       data-toggle="modal" data-id="${row.category.id}" >
                                  <i class="icon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>
                             </button> `;

                        return `
                            <td class="operation">

                              ${row.category.deleted_at != null ? restoreBtn : deleteBtn}

                                <button class="btn btn-sm btn-info ml-2 mt-1 editSub2Btn" data-target="#editSub2Modal" data-toggle="modal"
                                        id="editSub2Btn" data-id="${row.category.id}" data-recordid="${row.category.id}">
                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top" title="ویرایش"></i>
                                </button>
                                <button class="btn btn-sm btn-primary ml-2 mt-1 showSub2Btn" data-target="#showSub2Modal" data-toggle="modal"
                                        id="showSub2Btn" data-id="${row.category.id}" data-recordid="${row.category.id}">
                                    <i class="icon-eye" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="نمایش"></i>
                                </button>
                                <button class="btn btn-sm btn-danger ml-2 mt-1 imageLogoSub2Btn" data-target="#logoimageSub2Modal"
                                        data-toggle="modal" id="imageLogoSub2Btn" data-id="${row.category.id}" data-recordid="${row.category.id}">
                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="تصویر لوگو"></i>
                                </button>
                                <button class="btn btn-sm btn-warning ml-2 mt-1"><a href="/sub3-cat/page/${row.category.id}">
                                        <i class="icon-list" aria-hidden="true" data-toggle="tooltip"
                                           data-placement="top"
                                           title="زیر دسته3"></i></a>
                                </button>
                                <button class="btn btn-sm btn-info ml-2 mt-1"> <a href="/attribute/page/${row.category.id}">
                                        <i class="icon-star" aria-hidden="true" data-toggle="tooltip"
                                           data-placement="top"
                                           title="ویژگی های دسته2"></i></a>
                                </button>
                            </td>
                             `;
                    }
                },
            ],

            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center').data("id", data.category.id).attr("data-id", data.category.id);
            },

        });
    }


});//end document
