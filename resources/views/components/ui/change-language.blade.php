 <div class='flex items-center  gap-2'>
     <a href="{{ route('lang.switch', 'en') }}"
         class='w-19.5 h-10 font-normal text-base  hover:bg-[#F6F8FA] hover:text-[#2F363D] leading-4 tracking-normal cursor-pointer flex items-center justify-center rounded-xl
                       {{ app()->getLocale() === 'en' ? 'bg-[#F6F8FA] text-[#2F363D]' : 'bg-white text-[#6A737D] ' }}">
'>
         English</a>
     <a href="{{ route('lang.switch', 'ka') }}"
         class='w-24.5 h-10  flex hover:bg-[#F6F8FA] hover:text-[#2F363D] items-font-normal text-base leading-4 tracking-normal  items-center  cursor-pointer justify-center rounded-xl
                       {{ app()->getLocale() !== 'en' ? 'bg-[#F6F8FA] text-[#2F363D]' : 'bg-white text-[#6A737D] ' }}">
'>
         ქართული</a>
 </div>
