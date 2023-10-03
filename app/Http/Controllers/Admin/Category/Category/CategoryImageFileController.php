<?php

namespace App\Http\Controllers\Admin\Category\Category;

use App\Http\Controllers\Controller;
use App\Repository\Category\Category\CategoryImageFileRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryImageFileController extends Controller
{
    private $categoryImageRepo;


    public function __construct(CategoryImageFileRepo $categoryImageRepo)
    {
        $this->categoryImageRepo=$categoryImageRepo;
    }




    //////////////////////////////////////////////crud


    public function removeFileFromCategory($id)
    {
        if (request()->hasHeader("accept") && request()->header("accept")=="application/json" && request()->ajax())
        {
            return response()->json(["status"=>$this->categoryImageRepo->removeFileFromCategory($id)]);
        }
        return response()->json(["status"=>"refused"]);
    }

    public function uploadFileForCategory($id,Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept")=="application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "pic_file" => 'required|image|size:1024||dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
            ]);

            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return  response()->json(["status" => $this->categoryImageRepo->uploadFileForCategory($id,
                $request->pic_file)]);

        }
        return response()->json(["status"=>"refused"]);
    }

    public function downloadPicOfCategory($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept")=="application/json" && \request()->ajax())
        {
            return response()->json(["status"=>$this->categoryImageRepo->downloadPicOfCategory($id)]);
        }
        return response()->json(["status"=>"refused"]);
    }

    //////////////////////////////////////////////operation


    //////////////////////////////////////////////relation


}
