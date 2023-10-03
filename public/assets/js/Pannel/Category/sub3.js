$(document).ready(function () {
    let tableSub3Category = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableSub3Category').on('draw.dt', () => hideLoader());
    getSub3();

    //=================================== show data ===============================//

    $(document).on('click', ".show-sub3-btn", function (event) {
        let sub_cat_id = $(this).data('id');
        fetch(`/sub3-cat/get-one/${sub_cat_id}`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
            , method: "GET"
        })
            .then(response => response.json())
            .then(data => {
                if (data.status !== "notFound") {

                    $("#title_show").val(data.status.title)
                    $("#desc_show").val(data.status.description)
                    $("#count_show").val(data.status.child_count)

                } else {
                    toastr.error('خطا در نمایش ')
                }
            })
    })
    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });
    // ====================================== insert =========================//
    $("#new_sub3_modal").on("hide.bs.modal", () => $(this).find(".inp").val(''));
    $("#insert_new_sub3").on("click", function () {

        let data = {
            "title": $("#new_title").val(),
            "description": $("#new_desc").val(),
            "child_count": $("#new_count").val(),
        };


        let parent_cat_id = 3
        fetch(`/sub3-cat/insert/${parent_cat_id}`, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Accept": "application/json",
                "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                console.log(data);
                if (data.status.status == "success") {
                    toastr.success("ثبت  با موفقیت انجام شد.");
                }
                if (data.status.status == "validation-error") {
                    $.each(data.errors, (index, err) => toastr.error(err));
                    return;
                }
                if (data.status.status == "duplicate") {
                    toastr.error("مقادیر واردشده تکراری است.");
                    return;
                }
                getSub3();

            });
    });

    //=================================== update data ===============================//

    $(document).on('click', ".edit-sub3-btn", async function () {
        let sub_cat_id = $(this).attr('data-id');

        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        $("#edit_sub3_modal").find("#edit-sub3").data('recordid', sub_cat_id).attr('data-recordid', sub_cat_id);

        let data = await getData(`/sub3-cat/get-one/${sub_cat_id}`, headers)


        if (data.status == "notFound") {
            toastr.error("خطا در گرفتن لیست یک سازمان");
            return;
        } else {
            // console.log(data);
            $("#edit_title").val(data.status.title)
            $("#edit_desc").val(data.status.description)
            $("#edit_count").val(data.status.child_count)
        }
    })
    $("#edit-sub3").on('click', async function () {
        let sub_cat_id = $(this).attr('data-id');
        // sub_cat_id = 4 ;
        let title = $("#edit_title").val()
        let description = $("#edit_desc").val()
        let under_count = $("#edit_count").val()
        data = {
            "title": title,
            "description": description,
            "child_count": under_count,
        }
        await fetch(`/sub3-cat/update/${sub_cat_id}`, {
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(data),
            method: "POST"
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                getSub3()
            })
    });

    //============================== delete Sub3 =======================//

    $(document).on('click', ".delete-sub3-btn", function (event) {
        let id = $(this).data('id');
        $("#del_sub3_modal #delete-sub3").data("recordid", id).attr("data-recordid", id);
    })
    $("#delete-sub3").on('click', async function () {
        let sub_cat_id = $(this).data("recordid")
        fetch(`/sub3-cat/delete/${sub_cat_id}`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
            , method: "GET"
        })
            .then(response => response.json())
            .then(data => {
                if (data.status !== "notFound") {
                    toastr.success("زیر دسته با موفقیت حذف شد");

                    getSub3();
                } else {
                    toastr.error('خطا در حذف ارگان')
                }
            })
    })

    // ================================== restore Sub3 =========================//

    $(document).on('click', ".restore-sub3-btn", function (event) {
        let id = $(this).attr('data-id');
        $("#res_sub3_modal #restore-sub3").data('recordid', id).attr('data-recordid', id);
    });
    $("#restore-sub3").on('click', function () {
        let sub_cat_id = $(this).data("recordid");
        fetch(`/sub3-cat/restore/${sub_cat_id}`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method: "GET"
        })
            .then(response => response.json())
            .then(data => {
                if (data.status !== "notFound") {
                    toastr.success("زیر دسته با موفقیت بازیابی شد");
                    getSub3();

                    return;
                }
                toastr.error("بروز خطا");
            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });
    })

// ================================== functions =========================//
    async function getSub3() {
        let parent_cat_id = $("meta[name=category_id]").attr("content");
        // console.log(parent_cat_id)
        let data = await getData(`/sub3-cat/get-all/${parent_cat_id}`, {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });
        console.log(data.status)
        updateTable(data.status.sub_cat);

    }

    async function getData(url, headers) {
        let response = await fetch(url, {headers: headers, method: 'GET'});
        return response.json()
    }


