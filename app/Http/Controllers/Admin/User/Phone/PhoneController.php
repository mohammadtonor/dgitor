<?php

namespace App\Http\Controllers\Admin\User\Phone;

use App\Http\Controllers\Controller;
use App\Repository\User\Phone\UserPhoneRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhoneController extends Controller
{
    private $userPhoneRepo;

    public function __construct(UserPhoneRepo $userPhoneRepo)
    {
        $this->userPhoneRepo=$userPhoneRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo($user_id)
    {
//        $user_id = Auth::id();
            $result = $this->userPhoneRepo->showUserPhonePageInfo($user_id);
//            return response()->json($result);
            return view("Pannel.Personnel.PersonnelPhoneNumber", compact("result"));
    }

    //////////////////////////////////////////crud

    public function insert(Request $request, $user_id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "phone" => 'required',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->userPhoneRepo->insertUserPhone(
                $request->title,
                $request->phone,
                $user_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->userPhoneRepo->selectUserPhoneById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllPhones($user_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json($this->userPhoneRepo->selectAllUserPhone($user_id));
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->userPhoneRepo->deleteUserPhone($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->userPhoneRepo->restoreUserPhone($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'nullable',
                "phone" => 'nullable',
                "user_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->userPhoneRepo->updateUserPhone($id,
                $request->title,
                $request->phone,
                $request->user_id,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
