@props(['task'])

<div class='grid grid-cols-[25fr_30fr_12fr_12fr_22fr] items-center'>
    <p
        class='h-16 pl-10 flex items-center text-[#6A737D] font-normal text-lg leading-none tracking-normal truncate pr-2'>
        {{ $task->title }}
    </p>
    <p class='h-16 pl-6 flex items-center text-[#6A737D] font-normal text-lg leading-none tracking-normal truncate pr-2'>
        {{ $task->description }}
    </p>
    <p class='h-16 pl-6 flex items-center text-[#6A737D] font-normal text-lg leading-none tracking-normal'>
        {{ $task->created_at ? $task->created_at->format('d/m/Y') : '—' }}
    </p>
    <p
        class='h-16 pl-6 flex items-center font-normal text-lg leading-none tracking-normal {{ $task->due_date && $task->due_date->isPast() ? 'text-[#E91818]' : 'text-[#6A737D]' }}'>
        {{ $task->due_date ? $task->due_date->format('d/m/Y') : '—' }}
    </p>
    <div class='h-16 pl-6 flex items-center gap-7.5'>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="font-normal text-base leading-4 cursor-pointer tracking-normal underline decoration-solid">
                Delete
            </button>
        </form>
        <button
            class="font-normal text-base leading-4 cursor-pointer tracking-normal underline decoration-solid">Edit</button>
        <a href="{{ route('tasks.show', $task->id) }}"
            class="font-normal text-base leading-4 cursor-pointer tracking-normal underline decoration-solid">
            Show
        </a>
    </div>
</div>
