<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hierarchy;
use Illuminate\Validation\Rule;


class HierarchyController extends Controller
{
    public function index()
    {
        $hierarchies = Hierarchy::with('children')->whereNull('parent_id')->get();
        return view('hierarchy.index', compact('hierarchies'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => [
                'required',
                Rule::unique('hierarchies')->where(function ($query) use ($request) {
                    return $query->where('parent_id', $request->input('parent_id'));
                })
            ],
            'parent_id' => 'nullable|exists:hierarchies,id',
        ]);

        
        Hierarchy::create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id')
        ]);

        return redirect()->route('hierarchy.index');
    }

    public function getAllHierarchies()
    {
        $hierarchies = Hierarchy::all();
        return view('hierarchy.index', compact('hierarchies'));
    }

}