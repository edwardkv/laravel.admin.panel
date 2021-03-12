<?php
namespace App\Repositories\Admin;

use App\Models\Admin\AttributeValue as Model;
use App\Repositories\CoreRepository;

class FilterAttrsRepository extends CoreRepository
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

    public function getCountFilterAttrsById($id)
    {
        $count = \DB::table('attribute_values')->where('attr_group_id', $id)->count();
        return $count;
    }

    /** Get All Attribute filter with name Group */
    public function getAllAttrsFilter()
    {
        $attrs = \DB::table('attribute_values')
            ->join('attribute_groups','attribute_groups.id', '=', 'attribute_values.attr_group_id')
            ->select('attribute_values.*', 'attribute_groups.title')
            ->paginate(10);
        return $attrs;
    }


}