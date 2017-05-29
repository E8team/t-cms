{{--友情链接--}}

<div class="friendship-link">
    <div class="container">
        @foreach(Facades\App\T\Link\Link::getLinkFromCache()->take(2) as $type)
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>{!! $type->name !!}</h3>
            <ul class="links">
                @foreach($type->links as $link)
                <li>
                    <a href="{!! $link->url !!}"  target="_blank" title="{!! $link->name !!}">{!! $link->name !!}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>