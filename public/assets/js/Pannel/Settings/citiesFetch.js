$(document).ready(function () {
  var country_id = 1;

    let tableCity = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableCity').on('draw.dt', () => hideLoader());
    getAllCities();

// ====================================== insert =========================//

    $(document).on('click',"#new_city",async function () {

        $("#create_new_city_city").val('');

        await fetch(`/country/get-all`, {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            method: "GET"
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                $("#create_new_city_country").html("");
                $("#create_new_city_country").append(`<option>انتخاب کنید</option>`)
                data.countries.forEach(function (object) {
                    $("#create_new_city_country").append(`<option value="${object.country.id}">${object.country.name}</option>`)
                })
            })


        $(document).on('change',"#create_new_city_country", async function () {
            let country_id = $("#create_new_city_country option:selected").val()
            await fetch(`/ostan/get-all/${country_id}`,{
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
                method: "GET"
            })
                .then(response => response.json())
                .then(data => {
                    $("#name_ostan").html("");

                    data.status.ostans.forEach(function (object) {
                        $("#name_ostan").append(`<option value="${object.ostan.id}">${object.ostan.name}</option>`)
                    })
                })
        })
    })

    $(document).on('click',"#register",async function () {
    let country = $("#create_new_city_country option:selected").val();
    let ostan = $("#name_ostan option:selected").val();
    let city = $("#create_new_city_city").val();

    let data = {
        "country_id":country,
        "ostan_id":ostan,
        "name":city
    }


        await fetch(`/city/insert`,{
        headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type":"application/json"
        },
        method:'POST',
        body:JSON.stringify(data)
    })
        .then(response=>response.json())
        .then(data=>{
            console.log(data);
            toastr.success('با موفقیت انجام شد . ');
            getAllCities();
        }).catch(err=>{
            console.log('Error'+err)
        })

    $("#btncreatenewcity").modal("hide");


    $("#name_ostan option:selected").empty();
    $("#create_new_city_country").empty();
    $("#create_new_city_city option:selected").empty();
})



// //=================================== update city ===============================//

    $(document).on('click',".edit-product-btn",async function () {
        let id = $(this).attr('data-id');
        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
        };

        $("#editcity").find("#edit_city").data('recordid',id).attr('data-recordid',id)


        let data = await getData(`/city/get-one/${id}`,headers)

        console.log(data);

        if (data.result == "notFound") {
            toastr.error("خطا در گرفتن لیست یک سازمان");
            return;
        }

        else {
            await fetch(`/country/get-all`, {
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
                method: "GET"
            })
                .then(response => response.json())
                .then(data => {
                    $("#edit_name_country").html("");
                    data.countries.forEach(function (object) {
                        $("#edit_name_country").append(`<option value="${object.country.id}">${object.country.name}</option>`)
                    })
                })

            $("#edit_name_country").on('change',async function(){

                let country_id = $("#edit_name_country option:selected").val()

                await fetch(`/ostan/get-all/${1}`,{
                    headers: {
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    method: "GET"
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        $("#edit_name_ostan").html("");
                        data.status.ostans.forEach(function (object) {
                            $("#edit_name_ostan").append(`<option value="${object.ostan.id}">${object.ostan.name}</option>`)
                        })
                        console.log(data);
                    })
            })
            $("#edit_name_city").val(data.status.name);
            $("#edit_name_country").append(`<option value="${data.status.country.id}" selected>${data.status.country.name}</option>`)
            $("#edit_name_ostan").append(`<option value="${data.status.ostan.id}" selected>${data.status.ostan.name}</option>`)
        }
    })

    $("#edit_city").on('click',async function () {
        let id = $(this).data('recordid');

        let country = $("#edit_name_country").find(":selected").val()
        let city =  $("#edit_name_city").val()
        let ostan = $("#edit_name_ostan option:selected").val()


        let data =  {
            "country_id": country,
            "name":city,
            "ostan_id":ostan
        }


        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };


        await fetch(`/city/update/${id}`,{
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type":"application/json"
            },
            method:'POST',
            body:JSON.stringify(data)
        })
            .then(response=>response.json())
            .then(data=>{
                console.log(data);
                toastr.success('اپدیت با موفقیت انجام شد . ');
                getAllCities();
            }).catch(err=>{
                console.log('Error'+err)
            })

    });

  //============================== delete city =======================//

    $(document).on('click',".delete-product-btn",function (event) {
        let id = $(this).data('id');
        $("#deletecity #delete-city").data("recordid", id).attr("data-recordid", id);
    })
    $("#delete-city").on('click',async function () {
        let city_id = $(this).data("recordid")

        fetch(`/city/del/${city_id}`,{
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
                    toastr.success("شهر با موفقیت حذف شد");

                    getAllCities();
                } else {
                    toastr.error('خطا در حذف شهر')
                }
            })
    })

    // ================================== restore city =========================//

    $(document).on('click',".restore-product-btn",function (event) {
        let id = $(this).attr('data-id');
        $("#restorecity #restore-city").data('recordid',id).attr('data-recordid',id);
    });
    $("#restore-city").on('click',function () {
        let city_id = $(this).data("recordid");
        fetch(`/city/restore/${city_id}`,{
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
                    getAllCities();

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

    async function getAllCities(){
        // let data = await getData(`/city/get-all/${country_id}/${ostan_id}`,{
        let ostan_id = 1;
        let data = await getData(`/city/get-all/${ostan_id}`,{
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });
        updateTable(data.status.cities);
    }
    async function getData(url,headers){
        let response = await fetch(url,{headers:headers,method:'GET'});
        return response.json()
    }

//========================== updateDataTable =====================//

    function updateTable(receiveData) {

        if (tableCity != null)
        tableCity.destroy();

        tableCity = $('#tableCity').DataTable({
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
                    "name": "country_name",
                    render:function (data, type, row, meta) {
                        return row['country']
                    },
                    "targets": 1,
                    "className": 'country_name',
                },
                {
                    "name": "city_name",
                    render:function (data, type, row, meta) {
                        return row['city']['name']
                    },
                    "targets": 2,
                    "className": 'city_name',
                },
                {
                    "name": "ostan_name",
                    render:function (data, type, row, meta) {
                        return row['ostan']
                    },
                    "targets": 3,
                    "className": 'ostan_name',
                },
                {
                    "name": "created_at",
                    render:function (data, type, row, meta) {
                        return row["city"]["created_at"]
                    },
                    "targets": 4,
                    "className": 'created_at',
                },
                {
                    "name": "deleted_at",
                    render:function (data, type, row, meta) {
                        return row["city"]["deleted_at"]
                    },
                    "targets": 5,
                    "className": 'deleted_at',
                },
                {
                    "name": "count_user",
                    render:function (data, type, row, meta) {
                        return row['user_count']
                    },
                    "targets": 6,
                    "className": 'count_user',
                },
                {
                    "name": "operation",
                    "targets": 7,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = ` <button type="button" class="btn btn-sm btn-danger ml-2  delete-product-btn"
                                                      data-target="#deletecity" data-toggle="modal" data-id="${row.city.id}">
                                                   <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                          data-placement="top" title="حذف"></i>
                                                 </button>`;
                        let restoreBtn = `<button type="button" class="btn btn-sm btn-warning ml-2  restore-product-btn"
                                                      data-target="#restorecity" data-toggle="modal" data-id="${row.city.id}">
                                                   <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                                         data-placement="top"  title="بازیابی"></i>
                                                   </button>`;
                        return `
                      <td class="operation">
                            ${row.city.deleted_at != null ? restoreBtn : deleteBtn}
                                        <button class="btn btn-sm btn-primary ml-2 edit-product-btn" data-target="#editcity" data-recordid="${row.city.id}" data-id="${row.city.id}"
                                                data-toggle="modal">
                                            <i class="icon-note " aria-hidden="true" data-toggle="tooltip"
                                               data-placement="top"
                                               title="ویرایش"></i>
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
