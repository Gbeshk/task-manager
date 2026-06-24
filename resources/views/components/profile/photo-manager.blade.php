@props([
    'profileSrc',
    'coverSrc',
    'defaultProfile',
    'defaultCover',
    'deleteProfileOld' => '0',
    'deleteCoverOld' => '0',
])

<h2 class='font-normal text-base mt-16 leading-4 tracking-normal text-center uppercase text-[#2F363D]'>
    {{ __('messages.change_photos') }}
</h2>

<div x-data="{
    profileSrc: '{{ $profileSrc }}',
    coverSrc: '{{ $coverSrc }}',
    defaultProfile: '{{ $defaultProfile }}',
    defaultCover: '{{ $defaultCover }}',
    shouldDeleteProfile: {{ $deleteProfileOld === '1' ? 'true' : 'false' }},
    shouldDeleteCover: {{ $deleteCoverOld === '1' ? 'true' : 'false' }},
    showError: true,
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

    <x-profile.photo-row type="profile" label="{{ __('messages.upload_profile') }}" thumbnail-class="rounded-full"
        src-bind="profileSrc" input-ref="profileInput" upload-method="uploadProfile($event)"
        delete-method="deleteProfile()" />

    <x-profile.photo-row type="cover" label="{{ __('messages.upload_cover') }}" thumbnail-class="rounded-l-2xl"
        src-bind="coverSrc" input-ref="coverInput" upload-method="uploadCover($event)" delete-method="deleteCover()" />
</div>
