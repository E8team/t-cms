{{--友情链接--}}
@inject('link', 'App\T\Link\Link')

<div class="link">
    <div class="container">
        <h3>友情链接</h3>
        @foreach($link->getLinkWithoutTypeFromCache() as $linkItem)
            <a href="{!! $linkItem->url !!}" target="_blank" title="{!! $linkItem->name !!}">
                <img lazy src="{!! $linkItem->logoUrls['md'] !!}">
            </a>
        @endforeach
    </div>
</div>