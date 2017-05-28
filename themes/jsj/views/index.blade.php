@extends('layouts.app')

@section('content')
{!! Facades\App\T\Widgets\Banner::render() !!}
<div class="focus-news">
    <div class="container">
        <div class="news-panel col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="header">
                <h3>学院要闻</h3>
                <a class="more" href="#" target="_blank">更多</a>
            </div>
            <div class="body">
                <div class="top-carousel col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="wrapper">
                        <div class="top-carousel-item">
                            <a href="#">
                                <img src="http://www.pku.edu.cn/img/news/484d7eb258891a6d376b27.JPG" alt="">
                                <h3>拓展合作共赢局面，推进生源基地建设工作</h3>
                                <p>为了加强校际联系，扩大我校招生宣传，根据学校统一部署，5月16日-18日，计算机学院学院党政领导与党政办主任等一行五人先后走访了源潭中学、</p>
                            </a>
                        </div>
                    </div>
                </div>
                <ul class="currency-list focus-currency-list col-md-7 col-lg-7 col-xs-12 col-sm-12">
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="news-panel col-xs-12 col-sm-12 col-md-4 col-lg-4 notice">
            <div class="header">
                <h3>通知公告</h3>
                <a class="more" href="#" target="_blank">更多</a>
            </div>
            <div class="body">
                <ul class="notice-list">
                    <li>
                        <div class="notice-time">
                            <div class="day">23</div>
                            <div class="month">5月</div>
                        </div>
                        <div class="title">
                            <a href="#">计算机推荐2017届品学兼优毕业生公示</a>
                            <span class="author">admin</span>
                        </div>
                    </li>
                    <li>
                        <div class="notice-time">
                            <div class="day">23</div>
                            <div class="month">5月</div>
                        </div>
                        <div class="title">
                            <a href="#">计算机推荐2017届品学兼优毕业生公示</a>
                            <span class="author">admin</span>
                        </div>
                    </li>
                    <li>
                        <div class="notice-time">
                            <div class="day">23</div>
                            <div class="month">5月</div>
                        </div>
                        <div class="title">
                            <a href="#">计算机推荐2017届品学兼优毕业生公示</a>
                            <span class="author">admin</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="splitter-bar">
    <div class="mask">工程&nbsp;&nbsp;&nbsp;应用&nbsp;&nbsp;&nbsp;实践&nbsp;&nbsp;&nbsp;创新</div>
    <div class="container"><img src="{!! asset('static/jsj/images/splitter.png') !!}" alt=""></div>
</div>
<div class="news">
    <div class="container">
        <div class="news-panel  col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="header">
                <h3>学院要闻</h3>
                <a class="more" href="#" target="_blank">更多</a>
            </div>
            <div class="body">
                <ul class="currency-list">
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="news-panel  col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="header">
                <h3>学院要闻</h3>
                <a class="more" href="#" target="_blank">更多</a>
            </div>
            <div class="body">
                <ul class="currency-list">
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="news-panel  col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="header">
                <h3>学院要闻</h3>
                <a class="more" href="#" target="_blank">更多</a>
            </div>
            <div class="body">
            <ul class="currency-list">
                <li class="item">
                    <a href="#">附属中山医院多学科协作与精细化发展</a>
                    <div class="time">6个小时前</div>
                </li>
                <li class="item">
                    <a href="#">附属中山医院多学科协作与精细化发展</a>
                    <div class="time">6个小时前</div>
                </li>
                <li class="item">
                    <a href="#">附属中山医院多学科协作与精细化发展</a>
                    <div class="time">6个小时前</div>
                </li>
                <li class="item">
                    <a href="#">附属中山医院多学科协作与精细化发展</a>
                    <div class="time">6个小时前</div>
                </li>
                <li class="item">
                    <a href="#">附属中山医院多学科协作与精细化发展</a>
                    <div class="time">6个小时前</div>
                </li>
                <li class="item">
                    <a href="#">附属中山医院多学科协作与精细化发展</a>
                    <div class="time">6个小时前</div>
                </li>
                <li class="item">
                    <a href="#">附属中山医院多学科协作与精细化发展</a>
                    <div class="time">6个小时前</div>
                </li>
                <li class="item">
                    <a href="#">附属中山医院多学科协作与精细化发展</a>
                    <div class="time">6个小时前</div>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>
<div class="special">
    <div class="container">
        <h3 class="title">专题推荐</h3>
        <div class="body">
            <div class="top_special">
                <a href="#">
                    <div class="image">
                        <img src="http://www.fudan.edu.cn/2016/images/lxyz.jpg" alt="">
                    </div>
                    <div class="footer">
                        <h4>“两学一做”学习教育专题</h4>
                        <p>发布复“两学一做”教育实施动态及学习参考等学习教育，具体指的是：“1. 学习共产党党章党规，2. 学习贯彻习近平总。</p>
                    </div>
                </a>
            </div>
            <ul class="special-list">
                <li>
                    <div class="detail">
                        <a class="title" href="#">智圆行方的世界——中国传统文化概论</a>
                        <p>本课既非以哲学史、亦非以思想史、更非以断代史的方式介绍中华优秀传统文化，而是从中华优秀传统文化的文化精神及思维方式入手，展开中华文化的历史画卷。您想了解中华</p>
                    </div>
                    <a class="image" href="#">
                        <img src="http://www.fudan.edu.cn/2016/images/hanbingguan.jpg" alt="">
                    </a>
                </li>
                <li>
                    <div class="detail">
                        <a class="title" href="#">智圆行方的世界——中国传统文化概论</a>
                        <p>本课既非以哲学史、亦非以思想史、更非以断代史的方式介绍中华优秀传统文化，而是从中华优秀传统文化的文化精神及思维方式入手，展开中华文化的历史画卷。您想了解中华</p>
                    </div>
                    <a class="image" href="#">
                        <img src="http://www.fudan.edu.cn/2016/images/hanbingguan.jpg" alt="">
                    </a>
                </li>
                <li>
                    <div class="detail">
                        <a class="title" href="#">智圆行方的世界——中国传统文化概论</a>
                        <p>本课既非以哲学史、亦非以思想史、更非以断代史的方式介绍中华优秀传统文化，而是从中华优秀传统文化的文化精神及思维方式入手，展开中华文化的历史画卷。您想了解中华</p>
                    </div>
                    <a class="image" href="#">
                        <img src="http://www.fudan.edu.cn/2016/images/hanbingguan.jpg" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="mask"></div>
</div>
<div class="image-link">
    <div class="container">
        <div class="image-link-item col-md-3 col-lg-3 col-xs-12 col-sm-6">
            <a href="#">
                <img src="http://www.xinhuanet.com/titlepic/112052/1120522872_1489022225269_title0h.jpg" alt="">
            </a>
        </div>
        <div class="image-link-item col-md-3 col-lg-3 col-xs-12 col-sm-6">
            <a href="#">
                <img src="http://211.70.176.141/jxx/Public/e8admin/upload/image/2017-02-23/58ae7b538dc3a.png" alt="">
            </a>
        </div>
        <div class="image-link-item col-md-3 col-lg-3 col-xs-12 col-sm-6">
            <a href="#">
                <img src="http://211.70.176.141/fxy/Public/upload/image/20170324/58d52e505f0fd.png" alt="">
            </a>
        </div>
        <div class="image-link-item col-md-3 col-lg-3 col-xs-12 col-sm-6">
            <a href="#">
                <img src="http://211.70.176.141/fxy/Public/upload/image/20170324/58d5280d497a8.jpg" alt="">
            </a>
        </div>
    </div>
</div>
<div class="friendship-link">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>院系设置</h3>
            <ul class="links">
                <li>
                    <a href="#">计算机学院</a>
                </li>
                <li>
                    <a href="#">法学院</a>
                </li>
                <li>
                    <a href="#">文传学院</a>
                </li>
                <li>
                    <a href="#">化学与材料工程学院</a>
                </li>
                <li>
                    <a href="#">美术与设计学院</a>
                </li>
                <li>
                    <a href="#">电子工程学院</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>院系设置</h3>
            <ul class="links">
                <li>
                    <a href="#">计算机学院</a>
                </li>
                <li>
                    <a href="#">法学院</a>
                </li>
                <li>
                    <a href="#">文传学院</a>
                </li>
                <li>
                    <a href="#">化学与材料工程学院</a>
                </li>
                <li>
                    <a href="#">美术与设计学院</a>
                </li>
                <li>
                    <a href="#">电子工程学院</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection