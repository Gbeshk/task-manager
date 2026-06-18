@props(['sortBy', 'sortDir'])

@php
    $nextSortUrl = function (string $key) use ($sortBy, $sortDir) {
        if ($sortBy === $key && $sortDir === 'asc') {
            $params = ['sort' => $key, 'dir' => 'desc', 'page' => 1];
        } elseif ($sortBy === $key && $sortDir === 'desc') {
            $params = ['sort' => null, 'dir' => null, 'page' => 1];
        } else {
            $params = ['sort' => $key, 'dir' => 'asc', 'page' => 1];
        }

        return request()->fullUrlWithQuery($params);
    };
@endphp

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
        <a href="{{ $nextSortUrl('created_at') }}" class="flex items-center gap-2">
            Created at <x-icons.sort-icon />
        </a>
    </p>
    <p
        class='h-20 pl-6 flex items-center text-black font-normal text-lg leading-none tracking-normal gap-2 border-b border-[#E0E3E7]'>
        <a href="{{ $nextSortUrl('due_date') }}" class="flex items-center gap-2">
            Due Date <x-icons.sort-icon />
        </a>
    </p>
    <p
        class='h-20 pl-6 flex items-center text-black font-normal text-lg leading-none tracking-normal border-b border-[#E0E3E7]'>
        Actions
    </p>
</div>
