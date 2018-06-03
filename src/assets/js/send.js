/**
 * Created by User on 25.11.2017.
 */
$(document).on('pjax:complete', function() {
    $(function () {
        $("#del-btn-feedback,#draft-btn-feedback,#activate-btn-feedback").on('click',function() {
            var url=$(this).data('url');
            if ($(this).attr('id')=='del-btn'&&!confirm('Подтвердите удаление')){return;}
            ajaxSend(url);

            return false;
        });
    });
});
$(function () {
    $("#del-btn-feedback,#draft-btn-feedback,#activate-btn-feedback").on('click',function() {
        var url=$(this).data('url');
        if ($(this).attr('id')=='del-btn'&&!confirm('Подтвердите удаление')){return;}
         ajaxSend(url);

        return false;
    });
});

function ajaxSend(url) {
    var keys = $('#w0').yiiGridView('getSelectedRows');
    if(keys.length<1){return;}
    $.ajax({
        url: url,
        type: 'POST',
        dateType: 'json',
        data:{
            keys:keys
        },
        success: function(res){
            $.pjax.reload({
                container:'#pjax-content'
            });
        },
        error: function(err){
            console.log(err);
        }
    });
}

