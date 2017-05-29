@extends('layouts.app')
@section('content')
	<div class="page-bg" style="background-image: url('{!! asset('static/jsj/images/page-bg-3.png') !!}')">
		<div class="title">
			<div class="mask"></div>
			<h2>公司介绍</h2>
		</div>
	</div>
	<div class="list-body">
		<div class="container">
			<div class="nav_menu col-md-3 col-lg-3">
				<ul>
					<li class="active">
						<span class="pendant"></span>
						<a class="active" href="#">公司简介</a>
						<span class="arrow glyphicon glyphicon-chevron-right"></span>
					</li>
					<li>
						<span class="pendant"></span>
						<a class="active" href="#">资质证书</a>
						<span class="arrow glyphicon glyphicon-chevron-right"></span>
					</li>
				</ul>
			</div>
			<div class="main-page col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<div class="header">
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li><a href="#">Library</a></li>
						<li class="active">Data</li>
					</ol>
				</div>
				<div class="body">
					<h1>计算机学院：举办2017届毕业生干部座谈会</h1>
					<div class="content">
						5月24日上午，计算机学院于A201举办2017届毕业生干部座谈会，党总支书记许江荣、副书记吴兆文、党政办主任彭飞、计科专业辅导员李晓燕、2017届辅导员冯笑炜参加，座谈会由吴兆文主持。
						许江荣首先对大家三年来的工作辛苦表示感谢，对近期的创新创业成果表示祝贺，并就毕业设计答辩、离校前相关工作进行了部署和要求。
						会议成立了以4个班级班长、团支部书记为负责人的计算机学院2017届校
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection