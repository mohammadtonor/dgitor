$(document).ready(function(){

    //-----------Initialize DataTable-------------//
    let myTablePreProduct = $("#myTablePreProduct").DataTable({
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



    //-------------------------------- getAllPreProduct -----------------------------//
    getAllPreProduct();

    //-------------- delete PreProduct --------------//
    $(document).on("click",".deletePreProductBtn", function(evt){
        let id = $(this).data('id');
        $("#deletePreProductModal #deletePreProductOk").data("recordid", id).attr("data-recordid", id);
    });
    $("#deletePreProductOk").on("click", async  function(){
        let preProduct_id = $(this).attr("data-recordid");
        fetch(`/pre-product/delete/${preProduct_id}`, {
            headers: {
                // "accept": "application/json",
                // "X-Requested-With": "XMLHttpRequest",
                // "Content-Type": "application/json"
            },
            method: "GET"

        })
            .then(response => response.json())
            .then(data =>{
                if(data.status == "success"){
                    toastr.success("کالا با موفقیت حذف شد! ");
                    changeDeleteRestoreButton("deletePreProductBtn","restorePreProductBtn", preProduct_id)
                    getAllPreProduct(data.preProducts);
                }
                else{
                    toastr.error("بروز خطا در حذف کالا")
                }
            })
    });

    //---------------------- restore PreProduct ---------------------//
    $(document).on("click",".restorePreProductBtn", function(evt){
        let id = $(this).attr("data-id");
        $("#restorePreProductModal #restorePreProdeuctOk").data("recordid", id).attr("data-recordid",id);
    });
    $("#restorePreProdeuctOk").on("click", function(){
        let preProduct_id = $(this).data("recordid");

        fetch(`/pre-product/restore/${preProduct_id}` ,
            {headers:{
                    "accept":"application/json",
                    "X-Requested-With":"XMLHttpRequest",
                    "Content-Type":"application/json"
                }
                ,method: "GET"
            })

            .then(response => response.json())
            .then(data =>{
                if(data.status == "success"){
                    toastr.success("کالا با موفقیت بازیابی شد.");
                    changeDeleteRestoreButton("#deletePreProductBtn" ,"#restorePreProductBtn" ,preProduct_id );
                    getAllPreProduct(data.preProducts);
                    return;
                }
                toastr.error("بروز خطا در بازیابی کالا")
            })
            .catch(error => {
                return{
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });
    });

    //--------------------------------- insert PreProduct -----------------------------//
    $(".insertPreProduct").on("click", function(){
        $("#insertPreProductModal").find("#insertTitle").val("");
        $("#insertPreProductModal").find("#insertDiscription").val("");
        $("#insertPreProductModal").find("#insertNo").val("");
        $("#insertPreProductModal").find("#insertDaste1").val("");
        $("#insertPreProductModal").find("#insertDaste2").val("");
        $("#insertPreProductModal").find("#insertDaste3").val("");
        $("#insertPreProductModal").find("#insertDaste4").val("");
    });
    $("#insertPreProductOk").on("click", function(){
        let data ={
            "title": $("#insertPreProductModal").find("#insertTitle").val(),
            "description":$("#insertPreProductModal").find("#insertDiscription").val(),
            "type": $("#insertPreProductModal").find("#insertNo").val(),
            "category_id": $("#insertPreProductModal").find("#insertDaste4").find(":selected").val(),
        };

        fetch(`/pre-product/insert`, {
            method:"POST",
            body: JSON.stringify(data),
            headers:{
                "accept": "application/json",
                "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response => response.json())
            .then(data =>{
                if(data.status == "success"){
                    getAllPreProduct(data.result);
                    toastr.success("کالا با موفقیت ثبت شد. ");
                    return;
                }
                if(data.status== "validation-error"){
                    $.each(data.errors , (index, err) => toastr.error(err));
                    return;
                }
                if(data.status == "duplicate"){
                    toastr.error("کالای تکراری وارد شده است.");
                    return;
                }
            });
    });
    //---------------------- show PreProduct -------------------------//
    $(document).on("click", ".showPreProductBtn" , async function(evt){
        let preProduct_id = $(this).closest("tr").attr("data-id");

        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await  getData(`/pre-product/get-one/${preProduct_id}`, headers)

        if(data.status == "notFound"){
            toastr.error("بروز خطا در دریافت کالا");
            return;
        }

        //-----> fill data in edit modal -----//

        $("#showPreProductModal").find("#showTitle").val(data.status.title);
        $("#showPreProductModal").find("#showDiscription").val(data.status.description);
        $("#showPreProductModal").find("#showNo").val(data.status.type);
        $("#showPreProductModal").find("#showDaste4").val(data.status.category_id);

        //-------> show modal ---------//

        $("#showPreProductModal").modal("show");
        // toastr.success("نمایش اطلاعات با موفقیت انجام شد...");

        $("#showPreProductDismiss").on("click",function (){
            $('#showPreProductModal').modal('hide');
        })

    });

    //-------------- dont Show ProceduresCourse --------------//
    $(document).on("click",".dontShowPreProductBtn", function(evt){
        let id = $(this).data('id');
        $("#dontShowPreProductModal #dontShowPreProductOk").data("recordid", id).attr("data-recordid", id);
    });
    $("#dontShowPreProductOk").on("click", async  function(){
        let preProduct_id = $(this).attr("data-recordid");
        fetch(`/pre-product/inactive-show/${preProduct_id }`, {
            headers: {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type": "application/json"
            },
            method: "GET"

        })
            .then(response => response.json())
            .then(data =>{
                if(data.status == "notShow"){
                    toastr.success("عدم نمایش برای کالا مورد نظر فعال شد! ");
                    getAllPreProduct(data.preProducts);
                }
                else{
                    toastr.error("بروز خطا در ثبت عدم نمایش کالا")
                }
            })
    });

    //------------------------------- Function in PreProduct page ---------------------//
    //----- get All PreProduct ----//
    async function getAllPreProduct(){
        let data = await getData('/pre-product/get-all', {

            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",

        });
        console.log(data.preProducts);
        updateDataTable(data.preProducts);

    }
    //-------- post Data -----------//
    async function postData(url,headers, data, stringifyBody =true ){
        let response = await fetch(url, {
            headers: headers,
            method: "POST",
            body: stringifyBody ? JSON.stringify(data) : data
        })
        return response.json();
    }
    //------------- get Data ---------------//
    async function getData(url, headers){

        let response = await fetch(url, {
            headers: headers,
            method: "GET"
        })
        return response.json();
    }
    //---------- get currentData ----------//
    function getCurrentData(){
        const m =moment();
        m.local('fa');
        return m.format('DD MMMM YYYY');
    }
    //------------ change Button -----------//
    function changeDeleteRestoreButton(fromElementName, toElementName,PreProductId ){

        let tableRow = $(document).find("#myTablePreProduct").find(`tr#${PreProductId}`);

        let restoreBtn = `<button class="btn btn-sm ml-2 restorePreProductBtn" id="restorePreProductBtn" data-target="#restorePreProductModal"
                                          data-toggle="modal" data-id="${PreProductId}">
                                                <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                                     data-placement="top" title="restore" data-original-title=" restore" ></i>
                                   </button>`;

        let deleteBtn= `<button class="btn btn-sm btn-danger ml-2 deletePreProductBtn" data-target="#deletePreProductModal"
                                   data-toggle="modal"   data-id="${PreProductId}" id="deletePreProductBtn">
                                            <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top" title="حذف" data-original-title="حذف"></i>
                                 </button>`;
        $("#myTablePreProduct")
            .fadeOut(500, function(){
                tableRow
                    .find(`#${fromElementName}`)
                    .replaceWith(`.${toElementName == 'restorePreProductBtn' ? restoreBtn : deleteBtn }`);

                //manage delete-at column to empty or currentTime
                tableRow.find(".deletedAt").html(`${toElementName == 'restorePreProductBtn' ? getCurrentData() : ''}`)
            })
            .fadeIn(500);
    }

    //---------- updateDataTable ------------//
   async function updateDataTable(receivedData)
    {
        if(receivedData == "notFound"){
            receivedData == [];
        }
        myTablePreProduct.destroy();
        myTablePreProduct = $("#myTablePreProduct").DataTable({
            data: receivedData,
            "language":{
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
                    "name": "title",
                    // "data":"title",
                    render: function (data, type, row, meta) {
                        return row["preProduct"]["title"];
                    },
                    "targets": 1,
                    "className": 'title'
                },
                {
                    "name": "description",
                    // "data":"description",
                    render: function (data, type, row, meta) {
                        return row["preProduct"]["description"];
                    },
                    "targets": 2,
                    "className": 'description'
                },
                {
                    "name": "show",
                    // "data":"show",
                    render: function (data, type, row, meta) {
                        return row["preProduct"]["show"];
                    },
                    "targets": 3,
                    "className": 'show'
                },
                {
                    "name": "registerUser",
                    "data":"preProduct.register_user.name",
                    // "data":row ["preProduct"]["register_user"]["name"],
                    // render: function (data, type, row, meta) {
                    //     return row["preProduct"]["register_user"]["name"];
                    // },
                    "targets": 4,
                    "className": 'registerUser'
                },
                {
                    "name": "category",
                    // "data":"category",
                    render: function (data, type, row, meta) {
                        return row["preProduct"]["category"];
                    },
                    "targets": 5,
                    "className": 'category'
                },
                {
                    "name": "insertAt",
                    // "data":"created_at",
                    render: function (data, type, row, meta) {
                        return row["preProduct"]["created_at"];
                    },
                    "targets": 6,
                    "className": 'insertAt'
                },
                {
                    "name": "deletedAt",
                    // "data":"deleted_at",
                    render: function (data, type, row, meta) {
                        return row["preProduct"]["deleted_at"];
                    },
                    "targets": 7,
                    "className": 'deletedAt'
                },
                {
                    "name": "operation",
                    "targets": 8,
                    "className": 'operation',
                    "render": function (data, type, row, meta){

                        let deleteBtn= `  <button class="btn btn-sm btn-danger ml-2 mt-2 deletePreProductBtn" data-target="#deletePreProductModal"
                                                  data-toggle="modal" data-id="${row["preProduct"]["id"]}" id="deletePreProductBtn">
                                                  <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                         data-placement="top" title="حذف" data-original-title="حذف"></i>
                                                 </button>`;

                        let restoreBtn = `  <button class="btn btn-sm ml-2 mt-2 restorePreProductBtn" id="restorePreProductBtn" data-target="#restorePreProductModal"
                                                    data-toggle="modal" style="background-color: #9900cc; color: white" data-id="${row["preProduct"]["id"]}">
                                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                                            data-placement="top" title="restore" data-original-title=" restore" data-id="${row["preProduct"]["id"]}"></i>
                                               </button>`;
                        return `
                        <td class="operation">
                           ${row.preProduct.deleted_at != null ? restoreBtn : deleteBtn}

                               <button class="btn btn-sm btn-warning ml-2 mt-2 editPreProductBtn" id="editPreProductBtn"
                                        style="color: white" data-id="${row["preProduct"]["id"]}" data-recordid="${row["preProduct"]["id"]}">
                                   <i class="icon-note" aria-hidden="true" data-toggle="tooltip"
                                      data-placement="top" title="ویرایش" data-original-title="ویرایش"></i>
                               </button>
                               <button class="btn btn-sm btn-success ml-2 mt-2 showPreProductBtn" id="showPreProductBtn"
                                        data-target="#showPreProductModal" data-toggle="modal"
                                        data-id="${row["preProduct"]["id"]}" data-recordid="${row["preProduct"]["id"]}">
                                   <i class="icon-eye" aria-hidden="true" data-toggle="tooltip"
                                     data-placement="top" title="نمایش"
                                      data-original-title="نمایش"></i>
                               </button>
                               <button class="btn btn-sm btn-secondary ml-2 mt-1 dontShowPreProductBtn" id="dontShowPreProductBtn"
                                              data-id="${row["preProduct"]["id"]}" data-target="#dontShowPreProductModal" data-toggle="modal">
                                    <i class="icon-ban" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="عدم نمایش"></i>
                               </button>
                        </td>
                        `;
                    }},
            ],
            createdRow: function (row, data, dataIndex){
                $(row).addClass('data text-center').attr("id",data.id);
            },
        });
    }





}) //end ready document function
