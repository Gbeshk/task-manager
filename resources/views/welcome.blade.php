<!DOCTYPE html>
<html lang="en">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Login</title>
</head>

<body class="mt-10">
    <div class="flex items-center justify-between w-315.5 mx-auto">
        <div class="w-175 h-236 rounded-l-[50px]">
            <img src="/images/defaultCover.png" class="w-full h-full object-cover" alt="">
        </div>

        <div class="w-115.5">
            <div class="items-center flex justify-between">
                <div class="h-10">
                    <h1 class="font-bold text-[32px] leading-4 uppercase text-[#2F363D]">Welcome back!</h1>
                    <p class="font-normal text-[16px] mt-4 leading-4 text-[#6A737D]">Please enter your details</p>
                </div>
                <img src="/images/icons/smileIcon.svg" alt="" class="w-15 h-12">
            </div>

            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <div x-data="{ hasError: {{ $errors->has('email') ? 'true' : 'false' }}, showError: {{ $errors->has('email') ? 'true' : 'false' }} }"
                    :class="hasError ? 'ring-1 ring-[#E91818] focus-within:ring-0 focus-within:border-[#499AF9]' :
                        'hover:border-[#499AF9]'"
                    class="relative mt-14 w-115.5 h-19.5 rounded-[14px] bg-[#F6F8FA] border border-transparent focus-within:border-[#499AF9] px-6 flex items-center transition-all">

                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="Write your email" autocomplete="email" @input="hasError = false; showError = false"
                        class="peer w-full h-full bg-transparent outline-none pt-6 font-[Helvetica] text-base text-[#2F363D] placeholder-transparent focus:placeholder-[#586069]/50" />

                    <label for="email"
                        class="absolute left-6 font-[Helvetica] transition-all duration-200 pointer-events-none
                        top-4 text-xs text-[#959DA5]
                        peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-[#586069]
                        peer-focus:top-4 peer-focus:translate-y-0 peer-focus:text-xs peer-focus:text-[#2F363D]">
                        E-mail
                    </label>

                    @error('email')
                        <p x-show="showError"
                            class="absolute -bottom-6 left-2 text-[#E91818] text-xs font-normal font-[Helvetica] leading-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                @error('email')
                    <div class="h-6"></div>
                @enderror

                <div x-data="{ hasError: {{ $errors->has('password') ? 'true' : 'false' }}, showError: {{ $errors->has('password') ? 'true' : 'false' }}, showPassword: false }"
                    :class="hasError ? 'ring-1 ring-[#E91818] focus-within:ring-0 focus-within:border-[#499AF9]' :
                        'hover:border-[#499AF9]'"
                    class="relative mt-6 w-115.5 h-19.5 rounded-[14px] bg-[#F6F8FA] border border-transparent focus-within:border-[#499AF9] pl-6 pr-14 flex items-center transition-all">

                    <input id="password" :type="showPassword ? 'text' : 'password'" name="password"
                        placeholder="Write your password" autocomplete="current-password"
                        @input="hasError = false; showError = false"
                        class="peer w-full h-full bg-transparent outline-none pt-6 font-[Helvetica] text-base text-[#2F363D] placeholder-transparent focus:placeholder-[#586069]/50" />

                    <label for="password"
                        class="absolute left-6 font-[Helvetica] transition-all duration-200 pointer-events-none
                        top-4 text-xs text-[#959DA5]
                        peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-[#586069]
                        peer-focus:top-4 peer-focus:translate-y-0 peer-focus:text-xs peer-focus:text-[#2F363D]">
                        Password
                    </label>

                    <button type="button" @click="showPassword = !showPassword"
                        class="absolute right-6 top-1/2 -translate-y-1/2 focus:outline-none"
                        :aria-label="showPassword ? 'Hide password' : 'Show password'">
                        <svg x-show="showPassword" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                stroke="#2F363D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                stroke="#2F363D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg x-show="!showPassword" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.94 17.94C16.2306 19.243 14.1491 19.9649 12 20C5 20 1 12 1 12C2.24389 9.68192 3.96914 7.65663 6.06 6.06003M9.9 4.24002C10.5883 4.0789 11.2931 3.99836 12 4.00003C19 4.00003 23 12 23 12C22.393 13.1356 21.6691 14.2048 20.84 15.19M14.12 14.12C13.8454 14.4148 13.5141 14.6512 13.1462 14.8151C12.7782 14.9791 12.3809 15.0673 11.9781 15.0744C11.5753 15.0815 11.1752 15.0074 10.8016 14.8565C10.4281 14.7056 10.0887 14.4811 9.80385 14.1962C9.51897 13.9113 9.29439 13.572 9.14351 13.1984C8.99262 12.8249 8.91853 12.4247 8.92563 12.0219C8.93274 11.6191 9.02091 11.2219 9.18488 10.8539C9.34884 10.4859 9.58525 10.1547 9.88 9.88003"
                                stroke="#2F363D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1 1L23 23" stroke="#2F363D" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>

                    @error('password')
                        <p x-show="showError"
                            class="absolute -bottom-6 left-2 text-[#E91818] text-xs font-normal font-[Helvetica] leading-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                @error('password')
                    <div class="h-6"></div>
                @enderror

                <button type="submit"
                    class="w-115.5 h-19.5 mt-6 rounded-[14px] bg-[#499AF9] flex items-center justify-center text-white font-[Helvetica] text-base">
                    Log in
                </button>
            </form>
        </div>
    </div>
</body>

</html>
