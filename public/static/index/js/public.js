/**
 * Created by Administrator on 2018/11/29.
 */



/**
 * @autoAlert   弹窗提示&自动关闭
 * @param msg   string  提示信息
 *
 **/
function autoAlert(msg) {
    $('#alertInfo p').text(msg);
    $('#alertInfo').show();
    setTimeout(function () {
        $('#alertInfo').hide();
    }, 2000);
}


/**
 * @ resetToken              重置TOKEN
 * @ param   formId  string  form表单ID
 * @ return  token   string  新token
 * */
function resetToken(formId){
    var token = '';
    $.ajax({
        type: "POST",      //data 传送数据类型。post 传递
        dataType: 'json',  // 返回数据的数据类型json
        url: "/resetToken",  // yii 控制器/方法
        cache: false,
        async:false,
        error:function(){
            alert("数据传输错误");
        },success: function (data) {
            token = data;
        }
    });
    $("#"+formId).find("input[name='__token__']").val(token);
    return token;
}

/*
 * @ timeOutUrl             延时跳转
 * @ param  url     string  目标url
 * @ param  time    number  延时时间
 * @ time 默认值 2000
 **/
function timeOutUrl(url , time){
    time = time ? time : 2000;
    window.setTimeout(function(){
        window.location=url;
    },time);
}


