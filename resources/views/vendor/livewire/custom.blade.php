<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)
        <div class="mb-5">
            <ul class="pagination float-end">
                <li class="page-item page-prev disabled">
                    @if ($paginator->onFirstPage())
                        <a class="page-link" href="#" tabindex="-1">Prev</a>
                    @else
                        <a wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="page-link" href="#" tabindex="-1">Prev</a>
                    @endif
                </li>

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}" class="page-item">
                                @if ($page == $paginator->currentPage())
                                    <a class="page-link" href="#">{{ $page }}</a>
                                @else
                                    <a wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" class="page-link" href="#" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach

                <li class="page-item page-next">
                    @if ($paginator->hasMorePages())
                        <a wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="page-link" href="#">Next</a>
                    @else
                        <a class="page-link" href="#">Next</a>
                    @endif
                </li>
            </ul>
        </div>
    @endif
</div>

