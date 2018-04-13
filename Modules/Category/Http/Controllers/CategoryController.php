<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Modules\Category\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $category_repository;

    public function __construct(CategoryRepositoryInterface $category_repository)
    {
        $this->category_repository = $category_repository;
    }

    public function index()
    {
        $categories = $this->category_repository->all();
        return view('category::index', compact('categories'));
    }
    public function create()
    {
        return view('category::create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            $data['user_id'] = $user->id;
            $this->category_repository->save($data);
            DB::commit();
            $status = 'success';
            $message = 'Category has been created.';
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->route('category.index')->with($status, $message);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = $this->category_repository->find($id);
        return view('category::edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $user = $this->category_repository->update($id, $data);
            DB::commit();
            $status = 'success';
            $message = 'Category has been updated.';
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->route('category.index')->with($status, $message);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->category_repository->delete($id);
            $status = 'success';
            $message = 'Category has been deleted.';
            DB::commit();
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->route('category.index')->with($status, $message);
    }
}
