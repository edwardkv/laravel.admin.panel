<?php

namespace App\Repositories\Admin;

use App\Models\Admin\AttributeGroup as Model;
use App\Repositories\CoreRepository;

class FilterGroupRepository extends CoreRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /** Get Info  by Id */
    public function getInfoProduct($id)
    {
        $product = $this->startConditions()
            ->find($id);
        return $product;
    }

    /** Get all Groups Filter */
    public function getAllGroupsFilter()
    {
        $attrs_group = \DB::table('attribute_groups')->get()->all();
        return $attrs_group;
    }

}
