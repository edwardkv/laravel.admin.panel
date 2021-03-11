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

}
