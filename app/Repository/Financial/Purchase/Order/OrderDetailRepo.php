<?php

namespace App\Repository\Financial\Purchase\Order;

use App\Models\Financial\Purchase\Order\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderDetailRepo
{
    //////////////////////////////// Page
    public function showOrderDetailPageInfo($user_id)
    {
        $pageInfo = [
            "count"=>0,
            "ordeDetails"=>null,
        ];
        if (OrderDetail::where("register_user_id", "=", $user_id)->exists())
        {
            $orderDetails = OrderDetail::with(["product", "order"])->where("register_user_id", "=", $user_id)->get();
            $pageInfo["count"] = DB::table("favorites")->where("register_user_id", "=", $user_id)->count();
            foreach ($orderDetails as $orderDetail)
            {
                $pageInfo["ordeDetails"][] = [
                    "orderDetail" => $orderDetail
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertOrderDetail($title,
                                   $desc, $product_id, $order_id)
    {
        $orderDetail = new OrderDetail();
        $orderDetail->title=$title;
        $orderDetail->desc=$desc;
        $orderDetail->product_id=$product_id;
        $orderDetail->order_id=$order_id;

        return ($orderDetail->save())? ["status"=>"success","result"=>$orderDetail]:["status"=>"failed"];
    }

    public function selectOrderDetailById($id)
    {
        if ($this->checkExistsOrderDetailById($id))
            return OrderDetail::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllOrderDetails()
    {
        return (OrderDetail::withTrashed()->get()->count()>0) ? OrderDetail::withTrashed()->get() : "notFound";
    }

    public function updateOrderDetail($id, $title, $desc, $product_id, $order_id)
    {
        if ($this->checkExistsOrderDetailById($id))
        {
            $orderDetail = $this->selectOrderDetailById($id);
            if ($title != null) $orderDetail->title=$title;
            if ($desc != null) $orderDetail->desc=$desc;
            if ($product_id != null) $orderDetail->product_id=$product_id;
            if ($order_id != null) $orderDetail->order_id=$order_id;
            return ($orderDetail->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteOrderDetail($id)
    {
        if ($this->checkExistsOrderDetailById($id))
            return OrderDetail::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsOrderDetailById($id)
    {
        return DB::table("orderdetails")->where("id", "=" , $id)->exists();
    }

    public function checkExistsOrderDetailByTitle($orderDetail_id, $title = null)
    {
        if ($title==null) return true;
        $orderDetail=DB::table("orderdetails");
        if ($title!=null) $orderDetail->where("title",$title);
        if ($orderDetail_id!=null) $orderDetail->where("id","<>",$orderDetail_id);
        return $orderDetail->exists();
    }
    //////////////////////////////// Relation

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
