import './bootstrap.js'
var original_title = document.title;
var tcms = {
    init: function () {

        $(document).pjax(
            'a:not(a[target="_blank"])', 'body', {
                timeout: 1600,
                maxCacheLength: 500
            }
        );
        $(document).on(
            'pjax:start', function () {
                NProgress.start();
            }
        );
        $(document).on(
            'pjax:end', function () {
                NProgress.done();
            }
        );
        $(document).on(
            'pjax:complete', function () {
                original_title = document.title;
                NProgress.done();

            }
        );
        // Exclude links with a specific attr
        $(document).on("pjax:click", "a[no-pjax]", false);

        // lazyload
        $("img[lazy]").lazyload();
    }
}
$(document).ready(
    function () {
        tcms.init();
    }
);