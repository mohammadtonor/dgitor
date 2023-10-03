$(document).ready(function () {

    //=========================== getAllAddressPersonal =======================//

    let myTableAddressPersonal = null;

    $('#myTableAddressPersonal').on('draw.dt', () => hideLoader());
    getAllAddressPersonal();

    getAllCities();

    //=========================== deleteAddressPersonal =======================//
    $(document).on("click",".deleteAddressBtn",function(evt){

        let AddressPersonalId = $(this).closest("tr").attr("data-id");

        $("#deleteAddressModal #doDeleteModal").data("recordid",AddressPersonalId).attr("data-recordid",AddressPersonalId);
    });

    $("#doDeleteModal").on("click",async function(){
        let AddressPersonalId = $(this).attr("data-recordid");

        fetch(`/user/address/del/${AddressPersonalId}`,{

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
                    toastr.success("آدرس با موفقیت حذف شد");
                    changeDeleteRestoreButton("deleteAddressBtn","restoreAddressBtn",AddressPersonalId);
                    getAllAddressPersonal(data.addrs);

                }

                else if(data.status == "failed"){
                    toastr.error(" عدم حذف این آدرس");
                }

                else{
                    toastr.error("بروز خطا درحذف این آدرس");
                }
            })

    });

    //============================ restoreAddressPersonal =======================//
    $(document).on("click",".restoreAddressBtn",function (evt){
        let AddressPersonalId = $(this).closest("tr").attr("data-id");

        $("#restoreAddressModal #dorestoreModal").data("recordid",AddressPersonalId).attr("data-recordid",AddressPersonalId);

    });

    $("#dorestoreModal").on("click",function(){

        let AddressPersonalId= $(this).data("recordid");

        fetch(`/user/address/restore/${AddressPersonalId}`,{
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
                    changeDeleteRestoreButton("#deleteAddressBtn","#restoreAddressBtn",AddressPersonalId);
                    getAllAddressPersonal(data.addrs);
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
    //============================ insertAddressPersonal =========================//
    $("#insertAddressBtn").on("hide.bs.modal", () => $(this).find(".inp").val(''));

    $("#insertAddressBtn").on("click",function(){
        $("#insertAddressModal").find("#titleAdress").val("");
        $("#insertAddressModal").find("#InsertCity_selectbox").val("");
        $("#insertAddressModal").find("#postal_code").val("");
        $("#insertAddressModal").find("#complateAdress").val("");

        $("#insertAddressModal").modal("show");
    });

    $("#doInsertAdress").on("click",function(){

        let  user_id = $("meta[name=user_id]").attr("content");

        let title = $("#insertAddressModal").find("#titleAdress").val();
        let city = $("#insertAddressModal").find("#InsertCity_selectbox").val();
        let postCode = $("#insertAddressModal").find("#postal_code").val();
        let address = $("#insertAddressModal").find("#complateAdress").val();

        let data={

            "title": title,
            "city_id": city,
            "postal_code": postCode ,
            "address":address,
            "user_id":user_id,
        };

        fetch(`/user/address/insert/${user_id}`,{
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
                    getAllAddressPersonal(data.addrs);
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

    //============================= edit/updateAddressPersonal ======================//
    $(document).on("click",".editAddresBtn",async function(evt){

        let AddressPersonalId = $(this).closest("tr").attr("data-id");

        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await getData(`/user/address/get-one/${AddressPersonalId}`,headers)
        if(data.status == "notFound"){
            toastr.error("بروز خطا در دریافت ");
            return;
        }

        $("#editAddresModal").find("#doEditeAddressModal").data("recordid",AddressPersonalId).attr("data-recordid",AddressPersonalId);

        //fill data to edit modal
        $("#editAddresModal").find("#editAddresModalTitle").val(data.status.title);
        $("#editAddresModal").find("#cityEdit_selectbox").val(data.status.city_id);
        $("#editAddresModal").find("#editAddresModalPostalCode").val(data.status.postal_code);
        $("#editAddresModal").find("#editAddresModalAddress").val(data.status.address);


        //show modal
        $("#editAddresModal").modal("show");
    });


    $("#doEditeAddressModal").on("click",async function(evt){
        let AddressPersonalId = $(this).data("recordid");

        let  user_id = $("meta[name=user_id]").attr("content");

        let Title = $("#editAddresModal").find("#editAddresModalTitle").val();
        let city = $("#editAddresModal").find("#cityEdit_selectbox :selected").val();
        let postalCode = $("#editAddresModal").find("#editAddresModalPostalCode").val();
        let adress = $("#editAddresModal").find("#editAddresModalAddress").val();

        let csrfToken = $(document).find("meta[name=csrf_token]").attr("content");
        let TableRowId = $(this).attr("data-recordid");

        let data={
            "title":Title,
            "city_id":city,
            "postal_code":postalCode,
            "address":adress,
            "user_id" : user_id,
        };

        let headers={
            "accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        };

        let res = await postData(`/user/address/update/${AddressPersonalId}`,headers,data);

        if(res.status == "validation-error"){
            $(document).each(data.errors, (index, err) => toastr.error(err));
            return;
        }

        if(res.status == "success"){

            $(document).find(`tr#${TableRowId}`).find(".titleAdress").html(Title);
            $(document).find(`tr#${TableRowId}`).find(".PostalCode").html(postalCode);
            $(document).find(`tr#${TableRowId}`).find(".city_id").html(city);

            //clear all inputs for futur
            $(".editCourseTypeModal").on("click",function (){
                $("#editAddresModal").find("#editAddresModalTitle").val("");
                $("#editAddresModal").find("#cityEdit_selectbox").val("");
                $("#editAddresModal").find("#editAddresModalPostalCode").val("");
                $("#editAddresModal").find("#editAddresModalAddress").val("");
            });

            getAllAddressPersonal(data.addrs);
            // location.reload();

            toastr.success("ویرایش با موفقیت انجام شد...");
            return;
        }

    });

    //============================= showAddressPersonal =============================//
     $(document).on("click",".showAddreseBtn",async function(evt){
         let AddressPersonalId = $(this).closest("tr").attr("data-id");

         console.log(AddressPersonalId+"$$$$$$");

         let headers = {
             "accept": "application/json",
             "X-Requested-With": "XMLHttpRequest",
             "Content-Type": "application/json",
         };

         let data = await getData(`/user/address/get-one/${AddressPersonalId}`,headers)

         console.log(data);

         if(data.status == "notFound"){
             toastr.error("بروز خطا در دریافت اطلاعات ");
             return;
         }

         //fill data to show modal
         $("#showAddresModal").find("#showAddresModalTitle").val(data.status.title);
         $("#showAddresModal").find("#showAddresModalCity").val(data.status.city_id);
         $("#showAddresModal").find("#showAddresModalPostalCode").val(data.status.postal_code);
         $("#showAddresModal").find("#showAddresModalFullAdress").val(data.status.address);

         //show modal
         $("#showAddresModal").modal("show");

         toastr.success("نمایش آدرس با موفقیت انجام شد...");
     });

    //============================ customFunction =============================//

    //============= getAll =========//

    async function getAllAddressPersonal() {

        let  user_id = $("meta[name=user_id]").attr("content");

        let data = await getData(`/user/address/get-all/${user_id}`, {

            "accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });
        updateDataTable(data.addrs);

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

    function changeDeleteRestoreButton(fromElementName, toElementName, AddressPersonalId) {

        let tableRow = $(document).find("#myTableAddressPersonal").find(`tr#${AddressPersonalId}`);

        let restoreBtn =
            `<button type="button" class="btn btn-sm btn-info ml-2 mt-1 restoreAddressBtn" data-target="#restoreAddressModal"
                     data-toggle="modal" data-id="${AddressPersonalId}" id="restoreAddressBtn">
                <i class="icon-loop" aria-hidden="true" data-toggle="tooltip"
                    data-placement="top" title="restore"></i>
            </button>`;

        let deleteBtn =
            `<button type="button" class="btn btn-sm btn-danger ml-2 mt-1 deleteAddressBtn" data-target="#deleteAddressModal"
                     data-toggle="modal" data-id="${AddressPersonalId}" id="deleteAddressBtn">
               <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                    data-placement="top" title="حذف"></i>
            </button> `;


        $("#myTableAddressPersonal")
            .fadeOut(500, function () {
                tableRow
                    .find(`#${fromElementName}`)
                    .replaceWith(`.${toElementName == 'restoreAddressBtn' ? restoreBtn : deleteBtn}`);

                //manage deleteAt column to empty value or current value
                tableRow.find(".deletedAt").html(`${toElementName == 'restoreAddressBtn' ? getCurrentData() : ''}`);
            })
            .fadeIn(500);


    } //end changeBtn

    //========= city =======//
    async function getAllCities(){

        let  ostan_id = $("meta[name=ostan_id]").attr("content");

        console.log(ostan_id);

        let result = await getData(`/city/get-all/1`,{
            "accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });

        let targetSelectBox = $(".modal").find(".city-selectbox");
        targetSelectBox.empty();
        targetSelectBox.append('<option value="">انتخاب کنید</option> ');

        $.each(result.status.cities, function(key,value){
            targetSelectBox.append(`<option value="${value.city.id}">${value.city.name}</option>`)
        })
    }

    //========= updateDataTable ============//

    async function updateDataTable(receivedData) {

        if (myTableAddressPersonal != null)
        myTableAddressPersonal.destroy();

        myTableAddressPersonal = $('#myTableAddressPersonal').DataTable({
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
                    "name": "title",
                    "data": "title",
                    "targets": 1,
                    "className": 'titleAdress'
                },
                {
                    "name": "postal_code",
                    "data": "postal_code",
                    "targets": 2,
                    "className": 'PostalCode'
                },
                {
                    "name": "city_id",
                    "data": "city_id",
                    "targets": 3,
                    "className": 'City'
                },
                {
                    "name": "created_at",
                    "data": "created_at",
                    "targets": 4,
                    "className": '' +
                        ''
                },
                {
                    "name": "deleted_at",
                    "data":"deleted_at",
                    "targets": 5,
                    "className": 'DelDate'
                },
                {
                    "name": "operation",
                    "targets": 6,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let restoreBtn =
                            `<button type="button" class="btn btn-sm btn-info ml-2 mt-1 restoreAddressBtn" data-target="#restoreAddressModal"
                                     data-toggle="modal" data-id="${row.id}" id="restoreAddressBtn">
                                  <i class="icon-loop" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="restore"></i>
                            </button>`;

                        let deleteBtn =
                             `<button type="button" class="btn btn-sm btn-danger ml-2 mt-1 deleteAddressBtn" data-target="#deleteAddressModal"
                                       data-toggle="modal" data-id="${row.id}" id="deleteAddressBtn">
                                  <i class="icon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>
                             </button> `;

                        return `
                            <td class="operation">

                              ${row.deleted_at != null ? restoreBtn : deleteBtn}

                                <button class="btn btn-sm btn-info ml-2 mt-1 editAddresBtn" data-target="#editAddresModal" data-toggle="modal" id="editAddresBtn"
                                   data-id="${row.id}" data-recordid="${row.id}" >
                                    <i class="icon-pencil" aria-hidden="true" data-toggle="tooltip"  data-placement="top"  title="ویرایش"></i>
                                </button>
                                <button class="btn btn-sm btn-primary ml-2 mt-1 showAddreseBtn" data-target="#" data-toggle="modal" id="showAddreseBtn"
                                      data-id="${row.id}" data-recordid="${row.id}" >
                                    <i class="icon-eye" aria-hidden="true" data-toggle="tooltip " data-placement="top" title="نمایش"></i>
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
