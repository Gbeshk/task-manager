@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'autocomplete' => 'off',
    'mt' => 'mt-6',
])
<div x-data="{ hasError: {{ $errors->has($name) ? 'true' : 'false' }}, showError: {{ $errors->has($name) ? 'true' : 'false' }} }"
    :class="hasError ? 'ring-1 ring-[#E91818] focus-within:ring-0 focus-within:border-[#499AF9]' : 'hover:border-[#499AF9]'"
    class="relative {{ $mt }} w-115.5 h-19.5 rounded-xl bg-[#F6F8FA] border border-transparent focus-within:border-[#499AF9] px-6 flex items-center transition-all">
    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"
        placeholder="{{ $placeholder }}" autocomplete="{{ $autocomplete }}" @input="hasError = false; showError = false"
        class="peer w-full h-full bg-transparent outline-none pt-6 font-[Helvetica] text-base text-[#2F363D] placeholder-transparent focus:placeholder-[#586069]/50" />
    <label for="{{ $name }}"
        class="absolute left-6 font-[Helvetica] transition-all duration-200 pointer-events-none
        top-4 text-xs text-[#959DA5]
        peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-[#586069]
        peer-focus:top-4 peer-focus:translate-y-0 peer-focus:text-xs peer-focus:text-[#2F363D]">
        {{ $label }}
    </label>
    @error($name)
        <p x-show="showError"
            class="absolute -bottom-6 left-2 text-[#E91818] text-xs font-normal font-[Helvetica] leading-none">
            {{ $message }}
        </p>
    @enderror
</div>
@error($name)
    <div class="h-6"></div>
@enderror
