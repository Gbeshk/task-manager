<x-layouts.app title="{{ __('messages.dashboard') }}">
    <div class='flex mt-10 gap-9 w-365 h-236 mx-auto relative'>
        <x-dashboard.sidebar />

        <div class="w-289.25">
            <div class='flex mt-24 justify-between items-center'>
                <p class='ml-10 mt-4.5 font-bold text-3xl leading-none uppercase text-[#2F363D] tracking-normal'>
                    {{ __('messages.your_tasks') }}
                </p>
                <div class='flex items-center gap-4'>
                    <form action="{{ route('tasks.destroy-due') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-6 py-4 flex items-center transition-all duration-300 ease-in-out hover:bg-[#499AF914] justify-center border border-[#499AF9] rounded-xl cursor-pointer font-bold text-base leading-none uppercase text-[#499AF9] tracking-normal">
                            {{ __('messages.delete_old_tasks') }}
                        </button>
                    </form>
                    <a href="{{ route('tasks.create') }}"
                        class='flex items-center gap-3 px-6 py-4  bg-[#499AF9] justify-center rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#3386E7]'>
                        <x-icons.add-task-icon />
                        <p class="font-bold text-base leading-none uppercase text-white tracking-normal">
                            {{ __('messages.add_task') }}
                        </p>
                    </a>
                </div>
            </div>

            <div class='w-280 h-180 mt-6 flex flex-col justify-between'>
                <div>
                    <x-dashboard.task-table-header :sortBy="$sortBy" :sortDir="$sortDir" />

                    @forelse ($tasks as $task)
                        <x-dashboard.task-row :task="$task" />
                    @empty
                        <p
                            class='h-16 pl-10 flex items-center text-[#999] font-normal text-lg leading-none tracking-normal'>
                            {{ request()->routeIs('tasks.due') ? __('messages.zero_old_tasks') : __('messages.no_tasks_yet') }}
                        </p>
                    @endforelse
                </div>

                {{ $tasks->links() }}
            </div>
        </div>
        <div class='absolute top-226 left-296.5'>
            <x-ui.change-language />
        </div>
    </div>
</x-layouts.app>
