/**
 * Created by Administrator on 2018/11/29.
 */

function autoAlert(msg) {
    $('#alertInfo p').text(msg);
    $('#alertInfo').show();
    setTimeout(function () {
        $('#alertInfo').hide();
    }, 2000);
}
