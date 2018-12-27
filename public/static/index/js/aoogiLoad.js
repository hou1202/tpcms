/**
 * Created by Administrator on 2018/12/26.
 */

(function($) {
    $.fn.extend({

        aoogiLoad:function(opt,callBack){
            //数据访问接口
            var url = opt.url;

            //追加数据父级ID
            var id = opt.id;

            //分类ID
            var classify = opt.classify;

            /*
            * 数据访问起始页
            * 默认值   1
            * */
            var startPage = 1;
            if( opt.startPage ) {
                startPage = opt.startPage;
            }

            /*
            * 数据访问分页量
            * 默认值   20
            * */
            var limit = 20;
            if( opt.limt ) {
                limt = opt.limt;
            }

            //组装页面数据格式
            var html = $(['<a class="list-block" href="2">',
                        '<div class="block-img">',
                        '<img src="/static/index/images/goods1.jpg">',
                        '</div>',
                        '<div class="block-info">',
                        '<h2>iPhone XR-大屏幕上见</h2>',
                        '<h3>畅想科技未来不得不见的可以来现</h3>',
                        '<div class="block-info-price">',
                        '<p>￥<span>2500.00</span></p>',
                        '<p>￥<span>3000.00</span></p>',
                        '</div>',
                        '</div>',
                        '</a>'].join(''));

            //访问数据结果
            var arr;
            //执行函数
            int();

            function int(){
                //修改ajax 为同步请求
                $.ajaxSettings.async = false;
                $.post(url+'/'+classify+'/'+startPage+'/'+limit,'',function(res){
                    arr=res;
                });
                console.log(arr);
                //修正ajax 为异步请求
                $.ajaxSettings.async = true;
            }








        }
    });

})(jQuery);