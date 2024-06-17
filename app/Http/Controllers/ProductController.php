<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\MasterRepository;
use App\Models\Product;
Use DB;

class ProductController extends Controller
{
    protected $masterRepository;

    public function __construct(
        MasterRepository $masterRepository
    ) {
        $this->masterRepository = $masterRepository;
    }

    /**
     * List Category
     */
    public function index(Request $request)
    {
        $data = $this->masterRepository->getActiveProducts(50);

        return view('product.index', compact('data'));
    }

    public function create()
    {
        $title = 'Add Product';
        $action = 'create';
        $categories = $this->masterRepository->getCategoriesNames();

        return view('product.create', compact('title', 'action', 'categories'));
    }

    public function store(Request $request)
    {
        if ($image = $request->file('image')){
            $imageName = time() . $image->getClientOriginalExtension();
            $image->move('images/uploads', $imageName);
        }
        $data = [
            'id_category' => $request->id_category,
            'name' => $request->name,
            'desc' => $request->desc,
            'brand' => $request->brand,
            'price' => $request->price,
            'image' => $imageName,
            'qty' => $request->qty,
        ];

        DB::beginTransaction();

        try {
            $this->masterRepository->storeProduct($data);

            DB::commit();
            \Session::flash('message', "Product Created Successfully");
            return redirect()->to("/product/index");
        } catch (\Exception $e) {
            DB::rollback();

            \Session::flash('message', "Something Went Wrong");
            return redirect()->to("/product/index");
        }
    }

    public function edit($id)
    {
        $title = 'Edit Product';
        $action = 'update';
        $data = $this->masterRepository->getProduct($id);
        $categories = $this->masterRepository->getCategoriesNames();
        $status = Product::status();
        $url = \URL::to('/') . "/images/uploads/{$data->image}";

        return view('product.create', compact('data', 'status', 'title', 'action', 'categories', 'url'));
    }

    public function update(Request $request)
    {
        $data = $this->masterRepository->getProduct($request->id_product);
        
        if ($image = $request->file('image')){
            $imageName = time() . $image->getClientOriginalExtension();
            $image->move('images/uploads', $imageName);
        }
        $data = [
            'id_category' => $request->id_category,
            'name' => $request->name,
            'desc' => $request->desc,
            'brand' => $request->brand,
            'price' => $request->price,
            'image' => $imageName  ?? $data->image,
            'status' => $request->status,
            'qty' => $request->qty,
        ];

        DB::beginTransaction();

        try {
            $this->masterRepository->updateProduct($data, $request->id_product);

            DB::commit();
            \Session::flash('message', "Product Updated Successfully");
            return redirect()->to("/product/index");
        } catch (\Exception $e) {
            DB::rollback();

            \Session::flash('message', "Something Went Wrong");
            return redirect()->to("/product/index");
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $this->masterRepository->deleteProduct($id);

            DB::commit();
            \Session::flash('message', "Product Deleted Successfully");
            return redirect()->to("/product/index");
        } catch (\Exception $e) {
            DB::rollback();

            \Session::flash('message', "Something Went Wrong");
            return redirect()->to("/product/index");
        }
    }
}
