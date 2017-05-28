(function ($, window) {
    'use strict';
    $.fn.tcarousel = function(options) {
        var _self = this;
        var _options = $.extend({
            'height': '460px'
        }, options);

        var imgs = this.find('img');
        var length = imgs.length;
        this.addClass("tcarousel");
        this.css('height', _options.height);
        imgs.css('height', _options.height);

        var imageLoadCounter = 0;
        imgs.each(function () {
            $(this).ready(function () {
                if(++imageLoadCounter >= length){
                    ready();
                }
            })
        })
        function rePos(posIndex) {
            var windowWidth  = $(window).width();
            var litems = _self.find('.item');
            litems.each(function (index, element) {
                if(posIndex == index){
                    element.style.left = (windowWidth - element.offsetWidth) / 2 + 'px';
                }else if(index > posIndex){
                    if(index == length - 1) {
                        element.style.left = litems[0].offsetLeft - litems[0].offsetWidth + 'px';
                    }else {
                        element.style.left = litems[index - 1].offsetLeft + litems[index - 1].offsetWidth + 'px';
                    }
                }else{
                    element.style.left = litems[index + 1].offsetLeft - litems[index + 1].offsetWidth + 'px';
                }
            })
        }
        var ready = function () {
            rePos(0);
            $(window).resize(function () {
                rePos(0);
            })
        }

        return this;
    }
})(jQuery, window);