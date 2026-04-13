@extends('layout.layout')

@section('title') Create @endsection

@section('content')

    <h1>Tambah items.</h1>
    <p class="text-sm text-white/80">Tolong isi semua inputan yang tersedia.</p>

    <form action="{{ route('admin.items.store') }}" method="POST" class="w-1/2 mt-5 flex flex-col gap-y-3" >
        @csrf
        @method('POST')

        <div class="flex flex-col gap-y-3" id="container">

            <div class="form-item flex flex-col gap-y-3">
                <x-ui.input placeholder="Name Item" name="item_name" type="text" />
                @error('item_name')
                    <x-ui.message >{{ $message }}</x-ui.message>
                @enderror

                <select name="category_id" class="w-full px-2 py-2 border-[#575757] border rounded-md text-sm focus:border-[#575757] outline:border-[#575757] text-white/70">
                    <option class="bg-[#222]" value="" disabled selected >Pilih Category</option>
                    @foreach ($categories as $value)
                        <option class="bg-[#222]" value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
                 @error('category_id')
                    <x-ui.message >{{ $message }}</x-ui.message>
                @enderror

                <x-ui.input placeholder="Stock.." name="total_stock" type="number" />
                @error('total_stock')
                    <x-ui.message >{{ $message }}</x-ui.message>
                @enderror

                {{-- <x-ui.input placeholder="Total repair.." name="total_repaired" type="number" />
                @error('total_repaired')
                    <x-ui.message >{{ $message }}</x-ui.message>
                @enderror --}}

            </div>
        </div>
        <div class="mt-2 flex flex-col items-start gap-y-3">
            <div class="flex gap-x-3">
                <x-ui.button-cancel />
                <x-ui.button-create />
            </div>
        </div>
    </form>

@endsection