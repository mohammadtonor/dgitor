(function ($) {
    "use strict";
   

////////////////////////////// Quill Editor ////////////////////////
var toolbarOptions = [
  [{
    'direction': 'rtl'
  }], // text direction
  [{header:[1,2,!1]}],["bold","italic","underline"],["image","code-block"]
];
var quill = new Quill('#snow-container', {
    placeholder: 'Compose an epic...',
    theme: 'snow',
     modules: {
    toolbar: toolbarOptions
  }
  });

})(jQuery);
