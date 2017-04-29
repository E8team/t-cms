@extends('layouts.app')
@inject('navigation', 'App\T\Navigation\Navigation')
@section('style')
	<link rel="stylesheet" href="{!! asset('css/page.css') !!}">
@endsection
@section('content')
	@include('particals.navbar')
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
		@include('particals.side')
	</div>
	@include('particals.link')
	@include('particals.footer')
@endsection