@extends('layout.layout')

@section('title') Create @endsection

@section('content')


    @if (Session::get('failed'))
        <x-ui.toast type='failed' :message="Session::get('failed')" />
    @endif
    @if (Session::get('success'))
        <x-ui.toast type='success' :message="Session::get('success')" />
    @endif


    <h1>Tambah kategori.</h1>
    <p class="text-sm text-white/80">Tolong isi semua inputan yang tersedia.</p>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="w-1/2 mt-5 flex flex-col gap-y-3" >
        @csrf
        @method('POST')
        
        <div class="flex flex-col gap-y-3" id="container">
            <div class="form-item flex flex-col gap-y-3">

                <input
                    name="name"
                    type="text"
                    placeholder="Nama... (Elektronik)"
                    class="w-full px-5 py-2 border-[#575757] border rounded-md ">
                @error('name')
                    <x-ui.message>{{ $message }}</x-ui.message>
                @enderror

                <select name="division" class="w-full px-2 py-2 border-[#575757] border rounded-md text-sm focus:border-[#575757] outline:border-[#575757] text-white/70">
                    <option class="bg-[#222]" value="" disabled selected >Pilih Divisi</option>
                    <option class="bg-[#222]" value="sarpras">Sarpras</option>
                    <option class="bg-[#222]" value="tefa">Tefa</option>
                    <option class="bg-[#222]" value="tata_usaha">Tata Usaha</option>
                </select>
                 @error('division')
                    <x-ui.message>{{ $message }}</x-ui.message>
                @enderror

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