<?php

use Illuminate\Support\Facades\Route;


//////////////////////////////////////// Category ///////////////////////////////////////

Route::get("/main-cat/page",[\App\Http\Controllers\Admin\Category\Category\MainCategoriesController::class,"showMainCategoryPageInfo"])->name("main.cat.show");//1
Route::post("/main-cat/insert",[\App\Http\Controllers\Admin\Category\Category\MainCategoriesController::class,"insertMainCategory"])->name("main.cat.insert");//2
Route::get("/main-cat/get-one/{category_id}",[\App\Http\Controllers\Admin\Category\Category\MainCategoriesController::class,"selectOneMainCategory"])->name("main.cat.getone");//3
Route::get("/main-cat/get-all",[\App\Http\Controllers\Admin\Category\Category\MainCategoriesController::class,"selectAllMainCategory"])->name("main.cat.all");//4
Route::get("/main-cat/delete/{category_id}",[\App\Http\Controllers\Admin\Category\Category\MainCategoriesController::class,"deleteMainCategory"])->name("main.cat.rm");//5
Route::get("/main-cat/restore/{category_id}",[\App\Http\Controllers\Admin\Category\Category\MainCategoriesController::class,"restoreMainCategory"])->name("main.cat.restore");//6
Route::post("/main-cat/update/{category_id}",[\App\Http\Controllers\Admin\Category\Category\MainCategoriesController::class,"updateMainCategory"])->name("main.cat.update");//7


//////////////////////////////////////// sub2 Category ///////////////////////////////////

