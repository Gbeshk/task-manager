<x-layouts.app title="{{ __('messages.login_title') }}">
    <div class="mt-10">
        <div class="flex items-center justify-between w-315.5 mx-auto">
            <div class="w-175 h-236 rounded-l-3xl overflow-hidden">
                <img src="{{ $coverPhotoUrl }}" class="w-full h-full object-cover rounded-l-3xl"
                    alt="{{ __('messages.cover_picture_alt') }}">
            </div>

            <div class="w-115.5 h-236 flex flex-col">
                <div class="flex-1 flex flex-col justify-center">
                    <div class="items-center flex justify-between">
                        <div class="h-10">
                            <h1 class="font-bold text-3xl leading-none uppercase text-[#2F363D]">
                                {{ __('messages.welcome_back') }}</h1>
                            <p class="font-normal text-base mt-4 leading-none text-[#6A737D]">
                                {{ __('messages.enter_details') }}</p>
                        </div>
                        <img src="/images/icons/smileIcon.svg" alt="" class="w-15 h-12">
                    </div>
                    <form action="{{ route('login.post') }}" method="POST" novalidate>
                        @csrf
                        <x-auth.input name="email" label="{{ __('messages.email') }}" type="email" height='h-19.5'
                            :value="old('email')" placeholder="{{ __('messages.write_email') }}" autocomplete="email"
                            mt="mt-14" />
                        <x-auth.password-input name="password" label="{{ __('messages.password') }}"
                            placeholder="{{ __('messages.write_password') }}" autocomplete="current-password" />
                        <button type="submit"
                            class="w-115.5 h-19.5 cursor-pointer hover:bg-[#3386E7] transition-all duration-300 ease-in-out mt-6 rounded-xl font-bold text-base leading-4 tracking-normal text-center uppercase bg-[#499AF9] flex items-center justify-center text-white">
                            {{ __('messages.login_btn') }}
                        </button>
                    </form>
                </div>

                <div class="flex justify-center">
                    <x-ui.change-language />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