//========================== countUnderList =====================//

    async function sub4(parent_cat_id) {
        let data = await getData(`/sub4-cat/get-all/${parent_cat_id}`, {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });
        $(".sub3_tag").empty()
        data.status.sub_cat.forEach(function (object) {


            let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 delete_tag" data-id="${object.category.id}" >
                                   <i class="icon-trash " aria-hidden="true" data-toggle="tooltip"
                                   data-placement="top"
                                   title="حذف"></i>
                                </button>`;


            let restoreBtn = `<button class="btn btn-sm btn-info ml-2 restore_tag" data-id="${object.category.id}" >
                                   <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                   data-placement="top"
                                   title="بازیابی"></i>
                                </button>`;

            $(".sub3_tag").append(`
                <tr data-id="${object.category.id}">
                                        <td class="text-center col-3" data-id="${object.category.id}" >${object.category.id}</td>
                                        <td class="text-center col-3" data-id="${object.category.id}" >${object.category.title}</td>
                                        <td class="text-center col-3" data-id="${object.category.id}" >${object.category.description}</td>
                                        <td class="text-center col-3" data-id="${object.category.id}" >${object.category.deleted_at != null ? object.category.deleted_at : ''}</td>
                                        <td class="text-center col-3 d-flex ">
                                            ${object.category.deleted_at != null ? restoreBtn : deleteBtn}
                                            <button class="btn btn-sm btn-primary ml-2 uplaod_tag" data-id="${object.category.id}" >
                                                <i class="icon-cloud-upload " aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="آپلود"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning ml-2 download_tag" data-id="${object.category.id}" >
                                                <i class="icon-cloud-download " aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="دانلود"></i>
                                            </button>
                                        </td>
                                    </tr>
                `
            )
        })
    }

    $(document).on('click', ".under-sub3-btn", function () {
        let category_id = $(this).attr("data-id");
        sub4(category_id);


        // دکمه ی حذف ===========================================================

        $(document).on('click', ".delete_tag", function () {
            let sub_cat_id = $(this).attr('data-id');
            fetch(`/sub4-cat/delete/${sub_cat_id}`, {
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
                    sub4(category_id);
                })
        })


        $(document).on("click", ".sabt_tag", function () {
            let title = $(".title_tag").val();
            let description = $(".description_tag").val();
            data = {
                "title": title,
                "description": description
            }
            fetch(`/sub4-cat/insert/${category_id}`, {
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data),
                method: "POST",
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    sub4(category_id);
                    $(".title_tag").val('')
                    $(".description_tag").val('')
                })
                .catch(err => {
                    console.log(err)
                })
        })


        $(document).on('click', ".restore_tag", function () {
            let sub_cat_id = $(this).attr('data-id');
            fetch(`/sub4-cat/restore/${sub_cat_id}`, {
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                method: "GET"
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    toastr.success('با موفقیت انجام شد')
                    sub4(category_id);
                })
        })

    })


//========================== updateDataTable =====================//

    function updateTable(receiveData) {
        if (tableSub3Category != null)
            tableSub3Category.destroy();
        tableSub3Category = $('#tableSub3Category').DataTable({
            data: receiveData,
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
                    "name": "category_name",
                    render: function (data, type, row, meta) {
                        return row['category']['title']
                    },
                    "targets": 1,
                    "className": 'category_name',
                },
                {
                    "name": "desc",
                    render: function (data, type, row, meta) {
                        return row['category']['description']
                    },
                    "targets": 2,
                    "className": 'desc',
                },
                {
                    "name": "subcatcount",
                    render: function (data, type, row, meta) {
                        return row['child_count']
                    },
                    "targets": 3,
                    "className": 'category_parent',
                },
                {
                    "name": "created_at",
                    render: function (data, type, row, meta) {
                        return row['category']['created_at']
                    },
                    "targets": 4,
                    "className": 'created_at',
                },
                {
                    "name": "deleted_at",
                    render: function (data, type, row, meta) {
                        return row['category']['deleted_at']
                    },
                    "targets": 5,
                    "className": 'deleted_at',
                },
                {
                    "name": "operation",
                    "targets": 6,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = ` <button type="button" class="btn btn-sm btn-danger ml-2  delete-sub3-btn"
                                                      data-target="#del_sub3_modal" data-toggle="modal" data-id="${row.category.id}">
                                                   <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                          data-placement="top" title="حذف"></i>
                                                 </button>`;
                        let restoreBtn = `<button type="button" class="btn btn-sm btn-warning ml-2  restore-sub3-btn"
                                                      data-target="#res_sub3_modal" data-toggle="modal" data-id="${row.category.id}">
                                                   <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                                         data-placement="top"  title="بازیابی"></i>
                                                   </button>`;
                        return `
                      <td class="operation">
                            ${row.category.deleted_at != null ? restoreBtn : deleteBtn}
                                        <button class="btn btn-sm btn-warning ml-2 edit-sub3-btn" data-target="#edit_sub3_modal" data-recordid="${row.category.id}" data-id="${row.category.id}"
                                               data-toggle="modal">
                                            <i class="icon-note " aria-hidden="true" data-toggle="tooltip"
                                               data-placement="top"
                                               title="ویرایش"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success ml-2 mt-1 show-sub3-btn" data-target="#show_sub3_modal"
                                               data-toggle="modal" data-id="${row.category.id}">
                                            <i class="icon-screen-desktop" aria-hidden="true" data-toggle="tooltip "
                                               data-placement="top"
                                               title="نمایش"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger ml-2 mt-1 logo-sub3-btn" data-target="#logo_sub3_modal" data-id="${row.category.id}"
                                               data-toggle="modal">
                                            <i class="icon-camera" aria-hidden="true" data-toggle="tooltip "
                                               data-placement="top"
                                               title="تصویر لوگو"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning ml-2 mt-1 under-sub3-btn" data-target="#under_sub3_modal" data-id="${row.category.id}"
                                               data-toggle="modal">
                                            <i class="icon-list" aria-hidden="true" data-toggle="tooltip "
                                               data-placement="top"
                                               title="زیر دسته ها"></i>
                                        </button>
                                        <button class="btn btn-sm btn-info ml-2 mt-1" data-id="${row.category.id}"
                                         ><a href="/attribute/page/${row.category.id}">
                                                <i class="icon-star" aria-hidden="true" data-toggle="tooltip "
                                                   data-placement="top"
                                                   title="ویژگی های دسته"></i></a>
                                        </button>
                                </td>
                    `;
                    }
                }
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center').data("id", data.id).attr('data-id', data.id)
            },
        });
    }
});
