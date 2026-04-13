@extends('layout.layout')

@section('title') item @endsection

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
            <p class="text-sm text-white/80">Add, Update, and Delete Items</p>
        </div>
        <div class="flex gap-x-3">
            <x-ui.button-export href="{{ route('admin.items.export') }}" />
            <x-ui.button-add href="{{ route('admin.items.create') }}">
                Items
            </x-ui.button-add>
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
                        <th class="border-b border-[#575757] py-3 px-2">Repair</th>
                        <th class="border-b border-[#575757] py-3 px-2">Lending</th>
                        <th class="border-b border-[#575757] py-3 px-2">Action</th>
                    </tr>
                </thead>
                <tbody >
                    @if (count($items) == 0)
                         <tr>
                            <td colspan="7" class="italic text-white/80 text-center py-32">Tidak ada data...</td>
                        </tr>
                    @else    
                        @foreach ($items as $index => $value)
                            @php
                                $jumlahDipinjam = $value->borrowed_sum_total_item;
                                $totalItemSesungguhnya = $value->total_stock - $jumlahDipinjam;
                            @endphp
                            <tr class="text-center">
                                <td class=" py-3 px-2">{{ $index + 1 }}</td>
                                <td class=" py-3 px-2">{{ $value->category->name }}</td>
                                <td class=" py-3 px-2 capitalize">{{ $value->item_name }}</td>
                                <td class=" py-3 px-2">
                                    {{ $totalItemSesungguhnya }}
                                </td>
                                <td class=" py-3 px-2">{{ $value->total_repaired }}</td>
                                <td class=" py-3 px-2">
                                    @if ($value->borrowed_count == 0)
                                        <p>{{ $value->borrowed_count ?? 0  }}</p>
                                    @else
                                        <a href="{{ route('admin.items.show', $value->id) }}" class="text-blue-300 underline">{{ $value->borrowed_count }}</a>
                                    @endif
                                </td>
                                <td class=" py-3 px-2 flex gap-x-3 items-center justify-center">
                                    <x-ui.button-edit href="{{ route('admin.items.edit', $value->id) }}" />
                                </td>
                            </tr>

                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection