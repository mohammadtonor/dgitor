$(document).ready(function () {
   let dualList = new DualListbox(".anbar-categories", {
        availableTitle: "لیست دسترسی های سمت",
        selectedTitle: "کل دسترسی ها",
        addButtonText: "افزودن",
        removeButtonText: "حذف",
        addAllButtonText: "افزودن همه",
        removeAllButtonText: "حذف همه",
    });

    // Change Multiselect Search box To Persian
    // $(".dual-listbox__search").attr("placeholder", "جستجو");
    $(".dual-listbox__search").css("display", "none");
    $(".dual-listbox__button").addClass("bg-primary");



    fetch(`/role/get-all`,{
        headers:{
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        },
        method:"GET"
    })
        .then(response=>response.json())
        .then(data=>{
            $("#semat").html("");
            data.roles.forEach(function (object) {
            $("#semat").append(`<option value="${object.role.id}">${object.role.name}</option>`)
        })
    })

    $(document).on('change',"#semat",function () {
        let role_id = $("#semat option:selected").val()

        fetch(`/permission-role/page/${role_id}`,{
            headers:{
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            method:"GET"
        })
            .then(response=>response.json())
            .then(data=>{
                console.log(data.status);
                $("#list_access").html("");
                data.status.permissions.forEach(function (object) {
                    $("#list_access").append(`<option value="${object.id}">${object.name}</option>`)
                })
            })
    })
});
