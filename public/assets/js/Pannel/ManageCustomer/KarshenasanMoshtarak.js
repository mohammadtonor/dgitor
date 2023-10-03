$(document).ready(function () {
    let dualList = new DualListbox(".karshenas", {
        availableTitle: "لیست همه کارشناس ها",
        selectedTitle: "لیست کارشناسان مشترک",
        addButtonText: "افزودن",
        removeButtonText: "حذف",
        addAllButtonText: "افزودن همه",
        removeAllButtonText: "حذف همه",
    });

    // Change Multiselect Search box To Persian
    // $(".dual-listbox__search").attr("placeholder", "جستجو");
    $(".dual-listbox__search").css("display", "none");
    $(".dual-listbox__button").addClass("bg-primary");







});
