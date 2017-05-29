@extends('layouts.app')

@inject('navigation', 'App\T\Navigation\Navigation')

@section('title'){!! $navigation->getActiveNav()->cate_name!!}@endsection

@section('content')
	@include('post.particals.category_bg')
	<div class="list-body">
		<div class="container">
			@include('post.particals.category_side_nav')
			<div class="main-page col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<div class="header">
					{!! Breadcrumbs::render('category', $navigation) !!}
				</div>
				<div class="body">
					<h1>{!! $pagePost->title !!}</h1>
					<div class="content">@if(!is_null($pagePost->content))
							{!! $pagePost->content->content !!}
						@endif</div>
				</div>
			</div>
		</div>
	</div>
@endsection