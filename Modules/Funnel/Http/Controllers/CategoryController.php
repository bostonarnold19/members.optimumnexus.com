<?php

namespace Modules\Funnel\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Modules\Category\Interfaces\CategoryRepositoryInterface;
use Modules\Funnel\Interfaces\FunnelRepositoryInterface;

class CategoryController extends Controller
{
    protected $category_repository;
    protected $funnel_repository;

    public function __construct(CategoryRepositoryInterface $category_repository, FunnelRepositoryInterface $funnel_repository)
    {
        $this->category_repository = $category_repository;
        $this->funnel_repository = $funnel_repository;
    }

    public function index()
    {
        $funnels = $this->funnel_repository->where('user_id', auth()->user()->id)->get();
        $categories = $this->category_repository->where('type', 'funnel')->where('user_id', auth()->user()->id)->get();
        return view('category_bagel::index', compact('categories', 'funnels'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            $data['user_id'] = $user->id;
            $data['type'] = 'funnel';
            $this->category_repository->save($data);
            DB::commit();
            $status = 'success';
            $message = 'Category has been created.';
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->route('category-bagel.index')->with($status, $message);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $funnels = $this->funnel_repository->where('user_id', auth()->user()->id)->get();
        $category = $this->category_repository
            ->where('type', 'funnel')
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        return view('category_bagel::edit', compact('category', 'funnels'));
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
        return redirect()->route('category-bagel.index')->with($status, $message);
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
        return redirect()->route('category-bagel.index')->with($status, $message);
    }
}
