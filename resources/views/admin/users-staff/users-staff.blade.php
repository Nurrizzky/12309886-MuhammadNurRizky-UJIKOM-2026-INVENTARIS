@extends('layout.layout')

@section('title')
   Users admin
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
            <h3>Users Table</h3>
            <p class="text-sm text-white/80">Add, Update, and Delete Users</p>
            <p class="text-sm text-white/80">Password 4 character of email + nomor unik</p>
        </div>
        <div class="flex gap-x-3">
            <x-ui.button-export  href="{{ route('admin.users.export.staff') }}" />
            <x-ui.button-add href="{{ route('admin.users.create.staff') }}">
                Users
            </x-ui.button-add>
        </div>
    </div>

    <div class="w-full h-full mt-10">
        <div class="border border-[#575757] rounded-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="border-b border-[#575757] py-3 px-2">No</th>
                        <th class="border-b border-[#575757] py-3 px-2">Name</th>
                        <th class="border-b border-[#575757] py-3 px-2">Email</th>
                        <th class="border-b border-[#575757] py-3 px-2">Action</th>
                    </tr>
                </thead>
                <tbody >
                    @if (count($staffs) == 0)
                        <tr>
                            <td colspan="4" class="italic text-white/80 text-center py-32">Tidak ada data...</td>
                        </tr>
                    @endif
                    @foreach ($staffs as $index => $value)    
                        <tr class="text-center">
                            <td class=" py-3 px-2">{{ $index + 1 }}</td>
                            <td class=" py-3 px-2">{{ $value->email }}</td>
                            <td class=" py-3 px-2 capitalize">{{ $value->name }}</td>
                            <td class=" py-3 px-2 flex gap-x-3 items-center justify-center">
                                <x-ui.button-reset-password href="{{ route('admin.users.reset.password.staff', $value->id) }}" />
                                <x-ui.button-delete href="{{ route('admin.users.destroy.staff', $value->id) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection