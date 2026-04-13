@extends('layout.layout')

@section('title') Categories @endsection

@section('content')


     @if (Session::get('failed'))
        <x-ui.toast type='failed' :message="Session::get('failed')" />
    @endif
    @if (Session::get('success'))
        <x-ui.toast type='success' :message="Session::get('success')" />
    @endif


    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <h3>Categories Table</h3>
            <p class="text-sm text-white/80">Add, Update, and Delete Categories</p>
        </div>
        <div class="flex gap-x-3">
            <x-ui.button-add href="{{ route('admin.categories.create') }}" >
                categories
            </x-ui.button-add>
        </div>
    </div>

    <div class="w-full h-full mt-10">
        <div class="border border-[#555] rounded-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="border-b border-[#555] py-3 px-2">No</th>
                        <th class="border-b border-[#555] py-3 px-2">Name</th>
                        <th class="border-b border-[#555] py-3 px-2">Division PJ</th>
                        <th class="border-b border-[#555] py-3 px-2">Total Item</th>
                        <th class="border-b border-[#555] py-3 px-2">Action</th>
                    </tr>
                </thead>
                <tbody >
                    @if (count($categories) == 0)
                        <tr>
                            <td colspan="5" class="italic text-white/80 text-center py-32">Tidak ada data...</td>
                        </tr>
                    @else
                    @foreach ($categories as $index => $value)
                        <tr class="text-center">
                            <td class=" py-3 px-2">{{ $index + 1 }}</td>
                            <td class=" py-3 px-2">{{ $value->name }}</td>
                            <td class=" py-3 px-2 capitalize">{{ $value->division }}</td>
                            <td class=" py-3 px-2 capitalize">{{ $value->item_count }}</td>
                            <td class=" py-3 px-2 flex gap-x-3 items-center justify-center">
                                <x-ui.button-edit  href="{{ route('admin.categories.edit', $value->id) }}" />
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection