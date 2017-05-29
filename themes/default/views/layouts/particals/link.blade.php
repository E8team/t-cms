{{--友情链接--}}
@inject('link', 'App\T\Link\Link')

<div class="link">
    <div class="container">
        <h3>友情链接</h3>
        @foreach($link->getLinkWithoutTypeFromCache() as $linkItem)
            <a href="{{ $linkItem->url }}" target="_blank" title="{{ $linkItem->name }}">
                @if(!is_null($linkItem->logo))
                    <img lazy src="{{ $linkItem->getLogoUrl('md') }}">
                    @else
                    {!! $linkItem->name !!}
                @endif
            </a>
        @endforeach
    </div>
</div>