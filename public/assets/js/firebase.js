let s = 59;
let  timeout = null;
let uid = null;
let sdt = 0;
let formOtp = '<div class="form_opt">' +
                '<h2>Xác nhận OTP</h2>' +
                '<div class="d-none text-center text-danger " id="text-error"></div>'+
                '<div class="code-container">' +
                '<input type="number" id="input_otp_one" class="code" placeholder="0" min="0" max="9" [(ngModel)]="verificationCode" required />' +
                '<input type="number" id="input_otp_two" class="code" placeholder="0" min="0" max="9" [(ngModel)]="verificationCode" required />' +
                '<input type="number" id="input_otp_three" class="code" placeholder="0" min="0" max="9" [(ngModel)]="verificationCode" required />' +
                '<input type="number" id="input_otp_foun" class="code" placeholder="0" min="0" max="9" [(ngModel)]="verificationCode" required />' +
                '<input type="number" id="input_otp_five" class="code" placeholder="0" min="0" max="9" [(ngModel)]="verificationCode" required />' +
                '<input type="number" id="input_otp_six" class="code" placeholder="0" min="0" max="9" [(ngModel)]="verificationCode" required />' +
                '<input type="number" id="otp_code" class="d-none" [(ngModel)]="verificationCode" />'+
                '<input type="number" id="phone_forgot" class="d-none" [(ngModel)]="verificationCode" />'+
                '</div>'+

                ' <button type="button" id="send_agin" disabled class="btn btn-alt-warning" onclick="get_otp()"> Gửi lại OTP : <label id="time_count">12</label>s</button>';

let formChangePassword = '<form class="js-validation-reminder" action="" method="post" novalidate="novalidate">' +
                        '<div class="block block-themed block-rounded block-shadow">' +
                        '<div class="block-header bg-gd-primary">' +
                        '<h3 class="block-title">Đổi mật khẩu</h3>' +
                        '<div class="block-options">' +
                        '<button type="button" class="btn-block-option"><i class="si si-wrench"></i></button></div></div>'+
                        '<div class="block-content"><div class="text-center text-danger d-none" id="text-error"></div> <div class="form-group row"> <div class="col-12"> <label for="reminder-credential">Mật khẩu mới</label> <input type="password" class="form-control" id="password_new" name="phone_forgot" data-not-empty><div class="invalid-feedback error-message"></div> </div> </div><div class="form-group row"> <div class="col-12"> <label for="reminder-credential">Xác nhận mật khẩu</label> <input type="password" class="form-control" id="confirm_password_new" name="phone_forgot" data-not-empty> <div class="invalid-feedback error-message"></div></div> </div> <div class="form-group text-center"> <div class="form-group text-center"> <button type="button" class="btn btn-alt-primary" onclick="OnChangePassword()"> <i class="fa fa-asterisk mr-10"></i> Xác Nhận</button> </div> </div>'+
                        '</form>'

$(document).ready(function() {
    var firebaseConfig = {
        apiKey: "AIzaSyAHkqsK1wlVrc_S2T1hhZLoYLMi3sCTn0M",
        authDomain: "testfirebase-87aed.firebaseapp.com",
        projectId: "testfirebase-87aed",
        storageBucket: "testfirebase-87aed.appspot.com",
        messagingSenderId: "533244178107",
        appId: "1:533244178107:web:0c7d5d52c2772a5ffb039e",
        measurementId: "G-117WLRDS4N"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    window.appVerificationDisabledForTesting = false;
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'invisible',
        'callback': function (response) {
            onSignInSubmit();
        }
    });
});


function time_out(){
    if (s == -1){
        $('#send_agin').prop('disabled', false);
        $('#time_count').text('');
        clearTimeout(timeout);
        return false;
    }
    $('#time_count').text(s);
    timeout = setTimeout(function(){
            s--;
        time_out();
    }, 1000);
}

$('#codeToVerify').on('input',function(){
    if($(this).val().length === 6){
        $('#btn_capcha').prop('disabled', false);
    }
});

// Lấy số điện thoại
async function get_phone(){
    let username = $('.user_name').val(),
    restaurant_name = $('.restaurant_name').val(),
    phoneNo = null;
    await axios.post("/get-phone", {
        username : username,
        restaurant_name : restaurant_name
    }).then(res => {
        if(res.status == '200'){
            phoneNo = res.data.data;
            return phoneNo;
        }
    })
}

async function get_otp(){
    let phone = $('#phone_forgot').val();
    sdt = phone;

    let method = 'POST',
    url = 'check-phone',
    data = {
        phone : $('#phone_forgot').val(),
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.status !== '200'){
        $('#text-error').removeClass('d-none');
        $('#text-error').text(res.message);
        return false;
    }else{
        phone = res.message;
    }
    while(phone.charAt(0) === '0')
    {
        phone = phone.substr(1);
    }
    phone = "+84" + phone;
    var appVerifier = window.recaptchaVerifier;
    console.log(appVerifier);
    firebase.auth().signInWithPhoneNumber(phone, appVerifier)
    .then(function (confirmationResult) {
        $('form').html(formOtp);
        $('#phone_forgot').val(sdt);
        time_out();
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        const inputs = document.querySelectorAll('.code');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('keydown', function (event) {
                    if (event.key === "Backspace") {
                        inputs[i].value = '';
                        if (i !== 0)
                            inputs[i - 1].focus();
                    } else {
                        if (i === inputs.length - 1 && inputs[i].value !== '') {
                            return true;
                        } else if (event.keyCode > 47 && event.keyCode < 58 || event.keyCode > 95 && event.keyCode < 106) {
                            inputs[i].value = event.key;
                            if (i !== inputs.length - 1)
                                inputs[i + 1].focus();
                            event.preventDefault();
                        } else {
                            event.preventDefault();
                        }
                    }
                    if (inputs[0].value.length === 1 && inputs[1].value.length === 1 && inputs[2].value.length === 1 && inputs[3].value.length === 1 && inputs[4].value.length === 1 && inputs[5].value.length === 1) {
                        let otp_code = $('#input_otp_one').val() + $('#input_otp_two').val() + $('#input_otp_three').val() + $('#input_otp_foun').val() + $('#input_otp_five').val() + $('#input_otp_six').val();
                        $('#otp_code').val(otp_code);
                        let otp = $('#otp_code').val();
                        confirmationResult.confirm(otp).then(function (result) {
                            var user = result.user;
                            console.log(user.uid);
                            $('form').html(formChangePassword);
                        }.bind($(this))).catch(function (error) {
                            $('#text-error').removeClass('d-none');
                            $('#text-error').text('Mã xác thực không chính xác');
                            console.log(error);
                        }.bind($(this)));
                    }
                });
            }
    }).catch(function (error) {
        console.log(error)
    });
}


async function OnChangePassword(){
    if(!checkEmptyTemplate('#main-container')){
        return false;
    }

    let newPass =  $('#password_new').val();
    let ConfPass =  $('#confirm_password_new').val();
    if(ConfPass !== newPass){
        $('#text-error').removeClass('d-none');
        $('#text-error').text('Xác nhận mật khẩu không đúng');
        return false;
    }

    let method = 'post',
    url = 'post-change-password',
    data = {
        sdt : sdt,
        password_new : newPass,
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.status === '200'){
        let title = 'Thông Báo',
        text = 'Cập nhật thành công';
        SwalSuccess(title,text);
        setTimeout(() => {
            window.location.href = "/login";
        }, 1500);
    }
}



