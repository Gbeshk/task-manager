@props(['name', 'label', 'value' => '', 'mt' => 'mt-6'])
<div x-data="{
    hasError: {{ $errors->has($name) ? 'true' : 'false' }},
    showError: {{ $errors->has($name) ? 'true' : 'false' }},
    mask(e) {
        let cursorPosition = e.target.selectionStart;
        let originalLength = e.target.value.length;
        let digits = e.target.value.replace(/\D/g, '');
        if (digits.length > 6) digits = digits.slice(0, 6);
        let formatted = '';
        if (digits.length > 0) formatted += digits.slice(0, 2);
        if (digits.length > 2) formatted += '/' + digits.slice(2, 4);
        if (digits.length > 4) formatted += '/' + digits.slice(4, 6);
        e.target.value = formatted;
        let lengthDifference = formatted.length - originalLength;
        e.target.setSelectionRange(cursorPosition + lengthDifference, cursorPosition + lengthDifference);
    }
}">
    <div :class="hasError ? 'ring-1 ring-[#E91818] focus-within:ring-0 focus-within:border-[#499AF9]' : 'hover:border-[#499AF9]'"
        class="relative {{ $mt }} w-115.5 h-17 rounded-xl bg-[#F6F8FA] border border-transparent focus-within:border-[#499AF9] px-6 flex items-start transition-all">
        <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $value }}"
            placeholder="DD/MM/YY" autocomplete="off" @input="hasError = false; showError = false; mask($event)"
            class="peer w-full h-full bg-transparent outline-none pt-6 text-base text-[#2F363D] placeholder-transparent focus:placeholder-[#959DA5]" />
        <label for="{{ $name }}"
            class="absolute left-6 transition-all duration-200 pointer-events-none
                top-4 text-xs text-[#959DA5]
                peer-placeholder-shown:top-6 peer-placeholder-shown:text-base peer-placeholder-shown:text-[#586069]
                peer-focus:top-4 peer-focus:text-xs peer-focus:text-[#2F363D]">
            {{ $label }}
        </label>
    </div>
    @error($name)
        <p x-show="showError"
            style="font-family: Helvetica; font-weight: 400; font-size: 12px; line-height: 16px; letter-spacing: 0px; color: #E91818;"
            class="mt-2">
            {{ $message }}
        </p>
    @enderror
</div>
