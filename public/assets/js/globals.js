
function showLoader()
{
    $(".se-pre-con").fadeIn("slow");
}

function hideLoader()
{
    $(".se-pre-con").fadeOut();
}

function showModalLoader()
{
    let loader = `<div class="spinner-border text-info position-absolute" style="left: 50%;top: 50%" role="status"><span class="sr-only">Loading...</span></div>`;

    $(".modal .modal-body, .modal .modal-footer").children().css("visibility","hidden");
    $(".modal .modal-body").css("position","relative");
    $(".modal .modal-body, .modal .modal-footer").css("visibility","visible");
    $(".modal .modal-body").append(loader);

}

function hideModalLoader()
{
    $(".modal .modal-body, .modal .modal-footer").children().css("visibility","visible");
    $(".modal .modal-body").css("position","relative");
    $(".modal .modal-body, .modal .modal-footer").css("visibility","hidden");
    $(".modal .modal-body").find(".spinner-border").css("visibility","hidden");
}

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


function uploadedFilePreview(inputIp,containerPreviewClassName)
{
    let uploadedFile = null;
    $(`#${inputIp}`).on('change', function(){
        uploadedFile = this.files && this.files[0];
        // اگر فایلی آپلود نشده بود
        if(!uploadedFile) {
            $(`.${containerPreviewClassName}`).html('');
            $(`.${containerPreviewClassName}`).addClass('d-none');
            return false;
        }

        // validate type of file
        // نوع فایل چک شود
        if(['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp','application/pdf', 'application/msword'].indexOf(uploadedFile.type) == -1) {
            toastr.error('نوع فایل آپلود شده، معتبر نمیباشد.');
            $$(`#${inputIp}`).val(null); //empty file input
            uploadedFile=null;
            $(`.${containerPreviewClassName}`).html('');
            $(`.${containerPreviewClassName}`).addClass('d-none');
            return false;
        }
        if(uploadedFile) {
            $(`.${containerPreviewClassName}`).html(uploadedFile.name);
            $(`.${containerPreviewClassName}`).removeClass('d-none');
            return;
        }
    });
}


//Price 3 Digit Seperator
function separateNum(value, input) {
    /* seprate number input 3 number */
    let nStr = value + '';
    nStr = nStr.replace(/\,/g, "");
    x = nStr.split('.');
    let x1 = x[0];
    let x2 = x.length > 1 ? '.' + x[1] : '';
    let rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    if (input !== undefined) {
        input.value = x1 + x2;
    } else {
        return x1 + x2;
    }
}

function addCommas(nStr) {
    nStr += '';
    let x = nStr.split('.');
    let x1 = x[0];
    let x2 = x.length > 1 ? '.' + x[1] : '';
    let rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

//Price 3 Digit Seperator

function removeComma(str) {
    str = String(str);
    return str.replace(/,/g, '');
}

function toPersianNumber(str) {
    str = String(str);
    const id = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    return str.replace(/[0-9]/g, function (w) {
        return id[+w]
    });
}

function toEnglishNumber(replaceString) {
    let find = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    let replace = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    let regex;
    let arrLength = find.length;
    for (var i = 0; i < arrLength; i++) {
        regex = new RegExp(find[i], "g");
        replaceString = replaceString.replace(regex, replace[i]);
    }
    return replaceString;
}

function preparePrice(price)
{
    return toPersianNumber(addCommas(parseInt(price)));
}

//============ get and post data for fetch ===============//
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
