$(document).ready(function() {
    $('#nuform').submit(function(){
        return false;
    });
    
    $('#nubtn').click(function(){
        addUser();
    });
});

function addUser() {
    var newdata = {
        login: $('#nulogin').val(),
        password: $('#nupassword').val(),
        c_password: $('#nucpassword').val(),
        firstname: $('#nufirstname').val(),
        lastname: $('#nulastname').val()
    };
    
    // login
    if ( newdata.login == '' ) {
        showError($('#nulogin'), 'Не введен логин');
        return false;
    }
    
    if ( !/[a-z0-9]/.test(newdata.login) ) {
        showError($('#nulogin'), 'Логин может содержать буквы латиницы и цифры');
        return false;
    }
    
    if ( newdata.login.length > 20 ) {
        showError($('#nulogin'), 'Максимальная длина логина 20 символов');
        return false;
    }
    
    
    // пароль
    if ( newdata.password == '' ) {
        showError($('#nupassword'), 'Не введен пароль');
        return false;
    }
    
    if ( newdata.password != newdata.c_password ) {
        showError($('#nucpassword'), 'Пароли не совпадают');
        return false;
    }
    
    // имя
    if ( newdata.firstname == '' ) {
        showError($('#nufirstname'), 'Не введено имя');
        return false;
    }
    
    if ( newdata.firstname.length > 30 ) {
        showError($('#nufirstname'), 'Максимальная длина имени 30 символов');
        return false;
    }
    
    // фамилия
    if ( newdata.lastname == '' ) {
        showError($('#nulastname'), 'Не введена фамилия');
        return false;
    }
    
    if ( newdata.lastname.length > 30 ) {
        newdata.showError($('#nulastname'), 'Максимальная длина фамилии 30 символов');
        return false;
    }
    
    $.post('/registration', newdata, function(data){
        if (data.status == 'err') {
            $('#newusererror').children('label').html(data.error);
            $('#newusererror').addClass('error').show();
            
            return false;
        }
        
        location.assign('/');
    }, 'json');
}