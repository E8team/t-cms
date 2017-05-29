(function ($, window) {
    'use strict';
    $.fn.tcarousel = function(options) {
        var _self = this;
        var _options = $.extend({
            'height': '460px'
        }, options);

        var imgs = this.find('img');
        var $wrapper = _self.find('.wrapper');
        var $litems = _self.find('.item');
        imgs.attr('ondragstart', 'return false;')
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
            var totalWidth = 0;
            $litems.each(function (index, element) {
                totalWidth += $litems[index].offsetWidth;
                if(posIndex == index){
                    element.style.left = (windowWidth - element.offsetWidth) / 2 + 'px';
                }else if(index > posIndex){
                    if(index == length - 1) {
                        element.style.left = $litems[0].offsetLeft - $litems[0].offsetWidth + 'px';
                    }else {
                        element.style.left = $litems[index - 1].offsetLeft + $litems[index - 1].offsetWidth + 'px';
                    }
                    $wrapper.css('width', totalWidth);
                }else{
                    element.style.left = $litems[index + 1].offsetLeft - $litems[index + 1].offsetWidth + 'px';
                }
            })
        }
        var ready = function () {
            rePos(0);
            $(window).resize(function () {
                rePos(0);
            })
        }
        // 滑动
        var isDown = false;
        var lastX = 0;
        $wrapper.mousedown(function (e) {
            lastX = - this.offsetLeft + e.pageX;
            isDown = true;
        }).mouseup(function () {
            isDown = false;
            var minIndex = 0;
            for(var index in $litems){
                if( Math.abs(- $litems[index].offsetLeft - this.offsetLeft) < Math.abs(- this.offsetLeft - $litems[minIndex].offsetLeft)){
                    minIndex = index;
                }
            }
            $(this).animate({
                left: - $litems[minIndex].offsetLeft + ($(window).width() - $litems[minIndex].offsetWidth) / 2
            }, 300)
        }).mousemove(function (e) {
            if(isDown){
                $(this).css('left', e.pageX - lastX);
            }
        });
        return this;
    }
})(jQuery, window);