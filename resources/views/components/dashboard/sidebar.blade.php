<div class='w-44 shrink-0 h-236 bg-[#F6F8FA] rounded-xl flex flex-col items-center justify-between'>
    <div class="flex flex-col items-center">
        <a href="{{ route('profile.edit') }}" class="w-16 h-16 mt-6 rounded-full overflow-hidden">
            <img src="{{ auth()->user()->profile_picture
                ? asset('storage/' . auth()->user()->profile_picture)
                : asset('images/default-avatar.png') }}"
                alt="{{ __('messages.profile_photo') }}" class="w-full h-full object-cover">
        </a>
        <div class='mt-28 flex flex-col gap-9'>
            <a href="{{ route('tasks.index') }}" class="flex items-center gap-2">
                <x-icons.tasks-icon />
                <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>{{ __('messages.my_tasks') }}
                </p>
            </a>
            <a href="{{ route('tasks.due') }}" class="flex items-center gap-2">
                <x-icons.due-tasks-icon />
                <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>
                    {{ __('messages.due_tasks') }}</p>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2">
                <x-icons.profile-icon />
                <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>{{ __('messages.profile') }}
                </p>
            </a>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="mb-9">
        @csrf
        <button type="submit" class="flex items-center gap-2 cursor-pointer">
            <x-icons.log-out-icon />
            <p class='font-normal text-lg leading-none text-[#2F363D] tracking-normal'>{{ __('messages.log_out') }}</p>
        </button>
    </form>

</div>
