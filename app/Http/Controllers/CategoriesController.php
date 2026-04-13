<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index() 
    {
        $categories = ItemCategory::withCount('item')->get();
        return view('admin.categories.categories', compact('categories'));
    }

    public function create() 
    {
        return view('admin.categories.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'division' => 'required',
        ], [
            'name.required' => 'Wajib diisi!', 
            'division.required' => 'Wajib diisi!', 
        ]);

        $proses = ItemCategory::create([
            'name' => $request->name,
            'division' => $request->division,
        ]);

        if ($proses) {
            return redirect()->route('admin.categories.index')->with('success', 'Berhasil dibuat');
        } else {
            return redirect()->route('admin.categories.index')->with('failed', 'Gagal dibuat');
        }

    }

    public function edit(string $id) 
    {
        $category = ItemCategory::where('id', $id)->first();
        
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id) 
    {
        $request->validate([
            'name' => 'required',
            'division' => 'required',
        ], [
            'name.required' => 'Wajib diisi!', 
            'division.required' => 'Wajib diisi!', 
        ]);

        $proses = ItemCategory::where('id', $id)->update([
            'name' => $request->name,
            'division' => $request->division,
        ]);

        if ($proses) {
            return redirect()->route('admin.categories.index')->with('success', 'Berhasil update');
        } else {
            return redirect()->route('admin.categories.index')->with('failed', 'Gagal update');
        }
    }
}
