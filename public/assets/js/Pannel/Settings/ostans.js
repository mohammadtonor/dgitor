$(document).ready(function () {
//========================= Initialize DataTable =========================//

    var country_id = 1;
    let tableOstans = null;
    // each time dataTable is drawn, hide loader if it is displayed
    $('#tableOstans').on('draw.dt', () => hideLoader());


    //========================= Get All question at the Beginning =============//
    getAllostans();

    async function getAllostans() {
        // let country_id = $("meta[name=country_id]").attr("content");
        // showLoader();
        let result = await getData(`/ostan/get-all/${country_id}`,
            {
                "accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        if (catchFetch(result)) return;
        // hideLoader();
        if (result.status !== "notFound") {
            // console.log(result);
            // console.log(result.status);
            // console.log(result.status.ostans);
            updateDataTable(result.status.ostans);
        }

    }


    ////==================================ثبت استان========================
    $("#btncreatenewostans").on("hide.bs.modal", () => $(this).find(".inp").val(''));
    $("#insertostan").on("click", async function () {
        // let country_id = $("meta[name=country_id]").attr("content");
        let ostanName = $("#ostanName").val();
        let data = {
            "name": ostanName,
            "country_id": country_id
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/ostan/insert`, headers, data);
        if (catchFetch(result)) return;
        hideLoader();
        if (result.status == "validation-error") {
            $.each(data.errors, (index, err) => toastr.error(err));
            return;
        }
        if (result.status == "duplicate") {
            toastr.error("نام استان واردشده تکراری است.");
            return;
        }
        if (result.status == "notFound") {
            toastr.error("بروز خطا در ثبت استان");
            return;
        }
        if (data.status !== "refused") {
            toastr.success("استان با موفقیت ثبت شد!");
            getAllostans();   // get all answers and refresh dataTable
            return;
        }

        toastr.error("بروز خطا!");
    });

    ////===========================حذف استان===========================
    $(document).on("click", ".delete-ostan-btn", function (evt) {
        let id = $(this).data("id");
        $("#deleteostan #deleteostanbtn").data("recordid", id).attr("data-recordid", id);
    });
    $("#deleteostanbtn").on("click", async function () {
        showLoader();  // show loader
        let ostan_id = $(this).data("recordid");
        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await getData(`/ostan/del/${ostan_id}`, headers);
        if (catchFetch(result)) return;
        hideLoader(); //hide loader

        if (result.status.status !== "notFound") {
            toastr.success("سطح با موفقیت حذف شد");
            changeDeleteRestoreButton("delete-ostan-btn", "restore-ostan-btn", ostan_id)
            return;
        }
        toastr.error("بروز خطا");
    });

    //========================= restore ostan =========================//

    $(document).on("click", ".restore-ostan-btn", function (evt) {
        let id = $(this).attr("data-id");
        $("#restoremodal #dorestore").data("recordid", id).attr("data-recordid", id);
    });
    $("#dorestore").on("click", async function () {
        showLoader();  // show loader
        let ostan_id = $(this).data("recordid");

        let result = await getData(`/ostan/restore/${ostan_id}`,
            {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });
        if (catchFetch(result)) return;
        hideLoader(); // hide loader

        if (result.status !== "notFound") {
            toastr.success("اطلاعات استان با موفقیت بازیابی شد");
            changeDeleteRestoreButton("restore-ostan-btn", "delete-ostan-btn", ostan_id)
            return;
        }
        toastr.error("بروز خطا");
    });

    //========================= آپدیت استان =========================//

    $(document).on("click", ".editostan", async function (evt) {
        let ostanId = $(this).attr("data-id");
        // console.log(ostanId);
        let headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await getData(`/ostan/get-one/${ostanId}`, headers)
        hideLoader(); //hide loader
        if (result.result == "notFound") {
            toastr.error("بروز خطا در دریافت اطلاعات استان");
            return;
        }
        $("#editostan").find("#editostanbtn").data("recordid", ostanId).attr("data-recordid", ostanId);
        // fill data to edit modal
        $("#editostan").find("#ostannameedit").val(result.result.name);
        // show modal
        $("#editostan").modal("show");
    });

    $("#editostanbtn").on("click", async function (evt) {
        showLoader();  // show loader
        let farsiNameOstan = $("#editostan").find("#ostannameedit").val();
        console.log(farsiNameOstan);
        // let country_id = $("meta[name=country_id]").attr("content");
        let TableRowId = $(this).attr("data-recordid");
        let data = {
            "name": farsiNameOstan,
            "country_id": country_id
        };
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/ostan/update/${TableRowId}`, headers, data);
        hideLoader();
        console.log(result);
        console.log(result.status)
        if (result.status == "validation-error") {
            $.each(result.errors, (indx, err) => toastr.error(err));
            return;
        }
        if (result.status == "duplicate") {
            toastr.errors("نام استان وارد شده تکراری می باشد")
            return;
        }
        if (true) {
            toastr.success("ویرایش استان با موفقیت انجام شد!");
            $(document).find("#tableOstans").find(`tr#${TableRowId}`).find(".ostanName").html(farsiNameOstan);
            return;
        }
    });
    //=======================city modal===========================//
    $(document).on("click", ".cities", function () {
        let cities = [];
        let ostan_id = $(this).attr("data-id");

        // let country_id = $("meta[name=country_id]").attr("content");
        fetch(`/ostan/relation/cities/${ostan_id}`, {
            method: 'GET', headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status !== "refused") {
                    cities = data.status.cities.map(function (city) {
                        return {
                            id: city.city.id,
                            countryName: city.city.country.name,
                            ostanName: city.city.ostan.name,
                            cityName: city.city.name,
                        };
                    });
                    let tableBody = '';
                    $.each(cities, function (index, value) {
                        tableBody += '<tr id="' + value.id + '" class="text-center">';
                        tableBody += '<td class="text-center rowcount">' + (index + 1) + '</td>';
                        tableBody += '<td class="countryName">' + value.countryName + '</td>';
                        tableBody += '<td class="ostanName">' + value.ostanName + '</td>';
                        tableBody += '<td class="cityName">' + value.cityName + '</td>';
                        tableBody += '<td class="text-center">';
                        tableBody += '<div class="tooltipdelete text-center">';
                        tableBody += '<button id="' + value.id + '"  class="btn btn-sm btn-danger btndeletecity  ml-2" data-toggle="modal" data-target="#btndeletecity">';
                        tableBody += '<i class="icon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="حذف"></i>';
                        tableBody += '</button>';
                        tableBody += '<button id="' + value.id + '"  class="btn btn-sm btn-info btneditcity showdatainmodal" data-ostanid='+ostan_id+'>';
                        tableBody += '<i class="icon-note" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>';
                        tableBody += '</button>';
                        tableBody += '</div>';
                        tableBody += '</td>';
                        tableBody += '</tr>';
                    });

                    $("#citiesmodal table tbody").html(tableBody);
                    $("#citiesmodal").modal("show");

                } else {
                    toastr.errors("شهری یافت نشد");
                }
            })
            .catch(error => {
                return {
                    'Error:': error, 'statusText:': error.statusText, 'status:': error.status
                }
            });
    })

    // حذف شهر
    $(document).on("click", ".btndeletecity", function (evt) {
        let id = $(this).attr("id");
        $("#btndeletecity #deletecitybtn").data("recordid", id).attr("data-recordid", id);
    });
    $(document).on("click", ".deletecitybtn", function (evt) {
        evt.preventDefault();
        let city_id = $(this).attr("data-recordid");
        console.log(city_id + "city_id");
        fetch(`/city/del/${city_id}`, {
            method: "GET",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => response.json())
            .then(data => {
                if (data.status == "notFound") {
                    toastr.errors("شهری یافت نشد");
                } else {
                    let tableRow = $("#tableCities").find(`tr#${city_id}`);
                    $(tableRow).remove(); // Remove the table row
                    let rowCountElements = $(".rowcount");
                    rowCountElements.each(function (index) {
                        $(this).text(index + 1);
                    });
                    toastr.success("شهر با موفقیت حذف شد");
                    $("#tableCities").fadeOut().fadeIn(1000);
                    return {"status": "success", "data": data};
                }

            })
            .catch(error => {
                return {
                    'Error:': error,
                    'statusText:': error.statusText,
                    'status:': error.status
                }
            });

    })

    ////===========================ویرایش شهر=============================
    // $(document).on("click", ".showdatainmodal", async function (evt) {
    //     evt.preventDefault();
    //     let city_id = $(this).attr("id");
    //     let ostanId = $(this).data("ostanid");
    //
    //     $("#editcity").find("#btneditcit").attr("data-recordid", city_id).data("recordid", city_id);
    //     console.log(city_id);
    //     let headers = {
    //         "Accept": "application/json",
    //         "X-Requested-With": "XMLHttpRequest"
    //     };
    //     let result = await getData(`/city/get/${city_id}`, headers)
    //
    //     hideLoader(); //hide loader
    //
    //     if (result.result == "notFound") {
    //         toastr.error("بروز خطا در دریافت اطلاعات شهر");
    //         return;
    //     }
    //     $("#editcity").find("#btneditcit").data("recordid", city_id).attr("data-recordid", city_id);
    //     $("#editcity").find("#btneditcit").data("ostanId", ostanId).attr("data-ostanId", ostanId);
    //     // fill data to edit modal
    //     // $("#editcity").find("#countryNameEdit").val(result.result.name);
    //
    //     $("#editcity").find("#countryNameEdit").val(result.status.country.name);
    //     $("#editcity").find("#ostanNameEdit").val(result.status.ostan.name);
    //     $("#editcity").find("#cityNameEdit").val(result.status.name);
    //
    //     // show modal
    //     $("#editcity").modal("show");
    //
    // })
    // $("#btneditcit").on("click", async function (evt) {
    //     showLoader();  // show loader
    //
    //     let farsiNameCity = $("#editcity").find("#cityNameEdit").val();
    //     console.log(farsiNameCity);
    //     // let country_id = $("meta[name=country_id]").attr("content");
    //     let city_id = $(this).attr("data-recordid");
    //     let ostan_id = $(this).data("ostanId");
    //
    //
    //     let data = {
    //         "name": farsiNameCity,
    //         "country_id": country_id,
    //         "ostan_id" :ostan_id
    //     };
    //     let headers = {
    //         "Accept": "application/json",
    //         "Content-Type": "application/json",
    //         "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
    //         "X-Requested-With": "XMLHttpRequest"
    //     };
    //     let result = await postData(`/city/update/${city_id}`, headers, data);
    //     // if(catchFetch(result)) return;
    //     hideLoader();
    //
    //     console.log(result.status)
    //     if (result.status == "validation-error") {
    //         $.each(result.errors, (indx, err) => toastr.error(err));
    //         return;
    //     }
    //
    //     if (result.status == "duplicate") {
    //         toastr.errors("نام استان وارد شده تکراری می باشد")
    //         return;
    //     }
    //
    //     if (result.status == "success") {
    //         toastr.success("ویرایش استان با موفقیت انجام شد!");
    //         $(document).find("#tableCities").find(`tr#${city_id}`).find(".cityName").html(farsiNameCity);
    //
    //         return;
    //     }
    //
    // });
    //

    function updateDataTable(receivedData) {

        if (tableOstans != null)
            tableOstans.destroy();
        tableOstans = $('#tableOstans').DataTable({
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
                    "name": "nameCountry",
                    "data": "ostan.country.name",
                    "targets": 1,
                    "className": 'nameCountry'
                },
                {
                    "name": "ostanName",
                    "data": "ostan.name",
                    "targets": 2,
                    "className": 'ostanName'
                },
                {
                    "name": "cityCount",
                    'render': function (data, type, row, meta) {
                        return row.city_count > 0 ? row.city_count : 0;
                    },
                    "targets": 3,
                    "className": 'cityCount'
                },
                {
                    "name": "createdAt",
                    "data": "ostan.created_at",
                    "targets": 4,
                    "className": 'createdAt'
                },
                {
                    "name": "deletedAt",
                    "data": "ostan.deleted_at",
                    "targets": 5,
                    "className": 'deletedAt'
                },
                {
                    "name": "operation",
                    "targets": 6,
                    "className": 'operation',
                    "render": function (data, type, row, meta) {

                        let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 delete-ostan-btn" data-target="#deleteostan" data-toggle="modal" data-id="${row.ostan.id}">
                                                            <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="حذف"></i>
                                                        </button>`;

                        let restoreBtn = `<button type="button" class="btn btn-sm btn-warning ml-2 restore-ostan-btn" data-target="#restoremodal" data-toggle="modal" data-id="${row.ostan.id}">
                                                            <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="بازیابی"></i>
                                                        </button>`;


                        return `

                                          <td class="operation">
                                            ${row.deleted_at != null ? restoreBtn : deleteBtn}
                                                   <button class="btn btn-sm btn-primary ml-2 editostan"
                                                            data-id="${row.ostan.id}"
                                                            data-target="#editostan" data-toggle="modal"
                                                            data-recordid="${row.ostan.id}">
                                                        <i class="icon-note " aria-hidden="true" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="ویرایش"></i>
                                                    </button>
                                                     <button class="btn btn-sm btn-warning ml-2 mt-1 cities" data-id="${row.ostan.id}"
                                                            data-target="#citiesmodal" data-toggle="modal">
                                                        <i class="icon-options" aria-hidden="true" data-toggle="tooltip "
                                                           data-placement="top"
                                                           title="شهر ها"></i>
                                                    </button>
                                            </td>
                                        `;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('data text-center ').attr("id", data.ostan.id);
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

    function changeDeleteRestoreButton(fromElementName, toElementName, ostanId) {
        let tableRow = $(document).find("#tableOstans").find(`tr#${ostanId}`);
        let restoreBtn = `<button type="button" class="btn btn-sm btn-warning ml-2 restore-ostan-btn"
                                        data-target="#restoremodal" data-toggle="modal" data-id="${ostanId}">
                                    <i class="icon-refresh" aria-hidden="true" data-toggle="tooltip"
                                       data-placement="top"
                                       title="بازیابی"></i>
                                 </button>`;

        let deleteBtn = `<button class="btn btn-sm btn-danger ml-2 delete-ostan-btn" data-target="#deleteostan" data-toggle="modal" data-id="${ostanId}">
                                                            <i class="icon-trash" aria-hidden="true" data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="حذف"></i>
                                                        </button>`;

        $("#tableOstans")
            .fadeOut(500, function () {
                tableRow
                    .find(`.${fromElementName}`)
                    .replaceWith(`${toElementName == 'restore-ostan-btn' ? restoreBtn : deleteBtn}`);

                // manage delete_at column to empty-value or currentTime-value
                tableRow.find(".deletedAt").html(`${toElementName == 'restore-ostan-btn' ? getCurrentDate() : ''}`);
            })
            .fadeIn(500);
    }

    function getCurrentDate() {
        const m = moment();
        m.locale('en');
        return m.format('Y-m-d H:i:s');
    }
})
