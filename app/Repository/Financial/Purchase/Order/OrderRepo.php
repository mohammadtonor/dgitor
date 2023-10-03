<?php

namespace App\Repository\Financial\Purchase\Order;

use App\Models\Financial\Purchase\Order\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderRepo
{
    //////////////////////////////// Page
    public function showOrderPageInfo($user_id)
    {
        $pageInfo = [
            "count"=>0,
            "orders"=>null,
        ];
        if (Order::where("user_id", "=", $user_id)->exists())
        {
            $orders = Order::where("register_user_id", "=", $user_id)->get();
            $pageInfo["count"] = DB::table("orders")->where("user_id", "=", $user_id)->count();
            foreach ($orders as $order)
            {
                $pageInfo["orders"][] = [
                    "id" => $order->id,
                    "title" => $order->title,
                    "number" => $order->number,
                    "date" => $order->checkTimeIsNull($order->created_at),
                    "status" => $order->id,
                    "price" => $order->price,
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertOrder($title, $price, $number, $status, $user_id)
    {
        $order = new Order();
        $order->title=$title;
        $order->price=$price;
        $order->number=$number;
        $order->status=$status;
        $order->user_id=$user_id;

        return ($order->save())? ["status"=>"success","result"=>$order]:["status"=>"failed"];
    }

    public function selectOrderById($id)
    {
        if ($this->checkExistsOrderById($id))
            return Order::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllOrders()
    {
        return (Order::withTrashed()->get()->count()>0) ? Order::withTrashed()->get() : "notFound";
    }

    public function updateOrder($id, $title, $price, $number, $status, $user_id)
    {
        if ($this->checkExistsOrderById($id))
        {
            $order = $this->selectOrderById($id);
            if ($title != null) $order->title=$title;
            if ($price != null) $order->price=$price;
            if ($number != null) $order->number=$number;
            if ($status != null) $order->status=$status;
            if ($user_id != null) $order->user_id=$user_id;

            return ($order->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteOrder($id)
    {
        if ($this->checkExistsOrderById($id))
            return Order::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsOrderById($id)
    {
        return DB::table("orders")->where("id", "=" , $id)->exists();
    }

    public function checkExistsOrderByTitle($order_id, $title = null)
    {
        if ($title==null) return true;
        $order=DB::table("orders");
        if ($title!=null) $order->where("title",$title);
        if ($order_id!=null) $order->where("id","<>",$order_id);
        return $order->exists();
    }
    //////////////////////////////// Relation

    public function OrderChangeStatus($Order_id)
    {
        if ($this->checkExistsOrderById($Order_id))
        {
            $order = $this->selectOrderById($Order_id);
            if ($order->status=='0') $order->status='Permission';else $order->status='0';
            return $order->save();
        }
        return "notFound";
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
