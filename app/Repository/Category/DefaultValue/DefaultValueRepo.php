<?php

namespace App\Repository\Category\DefaultValue;


use App\Models\Category\DefaultValue\DefaultValue;
use Illuminate\Support\Facades\DB;

class DefaultValueRepo
{

    //////////////////////////////// CRUD

    public function showDefaultValuesPageInfo($attr_id)
    {
        $pageInfo = [
            "count"=>0,
            "attr"=>DB::table("attributes")->where("id",$attr_id)->first(),
            "values"=>[]
        ];

        if (DB::table("default_values")->where("attribute_id",$attr_id)->count() > 0)
        {
            $pageInfo["count"]=DB::table("default_values")->where("attribute_id",$attr_id)->count();
            $pageInfo["values"] = DB::table("default_values")->where("attribute_id",$attr_id)->get();
        }
        return $pageInfo;
    }

    public function insertValue($value, $attr_id)
    {
        if (!$this->checkExistsValueByTitle(null,$value,$attr_id))
        {
            $default_Value = new DefaultValue();
            $default_Value->value=$value;
            $default_Value->attribute_id=$attr_id;
            return ($default_Value->save()) ?
                ["status" => "success", "result" => $default_Value] :
                ["status" => "failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectValueById($id)
    {
        if ($this->checkExistsValueById($id))
            return DefaultValue::withTrashed()->where("id", $id)->first();
        return "notFound";
    }

    public function selectAllValues($attr_id)
    {
        return $this->showDefaultValuesPageInfo($attr_id);
    }


    public function deleteValue($id)
    {
        if ($this->checkExistsValueById($id))
            return (DefaultValue::where("id", $id)->delete()) ? "success" : "failed";
        return "notfound";
    }

    public function updateValue($id, $value, $attr_id)
    {
        if ($this->checkExistsValueById($id))
        {
            if (!$this->checkExistsValueByTitle($id,$value,$attr_id))
            {
                $default_Value = $this->selectValueById($id);
                if ($value != null) $default_Value->title = $value;
                if ($attr_id != null) $default_Value->attr_id = $attr_id;

                return ($default_Value->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notfound";
    }



    //////////////////////////////// Operation

    public function checkExistsValueById($id)
    {
        return DB::table("default_values")->where("id", $id)->exists();
    }

    public function checkExistsValueByTitle($id,$value=null,$attr_id)
    {
        if ($value==null || $attr_id==null) return true;

        $defaultValue=DB::table("default_values")->where("attribute_id",$attr_id);
        if ($id!=null) $defaultValue->where("id","<>",$id);
        $defaultValue->where("value",$value);
        return $defaultValue->exists();
    }

    //////////////////////////////// Relation





}
