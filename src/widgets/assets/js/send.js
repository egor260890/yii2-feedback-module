/**
 * Created by User on 04.05.2018.
 */

function registerFeedbackForm(id) {
    $('#'+id).on('beforeSubmit',function() {
        var data = $(this).serialize();
        $.ajax({
            url: '/feedback-send',
            type: 'POST',
            context:this,
            dateType: 'json',
            data: data,
            success: function(res){
                console.log(res);
                $(this)[0].reset();
                $("#modal-1").modal('show');
            },
            error: function(err){
                console.log(err);
            }
        });
        return false;
    });
}