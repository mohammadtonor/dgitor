$(document).ready(function () {

    let user_id = $("meta[name=user_id]").attr('id');

    let tablePersonnelPhoneNumber =  $('#tablePersonnelPhoneNumber').DataTable({

        "order": [],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "language": {
            "emptyTable": "هیچ داده ای برای نمایش وجود ندارد",
            "info": "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
            "infoEmpty": "نمایش 0 تا 0 از 0 آیتم",
            "infoFiltered": "(فیلتر شده از جمعا _MAX_ ایتم)",
            "zeroRecords": "داده مشابهی پیدا نشد",
        }
    });



    //=================================== update data ===============================//

    $(document).on("click", ".edit-contact-btn", async function (evt) {
        let id = $(this).closest("tr").attr("data-id");

        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };
        let data = await getData(`/user/phone/get/${id}`, headers)
        if (data.result == "notFound") {
            toastr.error("بروز خطا در دریافت شماره تماس");
            return;
        }


        $("#editphonenumber").find("#edit_btn").data("recordid", id).attr("data-recordid", id);


        //fill data to edit modal
        $("#editphonenumber").find("#edit_title").val(data.status.title);
        $("#editphonenumber").find("#edit_phone").val(data.status.phone);

        //show modal
        $("#edit-modal").modal("show");
    });

    $("#edit_btn").on("click", async function (evt) {
        let id = $(this).data("recordid");

        let title = $("#editphonenumber").find("#edit_title").val();
        let phone = $("#editphonenumber").find("#edit_phone").val();


        let csrfToken = $(document).find("meta[name=csrf_token]").attr("content");

        let data = {
            "title": title,
            "phone": phone,
        };

        let headers = {
            "X-CSRF-TOKEN": csrfToken,
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };

        let res = await postData(`/user/phone/update/${id}`, headers, data);


        if (res.status.status == "validation-error") {
            $(document).each(data.errors, (index, err) => toastr.error(err));
            return;
        }
        if (res.status.status == "success") {
            //clear all inputs for future
            $(".insert-tag-btn").on("click", function () {
                $("#edit-modal").find("#edit-title-fa").val("");
                $("#edit-modal").find("#edit-title-en").val("");
            });

            toastr.success("ویرایش با موفقیت انجام شد...");
            $('#edit-modal').modal('toggle');


            getAllContact(res.status.result);

            return;
        }
        if(res.status == "duplicate"){

            $('#edit-modal').modal('toggle');
            toastr.error(" تگ تکراری وارد کرده اید!..");
            return;
        }

    });

    //=================================== insert tag ===============================//

    $("#new_phone_number").on("click", function () {
        $("#new_title").val("");
        $("#new_phone").val("");
    });

    $("#insert_btn").on("click", function () {

        let data = {
            "title": $("#new_title").val(),
            "phone": $("#new_phone").val(),
        };


        fetch('/user/phone/insert', {
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
                if(data.status.status == "success"){
                    toastr.success("ثبت شماره تماس با موفقیت انجام شد.");
                }
                if (data.status.status == "validation-error") {
                    $.each(data.errors, (index, err) => toastr.error(err));
                    return;
                }
                if (data.status.status == "duplicate") {
                    toastr.error("شماره تماس واردشده تکراری است.");
                    return;
                }
                getAllContact(data.status.result);

            });
    });


    //============================== show contact =======================//

    $(document).on('click',".show-contact-btn",function (event) {
        let id = $(this).data('id');
        fetch(`/user/phone/get/${id}`,{
            headers:{
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                // "Content-Type": "application/json"
            }
            , method:"GET"
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status !== "notFound"){
                    $("#show_title").val(data.status.title)
                    $("#show_phone").val(data.status.phone)
                    getAllContact();
                } else {
                    toastr.error('خطا در نمایش تماس')
                }
            })
    })



    //============================== delete contact =======================//

    $(document).on('click',".delete-contact-btn",function (event) {
        let id = $(this).data('id');
        $("#deletephonenumber #delete_btn").data("recordid", id).attr("data-recordid", id);
    })

    $("#delete_btn").on('click',async function () {
        let id = $(this).data("recordid")

        fetch(`/user/phone/del/${id}`,{
            headers:{
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                // "Content-Type": "application/json"
            }
            , method:"GET"
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status !== "notFound"){
                    toastr.success("شماره تماس با موفقیت حذف شد");
                    getAllContact();
                } else {
                    toastr.error('خطا در حذف شماره تماس')
                }
            })
    })

    // ================================== restore contact =========================//

    $(document).on('click',".restore-contact-btn",function (event) {
        let id = $(this).attr('data-id');
        $("#restorephonenumber #restore_btn").data('recordid',id).attr('data-recordid',id);
    });

    $("#restore_btn").on('click',function () {
        let id = $(this).data("recordid");
        fetch(`/user/phone/restore/${id}`,{
            headers:{
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method:"GET"
        })
            .then(response=>response.json())
            .then(data=>{
                if (data.status !== "notFound") {
                    toastr.success("اطلاعات سطح با موفقیت بازیابی شد");
                    getAllContact();

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

    getAllContact();

    async function getAllContact(){

        // let data = await getData(`/user/phone/get/${id}`,{
        let data = await getData(`/user/phone/getall/1`,{
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });

        // console.log(data.status);
        updateTable(data.status);

    }
    async function getData(url,headers){
        let response = await fetch(url,{headers:headers,method:'GET'});
        return response.json()
    }



//========================== updateDataTable =====================//

    function updateTable(receiveData) {
        if (receiveData === "notFound"){
            receiveData = [];
        }
        tablePersonnelPhoneNumber.destroy();
        tablePersonnelPhoneNumber = $('#tablePersonnelPhoneNumber').DataTable({
            data:receiveData,
            "language": {
                "emptyTable": "هیچ داده ای برای نمایش وجود ندارد",
                "info": "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
                "infoEmpty": "نمایش 0 تا 0 از 0 آیتم",
                "infoFiltered": "(فیلتر شده از جمعا _MAX_ ایتم)",
                "zeroRecords": "داده مشابهی پیدا نشد",
            },
            "columnDefs":[
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
                    "name": "title_contact",
                    "data":'title',
                    "targets": 1,
                    "className": 'title_contact',
                },
                {
                    "name": "phone_number",
                    "data":"phone",
                    "targets": 2,
                    "className": 'phone_number',
                },
                {
                    "name": "created_at",
                    "data":"created_at",
                    "targets": 3,
                    "className": 'created_at',
                },
                {
                    "name": "deleted_at",
                    "data":"deleted_at",
                    "targets": 4,
                    "className": 'deleted_at',
                },
                {
                    "name": "operation",
                    "targets": 5,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = ` <button type="button" class="btn btn-sm btn-danger ml-2  delete-contact-btn"
                                                      data-target="#deletephonenumber" data-toggle="modal" data-id="${row.id}">
                                                   <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                          data-placement="top" title="حذف"></i>
                                                 </button>`;
                        let restoreBtn = `<button type="button" class="btn btn-sm btn-warning ml-2  restore-contact-btn"
                                                      data-target="#restorephonenumber" data-toggle="modal" data-id="${row.id}">
                                                   <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                                         data-placement="top"  title="بازیابی"></i>
                                                   </button>`;
                        return `
                      <td class="operation">
                            ${row.deleted_at != null ? restoreBtn : deleteBtn}
                                        <button class="btn btn-sm btn-warning ml-2 edit-contact-btn" data-target="#editphonenumber" data-recordid="${row.id}" data-id="${row.id}"
                                                data-toggle="modal">
                                            <i class="icon-note " aria-hidden="true" data-toggle="tooltip"
                                               data-placement="top"
                                               title="ویرایش"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary ml-2 mt-1 show-contact-btn" data-recordid="${row.id}" data-id="${row.id}"
                                                        data-target="#showphonenumber"
                                                        data-toggle="modal">
                                                    <i class="icon-camera" aria-hidden="true" data-toggle="tooltip "
                                                       data-placement="top"
                                                       title="نمایش"></i>
                                        </button>
                                </td>
                    `;
                    }
                }
            ],
            createdRow: function (row,data,dataIndex) {
                $(row).addClass('data text-center').data("id",data.id).attr('data-id',data.id)
            },
        });
    }

});
