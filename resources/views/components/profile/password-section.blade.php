<h2 class='font-normal text-base mt-16 leading-4 tracking-normal text-center uppercase text-[#2F363D]'>
    Change password
</h2>

<div class="mt-4 flex flex-col items-center">
    <x-auth.password-input name="current_password" label="Current Password" placeholder="Enter current password"
        autocomplete="current-password" />

    <x-auth.password-input name="new_password" label="New Password" placeholder="Enter new password"
        autocomplete="new-password" />

    <x-auth.password-input name="new_password_confirmation" label="Retype New Password"
        placeholder="Retype new password" autocomplete="new-password" />
</div>
