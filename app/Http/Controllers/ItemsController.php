<?php

namespace App\Http\Controllers;

use App\Exports\ItemsExport;
use App\Models\BorrowedItem;
use App\Models\ItemCategory;
use App\Models\ItemStock;
use App\Models\ReturnedItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemsController extends Controller
{
    public function export() 
    {
        return Excel::download(new ItemsExport, 'items.xlsx');
    }

    public function index() 
    {
        $items = ItemStock::with('category')->withCount('borrowed')->withSum('borrowed', 'total_item')->get();

        return view('admin.items.items', compact('items'));
    }

    public function create() 
    {
        $categories = ItemCategory::all();

        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'item_name' => 'required',
            'category_id' => 'required',
            'total_stock' => 'required',
        ], [
            'category_id.required' => 'Wajib diisi',
            'item_name.required' => 'Wajib diisi',
            'total_stock.required' => 'Wajib diisi',
        ]);

        $proses = ItemStock::create([
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'total_stock' => $request->total_stock,
        ]);

        if ($proses) {
            return redirect()->route('admin.items.index')->with('success', 'Berhasil dibuat');
        } else {
            return redirect()->route('admin.items.index')->with('failed', 'Gagal dibuat');
        }
    }

    public function show(string $id) 
    {
        // $lendings = ItemStock::with('category')->with('borrowed')->withCount('borrowed')->withSum('borrowed', 'total_item')->get();

        $lendings = BorrowedItem::with(['item', 'returned'])->where('item_id', $id)->get();

        return view('admin.items.detail', compact('lendings'));
    }

    public function edit(string $id) 
    {
        $item = ItemStock::where('id', $id)->first();
        $category = ItemCategory::all();

        return view('admin.items.edit', compact('item', 'category'));
    }

    public function update(Request $request, string $id) 
    {
        $request->validate([
            'item_name' => 'required',
            'category_id' => 'required',
            'total_stock' => 'required',
            'total_repaired' => 'nullable',
        ], [
            'category_id.required' => 'Wajib diisi',
            'item_name.required' => 'Wajib diisi',
            'total_stock.required' => 'Wajib diisi',
        ]);

        $item = ItemStock::where('id', $id)->first();
        $totalRepaired = $item->total_repaired + $request->total_repaired;


        $proses = ItemStock::where('id', $id)->update([
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'total_stock' => $request->total_stock,
            'total_repaired' => $totalRepaired,
        ]);

        if ($proses) {
            return redirect()->route('admin.items.index')->with('success', 'Berhasil diupdate');
        } else {
            return redirect()->route('admin.items.index')->with('failed', 'Gagal diupdate');
        }
    }

    public function itemsStaff() 
    {
        $items = ItemStock::with('category')->withCount('borrowed')->withSum('borrowed', 'total_item')->get();

        return view('staff.lending.items', compact('items'));
    }
}
