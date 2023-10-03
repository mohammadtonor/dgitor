<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\Utility\FileManagerRepo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//use App\Services\Sms\Sms;
class UserRepo
{
    public $userImagePath = "/image/User/";

    /////////////////////// Page
    public function showUserPageInfo($user_id)
    {
        if ($this->checkExistsUserById($user_id)){
            $user = $this->selectUserById($user_id);
            $pageInfo = [
                "id" => $user->id,
                "name" => $user->name,
                "birthday" => $user->birthday,
                "mobile" => $user->mobile,
                "ncode" => $user->ncode,
                "gender" => $user->gender,
                "personnel_code" => $user->personnel_code,
                "pic_path" => $user->pic_path,
            ];
            return $pageInfo;
        }
        return "user-notFound";
    }



    /////////////////////// CRUD

    // وارد کردن کاربر
    public function insertUser($name, $family, $ncode, $gender, $birthday, $username, $password,
                               $email, $pic_file, $desc, $email_verified_at, $mobile, $mobile_verified,
                               $mobile_verification_code, $mobile_verification_time,
                               $lang, $is_geniue, $personnel_code, $is_customer,
                               $ostan_id, $country_id, $register_customer_id,$city_id,
                               $title, $postal_code, $address)
    {
        $user = new User();
        $user->name = $name;
        $user->family = $family;
        $user->ncode = $ncode;
        $user->gender = ($gender=="زن")  ? "female" : "male";
        $user->birthday = $birthday;
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->description = $desc;
        $user->email_verified_at = $email_verified_at;
        $user->mobile = $mobile;
        $user->mobile_verified = $mobile_verified;
        $user->mobile_verification_code = $mobile_verification_code;
        $user->mobile_verification_time = $mobile_verification_time;
        $user->default_lang = $lang;
        $user->is_geniue = ($is_geniue=="حقوقی") ? "Permission" : "0";
        $user->personnel_code = $personnel_code;
        $user->is_customer = $is_customer;
        $user->city_id = $city_id;
        $user->ostan_id = $ostan_id;
        $user->country_id = $country_id;
        $user->register_customer_id = $register_customer_id;
        if ($user->save())
        {
            DB::table("user_addresses")
                ->insert(["title" => $title,
                        "postal_code" => $postal_code,
                        "address" => $address,
                        "city_id" => $city_id,
                        "user_id" => $user->id]);
            if (!is_null($pic_file))
            {
                $user_id = $user->id;
                $uploadResult = $this->uploadProfileImageForUser($user_id,$pic_file)["status"];
                if($uploadResult != "success")
                    return "upload-failed";
                return ["status"=>"success","result"=>$user];
            }
            if ($this->sendWelcome($mobile, $name) && $this->sendUserProfile($mobile, $name))
                return $user->addresses()->create(["title" => $title, "postal_code" => $postal_code, "address" => $address,
                    "city_id" => $city_id, "user_id" => $user->id]) ?
                    ["status" => "success", "result" => $user] : ["status" => "failed"];
            return "sms-notSend";
        }
        if ($user->is_customer == 1)
        {
            try
            {
                $user->roles()->attach(1);
                return ["status" => "success", "result" => $user];
            }
            catch (\Exception $exception)
            {
                return ["status" => "attach-failed"];
            }
        }
    }

    // انتخاب کاربر با ایدی
    public function selectUserById($id)
    {
        return ($this->checkExistsUserById($id)) ?
            (User::with("city", "class", "ostan", "customer_status", "customer_priority")->where("id",$id)->first()) : "user-notFound";
    }

    // انتخاب تمامی کاربران
    public function selectAllUsers()
    {
        return (User::all()->count()>0) ? User::all() : "user-notFound";
    }

    // به روزرسانی کاربر
    public function updateUserById($id, $name, $family, $ncode, $gender, $birthday, $username, $password,
                                        $email, $desc, $emailVerify, $mobile, $mobile_verified,
                                        $mobile_verification_code, $mobile_verification_time,
                                        $city_id, $lang, $is_geniue, $personnel_code,
                                        $ostan_id, $country_id, $register_customer_id, $pic_file)
    {
        if ($this->checkExistsUserById($id))
        {
            $user = $this->selectUserById($id);
            if ($name != null) $user -> name = $name;
            if ($family != null) $user -> family = $family;
            if ($ncode != null) $user -> ncode = $ncode;
            if ($gender != null) $user -> gender = ($gender=="زن")  ? "female" : "male";
            if ($birthday != null) $user -> birthday = $birthday;
            if ($username != null) $user -> username = $username;
            if ($password != null) $user -> password = $password;
            if ($email != null) $user -> email = $email;
            if ($desc != null) $user -> description = $desc;
            if ($emailVerify != null) $user -> email_verified_at = $emailVerify;
            if ($mobile != null) $user -> mobile = $mobile;
            if ($mobile_verified != null) $user -> mobile_verified = $mobile_verified;
            if ($mobile_verification_code != null) $user -> mobile_verification_code = $mobile_verification_code;
            if ($mobile_verification_time != null) $user -> mobile_verification_time = $mobile_verification_time;
            if ($city_id != null) $user -> city_id = $city_id;
            if ($lang != null) $user -> default_lang = $lang;
            if ($is_geniue != null) $user -> is_geniue = ($is_geniue=="حقوقی") ? "Permission" : "0";
            if ($personnel_code != null) $user -> personnel_code = $personnel_code;
            if ($ostan_id != null) $user -> ostan_id = $ostan_id;
            if ($country_id != null) $user -> country_id = $country_id;
            if ($register_customer_id != null) $user -> register_customer_id = $register_customer_id;
            if ($user->save())
            {
                if (!is_null($pic_file))
                {
                    $user_id= $user->id;
                    $uploadResult = $this->uploadProfileImageForUser($user_id,$pic_file)["status"];
                    if($uploadResult != "success")
                        return "upload-failed";
                    return ["status"=>"success","result"=>$user];
                }
                return "failed";

            }

        }
        return "user-notFound";
    }

