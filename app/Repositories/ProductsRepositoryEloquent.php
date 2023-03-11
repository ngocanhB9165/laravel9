<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductsRepository;
use App\Models\Product;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductsRepositoryEloquent extends BaseRepositoryEloquent implements ProductsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}