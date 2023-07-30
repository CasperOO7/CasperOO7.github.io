<x-layout>
@include('partials._hero')
@include('partials._search')
<div
class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
            >
@if (count($items)==0)
    <p>No items available</p>
@endif
@foreach ($items as $item)
<x-list-card :item="$item" />
@endforeach
</div>
{{$items->links()}}
</x-layout>
