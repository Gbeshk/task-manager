@props(['sortBy', 'sortDir'])

<div class='grid grid-cols-[25fr_30fr_12fr_12fr_22fr] items-center'>
    <p
        class='h-20 pl-10 flex items-center text-black font-normal text-lg leading-none tracking-normal border-b border-[#E0E3E7]'>
        Task name
    </p>
    <p
        class='h-20 pl-6 flex items-center text-black font-normal text-lg leading-none tracking-normal border-b border-[#E0E3E7]'>
        Description
    </p>
    <p
        class='h-20 pl-6 flex items-center text-black font-normal text-lg leading-none tracking-normal gap-2 border-b border-[#E0E3E7]'>
        @php
            if ($sortBy === 'created_at' && $sortDir === 'asc') {
                $nextCreatedUrl = request()->fullUrlWithQuery(['sort' => null, 'dir' => null, 'page' => 1]);
            } elseif ($sortBy === 'created_at' && $sortDir === 'desc') {
                $nextCreatedUrl = request()->fullUrlWithQuery(['sort' => 'created_at', 'dir' => 'asc', 'page' => 1]);
            } else {
                $nextCreatedUrl = request()->fullUrlWithQuery(['sort' => 'created_at', 'dir' => 'desc', 'page' => 1]);
            }
        @endphp
        <a href="{{ $nextCreatedUrl }}" class="flex items-center gap-2">
            Created at <x-icons.sort-icon />
        </a>
    </p>
    <p
        class='h-20 pl-6 flex items-center text-black font-normal text-lg leading-none tracking-normal gap-2 border-b border-[#E0E3E7]'>
        @php
            if ($sortBy === 'due_date' && $sortDir === 'asc') {
                $nextDueUrl = request()->fullUrlWithQuery(['sort' => 'due_date', 'dir' => 'desc', 'page' => 1]);
            } elseif ($sortBy === 'due_date' && $sortDir === 'desc') {
                $nextDueUrl = request()->fullUrlWithQuery(['sort' => null, 'dir' => null, 'page' => 1]);
            } else {
                $nextDueUrl = request()->fullUrlWithQuery(['sort' => 'due_date', 'dir' => 'asc', 'page' => 1]);
            }
        @endphp
        <a href="{{ $nextDueUrl }}" class="flex items-center gap-2">
            Due Date <x-icons.sort-icon />
        </a>
    </p>
    <p
        class='h-20 pl-6 flex items-center text-black font-normal text-lg leading-none tracking-normal border-b border-[#E0E3E7]'>
        Actions
    </p>
</div>
