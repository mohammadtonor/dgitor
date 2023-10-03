$(document).ready(function(){

    //============ js multiselect ========//
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

    //========= for tooltip =======//

    $(document).tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    //--------------- getAllPersonnelList ------------//
    let myTablePersonnelList = null;

    $('#myTablePersonnelList').on('draw.dt', () => hideLoader());
    getAllPersonnelList();

    //---------------- delete PersonnelList -------------//
    $(document).on("click",".deletePersonnelList", function(evt){
        let id =$(this).data('id');

        $("#deletePersonnelListModal #deleteOkPersonnel").data("recordid", id).attr("data-recordid", id);
    });
    $("#deleteOkPersonnel").on("click",async function(){
        let personnelId= $(this).attr("data-recordid");

        fetch(`/personnel/del/${personnelId}`,{
            headers:{
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type": "application/json"
            },
            method:"GET"
        })
            .then(response => response.json())
            .then(data => {
                if(data.status == "success"){
                    toastr.success("پرسنل با موفقیت حذف شد!");
                    changeDeleteRestoreButton("deletePersonnelList", "restorePersonnelList",personnelId )
                    getAllPersonnelList(data.status.personels);
                }
                else{
                    toastr.error("بروز خطا در حذف پرسنل")
                }
            })
    });

    //----------- restore PersonnelList ------------//
    $(document).on("click",".restorePersonnelList", function(evt){
        let id = $(this).attr("data-id");

        $("#restorePersonnelListModal #restoreOkPersonnel").data("recordid",id).attr("data-recordid",id);
    });
    $("#restoreOkPersonnel").on("click", function(){
        let personnelId = $(this).data("recordid");

        console.log(personnelId+"@@@@@@@@@");

        fetch(`/personnel/restore/${personnelId}`,{
            headers:{
                "accept":"application/json",
                "X-Requested-With":"XMLHttpRequest",
                "Content-Type":"application/json"
            },
            method: "GET"
        })
            .then(response => response.json())
            .then(data =>{
                if(data.status == "success"){
                    toastr.success("پرسنل با موفقیت بازیابی شد.");
                    changeDeleteRestoreButton("#deletePersonnelList", "#restorePersonnelList",personnelId);
                    getAllPersonnelList(data.status.personels);
                    return;
                }
                toastr.error("بروز خطا در بازیابی پرسنل")
            })

    });

    //=========================== showPersonnelList =====================//

    $(document).on("click",".showPersonnel",async function(evt){
        let PersonnelId = $(this).attr("data-id");

        let headers = {
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        let data = await getData(`/personnel/get/${PersonnelId}`,headers)

        if(data.status == "notFound"){
            toastr.error("بروز خطا در دریافت اطلاعات ");
            return;
        }

        //fill data to show modal
        $("#showpersonnelModal").find("#showNamePersonnel").val(data.status.personels.name);
        $("#showpersonnelModal").find("#showLastNamePersonnel").val(data.status.personels.family);
        $("#showpersonnelModal").find("#showNcodePersonnel").val(data.status.personels.ncode);

        $("#showpersonnelModal").find("#showBirthdayPersonnel").val(data.status.personels.birthday);
        $("#showpersonnelModal").find("#showMobilePersonnel").val(data.status.personels.mobile);
        $("#showpersonnelModal").find("#showGenderPersonnel").val(data.status.personels.gender);

        $("#showpersonnelModal").find("#showEmailPersonnel").val(data.status.personels.email);
        $("#showpersonnelModal").find("#showSematsPersonnel").val(data.status.personels.roles);

        $("#showpersonnelModal").find("#showOstanPersonnel").val(data.status.personels.ostan.name);
        $("#showpersonnelModal").find("#showCityPersonnel").val(data.status.personels.city.name);

        $("#showpersonnelModal").find("#personnelAdress").val(data.status.personels.addrs);


        toastr.success("نمایش تماس با موفقیت انجام شد...");

        //show modal
        $("#showpersonnelModal").modal("show");
    });

    //======================== semetsPersonnelList =================//

        //=============== modaltable ========//
    async function getAllSemats(parsonId) {

        let data = await getData(`/roles/getall/${parsonId}`, {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json"
        });



        $("#sematsListTable").empty()
        data.status.roles.forEach(function (object) {
            $("#sematsListTable").append(
                `<tr data-id="${object.id}">
                    <td data-id="${object.id}" class="text-center">${object.id}</td>
                    <td data-id="${object.id}" class="text-center">${object.name_fa}</td>
                    <td data-id="${object.id}" class="text-center">${object.created_at}</td>
                    <td data-id="${object.id}" class="text-center ">
                       <button class="btn btn-sm btn-danger ml-2 deleteSematsInModal" data-id="${object.id}">
                            <i class="icon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>
                       </button>
                    </td>
                </tr>`
            )
        })

    }


        //============= semats =============//
    $(document).on("click", ".tags", async function () {
        let semats = [];
        let parsonId = $(this).attr("data-id");
        getAllSemats(parsonId);


        ////=============== دکمه ی حذف ================
        $(document).on('click', ".deleteSematsInModal", function () {
            let sematId = $(this).attr('data-id');
            fetch(`/role/user/detach/${parsonId}/${sematId}`, {
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json"
                },
                method: "GET"
            })
                .then(response => response.json())
                .then(data => {
                    toastr.success('با موفقیت انجام شد')
                    getAllSemats(parsonId);
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





    //------------------------------- function PersonnelList -------------------------//

    //-------- get All --------//
    async function getAllPersonnelList(){

        let data = await getData(`/personnel/getall/data`,{
            "accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json"
        });
        updateDatatable(data.status.personels);
    }

    //--------- Post Data ------//
    async function postData(url,headers,data,stringifyBody =true){
        let response =await fetch(url,{
            headers: headers,
            method:"POST",
            body:stringifyBody ? JSON.stringify(data) : data
        })
        return response.json();
    }

    //--------- get Data -------------//
    async function getData(url,headers){
        let response= await fetch(url ,{
            headers:headers,
            method:"GET"
        })
        return response.json();
    }

    //-------- get currentData --------//
    function getCurrentData(){
        const m =moment();
        m.local('fa');
        return m.format('DD MMMM YYYY');
    }

    //-------------- change Button ------------//
    function changeDeleteRestoreButton(fromElementName, toElementName, personnelListId){

        let tableRow= $(document).find("#myTablePersonnelList").find(`tr#${personnelListId}`);

        let restoreBtn = `<button class="btn btn-sm btn-warning ml-2 mt-1 restorePersonnelList" data-target="#restorePersonnelList"
                                         data-toggle="modal" data-id="${personnelListId}">
                                    <i class="icon-loop" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="بازیابی"></i>
                                 </button>`;
        let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 mt-1 deletePersonnelList" data-target="#deletePersonnelList"
                                         data-toggle="modal" data-id="${personnelListId}">
                                    <i class="icon-trash " aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>
                               </button>`;
        $("#myTablePersonnelList")
            .fadeOut(500,function(){
                tableRow
                    .find(`${fromElementName}`)
                    .replaceWith(`.${toElementName == 'restorePersonnelList' ? restoreBtn : deleteBtn }`);

                //manage delete-at column to empty or currentTime
                tableRow.find(".deleteTime").html(`${toElementName == 'restorePersonnelList' ? getCurrentData() : '' }`)
            })

            .fadeIn(500);
    }


    //--------------- updateDataTable --------------//
    function updateDatatable(receivedData)
    {
        if (myTablePersonnelList != null)
            myTablePersonnelList.destroy();

        myTablePersonnelList = $('#myTablePersonnelList').DataTable({
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
                            "name": "firstName",
                            "data": "name",
                            "targets": 1,
                            "className": 'firstName'
                        },
                        {
                            "name": "lastName",
                            "data": "family",
                            "targets": 2,
                            "className": 'lastName'
                        },
                        {
                            "name": "codeNum",
                            "data": "ncode",
                            "targets": 3,
                            "className": 'codeNum'
                        },
                        {
                            "name": "cellNum",
                            "data": "mobile",
                            "targets": 4,
                            "className": 'cellNum'
                        },
                        {
                            "name": "city",
                            "data": "city.name",
                            "targets": 5,
                            "className": 'city'
                        },
                        {
                            "name": "statusPersonnel",
                            "data": "is_geniue",
                            "targets": 6,
                            "className": 'statusPersonnel'
                        },
                        {
                            "name": "created_at",
                            "data": "created_at",
                            "targets": 7,
                            "className": 'created_at'
                        },
                        {
                            "name": "deleted_at",
                            "data": "deleted_at",
                            "targets": 8,
                            "className": 'deleted_at'
                        },
                        {
                            "name": "operation",
                            "targets": 9,
                            "className": 'operation',
                            "render": function(data,type,row,meta){

                                let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 mt-1 deletePersonnelList" data-target="#deletePersonnelListModal"
                                                                 data-toggle="modal" data-id="${row.id}" id="deletePersonnelList">
                                                        <i class="icon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>
                                                      </button>`;

                                let restoreBtn = `<button class="btn btn-sm btn-warning ml-2 mt-1 restorePersonnelList" data-target="#restorePersonnelListModal"
                                                                 data-toggle="modal" data-id="${row.id}" id="restorePersonnelList">
                                                           <i class="icon-loop" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="بازیابی"></i>
                                                         </button>`;
                                return `
                                   <td>
                                        ${row.deleted_at!=null ? restoreBtn : deleteBtn}

                                                <button class="btn btn-sm btn-primary ml-2 mt-1 showPersonnel" data-target="#showpersonnelModal" id="showPersonnel" data-toggle="modal" data-id="${row.id}" data-recordid=" ${row.id}">
                                                    <i class="icon-eye" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="نمایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1">
                                                    <a href=/addrsperonnel">
                                                        <i class="icon-directions" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ادرس ها"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1">
                                                         <a href="/personnelcontacts">
                                                            <i class="icon-call-end" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="شماره تماس"></i>
                                                         </a>
                                                </button>
                                                <button class="btn btn-sm btn-success ml-2 mt-1">
                                                        <a href="/personnelbankaccount">
                                                          <i class="icon-basket" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="اطلاعات بانکی"></i>
                                                        </a>
                                                </button>
                                                <button class="btn btn-sm btn-danger ml-2 mt-1 semats" data-target="#sematsModal" id="semats" data-toggle="modal" data-id="${row.id}" data-recordid="${row.id}">
                                                    <i class="icon-list" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="سمت ها"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1" data-target="#uploaddocumentsModal" data-toggle="modal" data-id="${row.id}" data-recordid="${row.id}">
                                                    <i class="icon-cloud-upload" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="آپلود مدارک"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success ml-2 mt-1">
                                                      <a  href="/personnelvippermission">
                                                          <i class="fa fa-arrow-circle-left text-center pb-0 mb-0" aria-hidden="true" data-toggle="tooltip" style="color: white" data-placement="top"
                                                           title="دسترسی اختصاصی"></i>
                                                      </a>
                                                </button>
                                                <button class="btn btn-sm btn-primary ml-2 mt-1">
                                                        <a href="/personnelblockpermission">
                                                           <i class="icon-ban" aria-hidden="true" data-toggle="tooltip" style="color: white" data-placement="top" title=" سلب دسترسی"></i>
                                                        </a>
                                                </button>
                                            </td>
                                        `;
                            }},
                    ],
                    createdRow: function (row, data, dataIndex) {
                        $(row).addClass('data text-center').attr("id",data.id).attr("data-id",data.id);;
                    },
                });
    }


}); //end ready document function
