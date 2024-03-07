async function login(){
    let method = 'POST',
    url = 'post-login',
    data = {
        phone : $('#username').val(),
        password : $('#password').val(),
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.status === '200'){
        window.location.href = "/";
    }else{
        $('#text-error').removeClass('d-none');
        $('#text-error').text(res.message);
    }
    console.log(res);
}
