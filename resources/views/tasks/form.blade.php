@php $task = $task ?? null; @endphp

<x-auth.input name="title[en]" label="Task name in English" placeholder="Write task name in English"
    value="{{ old('title.en', $task?->getTranslation('title', 'en') ?? '') }}" height="h-19.5" />

<x-auth.input name="title[ka]" label="Task name in Georgian" placeholder="Write task name in Georgian"
    value="{{ old('title.ka', $task?->getTranslation('title', 'ka') ?? '') }}" height="h-19.5" mt="mt-6" />

<x-auth.input name="description[en]" label="Description in English" placeholder="Write description in English"
    value="{{ old('description.en', $task?->getTranslation('description', 'en') ?? '') }}" height="h-40"
    mt="mt-6" />

<x-auth.input name="description[ka]" label="Description in Georgian" placeholder="Write description in Georgian"
    value="{{ old('description.ka', $task?->getTranslation('description', 'ka') ?? '') }}" height="h-40"
    mt="mt-6" />

<x-auth.date-input name="due_date" label="Due date"
    value="{{ old('due_date', $task?->due_date?->format('d/m/y') ?? '') }}" />
