@php $task = $task ?? null; @endphp

<x-auth.input name="title[en]" label="{{ __('messages.task_name_en') }}"
    placeholder="{{ __('messages.write_task_name_en') }}"
    value="{{ old('title.en', $task?->getTranslation('title', 'en') ?? '') }}" height="h-19.5" />

<x-auth.input name="title[ka]" label="{{ __('messages.task_name_ka') }}"
    placeholder="{{ __('messages.write_task_name_ka') }}"
    value="{{ old('title.ka', $task?->getTranslation('title', 'ka') ?? '') }}" height="h-19.5" mt="mt-6" />

<x-auth.input name="description[en]" label="{{ __('messages.description_en') }}"
    placeholder="{{ __('messages.write_description_en') }}"
    value="{{ old('description.en', $task?->getTranslation('description', 'en') ?? '') }}" height="h-40"
    mt="mt-6" />

<x-auth.input name="description[ka]" label="{{ __('messages.description_ka') }}"
    placeholder="{{ __('messages.write_description_ka') }}"
    value="{{ old('description.ka', $task?->getTranslation('description', 'ka') ?? '') }}" height="h-40"
    mt="mt-6" />

<x-auth.date-input name="due_date" label="{{ __('messages.due_date') }}"
    value="{{ old('due_date', $task?->due_date?->format('Y-m-d') ?? '') }}" />
