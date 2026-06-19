@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'autocomplete' => 'off',
    'mt' => 'mt-6',
    'height' => '78',
    'readonly' => false,
    'muted' => false,
])
@php
    $isTall = $height === 'h-40';
    $heightClass = $height;
    $errorKey = str_replace(['[', ']'], ['.', ''], $name);
    $errorKey = rtrim($errorKey, '.');
@endphp
<div x-data="{
    hasError: {{ $errors->has($errorKey) ? 'true' : 'false' }},
    showError: {{ $errors->has($errorKey) ? 'true' : 'false' }},
}">

    <div :class="hasError ? 'ring-1 ring-[#E91818] focus-within:ring-0 focus-within:border-[#499AF9]' :
        '{{ $readonly ? '' : 'hover:border-[#499AF9]' }}'"
        class="relative {{ $mt }} w-115.5 {{ $heightClass }} rounded-xl border border-transparent px-6 flex items-start transition-all
        {{ $readonly ? 'bg-[#F6F8FA] cursor-not-allowed' : 'bg-[#F6F8FA] focus-within:border-[#499AF9]' }}">
        @if ($isTall)
            <textarea id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
                @input="hasError = false; showError = false"
                class="peer w-full h-full bg-transparent outline-none pt-9 pb-2 text-base text-[#2F363D] placeholder-transparent focus:placeholder-[#959DA5] resize-none">{{ $value }}</textarea>
        @else
            <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}"
                value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="{{ $autocomplete }}"
                {{ $readonly ? 'readonly' : '' }} @input="hasError = false; showError = false; formatDate($event)"
                class="peer w-full h-full bg-transparent outline-none pt-6 text-base placeholder-transparent focus:placeholder-[#959DA5]
        {{ $muted ? 'text-[#959DA5] cursor-not-allowed caret-transparent select-none' : 'text-[#2F363D]' }}" />
        @endif
        <label for="{{ $name }}"
            class="absolute left-6 transition-all duration-200 pointer-events-none

        top-4 text-xs
        {{ $muted ? 'text-[#959DA5]' : 'text-[#959DA5]' }}
        peer-placeholder-shown:top-6 peer-placeholder-shown:text-base {{ $isTall ? 'peer-placeholder-shown:text-[#2F363D]' : 'peer-placeholder-shown:text-[#586069]' }}
        peer-focus:top-4 peer-focus:text-xs
        {{ $muted ? 'peer-focus:text-[#959DA5]' : 'peer-focus:text-[#2F363D]' }}">
            {{ $label }}
        </label>
    </div>
    @error($errorKey)
        <p x-show="showError"
            style="font-family: Helvetica; font-weight: 400; font-size: 12px; line-height: 16px; letter-spacing: 0px; color: #E91818;"
            class="mt-2">
            {{ $message }}
        </p>
    @enderror
</div>
