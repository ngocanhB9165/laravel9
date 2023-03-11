<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository;
use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsVariantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $repository;
    protected $categoryRepository;
    protected $productVariantRepository;
    public function __construct(
        ProductsRepository $repository,
        CategoriesRepository $categoryRepository,
        ProductsVariantRepository $productVariantRepository
    ) {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->productVariantRepository = $productVariantRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->rootCategory()->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $dataProduct = $this->prepraDataProduct($data);
            $productId =  $this->repository->create($dataProduct);
            $dataProductVariants = $this->prepraDataProductVariants($data['product_variants'], $productId);
            $this->productVariantRepository->insert($dataProductVariants);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput();
        }

    }

    public function prepraDataProduct($data)
    {
        return [
            'categories_id' => $data['categories_id'],
            'name' => $data['name'],
            'code' => $data['code'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'collection' => $data['collection'],
            'made_in' => $data['made_in'],
            'material' => $data['material'],
        ];
    }

    public function prepraDataProductVariants($data, $productId)
    {
        $dataProductVariants = [];
        for ($i = 0; $i < count(reset($data)); $i++) {
            $productVariant = [
                'product_id' => $productId->id,
                'name' =>  $data['name'][$i],
                'code' =>  $data['code'][$i],
                'price' =>  $data['price'][$i],
                'quantity' =>  $data['quantity'][$i],
                'color' =>  $data['color'][$i],
                'size' =>  $data['size'][$i],
            ];
            array_push($dataProductVariants, $productVariant);
        }
        return $dataProductVariants;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->rootCategory()->get();
        $product = $this->repository->find($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->find($id)->update($request->all());
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->find($id)->delete();
        return redirect()->route('products.index');
    }
}
