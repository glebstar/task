$(document).ready(function() {
    $('#statuseditp').click(function(){
        $(this).hide();
        $('#statusinfo').hide();
        $('#statuseditb').show().css('display', 'inline');
    });
    
    $('#statuseditbtn').click(function(){
        saveStatus();
    });
    
    $('#newcommentbtn').click(function(){
        addComment();
    });
});

var sLabel = {
    1: 'label-success',
    2: 'label-info',
    3: 'label-important'
};

function saveStatus()
{
    var newdata = {
        id: $('#statuseditbtn').attr('taskid'),
        statusid: $('#statusids option:selected').val()
    };
    
    $.post('/task/setstatus', newdata, function(data){
        $('#statuseditb').hide();
        $('#statuseditp').show();
        $('#statusinfo').show();   
        $('#statusinfo').removeClass('label-success').removeClass('label-info').removeClass('label-important').addClass(sLabel[$('#statusids option:selected').val()]).html($('#statusids option:selected').html());
    }, 'json');
    
    
}

function addComment()
{
    var newdata = {
        task_id: $('#newcommentbtn').attr('taskid'),
        user_id: $('#newcommentbtn').attr('userid'),
        message: $('#newcomment').val()
    };
    
    if (newdata.message == '') {
        showError($('#newcomment'), 'Введите комментарий');
        return false;
    }
    
    $.post('/task/addcomment', newdata, function(data){
        $('#task_comments').append('<p><b>Я:</b></p><div class="well">' + newdata.message.replace(/([^>])\n/g, '$1<br/>') + '</div>');
        $('#newcomment').val('');
    }, 'json');
}