Route::get("/sub2-cat/page/{parent_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub2CategoriesController::class,"showSub2CategoryPageInfo"])->name("sub2.cat.show");//1
Route::post("/sub2-cat/insert/{parent_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub2CategoriesController::class,"insertSub2Category"])->name("sub2.cat.insert");//2
Route::get("/sub2-cat/get-one/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub2CategoriesController::class,"selectOneSub2Category"])->name("sub2.cat.getone");//3
Route::get("/sub2-cat/get-all/{parent_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub2CategoriesController::class,"selectAllSub2Category"])->name("sub2.cat.all");//4
Route::get("/sub2-cat/delete/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub2CategoriesController::class,"deleteSub2Category"])->name("sub2.cat.rm");//5
Route::get("/sub2-cat/restore/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub2CategoriesController::class,"restoreSub2Category"])->name("sub2.cat.restore");//6
Route::post("/sub2-cat/update/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub2CategoriesController::class,"updateSub2Category"])->name("sub2.cat.update");//7


//////////////////////////////////////// sub3 Category ///////////////////////////////////

Route::get("/sub3-cat/page/{parent_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub3CategoriesController::class,"showSub3CategoryPageInfo"])->name("sub3.cat.show");//1
Route::post("/sub3-cat/insert/{parent_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub3CategoriesController::class,"insertSub3Category"])->name("sub3.cat.insert");//2
Route::get("/sub3-cat/get-one/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub3CategoriesController::class,"selectOneSub3Category"])->name("sub3.cat.getone");//3
Route::get("/sub3-cat/get-all/{parent_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub3CategoriesController::class,"selectAllSub3Category"])->name("sub3.cat.all");//4
Route::get("/sub3-cat/delete/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub3CategoriesController::class,"deleteSub3Category"])->name("sub3.cat.rm");//5
Route::get("/sub3-cat/restore/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub3CategoriesController::class,"restoreSub3Category"])->name("sub3.cat.restore");//6
Route::post("/sub3-cat/update/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub3CategoriesController::class,"updateSub3Category"])->name("sub3.cat.update");//7

//////////////////////////////////////// sub4 Category ////////////////////////////////////

Route::get("/sub4-cat/page/{parent_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub4CategoriesController::class,"showSub4CategoryPageInfo"])->name("sub4.cat.show");//1
Route::post("/sub4-cat/insert/{parent_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub4CategoriesController::class,"insertSub4Category"])->name("sub4.cat.insert");//2
Route::get("/sub4-cat/get-one/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub4CategoriesController::class,"selectOneSub4Category"])->name("sub4.cat.getone");//3
Route::get("/sub4-cat/get-all/{parent_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub4CategoriesController::class,"selectAllSub4Category"])->name("sub4.cat.all");//4
Route::get("/sub4-cat/delete/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub4CategoriesController::class,"deleteSub4Category"])->name("sub4.cat.rm");//5
Route::get("/sub4-cat/restore/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub4CategoriesController::class,"restoreSub4Category"])->name("sub4.cat.restore");//6
Route::post("/sub4-cat/update/{sub_cat_id}",[\App\Http\Controllers\Admin\Category\Category\Sub4CategoriesController::class,"updateSub4Category"])->name("sub4.cat.update");//7



//////////////////////////////////////// Category relation/////////////////////////////////

////tags

////attribute
Route::get("/sub4-cat/attribute/get-all/{category_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryRelationController::class,"getAllAttributeOfCategory"])->name("subcat4.attr.all");
Route::get("/sub4-cat/attribute/delete/{category_id}/{attr_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryRelationController::class,"removeAttributeFromCategory"])->name("subcat4.attr.rm");
Route::get("/sub4-cat/attribute/add-cat/{category_id}/{attr_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryRelationController::class,"addAttributeToCategory"])->name("subcat4.attr.add");
Route::get("/sub4-cat/attribute-not-have-cat",[\App\Http\Controllers\Admin\Category\Category\CategoryRelationController::class,"attributeNotHaveCategory"])->name("subcat4.attr.withoutcat");


////pre product
Route::get("/sub4-cat/pre/get-all/{category_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryRelationController::class,"getAllPreProductOfCategory"])->name("subcat4.pre.all");
Route::get("/sub4-cat/pre/delete/{category_id}/{pre_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryRelationController::class,"removePreProductFromCategory"])->name("subcat4.pre.rm");
Route::get("/sub4-cat/pre/add-cat/{category_id}/{pre_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryRelationController::class,"addPreProductToCategory"])->name("subcat4.pre.add");
Route::get("/sub4-cat/pre-not-have-cat",[\App\Http\Controllers\Admin\Category\Category\CategoryRelationController::class,"preProductNotHavecategory"])->name("subcat4.pre.withoutcat");


//////////////////////////////////////// Category Pic Operations ///////////////////////////

Route::get("/file-cat/get-pic/{category_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryImageFileController::class, "downloadPicOfCategory"])->name("cat.pic.download");
Route::get("/file-cat/get-base64-pic/{category_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryImageFileController::class, "downloadPicOfCategory"])->name("cat.pic.base64.download");
Route::get("/file-cat/remove-pic/{category_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryImageFileController::class, "removeFileFromCategory"])->name("cat.pic.rm");
Route::post("/file-cat/upload-pic/{category_id}",[\App\Http\Controllers\Admin\Category\Category\CategoryImageFileController::class, "uploadFileForCategory"])->name("cat.pic.upload");


//////////////////////////////////////// Attribute ////////////////////////////////////////

Route::get("/attribute/page/{cat_id}",[\App\Http\Controllers\Admin\Category\Attribute\AttributeController::class,"showPage"])->name("attr.page");//1
Route::post("/attribute/insert/{cat_id}",[\App\Http\Controllers\Admin\Category\Attribute\AttributeController::class,"insert"])->name("attr.insert");//2
Route::get("/attribute/get-one/{attr_id}",[\App\Http\Controllers\Admin\Category\Attribute\AttributeController::class,"selectById"])->name("attr.get-one");//3
Route::get("/attribute/get-all/{cat_id}",[\App\Http\Controllers\Admin\Category\Attribute\AttributeController::class,"selectAll"])->name("attr.get-all");//4
Route::get("/attribute/delete/{attr_id}",[\App\Http\Controllers\Admin\Category\Attribute\AttributeController::class,"delete"])->name("attr.rm");//5
Route::get("/attribute/restore/{attr_id}",[\App\Http\Controllers\Admin\Category\Attribute\AttributeController::class,"restore"])->name("attr.restore");//6
Route::post("/attribute/update/{attr_id}/{cat_id}",[\App\Http\Controllers\Admin\Category\Attribute\AttributeController::class,"update"])->name("attr.update");//7

Route::get("/attribute/relation/category/{attr_id}",[\App\Http\Controllers\Admin\Category\Attribute\AttributeController::class,"getCategoryOfAttribute"])->name("attr.category-all");//8
Route::get("/attribute/relation/all-value/{attr_id}",[\App\Http\Controllers\Admin\Category\Attribute\AttributeController::class,"getAllValuesOfAttribute"])->name("attr.value-all");//9

//////////////////////////////////////// DefaultValue ////////////////////////////////////////

Route::get("/default-val/page/{attr_id}",[\App\Http\Controllers\Admin\Category\DefaultValue\DefaultValueController::class,"showPage"])->name("default-val.page");//1
Route::post("/default-val/insert",[\App\Http\Controllers\Admin\Category\DefaultValue\DefaultValueController::class,"insert"])->name("default-val.insert");//2
Route::get("/default-val/get-one/{id}",[\App\Http\Controllers\Admin\Category\DefaultValue\DefaultValueController::class,"selectById"])->name("default-val.get-one");//3
Route::get("/default-val/get-all/{attr_id}",[\App\Http\Controllers\Admin\Category\DefaultValue\DefaultValueController::class,"selectAll"])->name("default-val.get-all");//4
Route::get("/default-val/delete/{id}",[\App\Http\Controllers\Admin\Category\DefaultValue\DefaultValueController::class,"delete"])->name("default-val.rm");//5
Route::post("/default-val/update/{id}",[\App\Http\Controllers\Admin\Category\DefaultValue\DefaultValueController::class,"update"])->name("default-val.update");//6


///////////////////////////////////////////////// tag ////////////////////////////////////////

Route::get("/tag/page", [\App\Http\Controllers\Admin\Tag\TagsController::class, "showTagPageInfo"]); // 1
Route::post("/tag/insert", [\App\Http\Controllers\Admin\Tag\TagsController::class, "insertTag"]); // 2
Route::get("/tag/get-one/{id}", [\App\Http\Controllers\Admin\Tag\TagsController::class, "getOneTagById"]); // 3
Route::get("/tag/get-all", [\App\Http\Controllers\Admin\Tag\TagsController::class, "getAllTag"]); // 4
Route::get("/tag/del/{id}", [\App\Http\Controllers\Admin\Tag\TagsController::class, "deleteTag"]); // 5
Route::get("/tag/restore/{id}", [\App\Http\Controllers\Admin\Tag\TagsController::class, "restoreTag"]); // 6
Route::post("/tag/update/{id}", [\App\Http\Controllers\Admin\Tag\TagsController::class, "updateTag"]); // 7

///////////////////////////////////////////////// tag relations ////////////////////////////////////////
//// category

Route::get("/tag/relation/category/get-all/{category_id}", [\App\Http\Controllers\Admin\Tag\TagRelationsController::class, "getAllTagOfCategory"]);
Route::get("/tag/relation/category/can-assign/{category_id}", [\App\Http\Controllers\Admin\Tag\TagRelationsController::class, "tagsCanAssignedToCategory"]);
Route::post("/tag/relation/category/sync/{category_id}", [\App\Http\Controllers\Admin\Tag\TagRelationsController::class, "syncTagsToCategory"]);
Route::get("/tag/relation/category/attach/{category_id}/{tag_id}", [\App\Http\Controllers\Admin\Tag\TagRelationsController::class, "attachTagToCategory"]);
Route::get("/tag/relation/category/deatch/{category_id}/{tag_id}", [\App\Http\Controllers\Admin\Tag\TagRelationsController::class, "detachTagFromCategory"]);
Route::get("/tag/relation/category/deatch-all/{category_id}", [\App\Http\Controllers\Admin\Tag\TagRelationsController::class, "detachAllTagFromCategory"]);
