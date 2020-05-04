// on ready
const wrap = text => `<div class="alert alert-danger" role="alert">${text}</div>`

$(() => {
    $('form').validate({
        rules: {
            password: {
                required: true,
                minlength: 5
            },
            "password-repeat": {
                equalTo: "#password"
            }
        },
        errorLabelContainer: "#error",
        messages: {
            email: wrap("L'email n'est pas valid"),
            password: {
                required: wrap('Le mot de passe est requis'),
                minlength: wrap('Le mot de passe doit fair au moins 5 caractères')
            },
            "password-repeat": wrap('Les mots de passe ne sont pas identiques')
        },
    });
});

// $(() => $('#submit').click(validate))
