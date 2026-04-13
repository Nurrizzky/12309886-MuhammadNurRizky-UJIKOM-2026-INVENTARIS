<?php

namespace App\Http\Controllers;

use App\Exports\LendingsExport;
use App\Models\BorrowedItem;
use App\Models\ItemStock;
use App\Models\ReturnedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use function Symfony\Component\Clock\now;

class LendingController extends Controller
{
    public function export() {
        return Excel::download(new LendingsExport, 'lending.xlsx');
    }

    public function index() {
        $lendings = BorrowedItem::with('returned')->get();

        return view('staff.lending.lendings', compact('lendings'));
    }

    public function create(Request $request){
        $item = ItemStock::all();

        return view('staff.lending.create', compact('item'));
    } 

    public function store(Request $request){
        $request->validate([
            'name_of_borrower' => 'required',
            'notes' => 'required',
            'item_id' => 'required|array',     
            'item_id.*' => 'required',         
            'total_item' => 'required|array',  
            'total_item.*' => 'required|numeric|min:1', 
        ], [
            'name_of_borrower.required' => 'wajib Diisi',
            'notes.required' => 'wajib wiisi',
            'item_id.*.required' => 'wajib dipilih',
            'total_item.*.required' => ' Wajib Diisi',
            'total_item.*.min' => 'Jumlah minimal 1',
        ]);

        foreach ($request->item_id as $index => $itemId) {
            $item = ItemStock::find($itemId);
            $jumlahTotal = $request->total_item[$index];

            if ($jumlahTotal > $item->total_stock) {
                return redirect()->route('staff.lending.create')->with('failed', 'Stok melebihi sotk item');
            } else {
                $proses = BorrowedItem::create([
                    'staff_id' => Auth::user()->id,
                    'name_of_borrower' => $request->name_of_borrower,
                    'date' => now(),
                    'notes' => $request->notes,
                    'item_id' => $itemId,
                    'total_item' => $request->total_item[$index],
                ]);
            }
        }

        if ($proses) {
            return redirect()->route('staff.lending.index')->with('success', 'Berhasil dibuat');
        } else {
            return redirect()->route('staff.lending.index')->with('failed', 'Gagal dibuat');
        }

    } 

    public function destroy(string $id) {
        $proses = BorrowedItem::where('id', $id)->delete();

        if ($proses) {
            return redirect()->route('staff.lending.index')->with('success', 'Berhasil dihapus');
        } else {
            return redirect()->route('staff.lending.index')->with('failed', 'Gagal dihapus');
        }
    }

    public function returned(Request $request, string $id) {
        $request->validate([
            'notes' => 'required'
        ], [
            'notes.required' => 'wajib diisi'
        ]);

        $proses = ReturnedItem::create([
            'staff_id' => Auth::user()->id,
            'borrowed_id' => $id,
            'return_date' => now(),
            'notes' => $request->notes
        ]);

        if ($proses) {
            return redirect()->route('staff.lending.index')->with('success', 'Berhasil retrun');
        } else {
            return redirect()->route('staff.lending.index')->with('failed', 'Gagal return');
        }
    }
}
