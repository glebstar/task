$(document).ready(function() {
    $('#newtaskmodalbtn').click(function(){
        $('#newtaskmodal').modal();
    });
    
    $('#newuserbtn').click(function(){
        $('#newusermodal').modal();
    });
    
    $('#newtaskmodal').on('shown', function () {      
        $('#newtaskform').show();
        $('#newtasksavebtn').show();
        $('#newtasksuccess').hide();
        $('#newtaskerror').hide();
        
        $('#newtasksubjecti').val('').focus();
        $('#newtasktexti').val('');
        $("#newtaskuseri [value='0']").attr("selected", "selected");
        $("#newtaskurgi [value='2']").attr("selected", "selected");
        $("#newtaskcompi [value='2']").attr("selected", "selected");
        $('.control-group').removeClass('error').children('.help-block').hide();
    });
    
    $('#newtasksavebtn').click(function(){
        newTaskSave();
    });
    
    $('.span5, .span4, .nu').keydown(function(){
        $(this).parent().removeClass('error').children('.help-block').hide();
        $('#newtaskerror').hide();
        $('#newusererror').hide();
    });
    $('.span5, .nu').click(function(){
        $(this).parent().removeClass('error').children('.help-block').hide();
        $('#newtaskerror').hide();
        $('#newusererror').hide();
    });
    
    $('#newtaskclosebtn').click(function(){
        location.assign('/task/all');
    });
});

function newTaskSave() {
    newdata = {
        subject: $('#newtasksubjecti').val(),
        text: $('#newtasktexti').val(),
        user_id: $('#newtaskuseri option:selected').val(),
        task_urg_id: $('#newtaskurgi option:selected').val(),
        task_comp_id: $('#newtaskcompi option:selected').val()
    };
    
    var error = false;
    
    if (newdata.subject.length == 0) {
        error = true;
        $('#newtasksubjecti').focus();
        showError($('#newtasksubjecti'), 'Поле Тема не заполнено');
    }
    
    if (newdata.subject.length > 50) {
        error = true;
        $('#newtasksubjecti').focus();        
        showError($('#newtasksubjecti'), 'Максимальная длина темы 50 символов');
    }
    
    if (newdata.text.length == 0) {
        error = true;
        $('#newtasktexti').focus();
        showError($('#newtasktexti'), 'Поле Задание не заполнено');
    }
    
    if (newdata.user_id < 1) {
        error = true;
        showError($('#newtaskuseri'), 'Выберите исполнителя');
    }
    
    if (error) {
        return false;
    }
    
    $.post('/task/add', newdata, function(data){
        if (data.status == 'err') {
            $('#newtaskerror').children('label').html(data.error);
            $('#newtaskerror').addClass('error').show();
            
            return false;
        }
        
        $('#newtaskform').hide();
        $('#newtasksavebtn').hide();
        $('#newtaskclosebtn').show();
        $('#newtasksuccess').show();
    }, 'json');
}

function showError(obj, text) {
    $(obj).parent().addClass('error');
    $(obj).parent().children('.help-block').html(text).show().css('display', 'block');
}