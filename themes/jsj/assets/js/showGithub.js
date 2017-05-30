(function(){

    var caches = {};
    $.fn.showGithub = function(user, repo, type, count){

        $(this).each(function(){
            var $e = $(this);

            var user = $e.data('user') || user,
                repo = $e.data('repo') || repo,
                type = $e.data('type') || type || 'watch',
                count = $e.data('count') == 'true' || count || true;

            var $mainButton = $e.html('<span class="github-btn"><a class="btn btn-xs btn-default" href="#" target="_blank"><i class="icon-github"></i> <span class="gh-text"></span></a><a class="gh-count"href="#" target="_blank"></a></span>').find('.github-btn'),
                $button = $mainButton.find('.btn'),
                $text = $mainButton.find('.gh-text'),
                $counter = $mainButton.find('.gh-count');

            function addCommas(a) {
                return String(a).replace(/(\d)(?=(\d{3})+$)/g, '$1,');
            }

            function callback(a) {
                if (type == 'watch') {
                    $counter.html(addCommas(a.watchers));
                } else {
                    if (type == 'fork') {
                        $counter.html(addCommas(a.forks));
                    } else {
                        if (type == 'follow') {
                            $counter.html(addCommas(a.followers));
                        }
                    }
                }

                if (count) {
                    $counter.css('display', 'inline-block');
                }
            }

            function jsonp(url) {
                var ctx = caches[url] || {};
                caches[url] = ctx;
                if(ctx.onload || ctx.data){
                    if(ctx.data){
                        callback(ctx.data);
                    } else {
                        setTimeout(jsonp, 500, url);
                    }
                }else{
                    ctx.onload = true;
                    $.getJSON(url, function(a){
                        ctx.onload = false;
                        ctx.data = a;
                        callback(a);
                    });
                }
            }

            var urlBase = 'https://github.com/' + user + '/' + repo;

            $button.attr('href', urlBase + '/');

            if (type == 'watch') {
                $mainButton.addClass('github-watchers');
                $text.html('Star');
                $counter.attr('href', urlBase + '/stargazers');
            } else {
                if (type == 'fork') {
                    $mainButton.addClass('github-forks');
                    $text.html('Fork');
                    $counter.attr('href', urlBase + '/network');
                } else {
                    if (type == 'follow') {
                        $mainButton.addClass('github-me');
                        $text.html('Follow @' + user);
                        $button.attr('href', 'https://github.com/' + user);
                        $counter.attr('href', 'https://github.com/' + user + '/followers');
                    }
                }
            }

            if (type == 'follow') {
                jsonp('https://api.github.com/users/' + user);
            } else {
                jsonp('https://api.github.com/repos/' + user + '/' + repo);
            }

        });
    };

})();