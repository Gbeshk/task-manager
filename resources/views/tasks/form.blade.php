<x-auth.input name="title_en" label="Task name in English" placeholder="Write task name in English"
    value="{{ old('title_en', $task->getTranslation('title', 'en') ?? '') }}" height="78" />

<x-auth.input name="title_ka" label="Task name in Georgian" placeholder="Write task name in Georgian"
    value="{{ old('title_ka', $task->getTranslation('title', 'ka') ?? '') }}" height="78" mt="mt-6" />

<x-auth.input name="description_en" label="Description in English" placeholder="Write description in English"
    value="{{ old('description_en', $task->getTranslation('description', 'en') ?? '') }}" height="160"
    mt="mt-6" />

<x-auth.input name="description_ka" label="Description in Georgian" placeholder="Write description in Georgian"
    value="{{ old('description_ka', $task->getTranslation('description', 'ka') ?? '') }}" height="160"
    mt="mt-6" />

<div x-data="{
    mask(e) {
        const input = e.target;
        let v = input.value.replace(/\D/g, '').slice(0, 6);
        if (v.length >= 5) v = v.slice(0, 2) + '/' + v.slice(2, 4) + '/' + v.slice(4);
        else if (v.length >= 3) v = v.slice(0, 2) + '/' + v.slice(2);
        input.value = v;
    }
}" class="mt-6">
    <x-auth.input name="due_date" label="Due date" type="text" placeholder="DD/MM/YY"
        value="{{ old('due_date', $task->due_date?->format('d/m/y') ?? '') }}" height="70" mt=""
        x-on:input.capture="mask($event)" />
</div>
