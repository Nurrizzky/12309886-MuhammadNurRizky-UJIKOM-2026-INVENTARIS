@extends('layout.layout')

@section('title')
   Create - Lending
@endsection

@section('content')

    @if (Session::get('failed'))
        <x-ui.toast type='failed' :message="Session::get('failed')" />
    @endif
    @if (Session::get('success'))
        <x-ui.toast type='success' :message="Session::get('success')" />
    @endif

    <h1>Tambah Lending.</h1>
    <p class="text-sm text-white/80">Tolong isi semua inputan yang tersedia.</p>

    <form action="{{ route('staff.lending.store') }}" method="POST" class="w-1/2 mt-5 flex flex-col gap-y-3" >
        @csrf
        @method('POST')

        <div class="flex flex-col gap-y-3">

            <div class="form-item flex flex-col gap-y-3">
                <x-ui.input placeholder="Name Peminjam.." name="name_of_borrower" type="text" />
                    @error('name_of_borrower')
                        <x-ui.message>{{ $message }}</x-ui.message>
                    @enderror
                <div id="container">
                    <div class="form-item flex flex-col gap-y-3">
                        <select name="item_id[]" class="w-full px-2 py-2 border-[#575757] border rounded-md text-sm focus:border-[#575757] outline:border-[#575757] text-white/70">
                            <option class="bg-[#222]" value="" disabled selected >Pilih Item</option>
                            @foreach ($item as $value)
                                <option class="bg-[#222]" value="{{ $value->id }}">{{ $value->item_name }}</option>    
                            @endforeach
                        </select>
                            @error('item_id')
                                <x-ui.message>{{ $message }}</x-ui.message>
                            @enderror
        
                        <x-ui.input placeholder="Total item .." name="total_item[]" type="number" />
                        @error('total_item')
                            <x-ui.message>{{ $message }}</x-ui.message>
                        @enderror
                    </div>
                </div>
                
                <button onclick="onClick()" type="button" class="text-sm flex gap-x-1.5 text-white/80 cursor-pointer">
                    <x-icons.add />
                    add more
                </button>

                <textarea name="notes" class="w-full px-3 py-1.5 border-[#575757] border rounded-md" placeholder="Keterangan..."></textarea>
                @error('notes')
                    <x-ui.message>{{ $message }}</x-ui.message>
                @enderror

            </div>
        </div>
        <div class="mt-2 flex flex-col items-start gap-y-3">
            <div class="flex gap-x-3">
                <x-ui.button-cancel/>
                <x-ui.button-create />
            </div>
        </div>
    </form>

@endsection

@push('scripts')
    
<script>
    function onClick() {

        const container = document.getElementById('container')
        const wrapper = document.createElement('div');

        wrapper.className = 'flex flex-col gap-y-3'
    
        wrapper.innerHTML = `
            <select name="item_id[]" class="mt-2 w-full px-2 py-2 border-[#575757] border rounded-md text-sm focus:border-[#575757] outline:border-[#575757] text-white/70">
                <option class="bg-[#222]" value="" disabled selected >Pilih Item</option>
            @foreach ($item as $value)
                <option class="bg-[#222]" value="{{ $value->id }}">{{ $value->item_name }}</option>    
            @endforeach
            </select>
                   
            <x-ui.input placeholder="Total item .." name="total_item[]" type="number" />
             
            <button type="button" onclick="removeForm(this)" class="px-3 py-1 w-fit bg-red-400 rounded-md flex justify-between transition-all duration-200 hover:bg-red-600 cursor-pointer">
                delete
            </button>
        `;
        container.appendChild(wrapper);
    }


    function removeForm(button) {
        button.parentElement.remove();
    }
</script>
@endpush