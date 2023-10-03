<?php

namespace App\Repository\Category\Attribute;


use App\Models\Category\Attribute\Attribute;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\returnArgument;

class AttributeRepo
{

    //////////////////////////////// CRUD

    public function showAttributePageInfo($cat_id)
    {
        $pageInfo = [
            "count"=>0,
            "category"=>DB::table("categories")->where("id",$cat_id)->first(),
            "attrs"=>[]
        ];

        if (DB::table("attributes")->where("category_id",$cat_id)->count() > 0)
        {
            $pageInfo["count"]=DB::table("attributes")->where("category_id",$cat_id)->count();

            $attributes = Attribute::withTrashed()->with(["category"])->where("category_id",$cat_id)->get();

            foreach ($attributes as $attribute)
            {
                $pageInfo["attrs"][]=[
                    "attr"=>$attribute,
                    "value_count"=>DB::table("default_values")->where("attribute_id",$attribute->id)->count()
                ];
            }
        }
        return $pageInfo;
    }




    public function insertAttribute($title, $category_id)
    {
        if (!$this->checkExistsAttributeByTitle(null,$title,$category_id))
        {
            $attribute = new Attribute();
            $attribute->title = $title;
            $attribute->category_id = $category_id;
            if ($attribute->save())
            {
                $this->addAttrToChildCategory($title,$category_id);
                return ["status"=>"success","result"=>$attribute];
            }
            return ["status" => "failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectAttributeById($id)
    {
        if ($this->checkExistsAttributeById($id))
            return Attribute::withTrashed()->where("id", $id)->first();
        return "notFound";
    }


    public function selectAllAttrOfCat($cat_id)
    {
        return $this->showAttributePageInfo($cat_id);
    }


    public function deleteAttribute($id)
    {
        if ($this->checkExistsAttributeById($id))
        {
            if (DB::table("attributes")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return (Attribute::where("id", $id)->delete()) ? "success" : "failed";
            }
            return "deleted";
        }
        return "notfound";
    }

    public function restoreAttribute($id)
    {
        if ($this->checkExistsAttributeById($id))
        {
            if (DB::table("attributes")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return (Attribute::withTrashed()->find($id)->restore()) ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notfound";
    }



    public function updateAttribute($id, $title, $category_id)
    {
        if (!$this->checkExistsAttributeByTitle($id,$title,$category_id))
        {
            $attr=$this->selectAttributeById($id);
            if ($title!=null) $attr->title=$title;
            return ($attr->save()) ? "success" : "failed";
         }
        return "duplicate";
    }



    //////////////////////////////// Operation


    public function addAttrToChildCategory($title,$category_id)
    {
        if (DB::table("catgories")->where("id",$category_id)->has_child=='1')
        {
            $allChilds=DB::table("catgories")->where("category_id",$category_id)->get();
            foreach ($allChilds as $child)
            {
                $attribute = new Attribute();
                $attribute->title = $title;
                $attribute->category_id = $child->id;
                $attribute->save();
                $this->addAttrToChildCategory($title,$child->id);
            }
        }
        return ;
    }

    public function checkExistsAttributeById($id)
    {
        return DB::table("attributes")->where("id",  $id)->exists();
    }


    public function checkExistsAttributeByTitle($id, $title,$cat_id)
    {
        if ($title==null || $cat_id==null) return true;
        $attribute = DB::table("attributes")->where("category_id",$cat_id);
        if ($id!=null) $attribute->where("id","<>",$id);
        $attribute->where("title",$title);
        return $attribute->exists();
    }

    //////////////////////////////// Relation

    public function getCategoryOfAttribute($attr_id)
    {
        if ($this->checkExistsAttributeById($attr_id))
        {
            return ($this->selectAttributeById($attr_id)->category()->count()>0)?
                $this->selectAttributeById($attr_id)->category :"category_notFound";

        }
        return "attribute-notFound";
    }


    public function getAllValuesOfAttribute($attr_id)
    {
        if ($this->checkExistsAttributeById($attr_id))
        {
            return ($this->selectAttributeById($attr_id)->default_values()->count()>0)?
                $this->selectAttributeById($attr_id)->default_values :"values_notFound";

        }
        return "attribute-notFound";
    }


}
