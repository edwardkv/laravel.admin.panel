<?php


namespace App\Repositories\Admin;


use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Model;

class MainRepository extends  CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public static function getCountOrders()
    {
        $count = \DB::table('orders')
            ->where('status','0')
            ->get()
            ->count();
        return $count;
    }

    public static function getCountUsers()
    {
        $users = \DB::table('users')
            ->get()
            ->count();
        return $users;
    }

    public  static function getCountProducts()
    {
        $prod = \DB::table('products')
            ->get()
            ->count();
        return $prod;
    }

    public static function getCountCategories()
    {
        $cat = \DB::table('categories')
            ->get()
            ->count();
        return $cat;
    }
}
