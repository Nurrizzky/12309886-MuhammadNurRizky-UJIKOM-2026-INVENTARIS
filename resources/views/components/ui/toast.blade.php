@props(['type' => 'success', 'message'])

@php
    // Menentukan warna background berdasarkan tipe toast
    $colorClass = match($type) {
        'success' => 'bg-green-400',
        'failed', 'error' => 'bg-red-400',
        'warning' => 'bg-yellow-400 text-black',
        default => 'bg-blue-400',
    };
@endphp

<div id="toast-notification" class="fixed bottom-7 right-5 z-50 flex items-center w-full max-w-xs p-4 space-x-3 text-white rounded-lg shadow-lg transition-opacity duration-500 ease-in-out {{ $colorClass }}" role="alert">
    
    <div class="font-medium text-sm flex-1">{{ $message }}</div>

    <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-md p-1.5 hover:bg-black/20 inline-flex items-center justify-center h-7 w-7 transition-colors cursor-pointer border-none bg-transparent text-white" 
        onclick="closeToast()">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<script>
    function closeToast() {
        const toast = document.getElementById('toast-notification');
        if(toast) {
            toast.remove();
        }
    }
</script>