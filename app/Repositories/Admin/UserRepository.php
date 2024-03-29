<?php


namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Admin\User as Model;


class UserRepository extends CoreRepository
{

    public function __construct()
    {
        parent::__construct();

    }

    protected function getModelClass()
    {
        return Model::class;
    }

    /** All Users */
    public function getAllUsers($perpage)
    {
        $users = $this->startConditions()
            ->join('user_roles','user_roles.user_id', '=', 'users.id')
            ->join('roles','user_roles.role_id', '=', 'roles.id')
            ->select('users.id','users.name','users.email','roles.name as role')
            ->orderBy('users.id')
            ->toBase()
            ->paginate($perpage);
        return $users;
    }

    /** One Order by User */
    public function getUserOrders($user_id, $perpage)
    {
        $orders = $this->startConditions()::withTrashed()
            ->join('orders','orders.user_id','=','users.id')
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->select('orders.id','orders.user_id','orders.status','orders.created_at', 'orders.updated_at','orders.currency', \DB::raw('ROUND(SUM(order_products.price), 2) AS sum'))
            ->where('user_id',$user_id)
            ->groupBy('orders.id')
            ->orderBy('orders.status')
            ->orderBy('orders.id')
            ->paginate($perpage);

        return $orders;
    }

    /** User Role */
    public function getUserRole($id)
    {
        $role = $this->startConditions()
            ->find($id)
            ->roles()
            ->get();

        foreach ($role as $r){
            $role = $r->name;
        }

        return $role;
    }

    /** Count Orders*/
    public function getCountOrders($id,$perpage)
    {
        $count = \DB::table('orders')
            ->where('user_id', $id)
            ->limit($perpage)
            ->get();
        return $count;
    }

    /** CountOrders for Pagination part */
    public function getCountOrdersPag($id)
    {
        $count = \DB::table('orders')
            ->where('user_id', $id)
            ->count();
        return $count;
    }


}
