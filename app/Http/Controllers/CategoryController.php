<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\MasterRepository;
use App\Models\Category;
use DB;

class CategoryController extends Controller
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
        $data = $this->masterRepository->getActiveCategories();

        return view('category.index', compact('data'));
    }

    public function create()
    {
        $title = 'Add Category';
        $action = 'create';

        return view('category.create', compact('title', 'action'));
    }

    public function store(Request $request)
    {
        if ($image = $request->file('image')){
            $imageName = time() . $image->getClientOriginalExtension();
            $image->move('images/uploads', $imageName);
        }
        $data = [
            'name' => $request->name,
            'desc' => $request->desc,
            'image' => $imageName
        ];

        DB::beginTransaction();

        try {
            $this->masterRepository->storeCategory($data);

            DB::commit();
            \Session::flash('message', "Category Created Successfully");
            return redirect()->to("/category/index");
        } catch (\Exception $e) {
            DB::rollback();

            \Session::flash('message', "Something Went Wrong");
            return redirect()->to("/category/index");
        }
    }

    public function edit($id)
    {
        $title = 'Edit Category';
        $action = 'update';
        $data = $this->masterRepository->getCategory($id);
        $status = Category::status();
        $url = \URL::to('/') . "/images/uploads/{$data->image}";

        return view('category.create', compact('data', 'status', 'title', 'action', 'url'));
    }

    public function update(Request $request)
    {
        $data = $this->masterRepository->getCategory($request->id_category);
        
        if ($image = $request->file('image')){
            $imageName = time() . $image->getClientOriginalExtension();
            $image->move('images/uploads', $imageName);
        }
        $data = [
            'name' => $request->name,
            'desc' => $request->desc,
            'image' => $imageName  ?? $data->image,
            'status' => $request->status
        ];

        DB::beginTransaction();

        try {
            $this->masterRepository->updateCategory($data, $request->id_category);

            DB::commit();
            \Session::flash('message', "Category Updated Successfully");
            return redirect()->to("/category/index");
        } catch (\Exception $e) {
            DB::rollback();

            \Session::flash('message', "Something Went Wrong");
            return redirect()->to("/category/index");
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $this->masterRepository->deleteCategory($id);

            DB::commit();
            \Session::flash('message', "Category Deleted Successfully");
            return redirect()->to("/category/index");
        } catch (\Exception $e) {
            DB::rollback();

            \Session::flash('message', "Something Went Wrong");
            return redirect()->to("/category/index");
        }
    }
}
