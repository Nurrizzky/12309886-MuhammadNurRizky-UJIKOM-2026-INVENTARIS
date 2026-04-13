@extends('layout.layout')

@section('title')
   Items
@endsection

@section('content')

    @if (Session::get('failed'))
        <x-ui.toast type='failed' :message="Session::get('failed')" />
    @endif
    @if (Session::get('success'))
        <x-ui.toast type='success' :message="Session::get('success')" />
    @endif

    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <h3>Items Table</h3>
            <p class="text-sm text-white/80">Show data item</p>
        </div>
        <div class="flex gap-x-3">
        </div>
    </div>

    <div class="w-full h-full mt-10">
        <div class="border border-[#575757] rounded-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="border-b border-[#575757] py-3 px-2">No</th>
                        <th class="border-b border-[#575757] py-3 px-2">Category</th>
                        <th class="border-b border-[#575757] py-3 px-2">Name</th>
                        <th class="border-b border-[#575757] py-3 px-2">Total</th>
                        <th class="border-b border-[#575757] py-3 px-2">Avaliable</th>
                        <th class="border-b border-[#575757] py-3 px-2">Lending</th>
                    </tr>
                </thead>
                <tbody >
                    @if (count($items) <= 0)
                        <tr>
                            <td colspan="5" class="italic text-white/80 text-center py-32">Tidak ada data...</td>
                        </tr>
                    @endif
                    @foreach ($items as $index => $value)   
                    @php
                        $jumlahDipinjam = $value->borrowed_sum_total_item ?? 0;
                        $onRepair = $value->total_repaired ?? 0;

                        $yangTersedia = $value->total_stock - $jumlahDipinjam - $onRepair;
                    @endphp 
                        <tr class="text-center">
                            <td class=" py-3 px-2">{{ $index + 1 }}</td>
                            <td class=" py-3 px-2">{{ $value->category->name }}</td>
                            <td class=" py-3 px-2 capitalize">{{ $value->item_name }}</td>
                            <td class=" py-3 px-2">{{ $value->total_stock }}</td>
                            <td class=" py-3 px-2">{{ $yangTersedia  }}</td>
                            <td class=" py-3 px-2">
                                @if ($value->borrowed_count > 0)
                                    <p>{{ $value->borrowed_count }}</p>
                                @else
                                    {{ $value->borrowed_count ?? '0' }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection