<?php

// Index
Breadcrumbs::register('index', function ($breadcrumbs) {
    $breadcrumbs->push('首页', route('index'));
});

Breadcrumbs::register('category', function ($breadcrumbs, \App\T\Navigation\Navigation $navigation) {
    $breadcrumbs->parent('index');
    $breadcrumbs->push($navigation->getTopNav()->cate_name, route('category', $navigation->getTopNav()->cate_slug));

    if (!$navigation->getCurrentNav()->equals($navigation->getTopNav())) {
        $breadcrumbs->push($navigation->getCurrentNav()->cate_name, route('category', $navigation->getCurrentNav()->cate_slug));
    }
});

Breadcrumbs::register('post', function ($breadcrumbs, \App\T\Navigation\Navigation $navigation, $post) {
    $breadcrumbs->parent('category', $navigation);
    $breadcrumbs->push($post->title, route('post', [$navigation->getCurrentNav()->cate_slug, $post->id]));
});
