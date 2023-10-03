
$(document).ready(function (){

    var country_id = 1;


    let tableCountries = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableCountries').on('draw.dt', () => hideLoader());
    getAllCountry();



    // ================================== function ======================================= //

   async function getAllCountry() {

       let data = await getData(`/country/get-all`,{
           "Accept": "application/json",
           "Content-Type": "application/json",
           "X-Requested-With": "XMLHttpRequest"
       });
       // console.log(data.status.cities);
       updateDataTable(data)
       console.log(data);
       // console.log(data);
    }


    //========================tooltip on dynamically added element========================
        $(document).tooltip({
            selector: '[data-toggle="tooltip"]'
        });



    //==========================edit country info in edit modal===========================

    $(document).on("click",".editCountry",async function (){
        let country_id = $(this).closest("tr").attr("id");
        $("#editcountry").find("#editCountryInfoBtn").attr("data-id",1);
        let result = await getData(`/country/get-one/${country_id}`,
            {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        );
        $("#countryName").val(result.status.name);
    })


    //==========================update country info===========================
    $("#editCountryInfoBtn").on("click", async function () {
        let country_id = $("#editCountryInfoBtn").attr("data-id");

        let data = {
            "name": $("#countryName").val(),
        };
        let headers={
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/country/update/${country_id}`,headers,data);
        if(catchFetch(result)) return;
        hideLoader();

            toastr.success("کشور با موفقیت به روزرسانی شد!");
            $("#edit-modal").modal('hide');
            $(`tr#${country_id}`).find(".countryNameUpdate").html($("#countryName").val());

    });




    //========================= insert country =========================//
    // clear inputs

    $("#btncreatenewcountry").on("hide.bs.modal", ()=>$(this).find(".inp").val(''));
    $("#insertNewCountryBtn").on("click", async function () {
        let data = {
            "name": $("#countryNameInsert").val(),
        };
        let headers={
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData("/country/insert",headers,data);
        if(catchFetch(result)) return;
        hideLoader();
            toastr.success("کشور با موفقیت ثبت شد!");
            $("#AddNew-modal").modal('hide');
            getAllCountry();

    });


    //================================حذف========================

    $(document).on("click",".deleteCountryBtn", function (evt) {
        // let country_id = $(this).attr("data-id");
        $("#deletecountry #dodelete").data("recordid", country_id).attr("data-recordid", country_id);
    });
    $("#dodelete").on("click", function () {
        // let country_id = $(this).data("recordid");
        fetch(`/country/del/${country_id}`,{method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }
        })
            .then(response=>response.json())
            .then(data=>{
                    toastr.success("کشور با موفقیت حذف شد");
                    changeDeleteRestoreButton("deleteCountryBtn","restoreCountryBtn",country_id);
                    getAllCountry();
            })
            .catch(error => toastr.error("بروز خطا"));
    });


    //================================= بازیابی کشور  ==========================

    $(document).on("click",".restoreCountryBtn", function(){
        // let country_id = $(this).attr("data-id");
        $("#restoremodal").find("#restore-modal-btn").attr("data-recordid",country_id).data("recordid",country_id);
    });
    $("#restore-modal-btn").on("click", function (){
        // let country_id = $(this).data("recordid");
        fetch(`/country/restore/${country_id}`,{
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
                    toastr.success("کشور با موفقیت بازیابی شد.");
                    // changeDeleteRestoreButton("restoreCountryBtn","deleteCountryBtn",country_id);
                    getAllCountry();
                    return;
                }
                else{
                    toastr.error("بروز خطا در بازیابی کشور");
                }
            })
            .catch(error => toastr.error("بروز خطا"));
    });

    //===========================change delete restore btn=========================
    function changeDeleteRestoreButton(fromElementName,toElementName,country_id)
    {
        let tableRow = $(document).find("#tableCountries").find(`tr#${country_id}`);
        let restoreBtn = `<button data-id="${country_id}" class="btn btn-sm btn-warning ml-2 restoreCountryBtn"
                                    data-target="#restoremodal" data-toggle="modal">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button data-id="${country_id}" class="btn btn-sm btn-danger ml-2 deleteCountryBtn"
                                    data-target="#deletecountry" data-toggle="modal">
                                    <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="حذف"></i>
                                </button>`;


        $("#tableCountries")
            .fadeOut(500, function(){
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'restoreCountryBtn' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deletedAtUpdate").html(`${toElementName == 'restoreCountryBtn' ? getCurrentDate() : '' }`);
            })
            .fadeIn(500);
    }


    function getCurrentDate()
    {
        const m = moment();
        m.locale('fa');
        return m.format('DD  MMMM  YYYY ');
    }


    async function getData(url,headers)
    {
        try{
            let response = await fetch(url,{headers:headers,method:"GET"});
            return response.json();
        }
        catch(err){
            hideLoader();  // if loader is shown, hide it.
            return {"status":"network error"};
        }
    }


    async function postData(url,headers,data,stringifyBody=true)
    {
        try{
            let response = await fetch(url,{headers:headers,method:"POST",body: stringifyBody ? JSON.stringify(data) : data});
            return response.json();
        }
        catch(err){
            hideLoader(); // if loader is shown, hide it.
            return {"status":"network error","err":err};
        }
    }

    function catchFetch(result,err)
    {
        if(result.status=="network error"){
            toastr.error("بروز خطا در شبکه");
            hideLoader();
            return true;
        }
        return false;
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


    function updateDataTable(data)
    {
                $("#countriesCount").html(data.count);
                if (tableCountries != null)
                    tableCountries.destroy();
                    tableCountries = $('#tableCountries').DataTable({
                    data: data.countries,
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
                        {"name": "countryNameUpdate", "data": "country.name", "targets": 1, "className": 'countryNameUpdate'},
                        {"name": "ostansCountUpdate","data": "ostan_count",  "targets": 2, "className": 'ostansCountUpdate'},
                        {"name": "citiesCountUpdate", "data": "ostan_count", "targets": 3, "className": 'citiesCountUpdate'},
                        {"name": "createdAtUpdate", "data": "country.created_at", "targets": 4, "className": 'createdAtUpdate',
                            render: function (data, type, row, meta) {
                                return (row.country.created_at!=null) ? convertMiladiDateToShamsi(`${row.country.created_at}`) : null;
                            }},
                        {"name": "deletedAtUpdate", "data": "country.deleted_at", "targets": 5, "className": 'deletedAtUpdate',
                            render: function (data, type, row, meta) {
                                return (row.country.deleted_at!=null) ? convertMiladiDateToShamsi(`${row.country.deleted_at}`) : null;
                            }},
                        {"name": "operation", "targets": 6, "className": 'operation', "render": function(data,type,row,meta){

                                let deleteBtn = `<button type="button" class="btn btn-sm btn-danger ml-2 deleteCountryBtn" data-id="${row.country.id}" data-target="#deletecountry"
                                                data-toggle="modal">
                                            <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                               data-placement="top" title="" data-original-title="حذف"></i>
                                        </button>`;

                                let restoreBtn = `<button data-id="${row.country.id}" class="btn btn-sm btn-warning ml-2 restoreCountryBtn" data-target="#restoremodal" data-toggle="modal">
                                                <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="بازیابی"></i>
                                            </button>`;
                                return `
                                    <td class="operation">
                                        ${row.country.deleted_at!=null ? restoreBtn : deleteBtn}
                                           <button class="btn btn-sm btn-info ml-2 mt-1 editCountry" data-target="#editcountry"
                                                        data-toggle="modal">
                                                    <i class="icon-note" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="ویرایش"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning ml-2 mt-1">
                                                    <a href="/ostan/page/${row.country.id}">
                                                    <i class="icon-list" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="استان ها"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-sm btn-info ml-2 mt-1">
                                                    <a href="/city/page/${row.country.id}/1">
                                                    <i class="icon-star" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="شهر ها"></i>
                                                    </a>
                                                </button>
                                    </td>
                                        `;
                            }},
                    ],
                    createdRow: function (row, data, dataIndex) {
                        $(row).addClass('data text-center').attr("id",data.country.id);
                    },
                });
    }


})//end of document ready



