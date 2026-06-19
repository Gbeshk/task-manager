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
            <h2 class='font-normal text-base mt-16 leading-4 tracking-normal text-center uppercase text-[#2F363D]'>
                Change password
            </h2>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                class="mt-4 flex flex-col items-center">
                @csrf
                @method('PUT')

                <x-auth.password-input name="current_password" label="Current Password"
                    placeholder="Enter current password" autocomplete="current-password" />

                <x-auth.password-input name="new_password" label="New Password" placeholder="Enter new password"
                    autocomplete="new-password" />

                <x-auth.password-input name="new_password_confirmation" label="Retype New Password"
                    placeholder="Retype new password" autocomplete="new-password" />

                <h2 class='font-normal text-base mt-16 leading-4 tracking-normal text-center uppercase text-[#2F363D]'>
                    Change Photos
                </h2>

                <div x-data="{
                    profileSrc: '{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : asset('images/default-avatar.png') }}',
                    coverSrc: '{{ auth()->user()->cover_picture ? Storage::url(auth()->user()->cover_picture) : asset('images/defaultCover.png') }}',
                    defaultProfile: '{{ asset('images/default-avatar.png') }}',
                    defaultCover: '{{ asset('images/defaultCover.png') }}',
                    shouldDeleteProfile: {{ old('delete_profile_picture', '0') === '1' ? 'true' : 'false' }},
                    shouldDeleteCover: {{ old('delete_cover_picture', '0') === '1' ? 'true' : 'false' }},
                    uploadProfile(e) {
                        const file = e.target.files[0];
                        if (!file) return;
                        this.profileSrc = URL.createObjectURL(file);
                        this.shouldDeleteProfile = false;
                    },
                    deleteProfile() {
                        this.profileSrc = this.defaultProfile;
                        this.$refs.profileInput.value = '';
                        this.shouldDeleteProfile = true;
                    },
                    uploadCover(e) {
                        const file = e.target.files[0];
                        if (!file) return;
                        this.coverSrc = URL.createObjectURL(file);
                        this.shouldDeleteCover = false;
                    },
                    deleteCover() {
                        this.coverSrc = this.defaultCover;
                        this.$refs.coverInput.value = '';
                        this.shouldDeleteCover = true;
                    }
                }">
                    <input type="hidden" name="delete_profile_picture" :value="shouldDeleteProfile ? '1' : '0'" />
                    <input type="hidden" name="delete_cover_picture" :value="shouldDeleteCover ? '1' : '0'" />

                    <div class='flex items-center mt-10 ml-31.5'>
                        <div class='w-31 h-31 ml-2 rounded-full overflow-hidden bg-gray-200'>
                            <img :src="profileSrc" class="w-full h-full object-cover" alt="Profile picture" />
                        </div>
                        <input type="file" name="profile_picture" accept="image/*,image/svg+xml" class="hidden"
                            x-ref="profileInput" @change="uploadProfile($event)" />
                        <button type="button" @click="$refs.profileInput.click()"
                            class='border border-[#499AF9] cursor-pointer rounded-2xl w-68 h-15 ml-5.5 flex items-center justify-center gap-3 text-[#499AF9] font-bold text-base leading-4 tracking-normal text-center uppercase'>
                            <x-icons.upload-picture-icon />
                            Upload Profile
                        </button>
                        <button type="button" @click="deleteProfile()"
                            class='w-40 h-15 ml-1 flex items-center justify-center font-bold text-base leading-4 tracking-normal text-center uppercase text-[#586069] hover:text-red-500 transition-colors cursor-pointer'>
                            DELETE
                        </button>
                    </div>

                    <div class='flex items-center mt-17 ml-31.5'>
                        <div class='w-31 h-31 ml-2 rounded-l-2xl overflow-hidden bg-gray-200'>
                            <img :src="coverSrc" class="w-full h-full object-cover" alt="Cover picture" />
                        </div>
                        <input type="file" name="cover_picture" accept="image/*,image/svg+xml" class="hidden"
                            x-ref="coverInput" @change="uploadCover($event)" />
                        <button type="button" @click="$refs.coverInput.click()"
                            class='border border-[#499AF9] cursor-pointer rounded-2xl w-65 h-15 ml-5.5 flex items-center justify-center gap-3 text-[#499AF9] font-bold text-base leading-4 tracking-normal text-center uppercase'>
                            <x-icons.upload-picture-icon />
                            Upload Cover
                        </button>
                        <button type="button" @click="deleteCover()"
                            class='w-40 h-15 ml-1 flex items-center justify-center font-bold text-base leading-4 tracking-normal text-center uppercase text-[#586069] hover:text-red-500 transition-colors cursor-pointer'>
                            DELETE
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="mt-20 mb-10 w-115.5 h-17.5 hover:bg-[#3386E7] transition-all duration-300 ease-in-out cursor-pointer rounded-xl bg-[#499AF9] text-white font-bold text-base leading-4 tracking-normal text-center uppercase">
                    Change
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
