@extends('layout.layout')

@section('title')
   Edit
@endsection

@section('content')

    <h1>Update Item.</h1>
    <p class="text-sm text-white/80">Tolong isi semua inputan yang tersedia.</p>

    <form action="{{ route('admin.items.update', $item->id) }}" method="POST" class="w-1/2 mt-5 flex flex-col gap-y-3" >
        @csrf
        @method('PATCH')

        <div class="flex flex-col gap-y-3" id="container">

            <div class="form-item flex flex-col gap-y-3">
                <x-ui.input placeholder="Name.." name="item_name" type="text" value="{{ $item->item_name }}" />
                @error('name')
                    <x-ui.message>{{ $message }}</x-ui.message>
                @enderror

                <select name="category_id" class="w-full px-2 py-2 border-[#575757] border rounded-md text-sm focus:border-[#575757] outline:border-[#575757] text-white/70">
                    <option class="bg-[#222]" value="" disabled >Pilih Categories</option>
                    @foreach ($category as $value)
                        <option class="bg-[#222]" value="{{ $value->id }}" {{ $item->category_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>    
                    @endforeach
                </select>
                @error('category')
                    <x-ui.message>{{ $message }}</x-ui.message>
                @enderror

                <x-ui.input placeholder="Total.." name="total_stock" type="number" value="{{ $item->total_stock }}" />
                @error('total_stock')
                    <x-ui.message>{{ $message }}</x-ui.message>
                @enderror

                <span class="text-sm">Current repair ({{ $item->total_repaired }})</span>
                <x-ui.input placeholder="new broke item (repair).." name="total_repaired" type="number" value="0" />
                @error('total_repaired')
                    <x-ui.message>{{ $message }}</x-ui.message>
                @enderror

            </div>
        </div>
        <div class="mt-2 flex items-start gap-x-3">
            <x-ui.button-cancel />
            <x-ui.button-update />
        </div>
    </form>

@endsection
