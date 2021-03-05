<?php

namespace App\Observers;

use App\Models\Admin\Product;
use Illuminate\Support\Carbon;


class AdminProductObserver
{

    public function creating(Product $product)
    {
        $this->setAlias($product);
    }
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }

    public function setAlias(Product $product)
    {
        if (empty($product->alias)){
            $product->alias = \Str::slug($product->title);

            $check = Product::where('alias','=', $product->alias)->exists();

            if ($check){
                $product->alias = \Str::slug($product->title) . \Str::random(5);
            }
        }
    }

    public function saving(Product $product)
    {
        $this->setPublishedAt($product);
        //return false;
    }

    public function setPublishedAt(Product $product)
    {
        $needSetPublished = empty($product->updated_at) || !empty($product->updated_at);

        if ($needSetPublished){
            $product->updated_at = Carbon::now();
        }
    }


}