    // حذف کاربر
//    public function deleteUserById($id)
//    {
//        if ($this->checkExistsUserById($id))
//            return (User::where("id",$id)->delete()) ? "success": "failed";
//        return "user-notFound";
//    }

    public function deleteUserById($id)
    {
        if ($this->checkExistsUserById($id))
        {
            if (DB::table("role_user")->where("user_id", "=", $id)->exists())
            {
                $user = User::where("id", $id)->first();
                $role_users = DB::table("role_user")->where("user_id", "=", $id)->get();
                foreach ($role_users as $role_user)
                {
                    try
                    {
                        $user->roles()->detach($role_user->role_id);
                    }
                    catch (\Exception $exception)
                    {
                        return "detach-failed";
                    }
                }
                return (User::where("id",$id)->delete()) ? "success": "failed";

            }
        }
        return "user-notFound";
    }

    /////////////////////// Operation

    // بررسی موجود بودن کاربر با ایدی
    public function checkExistsUserById($id)
    {
        return (User::where("id",$id)->exists()) ? true : false;
    }

    public function checkExistsUserByName($name=null)
    {
        $user = DB::table("users");
        if ($name != null) $user = $user->where("name", $name);
        return $user->exists();
    }

    public function changeUserPassword($user_id, $newPassword)
    {
        if ($this->checkExistsUserById($user_id))
        {
            $user = $this->selectUserById($user_id);
            if ($newPassword != null) $user -> password = $newPassword;
            return ($user->save()) ? "success" : "failed";
        }
        return "user-notFound";
    }

    public function changeMobileVerifiedStatus($user_id)
    {
        if ($this->checkExistsUserById($user_id))
        {
            $user = $this->selectUserById($user_id);
            if ($user->mobile_verified=='0') $user->mobile_verified='Permission';else $user->mobile_verified='0';
            return $user->save();
        }
        return "user-notFound";
    }

    public function changeGeniueStatus($user_id)
    {
        if ($this->checkExistsUserById($user_id))
        {
            $user = $this->selectUserById($user_id);
            if ($user->mobile_verified=='0') $user->mobile_verified='Permission';else $user->mobile_verified='0';
            return $user->save();
        }
        return "user-notFound";
    }
    /////////////////////// Relation

    public function getToDoTasksOfUser($user_id)
    {
        if ($this->checkExistsUserById($user_id))
        {
            return ($this->selectUserById($user_id)->todo_tasks) ?
                $this->selectUserById($user_id)->todo_tasks : "task-notFound";
        }
        return "user-notFound";
    }

    public function getReferredTasksOfUser($user_id)
    {
        if ($this->checkExistsUserById($user_id))
        {
            return ($this->selectUserById($user_id)->referred_tasks) ?
                $this->selectUserById($user_id)->referred_tasks : "task-notFound";
        }
        return "user-notFound";
    }

    public function sendWelcome($mobile, $name)
    {
        return "success";
    }

    public function sendUserProfile($mobile, $name)
    {
        return "success";
    }
    //////////////file operation

    public function removeProfileImageForUser($id)
    {
        $file_path = DB::table("users")->where("id",$id)->first()->pic_file;
        $removeFile = new FileManagerRepo();
        if ($file_path != null)
        {
            if ($removeFile->removeFileFromStorage($file_path) == "success")
            {
                if (DB::table("users")->where("id",$id)->select("pic_file")->first() != null)
                {
                    if (DB::table("users")->where("id",$id)->update(["pic_file" => null]) == 1)
                        return 'remove-success';
                    return "path-delete-failed";
                }
                return "path-null";
            }
            return 'remove-failed';
        }
        return "path-null";

    }

    public function uploadProfileImageForUser($user_id,$doc_file)
    {
        if ($this->checkExistsUserById($user_id))
        {
            $user = User::where("id",$user_id)->first();

            $upload_file = new FileManagerRepo();
            if ($doc_file)
            {
                $result = $upload_file->insertFile($doc_file,$this->userImagePath.$user_id);
//                dd($result);
                if ($result["status"] == "ok")
                {
                    $user -> pic_file = $result["path"]."/".$result["filename"];
                    if ($user->save())
                    {
                        return [
                            "status" => "success",
                            "pic_path" => $result["path"]."/".$result["filename"]
                        ];
                    }
                }
                return ["status" => "upload-failed", "pic_path" => null];
            }
            return ["status" => "image-notExists", "pic_path" => null];
        }
        return ["status" => "user-notFound", "pic_path" => null];


    }

    public function getProfileImageOfUser($id)
    {
        if (DB::table("users")->where("id",$id)->exists())
        {
            $file_path_array = DB::table("users")->where("id", $id)->first();
            $path = $file_path_array->path;
            $fileManager = new FileManagerRepo();
            if ($path != null)
                return $fileManager->download($path);
            return "file-notFound";
        }
        return "notFound";
    }

    public function hasPassword($password)
    {
        $hashed = Hash::make($password);
        return $hashed;
    }



}
