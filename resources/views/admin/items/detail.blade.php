@extends('layout.layout')

@section('title')
   Items
@endsection

@section('content')


    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <h3>lending Table</h3>
            <p class="text-sm text-white/80">data of lending</p>
        </div>
        <div class="flex gap-x-3">
            <x-ui.button-cancel />
        </div>
    </div>

    <div class="w-full h-full mt-10">
        <div class="border border-[#575757] rounded-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="border-b border-[#575757] py-3 px-2">No</th>
                        <th class="border-b border-[#575757] py-3 px-2">Item</th>
                        <th class="border-b border-[#575757] py-3 px-2">Total</th>
                        <th class="border-b border-[#575757] py-3 px-2">Name</th>
                        <th class="border-b border-[#575757] py-3 px-2">deskripsi</th>
                        <th class="border-b border-[#575757] py-3 px-2">date</th>
                        <th class="border-b border-[#575757] py-3 px-2">Returned</th>
                        <th class="border-b border-[#575757] py-3 px-2">Edited by</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($lendings as $index => $value)    

                        <tr class="text-center">
                            <td class=" py-3 px-2">{{ $index + 1 }}</td>
                            <td class=" py-3 px-2">{{ $value->item->item_name }}</td>
                            <td class=" py-3 px-2 capitalize">
                                {{ $value->total_item }}
                            </td>
                            <td class=" py-3 px-2">{{ $value->name_of_borrower }}</td>
                            <td class=" py-3 px-2">
                                {{ $value->returned->notes ?? $value->notes }}
                            </td>
                            <td class=" py-3 px-2">{{ $value->created_at->format('d F, Y') }}</td>
                            <td class=" py-3 px-2">   
                                @if ($value->returned)
                                    <span class="text-green-600">{{ $value->returned->return_date->format('d F, Y') }}</span>
                                @else
                                    <span class="border border-yellow-500 text-yellow-600 px-2 py-1 text-xs rounded">not returned</span>
                                @endif
                            </td>
                            <td class=" py-3 px-2">{{ $value->staff->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection