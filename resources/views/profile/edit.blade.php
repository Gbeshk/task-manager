<x-layouts.app title="Edit Profile">
    <div class='flex mt-10 gap-9 w-365 h-236 mx-auto'>
        <x-dashboard.sidebar />

        <div class="w-289.25 flex items-center flex-col">
            <h1 class='font-bold text-3xl leading-4 tracking-normal text-center uppercase text-[#2F363D] mt-14'>
                Profile
            </h1>

            <div class="mt-4">
                <x-auth.input name="email" height="h-17.5" label="Email" value="{{ auth()->user()->email }}"
                    :readonly="true" :muted="true" />
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
                    Change
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
