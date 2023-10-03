<?php

namespace App\Http\Controllers\Admin\User\Address;

use App\Http\Controllers\Controller;
use App\Repository\User\Address\UserAddressRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAddressController extends Controller
{
    private $userAddressRepo;

    public function __construct(UserAddressRepo $userAddressRepo)
    {
        $this->userAddressRepo=$userAddressRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo($user_id)
    {
//        $user_id = Auth::id();
            $result = $this->userAddressRepo->showUserAddressPageInfo($user_id);
//            return response()->json($result);
//        dd($result);
            return view("Pannel.ManageCustomer.CustomerAddr", compact("result"));
    }

    //////////////////////////////////////////crud

    public function insert(Request $request, $user_id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'nullable',
                "postal_code" => 'nullable',
                "address" => 'nullable',
                "city_id" => "required"
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->userAddressRepo->insertUserAddress(
                $request->title,
                $request->postal_code,
                $request->address,
                $request->city_id,
                $user_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->userAddressRepo->selectUserAddressById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllAddress($user_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json($this->userAddressRepo->selectAllUserAddress($user_id));
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->userAddressRepo->deleteUserAddress($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->userAddressRepo->restoreUserAddress($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'nullable',
                "postal_code" => 'nullable',
                "address" => 'nullable',
                "city_id" => 'nullable',
                "user_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->userAddressRepo->updateUserAddress($id,
                $request->title,
                $request->postal_code,
                $request->address,
                $request->city_id,
                $request->user_id
            )]);
        }
        return  response()->json(["status" => "refused"]);
    }

    //////////////////////////////////////////relation


}
