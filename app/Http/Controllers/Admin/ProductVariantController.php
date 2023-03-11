<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductsVariants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository;

class ProductVariantController extends Controller
{
    protected $repository;
    protected $productsRepository;

    public function __construct(
        ProductsVariants $repository,
        ProductsRepository $productsRepository,
    ) {
        $this->repository = $repository;
        $this->productsRepository = $productsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsVariants = $this->repository->all();
        return view('admin.products_variants.index', compact('productsVariants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $product = $this->productsRepository->all();
        $products = $this->repository->find($id);
        return view('admin.products_variants.edit', compact('products', 'product'));
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
        //
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
        return redirect()->route('products_variants.index');
    }
}
