@extends('layouts.app')
@inject('navigation', 'App\T\Navigation\Navigation')
@section('content')
	<div class="content container">
		{!! Breadcrumbs::render('category', $navigation) !!}
		<div class="main col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="page">
				<div class="header">
					<h1>{!! $pagePost->title !!}</h1>
				</div>
				<div class="page_content">
					@if(!is_null($pagePost->content))
						{!! $pagePost->content->content !!}
					@endif
				</div>
			</div>
		</div>
		@component('layouts.particals.side', ['category' => $navigation->getCurrentNav()])@endcomponent
	</div>
@endsection