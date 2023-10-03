<?php

namespace App\Repository\Financial\TransType;

use App\Models\Financial\TransType\TransType;
use Illuminate\Support\Facades\DB;

class TransTypeRepo
{

    //////////////////////////////////////////page

    public function shoeTransTypePageInfo()
    {
        return [
            "count"=>TransType::all()->count(),
            "types"=>TransType::all()
        ];
    }

    //////////////////////////////////////////crud

    public function insert($title,$desc)
    {
        if (!$this->checkExistsTransTypeByTitle($title))
        {
            $transType=new TransType();
            $transType->title=$title;
            $transType->description=$desc;
            return $transType->save() ? ["status"=>"success" , "result"=>$transType] : ["status"=>"failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectTransTypeById($id)
    {
        if ($this->checkExistsTransTypeById($id))
        {
            return TransType::where("id",$id)->first();
        }
        return "notFound";
    }

    public function getAllTransType()
    {
        return (TransType::all()->count()>0) ?
            TransType::all() : "notFound";
    }

    public function delete($id)
    {
        if ($this->checkExistsTransTypeById($id))
        {
            return (TransType::where("id",$id)->delete()) ? "success" : "failed";
        }
        return "notFound";
    }

    public function update($id,$title,$desc)
    {
        if ($this->checkExistsTransTypeById($id))
        {
            if ($this->checkExistsTransTypeByTitle($title))
            {
                $transType=$this->selectTransTypeById($id);
                $transType=new TransType();
                $transType->title=$title;
                $transType->description=$desc;
                return $transType->save() ? "success" : "failed";
            }
            return  "duplicate";
        }
        return "notFound";
    }


    //////////////////////////////////////////repo

    public function checkExistsTransTypeById($id)
    {
        return DB::table("transtypes")->where("id", "=",$id)->exists();
    }


    public function checkExistsTransTypeByTitle($transType_id, $title = null)
    {
        if ($title==null) return true;
        $transType=DB::table("products");
        if ($title!=null) $transType->where("title",$title);
        if ($transType_id!=null) $transType->where("id","<>",$transType_id);
        return $transType->exists();



//        if ($title == null) return true;
//        $transtypes=DB::table("transtypes");
//        if ($title != null) $transtypes->where("title",$title);
//        return $transtypes->exists();


    }

    //////////////////////////////////////////relation





}
