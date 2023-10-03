<?php

use Illuminate\Support\Facades\Route;


/////////////////////////////////////////////////////////experting/////////////////////////////////////////////////////////

Route::get("/experting/user/page/{user_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingController::class, "showPageInfoForUser"]);//1
Route::get("/experting/karshenas/page/{user_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingController::class, "showPageInfoForKarshenas"]);//2
Route::post("/experting/insert", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingController::class, "insert"]);//3
Route::get("/experting/get/{exp_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingController::class, "selectById"]);//4
Route::get("/experting/getall/data", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingController::class, "getAll"]);//5
Route::get("/experting/del/{exp_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingController::class, "delete"]);//6
Route::get("/experting/restore/{exp_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingController::class, "restore"]);//7
Route::post("/experting/update/{exp_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingController::class, "update"]);//8


/////////////////////////////////////////////////////////experting-answer/////////////////////////////////////////////////////////

Route::get("/exp-answer/page/{exp_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerController::class, "showPageInfo"]);//1
Route::post("/exp-answer/insert", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerController::class, "insert"]);//2
Route::get("/exp-answer/get/{exp_a_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerController::class, "selectById"]);//3
Route::get("/exp-answer/getall/data", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerController::class, "getAll"]);//4
Route::get("/exp-answer/del/{exp_a_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerController::class, "delete"]);//5
Route::get("/exp-answer/restore/{exp_a_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerController::class, "restore"]);//6
Route::post("/exp-answer/update/{exp_a_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerController::class, "update"]);//7


/////////////////////////////////////////////////////////experting-question/////////////////////////////////////////////////////////

Route::get("/exp-question/page/{exp_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingQuestionController::class, "showPageInfo"]);//1
Route::post("/exp-question/insert", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingQuestionController::class, "insert"]);//2
Route::get("/exp-question/get/{exp_q_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingQuestionController::class, "selectById"]);//3
Route::get("/exp-question/getall/data", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingQuestionController::class, "getAll"]);//4
Route::get("/exp-question/del/{exp_q_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingQuestionController::class, "delete"]);//5
Route::get("/exp-question/restore/{exp_q_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingQuestionController::class, "restore"]);//6
Route::post("/exp-question/update/{exp_q_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingQuestionController::class, "update"]);//7


/////////////////////////////////////////////////////////experting-answer-File/////////////////////////////////////////////////////////

Route::post("/exp-answer/file/upload/{user_id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerFileController::class, "uploadFileForExpertingAnswerFile"]);//1
Route::get("/exp-answer/file/rm/{id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerFileController::class, "removeFileFromExpertingAnswerFile"]);//2
Route::get("/exp-answer/file/dl/{id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerFileController::class, "downloadFileOfExpertingAnswerFile"]);//3
Route::get("/exp-answer/file/dl/base64/{id}", [\App\Http\Controllers\Admin\Experting\Experting\ExpertingAnswerFileController::class, "downloadBase64FileOfExpertingAnswerFile"]);//4


/////////////////////////////////////////////////////////private-experting-answer/////////////////////////////////////////////////////////

Route::get("/private-answer/page/{private_q_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingAnswerController::class, "showPageInfo"]);//1
Route::post("/private-answer/insert", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingAnswerController::class, "insert"]);//2
Route::get("/private-answer/get/{private_a_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingAnswerController::class, "selectById"]);//3
Route::get("/private-answer/getall/data", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingAnswerController::class, "getAll"]);//4
Route::get("/private-answer/del/{private_a_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingAnswerController::class, "delete"]);//5
Route::get("/private-answer/restore/{private_a_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingAnswerController::class, "restore"]);//6
Route::post("/private-answer/update/{private_a_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingAnswerController::class, "update"]);//7


/////////////////////////////////////////////////////////private-experting-question/////////////////////////////////////////////////////////

Route::get("/private-question/page/{private_exp_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingQuestionController::class, "showPageInfo"]);//1
Route::post("/private-question/insert", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingQuestionController::class, "insert"]);//2
Route::get("/private-question/get/{private_q_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingQuestionController::class, "selectById"]);//3
Route::get("/private-question/getall/data", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingQuestionController::class, "getAll"]);//4
Route::get("/private-question/del/{private_q_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingQuestionController::class, "delete"]);//5
Route::get("/private-question/restore/{private_q_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingQuestionController::class, "restore"]);//6
Route::post("/private-question/update/{private_q_id}", [\App\Http\Controllers\Admin\Experting\PrivateExperting\PrivateExpertingQuestionController::class, "update"]);//7


/////////////////////////////////////////////////////////public-experting-answer/////////////////////////////////////////////////////////

Route::get("/public-answer/page/{public_q_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingAnswerController::class, "showPageInfo"]);//1
Route::post("/public-answer/insert", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingAnswerController::class, "insert"]);//2
Route::get("/public-answer/get/{public_a_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingAnswerController::class, "selectById"]);//3
Route::get("/public-answer/getall/data", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingAnswerController::class, "getAll"]);//4
Route::get("/public-answer/del/{public_a_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingAnswerController::class, "delete"]);//5
Route::get("/public-answer/restore/{public_a_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingAnswerController::class, "restore"]);//6
Route::post("/public-answer/update/{public_a_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingAnswerController::class, "update"]);//7


/////////////////////////////////////////////////////////public-experting-question/////////////////////////////////////////////////////////

Route::get("/public-question/page/{public_exp_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingQuestionController::class, "showPageInfo"]);//1
Route::post("/public-question/insert", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingQuestionController::class, "insert"]);//2
Route::get("/public-question/get/{public_q_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingQuestionController::class, "selectById"]);//3
Route::get("/public-question/getall/data", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingQuestionController::class, "getAll"]);//4
Route::get("/public-question/del/{public_q_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingQuestionController::class, "delete"]);//5
Route::get("/public-question/restore/{public_q_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingQuestionController::class, "restore"]);//6
Route::post("/public-question/update/{public_q_id}", [\App\Http\Controllers\Admin\Experting\PublicExperting\PublicExpertingQuestionController::class, "update"]);//7


/////////////////////////////////////////////////////////experting-type/////////////////////////////////////////////////////////

Route::post("/exp-type/insert", [\App\Http\Controllers\Admin\Experting\Type\ExpertingTypeController::class, "insert"]);//1
Route::get("/exp-type/get/{public_q_id}", [\App\Http\Controllers\Admin\Experting\Type\ExpertingTypeController::class, "selectById"]);//2
Route::get("/exp-type/getall/data", [\App\Http\Controllers\Admin\Experting\Type\ExpertingTypeController::class, "getAll"]);//3
Route::get("/exp-type/del/{public_q_id}", [\App\Http\Controllers\Admin\Experting\Type\ExpertingTypeController::class, "delete"]);//4
Route::get("/exp-type/restore/{public_q_id}", [\App\Http\Controllers\Admin\Experting\Type\ExpertingTypeController::class, "restore"]);//5
Route::post("/exp-type/update/{public_q_id}", [\App\Http\Controllers\Admin\Experting\Type\ExpertingTypeController::class, "update"]);//6

