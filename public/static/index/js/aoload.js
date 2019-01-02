/**
 * Created by Administrator on 2018/12/26.
 */

;(function($){
    'use strict';
    var win = window;
    var doc = document;
    var $win = $(win);
    var $doc = $(doc);
    $.fn.aoogiload = function(options){
        return new MyAoogiLoad(this, options);
    };
    var MyAoogiLoad = function(element, options){

    };

})(window.Zepto || window.jQuery);