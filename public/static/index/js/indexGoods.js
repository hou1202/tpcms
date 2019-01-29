/**
 * Created by Administrator on 2018/12/26.
 * 上拉加载数据
 */

$(function(){



    var pageAjax = {
        //loadDivC : "<div class='load' style='width:100%;height:1.2rem;line-height: 1.2rem;color: #838383;text-align:center;font-size:0.3rem;'><p id='loadP'></p></div>",
        loading : "加载中...",
        loadingUp : "上拉可以加载更多哦@#￥%…&",
        loadingEnd : "=== 我们的底线已经暴露了 ===",
        pageNo : 1,                 //开始页码
        pageSize : 20,              //分布数据数量
        loadDiv : $('.load'),   //提示信息DIV
        loadP : $('#loadP'),    //提示信息P标签
        loadBody : $("#goodsList"),     //数据信息主体
        onOff : true,


        throttle : function(func,delay){     //延缓滚动加载次数  防止抖动
            var timer = null;
            var startTime = Date.now();
            return function(){
                var curTime = Date.now();
                var remaining = delay - (curTime - startTime);
                var context = this;
                var args = arguments;
                clearTimeout(timer);
                if(remaining <= 0){
                    func.apply(context,args);
                    startTime = Date.now();
                }else{
                    timer = setTimeout(func,remaining);
                }
            }
        },
        //获取数据
        getDataInit : function(){
            var mui = $;
            pageAjax.onOff = false;

            mui.ajax("/index/goods"+"/"+pageAjax.pageNo+"/"+pageAjax.pageSize+"",{
                dataType:'json',
                type:'post',
                timeout:10000,
                headers:{'Content-Type':'application/json'},
                beforeSend:function(){
                    pageAjax.loadP.html(pageAjax.loading);
                },
                success:function(res){
                    if(res.code == 1){
                        var result = '';
                        $.each(res.data,function(i,val){
                            result +=   '<a class="list-block" href="/goods/'+res.data[i].id+'">'
                                +'<div class="block-img">'
                                +'<img src="'+res.data[i].thumbnail+'">'
                                +'</div>'
                                +'<div class="block-info">'
                                +'<h2>'+res.data[i].title+'</h2>'
                                +'<h3>'+res.data[i].info+'</h3>'
                                +'<div class="block-info-price">'
                                +'<p>￥<span>'+changeFloat(res.data[i].sell_price)+'</span></p>'
                                +'<p>￥<span>'+res.data[i].origin_price+'</span></p>'
                                +'</div>'
                                +'</div>'
                                +'</a>';
                        });
                        pageAjax.loadBody.append(result);     //追加数据
                        //判断数据是否已经全部获取完毕
                        if(res.data.length < pageAjax.pageSize){
                            pageAjax.loadP.html(pageAjax.loadingEnd);
                        }else{
                            pageAjax.onOff = true;
                            pageAjax.loadP.html(pageAjax.loadingUp);
                        }
                    }
                    if(res.code == 0){
                        pageAjax.onOff = true;
                        pageAjax.loadP.html(pageAjax.loadingUp);
                    }
                },
                error:function(data){
                    console.log(data);
                    pageAjax.onOff = true;
                }
            });
        },

        //计算页面滚动情况
        scrollFuc : function(){
            $(window).scroll(pageAjax.throttle(function(){
                var scrollTop = $(this).scrollTop();    //滚动条距离顶部的高度
                var scrollHeight = $(document).height();   //当前页面的总高度
                var clientHeight = $(this).height();    //当前可视的页面高度
                if(scrollTop + clientHeight >= scrollHeight - 50){   //距离顶部+当前高度 >=文档总高度 即代表滑动到底部
                    if(pageAjax.onOff){
                        pageAjax.pageNo++;
                        pageAjax.getDataInit();
                    }
                }
            },2000));
        }

    };


    pageAjax.scrollFuc();
    pageAjax.getDataInit();


});
