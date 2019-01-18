/**
 * Created by Administrator on 2018/12/26.
 * 上拉加载数据
 */

$(function(){



    var pageAjax = {
        //loadDivC : "<div class='load' style='width:100%;height:1.2rem;line-height: 1.2rem;color: #838383;text-align:center;font-size:0.3rem;'><p id='loadP'></p></div>",
        loading : "加载中...",
        loadingUp : "",
        loadingEnd : "=== 已经没有更多的信息了哦 ===",
        pageNo : 2,                 //开始页码
        pageSize : 20,              //分布数据数量
        loadDiv : $('.load'),   //提示信息DIV
        loadP : $('#loadP'),    //提示信息P标签

        loadBody : $("#integralList"),     //数据信息主体

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

            mui.ajax("/integral/data/"+pageAjax.pageNo+"/"+pageAjax.pageSize+"",{

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
                            result +=   '<div class="wallet-list integral">'
                                +'<p>'+res.data[i].create_time+'</p>'
                                +'<p>'+res.data[i].title+'</p>'
                                +'<p>'+res.data[i].type+res.data[i].integral+'</p>'
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
            /*pageAjax.topNav.on("click",function(){
                pageAjax.pageNo = 2;             //重置页码为1
                pageAjax.loadBody.html("");         //清空容器内容
                pageAjax.loadP.html("");        //清空加载更多

                pageAjax.topNav.removeClass("nav-active");
                $(this).addClass("nav-active");
                pageAjax.type = $(this).attr('data-type-id');
                pageAjax.getDataInit();

            });*/

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

    //pageAjax.clickAjax();
    pageAjax.scrollFuc();
    pageAjax.getDataInit();


});
