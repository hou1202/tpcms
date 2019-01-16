/**
 * Created by Administrator on 2018/12/26.
 * 上拉加载数据
 */

$(function(){



    var pageAjax = {
        //loadDivC : "<div class='load' style='width:100%;height:1.2rem;line-height: 1.2rem;color: #838383;text-align:center;font-size:0.3rem;'><p id='loadP'></p></div>",
        loading : "加载中...",
        loadingUp : "上拉可以加载更多哦@#￥%…&",
        loadingEnd : "=== 已经没有更多的订单了哦 ===",
        pageNo : 1,                 //开始页码
        pageSize : 6,              //分布数据数量
        loadDiv : $('.load'),   //提示信息DIV
        loadP : $('#loadP'),    //提示信息P标签

        loadBody : $("#orderList"),     //数据信息主体
        topNav : $(".typeSide"),   //分类导航
        type : $(".nav-active").attr('data-type-id'),
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

            mui.ajax("/order/pageData/"+pageAjax.type+"/"+pageAjax.pageNo+"/"+pageAjax.pageSize+"",{

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
                            var goods ='';
                            $.each(res.data[i].goods_order,function(n,val){
                                goods += '<div class="order-goods">'
                                    +'<div class="order-list-left">'
                                    +'<img src="'+res.data[i].goods_order[n].thumbnail+'" >'
                                    +'</div>'
                                    +'<div class="order-list-middle">'
                                    +'<h2>'+res.data[i].goods_order[n].title+'</h2>'
                                    +'<p>'+res.data[i].goods_order[n].name+'</p>'
                                    +'</div>'
                                    +'<div class="order-list-right">'
                                    +'<p>￥'+changeFloat(res.data[i].goods_order[n].price)+'</p>'
                                    +'<p>x '+res.data[i].goods_order[n].num+'</p>'
                                    +'</div>'
                                    +'</div>'
                            });
                            result +=   '<div class="order-list">'
                                +'<a href="/orderDetails">'
                                +goods
                                +'</a>'
                                +'<div class="order-list-bottom">'
                                +'<p>共计1件商品 合计：￥'+changeFloat(res.data[i].total_price)+' (含运费：￥ '+res.data[i].franking_price+')</p>'
                                +'<div class="bottom-button">'
                                +'<a  class="cancel cancelOrder" data-id="'+res.data[i].id+'">取消订单</a>'
                                +'<a href="/balance/'+res.data[i].id+'" class="payOrder">立即付款</a>'
                                +'</div>'
                                +'</div>'
                                +'</div>';
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
        //检查请求情况
        clickAjax : function(){
            pageAjax.topNav.on("click",function(){
                pageAjax.pageNo = 1;             //重置页码为1
                pageAjax.loadBody.html("");         //清空容器内容
                pageAjax.loadP.html("");        //清空加载更多

                pageAjax.topNav.removeClass("nav-active");
                $(this).addClass("nav-active");
                pageAjax.type = $(this).attr('data-type-id');
                pageAjax.getDataInit();

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

    pageAjax.clickAjax();
    pageAjax.scrollFuc();
    pageAjax.getDataInit();


});
