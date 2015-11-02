@if ($paginator->lastPage() > 1)

<div class="pagination" style="display:inline">
	<ul>
	    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
	        <a href="{{ $paginator->url(1) }}">Previous</a>
	    </li>
	    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
	        <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
	        	<?PHP  $newurl = str_replace('%%%?', '&', $paginator->url($i)); ?>
	            <a href="{{ $newurl }}">{{ $i }}</a>
	        </li>
	    @endfor
	    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
	        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >Next</a>
	    </li>
	</ul>
</div>
@endif