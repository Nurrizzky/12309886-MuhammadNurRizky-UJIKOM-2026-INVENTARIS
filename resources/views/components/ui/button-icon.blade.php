<a {{ $attributes->merge(['class' => 'group px-7 py-2 w-fit mt-2 bg-[#f5f5f5] rounded-md flex justify-between transition-all duration-200 hover:bg-[#cfcfcf]']) }}>
    <div class="flex gap-x-2 items-center text-[#111] font-semibold">
        {{ $slot }}
    </div>
</a>