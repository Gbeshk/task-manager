<x-layouts.app title="Dashboard">
    <div class='flex mt-10 gap-9 w-365 h-236 mx-auto'>
        <x-dashboard.sidebar />

        <div class="w-289.25">
            <div class='flex mt-24 justify-between items-center'>
                <p class='ml-10 mt-4.5 font-bold text-3xl leading-none uppercase text-[#2F363D] tracking-normal'>
                    Your tasks
                </p>
                <div class='flex items-center gap-4'>
                    <form action="{{ route('tasks.destroy-old') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-51.75 h-12 flex items-center transition-all duration-300 ease-in-out hover:bg-[#499AF914] justify-center border border-[#499AF9] rounded-xl cursor-pointer font-bold text-base leading-none uppercase text-[#499AF9] tracking-normal">
                            Delete old tasks
                        </button>
                    </form>
                    <button
                        class='flex items-center gap-3 w-41.5 h-12 bg-[#499AF9] justify-center rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#3386E7]'>
                        <x-icons.add-task-icon />
                        <p class="font-bold text-base leading-none uppercase text-white tracking-normal">Add task</p>
                    </button>
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
                            {{ request()->routeIs('tasks.due') ? 'You have 0 old tasks' : 'No tasks yet. Add your first task!' }}
                        </p>
                    @endforelse
                </div>
                <x-dashboard.pagination {{ $tasks->links() }} />

            </div>
        </div>
    </div>
</x-layouts.app>
