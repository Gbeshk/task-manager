@php
    $isKa = app()->getLocale() === 'ka';
    $dateColWidth = $isKa ? 'w-36' : 'w-23.5';
    $dateGap = $isKa ? 'gap-10' : 'gap-19';
@endphp

<x-layouts.app :title="$task->title">
    <div class='flex mt-10 gap-9 w-365 h-236 mx-auto relative'>
        <x-dashboard.sidebar />
        <div class="w-289.25">
            <div class='flex mt-24 justify-between items-center'>
                <p
                    class='ml-10 mt-4.5 font-bold text-3xl leading-tight uppercase text-[#2F363D] tracking-normal wrap-break-word min-w-0 flex-1'>
                    {{ $task->title }}
                </p>
                <div class='flex items-center gap-4 shrink-0'>
                    <a href="{{ route('tasks.edit', $task->id) }}"
                        class="py-3 px-6 flex gap-3.5 items-center transition-all duration-300 ease-in-out hover:bg-[#499AF914] justify-center border border-[#499AF9] rounded-xl cursor-pointer font-bold text-base leading-none uppercase text-[#499AF9] tracking-normal">
                        <x-icons.edit-task-icon /> {{ __('messages.edit_task') }}
                    </a>
                </div>
            </div>
            <p class="text-base leading-4 tracking-normal text-[#6A737D] mt-21.5 ml-10">
                {{ __('messages.description') }}
            </p>
            <p class="mt-3 ml-10 text-lg leading-none tracking-normal text-[#2F363D] min-h-21">
                {{ $task->description }}
            </p>

            <div
                class="text-base leading-4 tracking-normal text-[#6A737D] mt-21.5 ml-10 flex items-center {{ $dateGap }}">
                <p class="{{ $dateColWidth }}">{{ __('messages.created_date') }}</p>
                <p>{{ __('messages.due_date') }}</p>
            </div>

            <div
                class="text-lg leading-none tracking-normal text-[#2F363D] mt-3.5 ml-10 flex items-center {{ $dateGap }}">
                <p class="{{ $dateColWidth }}">{{ $task->created_at->format('d/m/y') }}</p>
                <p>{{ $task->due_date->format('d/m/y') }}</p>
            </div>
        </div>
        <div class='absolute top-226 left-296.5'>
            <x-ui.change-language />
        </div>
    </div>
</x-layouts.app>
