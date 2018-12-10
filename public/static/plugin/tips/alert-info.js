/**
 * Created by Administrator on 2018/12/10.
 * type     消息类型
 * @param   info    灰底-自动关闭型
 * @param   warning     白底-无标题，确认型
 * @param   confirm     白底-无标题，确认/取消型
 */

(function($){

    alertConfirm=function(popHtml,type,options){

        type = type||'info';

        var config=$.extend(true,{
            okText:'确定',
            cancelText:'取消',
            onOk:$.noop,
            onCancel:$.noop
        }, options);

        var popId=creatPopId();
        var $alertBox=$("<div>").addClass("alertBox");
        var $txt=$("<p>").html(popHtml);
        var $confirmBox=$("<div>").addClass("confirmBox");
        var $contBox=$("<div>").addClass("contBox");
        var $ok=$("<a>").addClass("ok").text(config.okText);
        var $cancel=$("<a>").addClass("cancel").text(config.cancelText);

        init();

        /*执行*/
        function init(){
            creatDom();
            bind();
        }

        /*创建窗口盒子*/
        function creatDom(){
            if(type == 'info'){
                $alertBox.attr("id",popId).append($txt.addClass('infoBox'));
                $("body").append($alertBox);
                setTimeout(function () {
                    $("#"+popId).remove();
                }, 2000);
            }else{
                $alertBox.attr("id",popId).append($confirmBox.append($contBox.append($txt)).append(creatBtnGroup()));
                $("body").append($alertBox);

            }

        }

        //事件执行
        function bind(){
            $ok.click(doOk);
            $cancel.click(doCancel);

        }

        /*确定事件*/
        function doOk(){
            var $o=$(this);
            config.onOk();
            $("#"+popId).remove();

        }

        /*取消事件*/
        function doCancel(){
            var $o=$(this);
            config.onCancel();
            $("#"+popId).remove();
        }

        //创建底部确定/取消按钮
        function creatBtnGroup(){
            var $btnBox=$("<div>").addClass("btnBox");
            if(type == 'confirm'){
                $btnBox.append($ok).append($cancel);
            }else{
                $btnBox.append($ok);
            }
            return $btnBox;
        }

        /*创建div ID*/
        function creatPopId(){
            var i="pop_"+(new Date()).getTime()+parseInt(Math.random()*100000);
            if($("#"+i).length>0){
                return creatPopId();
            }else{
                return i;
            }
        }
    };


})(jQuery);