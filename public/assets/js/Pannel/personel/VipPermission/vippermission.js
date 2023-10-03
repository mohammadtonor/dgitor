//dual list box
$(document).ready(function () {
    new DualListbox(".vippermissions", {
        availableTitle: "لیست تمام دسترسی ها",
        selectedTitle: "لیست دسترسی های ویژه",
        addButtonText: "افزودن",
        removeButtonText: "حذف",
        addAllButtonText: "افزودن همه",
        removeAllButtonText: "حذف همه",
    });

    // Change Multiselect Search box To Persian
    $(".dual-listbox__search").css("display", "none");
    $(".dual-listbox__button").addClass("bg-primary");
    $('.dual-listbox__search').attr('placeholder', 'جستجو');

    $(document).on("click","#sendnewpermission", async function (){
        let permissions= [];
        let user_id=$(".userName").val();
        console.log(user_id);
        $("#vippermissions") .find(":selected")
            .each(function(key,value){
                permissions.push($(this).val())
            });
        console.log(permissions);
        let headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData(`/vippermission/user/sync/${user_id}`, headers, data);








    })




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

});


