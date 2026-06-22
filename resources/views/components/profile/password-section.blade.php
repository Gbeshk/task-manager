<h2 class='font-normal text-base mt-16 leading-4 tracking-normal text-center uppercase text-[#2F363D]'>
    {{ __('messages.change_password') }}
</h2>

<div class="mt-4 flex flex-col items-center">
    <x-auth.password-input name="current_password" label="{{ __('messages.current_password_label') }}"
        placeholder="{{ __('messages.enter_current_password') }}" autocomplete="current-password" />

    <x-auth.password-input name="new_password" label="{{ __('messages.new_password_label') }}"
        placeholder="{{ __('messages.enter_new_password') }}" autocomplete="new-password" />

    <x-auth.password-input name="new_password_confirmation" label="{{ __('messages.retype_new_password_label') }}"
        placeholder="{{ __('messages.retype_new_password') }}" autocomplete="new-password" />
</div>
