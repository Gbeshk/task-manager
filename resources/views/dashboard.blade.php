<x-layouts.app title="Dashboard">
    <div class='flex mt-10 gap-9 w-365 h-236 mx-auto'>
        <div class='w-44 shrink-0 h-236 bg-[#F6F8FA] rounded-xl flex flex-col items-center justify-between'>
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 mt-6 rounded-full overflow-hidden">
                    <img src="{{ auth()->user()->profile_picture
                        ? asset('storage/' . auth()->user()->profile_picture)
                        : asset('images/default-avatar.png') }}"
                        alt="Profile Photo" class="w-full h-full object-cover">
                </div>
                <div class='mt-28 flex flex-col gap-9'>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-icons.tasks-icon />
                        <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>My tasks</p>
                    </a>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-icons.due-tasks-icon />
                        <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>Due tasks</p>
                    </a>
                    <a href="/profile" class="flex items-center gap-2">
                        <x-icons.profile-icon />
                        <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>Profile</p>
                    </a>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mb-9">
                @csrf
                <button type="submit" class="flex items-center gap-2 cursor-pointer">
                    <x-icons.log-out-icon />
                    <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>Log out</p>
                </button>
            </form>
        </div>
        <div class="w-289.25">
            <div class='flex mt-25 justify-between items-center'>
                <p class='ml-10 font-bold text-3xl leading-none uppercase text-[#2F363D] tracking-normal'>
                    Your tasks
                </p>
                <div class='flex items-center gap-4'>
                    <button
                        class="w-51.75 h-12 flex items-center justify-center border border-[#499AF9] rounded-xl cursor-pointer font-bold text-base leading-none uppercase text-[#499AF9] tracking-normal">
                        Delete old tasks
                    </button>
                    <button
                        class='flex items-center gap-3 w-41.5 h-12 bg-[#499AF9] justify-center rounded-xl cursor-pointer'>
                        <x-icons.add-task-icon />
                        <p class="font-bold text-base leading-none uppercase text-white tracking-normal">Add task</p>
                    </button>
                </div>
            </div>
            <div class='w-280 h-180 mt-6 flex flex-col justify-between'>
                <div>
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
                            Created at <x-icons.sort-icon />
                        </p>
                        <p
                            class='h-20 pl-6 flex items-center text-black font-normal text-lg leading-none tracking-normal gap-2 border-b border-[#E0E3E7]'>
                            Due Date <x-icons.sort-icon />
                        </p>
                        <p
                            class='h-20 pl-6 flex items-center text-black font-normal text-lg leading-none tracking-normal border-b border-[#E0E3E7]'>
                            Actions
                        </p>
                    </div>

                    @forelse ($tasks as $task)
                        <div class='grid grid-cols-[25fr_30fr_12fr_12fr_22fr] items-center'>
                            <p
                                class='h-16 pl-10 flex items-center text-[#6A737D] font-normal text-lg leading-none tracking-normal truncate pr-2'>
                                {{ $task->title }}
                            </p>
                            <p
                                class='h-16 pl-6 flex items-center text-[#6A737D] font-normal text-lg leading-none tracking-normal truncate pr-2'>
                                {{ $task->description }}
                            </p>
                            <p
                                class='h-16 pl-6 flex items-center text-[#6A737D] font-normal text-lg leading-none tracking-normal'>
                                {{ $task->created_at ? \Carbon\Carbon::parse($task->created_at)->format('d/m/Y') : '—' }}
                            </p>
                            <p
                                class='h-16 pl-6 flex items-center text-[#6A737D] font-normal text-lg leading-none tracking-normal'>
                                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') : '—' }}
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
                                <button
                                    class="font-normal text-base leading-4 cursor-pointer tracking-normal underline decoration-solid">Show</button>
                            </div>
                        </div>
                    @empty
                        <p
                            class='h-16 pl-10 flex items-center text-[#999] font-normal text-lg leading-none tracking-normal'>
                            No tasks yet. Add your first task!
                        </p>
                    @endforelse
                </div>

                <p class="mx-auto mb-15">pagination</p>
            </div>
        </div>
    </div>
</x-layouts.app>
