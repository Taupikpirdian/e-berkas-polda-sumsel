<div class="mb-5">
    <ul class="pagination float-end">
        <li class="page-item page-prev @if($paginator->onFirstPage()) disabled @endif">
            <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" tabindex="-1">Prev</a>
        </li>

        {{-- Pagination Elements --}}
        @foreach ($elements as $key => $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
              <li wire:key="paginator-page-{{ $key }}" class="page-item">
                  <button class="page-link">{{ $element }}</button>
              </li>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
              @foreach ($element as $page => $url)
                  <li wire:key="paginator-page{{ $page }}" class="page-item @if($page == $paginator->currentPage()) active @endif">
                      <button wire:click="gotoPage({{ $page != $paginator->currentPage() ? $page : $paginator->currentPage() }})" class="page-link" role="button">{{ $page }}</button>
                  </li>
              @endforeach
          @endif
        @endforeach

        <li class="page-item page-next @if(!$paginator->hasMorePages()) disabled @endif">
            <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled">Next</a>
        </li>
    </ul>
</div>