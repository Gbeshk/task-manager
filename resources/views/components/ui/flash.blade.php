@if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-6 left-1/2 gap-3 -translate-x-1/2 z-50 flex items-center w-84 h-26.5 bg-white border-b pl-7.5 border-b-[#4ABF4E] shadow-[0px_4px_4px_0px_#0000000F]">
        <x-icons.success-icon />
        <p class="text-base leading-none tracking-normal text-[#2F363D]">{{ session('success') }}</p>
    </div>
@endif
