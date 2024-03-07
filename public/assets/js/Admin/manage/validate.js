// Func
function checkEmptyTemplate(id) {
    let flag = true;
    $(id).find('input[data-not-empty]').each(function (index, el) {
        let name = $(this).parent().find('label').text();
        if ($(this).val() === '') {
            $(this).parent().children('.error-message').text("Không được để trống " + name);
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            flag = false;
        }
    });
    return flag;
}

function checkPhoneTemplate(id) {
    let flag = true;
    $(id).find('input[phone-required-template]').each(function (index, el) {
        let rePhone = /^(09|03|07|08|05).*$/;
        let name = $(this).parent().find('label').text();
        if ($(this).val() === '') {
            $(this).parent().children('.error-message').text("Không được để trống " + name);
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            flag = false;
        }

        let length_phone = $(this).val().length;
        if ($(this).val().length < 2 || $(this).val().length >= 2 && $(this).val().substring(0, 2).match(rePhone)) {
            if ($(this).val().length === 10) {
                return flag;
            } else {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                $(this).parent().children('.error-message').text('Số điện thoại chưa đúng 10 số!');
                flag = false;
            }
        }else {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $(this).parent().children('.error-message').text('Đầu số không đúng định dạng!');
            flag = false;
        }
    });
    return flag;
}

function checkSelectTemplate(id) {
    let flag = true;
    $(id).find('select[data-select-not-empty]').each(function (index, el) {
        let name = $(this).parent().parent().find('label').text();
        $(this).removeClass('is-invalid');
        if ($(this).val() === '' || $(this).val() === null || $(this).val() === '-2') {
            $(this).parent().children('.error-message').text('Vui lòng chọn ' + name);
            $(this).addClass('is-invalid');
            flag = false;
        } else {
            $(this).removeClass('is-invalid');
            flag == false ? false : true;
        }
    });
    return flag;
}

// ============================================================

// Không được để trống
$(document).on('input', 'input[data-not-empty]', function () {
    if ($(this).val() === '') {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        $(this).parent().children('.error-message').text('Không được để trống');
    } else {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');
    }
})

$(document).on('focus', 'input[data-not-empty]', function () {
    if ($(this).val() === '') {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        $(this).parent().children('.error-message').text('Không được để trống');
    }
})

$(document).on('focusout', 'input[data-not-empty]', function () {
    $(this).removeClass('is-valid');
    $(this).removeClass('is-invalid');
})


// Validate Email
$(document).on('input', 'input[data-validate=mail]', function () {
    let reMail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    let input_email = $(this).val();
    if (input_email !== '' || input_email !== undefined) {
        if (!input_email.match(reMail)) {
            $(this).addClass('is-invalid');
            $(this).parent().children('.error-message').text('Nhập mail đúng cú pháp!');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    }

})
$(document).on('focus', 'input[data-validate=mail]', function () {
    let reMail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    let input_email = $(this).val();
    if (input_email !== '' || input_email !== undefined) {
        if (!input_email.match(reMail)) {
            $(this).addClass('is-invalid');
            $(this).parent().children('.error-message').text('Nhập mail đúng cú pháp');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    }
})
$(document).on('focusout', 'input[data-validate=mail]', function () {
    $(this).removeClass('is-valid');
    $(this).removeClass('is-invalid');
})


// Validate Form
$(document).on('input', 'input[phone-required-template]', function () {
    let rePhone = /^(09|03|07|08|05).*$/;

    if ($(this).val() === '') {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        $(this).parent().children('.error-message').text('Không được để trống');
    } else {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');
    }

    let length_phone = $(this).val().length;
    if ($(this).val().length < 2 || $(this).val().length >= 2 && $(this).val().substring(0, 2).match(rePhone)) {
        if ($(this).val().length === 10) {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        } else {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $(this).parent().children('.error-message').text('Số điện thoại chưa đúng 10 số!');
        }
    } else {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        $(this).parent().children('.error-message').text('Đầu số không đúng định dạng!');
    }
})
$(document).on('focus', 'input[phone-required-template]', function () {
    let rePhone = /^(09|03|07|08|05).*$/;

    if ($(this).val() === '') {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        $(this).parent().children('.error-message').text('Không được để trống');
    } else {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');
    }

    let length_phone = $(this).val().length;
    if ($(this).val().length < 2 || $(this).val().length >= 2 && $(this).val().substring(0, 2).match(rePhone)) {
        if ($(this).val().length === 10) {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        } else {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $(this).parent().children('.error-message').text('Số điện thoại chưa đúng 10 số!');
        }
    } else {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        $(this).parent().children('.error-message').text('Đầu số không đúng định dạng!');
    }
})
$(document).on('focusout', 'input[phone-required-template]', function () {
    $(this).removeClass('is-valid');
    $(this).removeClass('is-invalid');
})

//  Select Empty
$('select2').ready(function () {
    $(document).on('change', 'select[data-select-not-empty]', function () {
        let name = $(this).parent().parent().find('label').text();
        if ($(this).val() === '' || $(this).val() === '-2' ||  $(this).val() === null) {
            $(this).removeClass('is-valid');
            $(this).parent().children('.error-message').text('Vui lòng chọn ' + name);
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    })
});
