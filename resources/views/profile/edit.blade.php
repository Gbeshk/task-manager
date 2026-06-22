<x-layouts.app title="{{ __('messages.edit_profile') }}">
    <div class='flex mt-10 gap-9 w-365 h-236 mx-auto relative'>
        <x-dashboard.sidebar />

        <div class="w-289.25 flex items-center flex-col">
            <h1 class='font-bold text-3xl leading-4 tracking-normal text-center uppercase text-[#2F363D] mt-14'>
                {{ __('messages.profile_title') }}
            </h1>

            <div class="mt-4">
                <x-auth.input name="email" height="h-17.5" label="{{ __('messages.email') }}"
                    value="{{ auth()->user()->email }}" :readonly="true" :muted="true" />
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                class="mt-4 flex flex-col items-center">
                @csrf
                @method('PUT')

                <x-profile.password-section />

                <x-profile.photo-manager :profile-src="auth()->user()->profile_picture
                    ? Storage::url(auth()->user()->profile_picture)
                    : asset('images/default-avatar.png')" :cover-src="$coverSrc" :default-profile="asset('images/default-avatar.png')" :default-cover="asset('images/defaultCover.png')"
                    :delete-profile-old="old('delete_profile_picture', '0')" :delete-cover-old="old('delete_cover_picture', '0')" />

                <button type="submit"
                    class="mt-20 mb-10 w-115.5 h-17.5 hover:bg-[#3386E7] transition-all duration-300 ease-in-out cursor-pointer rounded-xl bg-[#499AF9] text-white font-bold text-base leading-4 tracking-normal text-center uppercase">
                    {{ __('messages.change_btn') }}
                </button>
            </form>
        </div>
        <div class='absolute top-226 left-296.5'>
            <x-ui.change-language />
        </div>
    </div>
</x-layouts.app>
