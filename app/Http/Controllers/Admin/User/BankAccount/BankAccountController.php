<?php

namespace App\Http\Controllers\Admin\User\BankAccount;

use App\Http\Controllers\Controller;
use App\Repository\User\BankAccount\BankAccountRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankAccountController extends Controller
{
    private $bankAccountRepo;

    public function __construct(BankAccountRepo $bankAccountRepo)
    {
        $this->bankAccountRepo=$bankAccountRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo($user_id)
    {
//        $user_id = Auth::id();
            $result = $this->bankAccountRepo->showUserBankAccountPageInfo($user_id);
//            return response()->json($result);
            return view("Pannel.ManageCustomer.CustomerBankInfo", compact("result"));
    }

    //////////////////////////////////////////crud

    public function insert(Request $request, $user_id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "bank" => 'nullable',
                "title" => 'nullable',
                "card_number" => 'nullable',
                "sheba" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->bankAccountRepo->insertUserBankAccount(
                $request->bank,
                $request->title,
                $request->card_number,
                $request->sheba,
                $user_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->bankAccountRepo->selectUserBankAccountById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllBankAccount($user_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json($this->bankAccountRepo->selectAllUserBankAccount($user_id));
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->bankAccountRepo->deleteUserBankAccount($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->bankAccountRepo->restoreUserBankAccount($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "bank" => 'nullable',
                "title" => 'nullable',
                "card_number" => 'nullable',
                "sheba" => 'nullable',
                "user_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->bankAccountRepo->updateUserBankAccount($id,
                $request->bank,
                $request->title,
                $request->card_number,
                $request->sheba,
                $request->user_id,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
