@extends('layout.layout')

@section('title')
   Edit
@endsection

@section('content')

    <h1>Edit users.</h1>
    <p class="text-sm text-white/80">Tolong isi semua inputan yang tersedia.</p>

    <form action="{{ route('admin.users.admin.update', $admin->id) }}" method="POST" class="w-1/2 mt-5 flex flex-col gap-y-3" >
        @csrf
        @method('PATCH')

        <div class="flex flex-col gap-y-3" id="container">

            <div class="form-item flex flex-col gap-y-3">
                <x-ui.input placeholder="Name.." name="name" type="text" value="{{ $admin->name }}" />
                    @error('name')
                        <x-ui.message>{{ $message }}</x-ui.message>
                    @enderror

                <x-ui.input placeholder="Email.." name="email" type="email" value="{{ $admin->email }}" />
                    @error('email')
                        <x-ui.message>{{ $message }}</x-ui.message>
                    @enderror
                
                <span class="text-sm">Password optional</span>
                <x-ui.input placeholder="password.." name="password" type="password" />
                    @error('password')
                        <x-ui.message>{{ $message }}</x-ui.message>
                    @enderror

                <select name="role" class="w-full px-2 py-2 border-[#575757] border rounded-md text-sm focus:border-[#575757] outline:border-[#575757] text-white/70">
                    <option class="bg-[#222]" value="" disabled selected >Pilih Role</option>
                    <option class="bg-[#222]" value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option class="bg-[#222]" value="staff" {{ $admin->role == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
                @error('role')
                    <x-ui.message>{{ $message }}</x-ui.message>
                @enderror

            </div>
        </div>
        <div class="mt-2 flex flex-col items-start gap-y-3">
            <div class="flex gap-x-3">
                <x-ui.button-cancel />
                <x-ui.button-update />
            </div>
        </div>
    </form>

@endsection
