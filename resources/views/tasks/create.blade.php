<x-layouts.app title="Create Task">
    <div class='flex mt-10 gap-9 w-365 h-236 mx-auto'>
        <x-dashboard.sidebar />
        <div class="w-289.25 flex items-center flex-col">
            <h1 class='font-bold text-3xl leading-4 tracking-normal text-center uppercase text-[#2F363D] mt-23'>
                Create Task
            </h1>
            <form method="POST" action="{{ route('tasks.store') }}" class="mt-4 flex flex-col items-center">
                @csrf
                @include('tasks.form', ['task' => new App\Models\Task()])
                <button type="submit"
                    class="mt-6 w-115.5 h-17 hover:bg-[#3386E7] transition-all duration-300 ease-in-out cursor-pointer rounded-xl bg-[#499AF9] text-white font-bold text-base leading-4 tracking-normal text-center uppercase">
                    Create Task
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
