<?php

use Illuminate\Support\Facades\Route;



/////////////////////////////////////////////// PreProduct ////////////////////////////////////////////


Route::get("/pre-product/page",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class,"showPreProductPageInfo"])->name("pre.show"); // 1
Route::post("/pre-product/insert",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class,"insert"])->name("pre.insert"); // 2
Route::get("/pre-product/get-one/{preproduct_id}",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class,"selectById"])->name("pre.getone"); // 3
Route::get("/pre-product/get-all",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class, "selectAllPreProduct"])->name("pre.all"); // 4
Route::get("/pre-product/delete/{preproduct_id}",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class, "deletePreProduct"])->name("pre.del"); // 5
Route::get("/pre-product/restore/{preproduct_id}",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class,"restorePreProduct"])->name("pre.restore"); // 6
Route::post("/pre-product/update/{preproduct_id}",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class, "updatePreProduct"])->name("pre.update"); // 7
Route::get("/pre-product/active-show/{preproduct_id}",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class,"activeShowPreProduct"])->name("pre.activeShow"); // 8
Route::get("/pre-product/inactive-show/{preproduct_id}",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class,"inActiveShowPreProduct"])->name("pre.inactiveShow"); // 9
Route::get("/pre-product/search/{category_id}",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class,"searchPreProductByCategory"])->name("pre.searchPreProductByCategory");

Route::get("/pre-product/category/{preproduct_id}",[\App\Http\Controllers\Admin\Exchange\PreProduct\PreProductController::class,"getCategoryOfPreProduct"])->name("pre.getCategoryOfPreProduct");



//////////////////////////////////////////////////////////// Exchange ////////////////////////////////////////////////////////////

//////////////////////////////////////// Exchange ////////////////////////////////////////

