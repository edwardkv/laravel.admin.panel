<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CurrencyRepository;
use App\Repositories\Admin\ProductRepository;
use Illuminate\Http\Request;
use MetaTag;

class SearchController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->productRepository = app(ProductRepository::class);
        $this->currencyRepository = app(CurrencyRepository::class);
    }

    /** for show result **/
    public function index(Request $request)
    {
        $query = !empty(trim($request->search)) ? trim($request->search) : null;

        $products = $this->productRepository->getSearchProducts($query);

        $currency = $this->currencyRepository->getBaseCurrency();

        MetaTag::setTags(['title' => 'Результаты поиска']);
        return view('blog.admin.search.result',compact('query','products','currency'));
    }

    /** for ajax search **/
    public function search(Request $request)
    {
        $search = $request->get('term');

        $result = $this->productRepository->getSearchProductsTitle($search);

        return response()->json($result);
    }
}
