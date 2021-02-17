<?php

namespace App\Observers;

use App\Models\Admin\Category;

class AdminCategoryObserver
{


    public function creating(Category $category)
    {
        $this->setAlias($category);
    }

    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Models\Admin\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Models\Admin\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        $this->setAlias($category);
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Models\Admin\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Models\Models\Admin\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Models\Admin\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }

    public function setAlias(Category $category)
    {
        if (empty($category->alias)){
            $category->alias = \Str::slug($category->title) . rand(10,999);
        }
    }

}
