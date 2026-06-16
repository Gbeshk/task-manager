@props(['tasks'])

@if ($tasks->lastPage() > 1)
    @php
        $currentPage = $tasks->currentPage();
        $lastPage = $tasks->lastPage();

        $pages = collect();

        foreach ([1, 2, 3] as $p) {
            if ($p <= $lastPage) {
                $pages->push($p);
            }
        }

        foreach ([$currentPage - 1, $currentPage, $currentPage + 1] as $p) {
            if ($p > 0 && $p <= $lastPage) {
                $pages->push($p);
            }
        }

        foreach ([$lastPage - 2, $lastPage - 1, $lastPage] as $p) {
            if ($p > 0 && $p <= $lastPage) {
                $pages->push($p);
            }
        }

        $pages = $pages->unique()->sort()->values();
        $prev = null;
    @endphp

    <div class="flex items-center gap-2 mx-auto mb-15">
        @foreach ($pages as $page)
            @if ($prev !== null && $page - $prev > 1)
                <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-white"
                    style="font-family: Helvetica; font-weight: 400; font-size: 14px; line-height: 16px; color: #6A737D;">
                    ...
                </span>
            @endif

            @if ($page == $currentPage)
                <span class="w-9 h-9 flex items-center justify-center rounded-lg"
                    style="background-color: #499AF914; font-family: Helvetica; font-weight: 400; font-size: 14px; line-height: 16px; color: #499AF9;">
                    {{ $page }}
                </span>
            @else
                <a href="{{ request()->fullUrlWithQuery(['page' => $page]) }}"
                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-white hover:bg-[#499AF914] hover:text-[#499AF9] transition-colors"
                    style="font-family: Helvetica; font-weight: 400; font-size: 14px; line-height: 16px; color: #6A737D;">
                    {{ $page }}
                </a>
            @endif

            @php $prev = $page; @endphp
        @endforeach
    </div>
@endif
