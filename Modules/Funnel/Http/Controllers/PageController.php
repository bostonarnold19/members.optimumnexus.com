<?php

namespace Modules\Funnel\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Modules\Funnel\Interfaces\PageRepositoryInterface;

class PageController extends Controller
{
    protected $page_repository;

    public function __construct(PageRepositoryInterface $page_repository)
    {
        $this->page_repository = $page_repository;
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('Admin')) {
            $pages = $this->page_repository->all();
        } else {
            $pages = $this->page_repository->where('user_id', $user->id)->get();
        }
        return view('page::index', compact('pages'));
    }
    public function create()
    {
        return view('page::create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            $data['user_id'] = $user->id;
            $this->page_repository->save($data);
            DB::commit();
            $status = 'success';
            $message = 'Page has been created.';
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->back()->with($status, $message);
    }

    public function show($id)
    {
        $user = auth()->user();
        if ($user->hasRole('Admin')) {
            $page = $this->page_repository->find($id);
        } else {
            $page = $this->page_repository
                ->where('user_id', $user->id)
                ->where('id', $id)
                ->first();
        }
        if (empty($page)) {
            return abort(404);
        }
        return view('page::show', compact('page'));
    }

    public function edit($id)
    {
        $user = auth()->user();
        if ($user->hasRole('Admin')) {
            $page = $this->page_repository->find($id);
        } else {
            $page = $this->page_repository
                ->where('user_id', $user->id)
                ->where('id', $id)
                ->first();
        }
        if (empty($page)) {
            return abort(404);
        }
        return view('page::edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($user->hasRole('Admin')) {
                $this->page_repository->update($id, $data);
            } else {
                $page = $this->page_repository
                    ->where('user_id', $user->id)
                    ->where('id', $id)
                    ->first();
                if (!empty($page)) {
                    $this->page_repository->update($id, $data);
                } else {
                    return abort(404);
                }
            }
            DB::commit();
            $status = 'success';
            $message = 'Page has been updated.';
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->route('page.index')->with($status, $message);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($user->hasRole('Admin')) {
                $this->page_repository->delete($id);
            } else {
                $page = $this->page_repository
                    ->where('user_id', $user->id)
                    ->where('id', $id)
                    ->first();
                if (!empty($page)) {
                    $this->page_repository->delete($id);
                } else {
                    return abort(404);
                }
            }
            $status = 'success';
            $message = 'Page has been deleted.';
            DB::commit();
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->route('page.index')->with($status, $message);
    }
}
