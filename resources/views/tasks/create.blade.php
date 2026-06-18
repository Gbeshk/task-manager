<x-layouts.app title="Dashboard">
    <div class='flex mt-10 gap-9 w-365 h-236 mx-auto'>
        <x-dashboard.sidebar />
        <div class="w-289.25 flex items-center flex-col">
            <h1 class='font-bold text-3xl leading-4 tracking-normal text-center uppercase text-[#2F363D] mt-23'>
                CREATE TASK
            </h1>
            <form method="POST" action="{{ route('tasks.store') }}" class="mt-4 flex flex-col items-center">
                @csrf
                <x-auth.input name="title_en" label="Task name in English" placeholder="Write task name in English"
                    value="{{ old('title_en') }}" height="78" />
                <x-auth.input name="title_ka" label="Task name in Georgian" placeholder="Write task name in Georgian"
                    value="{{ old('title_ka') }}" height="78" mt="mt-6" />
                <x-auth.input name="description_en" label="Description in English"
                    placeholder="Write description in English" value="{{ old('description_en') }}" height="160"
                    mt="mt-6" />
                <x-auth.input name="description_ka" label="Description in Georgian"
                    placeholder="Write description in Georgian" value="{{ old('description_ka') }}" height="160"
                    mt="mt-6" />
                <div x-data="{
                    mask(e) {
                        const input = e.target;
                        const isBackspace = e.inputType === 'deleteContentBackward';
                        let v = input.value.replace(/\D/g, '').slice(0, 6);
                        if (!isBackspace) {
                            if (v.length >= 5) v = v.slice(0, 2) + '/' + v.slice(2, 4) + '/' + v.slice(4);
                            else if (v.length >= 3) v = v.slice(0, 2) + '/' + v.slice(2);
                        } else {
                            if (v.length >= 5) v = v.slice(0, 2) + '/' + v.slice(2, 4) + '/' + v.slice(4);
                            else if (v.length >= 3) v = v.slice(0, 2) + '/' + v.slice(2);
                        }
                        input.value = v;
                    }
                }" class="mt-6">
                    <x-auth.input name="due_date" label="Due date" type="text" placeholder="DD/MM/YY"
                        value="{{ old('due_date') }}" height="70" mt="" x-on:input.capture="mask($event)" />
                </div>
                <button type="submit"
                    class="mt-6 w-115.5 h-17 rounded-xl bg-[#499AF9] text-white font-bold text-base leading-4 tracking-normal text-center uppercase">
                    Create Task
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
