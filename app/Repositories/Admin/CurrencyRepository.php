<?php


namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Admin\Currency as Model;

class CurrencyRepository extends CoreRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    /** Get Info by Id */
    public function getInfoProduct($id)
    {
        $product = $this->startConditions()
            ->find($id);
        return $product;
    }

    /** All Currency */
    public function getAllCurrency()
    {
        $curr = $this->startConditions()::all();
        return $curr;
    }

    /** Switch Base Currency = 0  */
    public function switchBaseCurr()
    {
        $id =  $this->startConditions()->where('base',2)->pluck('id')->toArray();
        $id = $id[0];
        $new = $this->startConditions()->find($id);
        $new->base = '0';
        $new->save();

    }

    /** Delete Currency */
    public function deleteCurrency($id)
    {
        $delete = $this->startConditions()->where('id', $id)->forceDelete();
        return $delete;
    }

    public function getBaseCurrency()
    {
        $currency = \DB::table('currencies')
            ->where('base','=', '1')
            ->first();
        return $currency;
    }
}
