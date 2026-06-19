<x-layouts.app title="Login">
    <div class="mt-10">
        <div class="flex items-center justify-between w-315.5 mx-auto">
            <div class="w-175 h-236 rounded-l-3xl">
                <img src="/images/defaultCover.png" class="w-full h-full object-cover" alt="">
            </div>
            <div class="w-115.5">
                <div class="items-center flex justify-between">
                    <div class="h-10">
                        <h1 class="font-bold text-3xl leading-none uppercase text-[#2F363D]">Welcome back!</h1>
                        <p class="font-normal text-base mt-4 leading-none text-[#6A737D]">Please enter your details</p>
                    </div>
                    <img src="/images/icons/smileIcon.svg" alt="" class="w-15 h-12">
                </div>
                <form action="{{ route('login.post') }}" method="POST" novalidate>
                    @csrf
                    <x-auth.input name="email" label="E-mail" type="email" height='h-19.5' :value="old('email')"
                        placeholder="Write your email" autocomplete="email" mt="mt-14" />
                    <x-auth.password-input name="password" label="Password" placeholder="Write your password"
                        autocomplete="current-password" />
                    <button type="submit"
                        class="w-115.5 h-19.5 cursor-pointer hover:bg-[#3386E7] transition-all duration-300 ease-in-out mt-6 rounded-xl font-bold text-base leading-4 tracking-normal text-center uppercase bg-[#499AF9] flex items-center justify-center text-white">
                        Log in
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
