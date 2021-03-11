<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogGroupFilterAddRequest;
use App\Models\Admin\AttributeGroup;
use App\Models\Admin\AttributeValue;
use App\Repositories\Admin\FilterAttrsRepository;
use App\Repositories\Admin\FilterGroupRepository;
use Illuminate\Http\Request;
use MetaTag;

class FilterController extends AdminBaseController
{
    private $filterGroupRepository;
    private $filterAttrsRepository;

    public function __construct()
    {
        parent::__construct();
        $this->filterAttrsRepository = app(FilterAttrsRepository::class);
        $this->filterGroupRepository = app(FilterGroupRepository::class);
    }

    /** Show All Groups of Filter
     *  table->attribute_group
     */
    public function attributeGroup()
    {
        $attrs_group = $this->filterGroupRepository->getAllGroupsFilter();

        MetaTag::setTags(['title' => 'Группы фильтров']);
        return view('blog.admin.filter.attribute-group', compact('attrs_group'));
    }

    /** Add Group for Filter
     *  table->attribute_group
     * @param BlogGroupFilterAddRequest $request
     * @return array
     */
    public function groupAdd(BlogGroupFilterAddRequest $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            $group = (new AttributeGroup())->create($data);
            $group->save();

            if ($group) {
                return redirect('/admin/filter/group-add-group')
                    ->with(['success' => 'Добавлена новая группа']);
            } else {
                return back()
                    ->withErrors(['msg' => "Ошибка создания новой группы"])
                    ->withInput();
            }

        } else {
            if ($request->isMethod('get')) {
                MetaTag::setTags(['title' => 'Новая группа фильтров']);
                return view('blog.admin.filter.group-add-group');
            }
        }

    }


}
