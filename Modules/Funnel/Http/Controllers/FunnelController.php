<?php

namespace Modules\Funnel\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Modules\Category\Interfaces\CategoryRepositoryInterface;
use Modules\Funnel\Interfaces\FunnelRepositoryInterface;
use Modules\Funnel\Interfaces\PageRepositoryInterface;

class FunnelController extends Controller
{
    protected $funnel_repository;
    protected $category_repository;
    protected $page_repository;

    public function __construct(FunnelRepositoryInterface $funnel_repository, PageRepositoryInterface $page_repository, CategoryRepositoryInterface $category_repository)
    {
        $this->funnel_repository = $funnel_repository;
        $this->page_repository = $page_repository;
        $this->category_repository = $category_repository;
    }

    public function index()
    {
        $user = auth()->user();
        $categories = $user->categories;
        if ($user->hasRole('Admin')) {
            $funnels = $this->funnel_repository->all();
        } else {
            $funnels = $this->funnel_repository->where('user_id', $user->id)->get();
        }
        return view('funnel::index', compact('funnels', 'categories'));
    }

    public function create()
    {
        return view('funnel::create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            $data['user_id'] = $user->id;
            $this->funnel_repository->save($data);
            DB::commit();
            $status = 'success';
            $message = 'Funnel has been created.';
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->route('funnel.index')->with($status, $message);
    }

    public function show($id)
    {
        $user = auth()->user();
        $categories = $user->categories;
        if ($user->hasRole('Admin')) {
            $funnels = $this->funnel_repository->all();
        } else {
            $funnels = $this->funnel_repository->where('user_id', $user->id)->get();
        }
        if ($user->hasRole('Admin')) {
            $funnel = $this->funnel_repository->find($id);
            $pages = $this->page_repository->all();
        } else {
            $funnel = $this->funnel_repository
                ->where('user_id', $user->id)
                ->where('id', $id)
                ->first();
            $pages = $this->page_repository
                ->where('user_id', $user->id)
                ->get();
        }
        $funnel_pages = $funnel->pages()->pluck('id')->toArray();
        if (empty($funnel)) {
            return abort(404);
        }
        return view('funnel::show', compact('funnel', 'pages', 'funnel_pages', 'funnels', 'categories'));
    }

    public function edit($id)
    {
        $user = auth()->user();
        $categories = $user->categories;
        if ($user->hasRole('Admin')) {
            $funnel = $this->funnel_repository->find($id);
        } else {
            $funnel = $this->funnel_repository
                ->where('user_id', $user->id)
                ->where('id', $id)
                ->first();
        }
        if (empty($funnel)) {
            return abort(404);
        }
        return view('funnel::edit', compact('funnel', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($user->hasRole('Admin')) {
                $this->funnel_repository->update($id, $data);
            } else {
                $funnel = $this->funnel_repository
                    ->where('user_id', $user->id)
                    ->where('id', $id)
                    ->first();
                if (!empty($funnel)) {
                    $this->funnel_repository->update($id, $data);
                } else {
                    return abort(404);
                }
            }
            DB::commit();
            $status = 'success';
            $message = 'Funnel has been updated.';
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->back()->with($status, $message);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($user->hasRole('Admin')) {
                $this->funnel_repository->delete($id);
            } else {
                $funnel = $this->funnel_repository
                    ->where('user_id', $user->id)
                    ->where('id', $id)
                    ->first();
                if (!empty($funnel)) {
                    $this->funnel_repository->delete($id);
                } else {
                    return abort(404);
                }
            }
            $status = 'success';
            $message = 'Funnel has been deleted.';
            DB::commit();
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->route('funnel.index')->with($status, $message);
    }

    public function attachPage(Request $request, $id)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $funnel = $this->funnel_repository->find($data['funnel_id']);
            $funnel_page = $funnel->pages()->where('id', $id)->first();
            if (!empty($funnel_page)) {
                $this->funnel_repository->detach($data['funnel_id'], 'pages', $id);
                $message = 'Page has been dettached to funnel.';
            } else {
                $this->funnel_repository->attach($data['funnel_id'], 'pages', $id);
                $message = 'Page has been attached to funnel.';
            }
            $status = 'success';
            DB::commit();
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->back()->with($status, $message);
    }
}
