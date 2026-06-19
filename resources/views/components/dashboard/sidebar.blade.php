<div class='w-44 shrink-0 h-236 bg-[#F6F8FA] rounded-xl flex flex-col items-center justify-between'>
    <div class="flex flex-col items-center">
        <div class="w-16 h-16 mt-6 rounded-full overflow-hidden">
            <img src="{{ auth()->user()->profile_picture
                ? asset('storage/' . auth()->user()->profile_picture)
                : asset('images/default-avatar.png') }}"
                alt="Profile Photo" class="w-full h-full object-cover">
        </div>
        <div class='mt-28 flex flex-col gap-9'>
            <a href="{{ route('tasks.index') }}" class="flex items-center gap-2">
                <x-icons.tasks-icon />
                <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>My tasks</p>
            </a>
            <a href="{{ route('tasks.due') }}" class="flex items-center gap-2">
                <x-icons.due-tasks-icon />
                <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>Due tasks</p>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2">
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
