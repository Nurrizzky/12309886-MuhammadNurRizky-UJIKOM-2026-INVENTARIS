@extends('layout.layout')

@section('title')
   Lending
@endsection

@section('content')

    @if (Session::get('success'))
        <x-ui.toast type="success" :message="Session::get('success')" />
    @endif
    @if (Session::get('failed'))
        <x-ui.toast type="failed" :message="Session::get('failed')" />
    @endif

    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <h3>Lending Table</h3>
            <p class="text-sm text-white/80">Add, Update, and Delete Lending</p>
        </div>
        <div class="flex gap-x-3">
            <x-ui.button-export  href="{{ route('staff.export.lending') }}" />
            <x-ui.button-add href="{{ route('staff.lending.create') }}">
                Lending
            </x-ui.button-add>
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
                        <th class="border-b border-[#575757] py-3 px-2">Notes</th>
                        <th class="border-b border-[#575757] py-3 px-2">Date</th>
                        <th class="border-b border-[#575757] py-3 px-2">Returned</th>
                        <th class="border-b border-[#575757] py-3 px-2">Edited By</th>
                        <th class="border-b border-[#575757] py-3 px-2">action</th>
                    </tr>
                </thead>
                <tbody >
                    @if (count($lendings) <= 0)
                        <tr>
                            <td colspan="9" class="italic text-white/80 text-center py-32">Tidak ada data...</td>
                        </tr>
                    @endif
                    @foreach ($lendings as $index => $value)   
                        <tr class="text-center">
                            <td class=" py-3 px-2">{{ $index + 1 }}</td>
                            <td class=" py-3 px-2">{{ $value->item->item_name }}</td>
                            <td class=" py-3 px-2">{{ $value->total_item  }}</td>
                            <td class=" py-3 px-2">{{ $value->name_of_borrower }}</td>
                            <td class=" py-3 px-2 capitalize">
                                @if (!$value->returned)
                                    {{ $value->notes }}
                                @else
                                    {{ $value->returned->notes }}
                                @endif
                            </td>
                            <td class=" py-3 px-2 capitalize">{{ $value->created_at->format('d F, Y') }}</td>
                            <td class=" py-3 px-2 capitalize">
                                 @if ($value->returned)
                                    <span class="text-green-600">{{ $value->returned->return_date->format('d F, Y') }}</span>
                                 @else
                                    <span class="border border-yellow-500 text-yellow-600 px-2 py-1 text-xs rounded">not returned</span>
                                 @endif
                            </td>
                            <td class=" py-3 px-2">{{ $value->staff->name }}</td>
                            <td class=" py-3 px-2 flex gap-x-3 items-center justify-center">
                                @if (!$value->returned)    
                                    <button onclick="showModal('{{ $value->id }}')" class="group px-5 py-2.5 w-fit bg-orange-400 rounded-md flex justify-between transition-all duration-200 hover:bg-orange-600 cursor-pointer">
                                        <div class="flex gap-x-2 items-center text-white text-sm tracking-wide">
                                            Return
                                        </div>
                                    </button>
                                @endif
                                <form action="{{ route('staff.lending.destroy', $value->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="group px-5 py-2.5 w-fit bg-red-400 rounded-md flex justify-between transition-all duration-200 hover:bg-red-600 cursor-pointer text-white text-sm tracking-wide">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="modal" class="fixed inset-0 z-50 hidden items-center justify-center">
    
    <div class="bg-[#2a2a2a] rounded-xl p-6 w-82 shadow-2xl">
        <h3 class="text-xl font-bold text-white mb-4">Return Item</h3>
        <form id="return-form" action="" method="POST">
            @csrf
            <div class="mb-4">
                <textarea name="notes" rows="3" class="w-full bg-[#111] text-white border border-[#555] rounded p-3 focus:outline-none focus:border-orange-500" placeholder="Kondisi barang..."></textarea>
            </div>
            <div class="flex justify-end gap-x-3 mt-6">
                <button type="button" onclick="hideModal()" class="px-4 py-2 bg-transparent border border-[#555] text-white rounded-md cursor-pointer">
                    cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-[#f5f5f5] text-[#111] rounded-md cursor-pointer">
                    return
                </button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')

<script>
    const modalOverlay = document.getElementById('modal');
    const returnForm = document.getElementById('return-form');

    function showModal(lendingId) {
        modalOverlay.classList.remove('hidden');
        modalOverlay.classList.add('flex');
        returnForm.action = `/staff/lending/returned/${lendingId}`;
    }

    function hideModal() {
        modalOverlay.classList.add('hidden');
        modalOverlay.classList.remove('flex');
        returnForm.reset();
    }
</script>
    
@endpush