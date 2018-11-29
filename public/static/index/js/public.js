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
