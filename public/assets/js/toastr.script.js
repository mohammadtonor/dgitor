(function ($) {
    "use strict";
       toastr.options = {
        "debug": false,
        "newestOnTop": false,
        "positionClass": "toast-bottom-left",
        "closeButton": true,
        "progressBar": true
    };
    $('.homerDemo1').on('click', function (event) {
        toastr.info('اطلاعات - این یک اعلان اطلاعات سفارشی است');
    });
    $('.homerDemo2').on('click', function (event) {
        toastr.success('موفقیت  - این یک اعلان موفقیت است');
    });
    $('.homerDemo3').on('click', function (event) {
        toastr.warning('اخطار - این یک اخطار هشدار دهنده است');
    });
    $('.homerDemo4').on('click', function (event) {
        toastr.error('ارور - این یک اعلان  ارور است');
    });

})(jQuery);