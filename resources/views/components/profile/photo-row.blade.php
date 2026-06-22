@props(['type', 'label', 'thumbnailClass', 'srcBind', 'inputRef', 'uploadMethod', 'deleteMethod'])

<div class='flex items-center mt-10 ml-31.5'>

    <div class='w-31 h-31 ml-2 {{ $thumbnailClass }} overflow-hidden bg-gray-200'>
        <img :src="{{ $srcBind }}" class="w-full h-full object-cover" alt="{{ $label }}" />
    </div>

    <input type="file" name="{{ $type }}_picture" accept="image/*,image/svg+xml" class="hidden"
        x-ref="{{ $inputRef }}" @change="{{ $uploadMethod }}" />

    <button type="button" @click="$refs.{{ $inputRef }}.click()"
        class='border border-[#499AF9] cursor-pointer hover:bg-[#499AF914] transition-all duration-300 ease-in-out rounded-2xl px-12 py-4.5 ml-5.5 flex items-center justify-center gap-3 text-[#499AF9] font-bold text-base leading-4 tracking-normal text-center uppercase'>
        <x-icons.upload-picture-icon />
        {{ $label }}
    </button>

    <button type="button" @click="{{ $deleteMethod }}"
        class='px-12 py-4.5  ml-1 flex items-center justify-center transition-all duration-300 ease-in-out font-bold text-base leading-4 tracking-normal text-center uppercase text-[#586069] hover:text-red-500 transition-colors cursor-pointer'>
        {{ __('messages.delete_btn') }}
    </button>

</div>
