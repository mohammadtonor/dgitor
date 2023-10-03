(function ($) {
    "use strict";
    
     document.querySelector('.sweet-1').onclick = function(){
        swal("این پیام است!");
      };

      document.querySelector('.sweet-2').onclick = function(){
        swal("اینجا یک پیام است! ", "بسیار زیبا است ، اینطور نیست؟")
      };

      document.querySelector('.sweet-3').onclick = function(){
        swal("آفرین!", "شما روی دکمه کلیک کردید!", "success");
      };

      document.querySelector('.sweet-4').onclick = function(){
        swal({
          title: "مطمئنی؟",
          text: "شما قادر به بازیابی این پرونده تخیلی نخواهید بود!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'بله ، آن را حذف کنید!',
          closeOnConfirm: false,
          //closeOnCancel: false
        },
        function(){
          swal("حذف شده!", "پرونده تخیلی شما حذف شده است!", "success");
        });
      };

      document.querySelector('.sweet-5').onclick = function(){
        swal({
          title: "مطمئنی؟",
          text: "شما قادر به بازیابی این پرونده تخیلی نخواهید بود!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'بله ، آن را حذف کنید!',
          cancelButtonText: "نه ، لغو PLX!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){
            swal("حذف شده!", "پرونده تخیلی شما حذف شده است!", "success");
          } else {
            swal("لغو شد", "پرونده تخیلی شما بی خطر است :)", "error");
          }
        });
      };

      document.querySelector('.sweet-6').onclick = function(){
        swal({
          title: "سوئیت!",
          text: "در اینجا یک تصویر سفارشی وجود دارد.",
          imageUrl: 'dist/images/thumbs-up.jpg'
        });
      };

      document.querySelector('.sweet-7').onclick = function () {
        swal({
          title: "ورودی!",
          text: "چیزی جالب بنویسید:",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          animation: "slide-from-top",
          inputPlaceholder: "چیزی بنویسید"
        }, function (inputValue) {
          if (inputValue === false) return false;
          if (inputValue === "") {
            swal.showInputError("شما باید چیزی بنویسید!");
            return false
          }
          swal("خوب!", "تو نوشتی: " + inputValue, "success");
        });
      };

      document.querySelector('.sweet-8').onclick = function () {
        swal({
          title: "مثال درخواست آژاکس",
          text: "برای اجرای درخواست آژاکس ارسال کنید",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true
        }, function () {
          setTimeout(function () {
            swal("درخواست آژاکس به پایان رسید!");
          }, 2000);
        });
      };

      document.querySelector('.sweet-10').onclick = function(){
        swal({
          title: "مطمئنی؟",
          text: "شما قادر به بازیابی این پرونده تخیلی نخواهید بود!",
          type: "info",
          showCancelButton: true,
          confirmButtonClass: 'btn-primary',
          confirmButtonText: 'Primary!'
        });
      };

      document.querySelector('.sweet-11').onclick = function(){
        swal({
          title: "مطمئنی؟",
          text: "شما قادر به بازیابی این پرونده تخیلی نخواهید بود!",
          type: "info",
          showCancelButton: true,
          confirmButtonClass: 'btn-info',
          confirmButtonText: 'Info!'
        });
      };

      document.querySelector('.sweet-12').onclick = function(){
        swal({
          title: "مطمئنی؟",
          text: "شما قادر به بازیابی این پرونده تخیلی نخواهید بود!",
          type: "success",
          showCancelButton: true,
          confirmButtonClass: 'btn-success',
          confirmButtonText: 'Success!'
        });
      };

      document.querySelector('.sweet-13').onclick = function(){
        swal({
          title: "مطمئنی؟",
          text: "شما قادر به بازیابی این پرونده تخیلی نخواهید بود!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-warning',
          confirmButtonText: 'Warning!'
        });
      };

      document.querySelector('.sweet-14').onclick = function(){
        swal({
          title: "مطمئنی؟",
          text: "شما قادر به بازیابی این پرونده تخیلی نخواهید بود!",
          type: "error",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Danger!'
        });
    };

})(jQuery);