Route::get("/exchange/page/{user_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\Exchange\ExchangeController::class,"showExchangePageInfo"])->name("exchange.show");
Route::get("/exchange/all/page",[\App\Http\Controllers\Admin\Exchange\Exchange\Exchange\ExchangeController::class,"showAllExchangePageInfo"])->name("exchange.show.all");

Route::post("/exchange/insert",[\App\Http\Controllers\Admin\Exchange\Exchange\Exchange\ExchangeController::class,"insert"])->name("exchange.insert");
Route::get("/exchange/get-one/{exchange_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\Exchange\ExchangeController::class,"selectById"])->name("exchange.getone");
Route::get("/exchange/get-all",[\App\Http\Controllers\Admin\Exchange\Exchange\Exchange\ExchangeController::class,"selectAll"])->name("exchange.all");
Route::get("/exchange/delete/{exchange_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\Exchange\ExchangeController::class,"delete"])->name("exchange.rm");
Route::post("/exchange/update/{exchange_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\Exchange\ExchangeController::class,"update"])->name("exchange.update");


//////////////////////////////////////// Exchange Status ////////////////////////////////////////

Route::post("/ex-status/insert",[\App\Http\Controllers\Admin\Exchange\Exchange\Status\ExchangeStatusController::class,"insert"])->name("exchange.status.insert");
Route::get("/status/get-one/{ex_status_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\Status\ExchangeStatusController::class,"selectById"])->name("exchange.status.getone");
Route::get("/status/get-all",[\App\Http\Controllers\Admin\Exchange\Exchange\Status\ExchangeStatusController::class,"selectAll"])->name("exchange.status.all");
Route::get("/status/delete/{ex_status_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\Status\ExchangeStatusController::class,"delete"])->name("exchange.status.rm");
Route::post("/status/update/{ex_status_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\Status\ExchangeStatusController::class,"update"])->name("exchange.status.update");


//////////////////////////////////////// Exchange AttrValue ////////////////////////////////////////

Route::post("/attrval/insert",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrValue\ExchangeAttrValueController::class,"insert"])->name("exchange.attrval.insert");
Route::get("/attrval/get-one/{attrval_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrValue\ExchangeAttrValueController::class,"selectById"])->name("exchange.attrval.getone");
Route::get("/attrval/get-all",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrValue\ExchangeAttrValueController::class,"selectAll"])->name("exchange.attrval.all");
Route::get("/attrval/delete/{attrval_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrValue\ExchangeAttrValueController::class,"delete"])->name("exchange.attrval.rm");
Route::post("/attrval/update/{attrval_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrValue\ExchangeAttrValueController::class,"update"])->name("exchange.attrval.update");


//////////////////////////////////////// Exchange AttrDefaultValue ////////////////////////////////////////

Route::post("/attrvalexchange/insert",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrDefaultValueExchange\AttrDefaultValueExchangeController::class,"insert"])->name("exchange.attrdefaultval.insert");
Route::get("/attrvalexchange/get-one/{attrvalexchange_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrDefaultValueExchange\AttrDefaultValueExchangeController::class,"selectById"])->name("exchange.attrdefaultval.getone");
Route::get("/attrvalexchange/get-all",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrDefaultValueExchange\AttrDefaultValueExchangeController::class,"selectAll"])->name("exchange.attrdefaultval.all");
Route::get("/attrvalexchange/delete/{attrvalexchange_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrDefaultValueExchange\AttrDefaultValueExchangeController::class,"delete"])->name("exchange.attrdefaultval.rm");
Route::post("/attrvalexchange/update/{attrvalexchange_id}",[\App\Http\Controllers\Admin\Exchange\Exchange\AttrDefaultValueExchange\AttrDefaultValueExchangeController::class,"update"])->name("exchange.attrdefaultval.update");



//////////////////////////////////////////////////////////// Favorite ////////////////////////////////////////////////////////////

//////////////////////////////////////// Favorite ////////////////////////////////////////

Route::get("/favorite/page/{user_id}",[\App\Http\Controllers\Admin\Exchange\Favorite\FavoriteController::class,"showFavoritePageInfo"])->name("favorite.show");

Route::post("/favorite/insert",[\App\Http\Controllers\Admin\Exchange\Favorite\FavoriteController::class,"insert"])->name("favorite.insert");
Route::get("/favorite/get-one/{favorite_id}",[\App\Http\Controllers\Admin\Exchange\Favorite\FavoriteController::class,"selectById"])->name("favorite.getone");
Route::get("/favorite/get-all",[\App\Http\Controllers\Admin\Exchange\Favorite\FavoriteController::class,"selectAll"])->name("favorite.all");
Route::get("/favorite/delete/{favorite_id}",[\App\Http\Controllers\Admin\Exchange\Favorite\FavoriteController::class,"delete"])->name("favorite.rm");
Route::post("/favorite/update/{favorite_id}",[\App\Http\Controllers\Admin\Exchange\Favorite\FavoriteController::class,"update"])->name("favorite.update");



//////////////////////////////////////////////////////////// PeriodicService ////////////////////////////////////////////////////////////

//////////////////////////////////////// PeriodicService ////////////////////////////////////////

Route::post("/periodic-service/insert",[\App\Http\Controllers\Admin\Exchange\PeriodicService\PeriodicService\PeriodicServiceController::class,"insert"])->name("ps.insert");
Route::get("/periodic-service/get-one/{periodic_service_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\PeriodicService\PeriodicServiceController::class,"selectById"])->name("ps.getone");
Route::get("/periodic-service/get-all",[\App\Http\Controllers\Admin\Exchange\PeriodicService\PeriodicService\PeriodicServiceController::class,"selectAll"])->name("ps.all");
Route::get("/periodic-service/delete/{periodic_service_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\PeriodicService\PeriodicServiceController::class,"delete"])->name("ps.rm");
Route::post("/periodic-service/update/{periodic_service_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\PeriodicService\PeriodicServiceController::class,"update"])->name("ps.update");


//////////////////////////////////////// PeriodicService Time ////////////////////////////////////////

Route::post("/ps-time/insert",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Time\PeriodicServiceTimeController::class,"insert"])->name("ps.time.insert");
Route::get("/ps-time/get-one/{ps_time_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Time\PeriodicServiceTimeController::class,"selectById"])->name("ps.time.getone");
Route::get("/ps-time/get-all",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Time\PeriodicServiceTimeController::class,"selectAll"])->name("ps.time.all");
Route::get("/ps-time/delete/{ps_time_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Time\PeriodicServiceTimeController::class,"delete"])->name("ps.time.rm");
Route::post("/ps-time/update/{ps_time_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Time\PeriodicServiceTimeController::class,"update"])->name("ps.time.update");


//////////////////////////////////////// PeriodicService Archive ////////////////////////////////////////

Route::post("/ps-archive/insert",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Archive\PeriodicServiceArchiveController::class,"insert"])->name("ps.archive.insert");
Route::get("/ps-archive/get-one/{ps_time_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Archive\PeriodicServiceArchiveController::class,"selectById"])->name("ps.archive.getone");
Route::get("/ps-archive/get-all",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Archive\PeriodicServiceArchiveController::class,"selectAll"])->name("ps.archive.all");
Route::get("/ps-archive/delete/{ps_archive_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Archive\PeriodicServiceArchiveController::class,"delete"])->name("ps.archive.rm");
Route::post("/ps-archive/update/{ps_archive_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Archive\PeriodicServiceArchiveController::class,"update"])->name("ps.archive.update");


//////////////////////////////////////// PeriodicService Description ////////////////////////////////////////

Route::post("/ps-desc/insert",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Desc\PeriodicServiceDescController::class,"insert"])->name("ps.desc.insert");
Route::get("/ps-desc/get-one/{ps_desc_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Desc\PeriodicServiceDescController::class,"selectById"])->name("ps.desc.getone");
Route::get("/ps-desc/get-all",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Desc\PeriodicServiceDescController::class,"selectAll"])->name("ps.desc.all");
Route::get("/ps-desc/delete/{ps_desc_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Desc\PeriodicServiceDescController::class,"delete"])->name("ps.desc.rm");
Route::post("/ps-desc/update/{ps_desc_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Desc\PeriodicServiceDescController::class,"update"])->name("ps.desc.update");


//////////////////////////////////////// PeriodicService Pic Operations ////////////////////////////////////////

Route::get("/ps/get-pic/{ps_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Pic\PeriodicServicePicController::class, "getFileOfPeriodicService"])->name("ps.pic.download");
Route::get("/ps/remove-pic/{ps_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Pic\PeriodicServicePicController::class, "removeFileFromPeriodicService"])->name("ps.pic.rm");
Route::post("/ps/upload-pic/{ps_id}",[\App\Http\Controllers\Admin\Exchange\PeriodicService\Pic\PeriodicServicePicController::class, "uploadFileForPeriodicService"])->name("ps.pic.upload");




//////////////////////////////////////////////////////////// Product ////////////////////////////////////////////////////////////

////////////////////////////////////////////////product////////////////////////////////////////////////

Route::get("/product/page",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"showProductPageInfo"])->name("product.show"); // 1
Route::get("/product/insert/page", [\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class, "showInsertPage"])->name("product.insertPage"); // 2
//Route::post("/product/insert",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"insert"])->name("product.insert"); // 3
Route::get("/product/get-one/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"selectById"])->name("product.getone"); // 4
Route::get("/product/get-all",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"selectAll"])->name("product.all"); // 5
Route::get("/product/delete/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"delete"])->name("product.rm"); // 6
Route::get("/product/restore/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"restore"])->name("product.restore"); // 7
//Route::post("/product/update/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"update"])->name("product.update"); // 8
Route::get("/product/active-show/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"activeShow"])->name("product.activeShow"); // 9
Route::get("/product/inactive-show/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"inactiveShow"])->name("product.inactiveShow"); // 10
Route::post("/product/change-price/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"changePrice"])->name("product.changePrice"); // 11
Route::post("/product/change-address/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"changeAddress"])->name("product.changeAddr"); // 12
Route::post("/product/search",[\App\Http\Controllers\Admin\Exchange\Product\Product\ProductController::class,"searchProduct"])->name("product.search"); // 12

//////////////////////////////////////// Product Service ////////////////////////////////////////

Route::get("/product-service/page",[\App\Http\Controllers\Admin\Exchange\Product\ProductService\ProductServiceController::class, "showProductServicePageInfo"])->name("proserv.page"); // 1
Route::post("/product-service/insert",[\App\Http\Controllers\Admin\Exchange\Product\ProductService\ProductServiceController::class, "insertProductService"])->name("proserv.insert"); // 2
Route::get("/product-service/get-one/{ps_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductService\ProductServiceController::class, "selectProductServiceById"])->name("proserv.getone"); // 3
Route::get("/product-service/get-all",[\App\Http\Controllers\Admin\Exchange\Product\ProductService\ProductServiceController::class, "selectAllProductService"])->name("proserv.all"); // 4
Route::get("/product-service/delete/{ps_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductService\ProductServiceController::class, "deleteProductService"])->name("proserv.delete"); // 5
Route::get("/product-service/restore/{ps_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductService\ProductServiceController::class, "restoreProductService"])->name("proserv.restore"); // 6
Route::post("/product-service/update/{ps_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductService\ProductServiceController::class, "updateProductService"])->name("proserv.update"); // 7


//////////////////////////////////////// Product Relation ////////////////////////////////////////

Route::get("/product/relation/register/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductRelation\ProductRelationController::class,"getRegisterOfProduct"])->name("product.relation.register");
Route::get("/product/relation/city/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductRelation\ProductRelationController::class,"getCityOfProduct"])->name("product.relation.city");
Route::get("/product/relation/product-service/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductRelation\ProductRelationController::class,"getProductServiceOfProduct"])->name("product.relation.productservice");
Route::get("/product/relation/pic/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductRelation\ProductRelationController::class,"getProductPicProduct"])->name("product.relation.pic");
Route::get("/product/relation/attrvalue/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductRelation\ProductRelationController::class,"getAttrValueOfProduct"])->name("product.relation.attrval");
Route::get("/product/relation/defaultvalue/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\ProductRelation\ProductRelationController::class,"getDefaultValueProduct"])->name("product.relation.defaultval");


//////////////////////////////////////// Product DefaultValue ////////////////////////////////////////

Route::post("/product/defaultvalrel/attach/{product_id}/{default_value_id}",[\App\Http\Controllers\Admin\Exchange\Product\DefaultValueProductRelation\DefaultValueProductRelationController::class,"attachDefaultValueToProduct"])->name("product.defaultval.attach");
Route::get("/product/defaultvalrel/detach/{product_id}/{default_value_id}",[\App\Http\Controllers\Admin\Exchange\Product\DefaultValueProductRelation\DefaultValueProductRelationController::class,"detachDefaultValueFromProduct"])->name("product.defaultval.detach");
Route::get("/product/defaultvalrel/sync/{default_value_id}/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\DefaultValueProductRelation\DefaultValueProductRelationController::class,"SyncDefaultValueToProduct"])->name("product.defaultval.sync");
Route::get("/product/defaultvalrel/getall/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\DefaultValueProductRelation\DefaultValueProductRelationController::class,"getAllDefaultValuesOfProduct"])->name("product.defaultval.getall");
Route::get("/product/defaultvalrel/rmall/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\DefaultValueProductRelation\DefaultValueProductRelationController::class,"removeAllDefaultValueOfProduct"])->name("product.defaultval.rmall");
Route::get("/product/defaultvalrel/getallproduct/{default_value_id}",[\App\Http\Controllers\Admin\Exchange\Product\DefaultValueProductRelation\DefaultValueProductRelationController::class,"getAllProductHasDefaultValue"])->name("product.defaultval.getallproduct");


//////////////////////////////////////// Product AttrValue ////////////////////////////////////////

Route::post("/product/attrval/insert",[\App\Http\Controllers\Admin\Exchange\Product\AttrValue\ProductAttrValuesController::class,"insert"])->name("product.attrvalue.insert");
Route::get("/product/attrval/get-one/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\AttrValue\ProductAttrValuesController::class,"selectById"])->name("product.attrvalue.getone");
Route::get("/product/attrval/get-all",[\App\Http\Controllers\Admin\Exchange\Product\AttrValue\ProductAttrValuesController::class,"selectAll"])->name("product.attrvalue.all");
Route::get("/product/attrval/delete/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\AttrValue\ProductAttrValuesController::class,"delete"])->name("product.attrvalue.rm");
Route::post("/product/attrval/update/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\AttrValue\ProductAttrValuesController::class,"update"])->name("product.attrvalue.update");


//////////////////////////////////////// Product Pic Operations ////////////////////////////////////////

Route::get("/file-product/get-pic/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Pic\ProductPicController::class, "getPicOfProduct"])->name("product.pic.download");
Route::get("/file-product/remove-pic/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Pic\ProductPicController::class, "removePicFromProduct"])->name("product.pic.rm");
Route::post("/file-product/upload-pic/{product_id}",[\App\Http\Controllers\Admin\Exchange\Product\Pic\ProductPicController::class, "uploadPicForProduct"])->name("product.pic.upload");




