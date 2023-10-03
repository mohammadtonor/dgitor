
$(document).ready(function (){

    //=========== getAlls =========//
    getAllRoles();
    getAllOstans();

    //============== rols selected list ========//

    $('.multiselRols').select2({
        closeOnSelect: true,
        placeholder: "انتخاب کنید",
        allowClear: Boolean($(this).data('allow-clear')),
        "language": {
            "noResults": function () {
                return "داده ایی یافت نشد!";
            }
        },
    });

     //======== data ======//
    $('#birthdayInsert').persianDatepicker({
        months: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
        dowTitle: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه"],
        shortDowTitle: ["ش", "ی", "د", "س", "چ", "پ", "ج"],
        showGregorianDate: !1,
        persianNumbers: !0,
        format: 'YYYY/MM/DD',
        selectedBefore: !1,
        selectedDate: null,
        startDate: null,
        endDate: null,
        prevArrow: '\u25c4',
        nextArrow: '\u25ba',
        theme: 'default',
        alwaysShow: !1,
        selectableYears: null,
        selectableMonths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        cellWidth: 25, // by px
        cellHeight: 20, // by px
        fontSize: 13, // by px
        isRTL: !1,
        autoClose: true,
        initialValue: false,
    });



    //========================= insert personnel =========================//
    $(document).on("click" ,"#insertNewPersonnel" , async function ()
    {
        let data = {
        "name" : $("#firstNameInsert").val(),
        "family" : $("#lastNameInsert").val(),
        "gender" : $("#genderInsert :selected").val(),
        "ncode" : $("#ncodeInsert").val(),
        "birthday" : moment.from(convertToEnglishDigits($("#birthdayInsert").val()), 'fa', 'YYYY/MM/DD').locale('en').format('YYYY/MM/DD'),
        "mobile" : $("#phoneInsert").val(),
        "email" :  $("#emailInsert").val(),
        "role_ids" : $("#rolesInsert").val(),
        "ostan_id" : $("#ostanInsert").val(),
        "city_id" : $("#cityInsert").val(),
        "mobile_verification_code" : $("#verificationCode").val(),
        "postal_code" : $("#postalCodeInsert").val(),
        "address" : $("#adressInsert").val(),


        };
        let headers={
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $(document).find("meta[name=csrf_token]").attr("content"),
            "X-Requested-With": "XMLHttpRequest"
        };
        let result = await postData("/personnel/insert",headers,data);
        if(catchFetch(result)) return;
        hideLoader();

        if(result.status=="validation-error")
        {
            $.each(data.errors, (indx,err)=>toastr.error(err));
            return;
        }
        if(result.status=="success")
        {
            toastr.success("کارمند جدید با موفقیت ثبت شد!");
            return;
        }
        // toastr.error("بروز خطا!");
    });



    //================== get all options of roles select2 ==================
    async function getAllRoles(){
        let result = await getData("/role/get-all",{
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json"
        });


        $("#rolesInsert").empty();
        $.each(result.roles, function(key,value){
            $("#rolesInsert").append(`<option value="${value.role.id}">${value.role.name_fa}</option>`)
        });
        $('#rolesInsert').select2({
            closeOnSelect : true,
            placeholder : "انتخاب کنید",
            allowClear: Boolean($(this).data('allow-clear')),
            "language": {
                "noResults": function(){
                    return "داده ای یافت نشد!";
                }
            },
        });
    }


    //========================== get all options of ostans select2  ============//

    async function getAllOstans(){
        let result = await getData("/ostan/get-all/1",{
            "accept": "application/json",
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        });

        $("#ostanInsert").empty();
        $("#ostanInsert").append('<option value="">انتخاب کنید</option> ');

        $.each(result.status.ostans, function(key,value){
            $("#ostanInsert").append(`<option value="${value.ostan.id}">${value.ostan.name}</option>`)
        })
    }
    //==========================  get all options of cities select2  ==================//

    $("#ostanInsert").on("change",async function getAllCities(){

            let ostanId = $(this).find(":selected").val();

            let result = await getData(`/city/get-all/${ostanId}`,{
                "accept": "application/json",
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            });

            $("#cityInsert").empty();
            $("#cityInsert").append('<option value="">انتخاب کنید</option> ');

            $.each(result.status.cities, function(key,value){
                $("#cityInsert").append(`<option value="${value.city.id}">${value.city.name}</option>`)
            })
        });

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



//I used to convert birthday persian digits to english digits
//=================== Convert Persian/Arabic Digits to English Digits ===================//
    const persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
    const arabicNumbers  = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
    function convertToEnglishDigits (str)
    {
        if(str==undefined || str=='' || str==null) return;

        if(typeof str === 'string')
        {
            for(let i=0; i<10; i++)
            {
                str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
            }
        }
        return str;
    }



})//end of document ready



