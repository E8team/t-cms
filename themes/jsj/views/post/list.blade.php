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
                <ul class="list">
                    <li>
                        <div class="info no_cover">
                            <a href="#" title="计算机学院：举办2017届毕业生干部座谈会">
                                <h3><span class="label label-danger">置顶</span>计算机学院：举办2017届毕业生干部座谈会</h3>
                            </a>
                            <p class="describe">5月24日上午，计算机学院于A201举办2017届毕业生干部座谈会，党总支书记许江荣、副书记吴兆文、党政办主任彭飞、计科专业辅导员李晓燕、2017届辅导员冯笑炜参加，座谈会由吴兆文主持。</p>
                            <div class="list_footer">
                                <div class="avatar">
                                    <img src="http://e8-cms.dev/images/default_avatar.jpg" alt="admin">
                                    <span class="uname">admin</span>
                                </div>
                                <p class="time">2017-5-29</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="info">
                            <a class="cover" href="#" title="asd">
                                <img src="http://211.70.176.141/jxx/Public/data/upload/image/20170525/1495685863607737.jpg"/>
                            </a>
                            <a href="#" title="计算机学院：举办2017届毕业生干部座谈会">
                                <h3><span class="label label-danger">置顶</span>计算机学院：举办2017届毕业生干部座谈会</h3>
                            </a>
                            <p class="describe">5月24日上午，计算机学院于A201举办2017届毕业生干部座谈会，党总支书记许江荣、副书记吴兆文、党政办主任彭飞、计科专业辅导员李晓燕、2017届辅导员冯笑炜参加，座谈会由吴兆文主持。</p>
                            <div class="list_footer">
                                <div class="avatar">
                                    <img src="http://e8-cms.dev/images/default_avatar.jpg" alt="admin">
                                    <span class="uname">admin</span>
                                </div>
                                <p class="time">2017-5-29</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection