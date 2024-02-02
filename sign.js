$(document).ready(function () {

    /*Declarations */
    let users = ["dana@gmail.com", "pass"];
    let email = $("#sign-in-user");
    let passin = $("#sign-in-pass");
    let form = $("form");
    let frstname = $("#frst-name-Input");
    let lstname = $("#lst-name-Input");
    let contact = $("#ContactInput");
    let bday = $("#bday");
    let passup = $("#password");
    let confirmPass = $("#confirmPassword");
    let showTerms = $("#agree");
    let Agree = $(".policy .paragraph");
    let submitBtn = $(".input-box button");

    /*Function to Add Error Message*/
    function setError(element, errorMessage) {
        let parentElement = element.closest('.input-field');
        parentElement.addClass('error');
        let alertMessage = parentElement.find('small');
        alertMessage.text(errorMessage);
    }

    /*Function to Remove Error Message*/
    function removeError(element) {
        let parentElement = element.closest('.input-field');
        parentElement.removeClass('error');
        let alertMessage = parentElement.find('small');
        alertMessage.text('');
    }

    /*Click event handler for the Sign In button*/
    $("#sign-in-btn-submit").click(function () {
        // Check if the entered email matches the predefined email
        if (email.val() == users[0]) {
            removeError(email);
        }
        /*Check if both email and password match the predefined credentials*/
        if (email.val() == users[0] && passin.val() == users[1]) {
            removeError(passin);
            removeError(email);
            window.sessionStorage.setItem("SignedIn", "true");
            window.history.go(-1);
        } else {
            // Check if the password length is less than 8 characters and not equal to the predefined password
            if (passin.val().trim() === '') {
                setError(passin, 'Please enter a password');
                isValid = false;
            } else if (passin.val().length < 8 && passin.val() != users[1]) {
                setError(passin, "Invalid Password");
            }
            // Check if the entered email does not match the predefined email
            if (email.val().trim() === '') {
                setError(email, 'Please enter an email');
                isValid = false;
            } else if (email.val() != users[0]) {
                setError(email, "Email not found");
            }
        }
    });

    $("#pass1").click(function(){
        // Get the current type of the password input field
        let type = $("#sign-in-pass").attr('type');

        // Get the current type of the password input field
        type = (type === 'password') ? 'text' : 'password';
        $("#sign-in-pass").attr('type', type);
    })

    /* Input Vaalidation Functions */
    function validateFirstName(frstname) {
        return /^[a-zA-Z]{1,10}$/i.test(frstname);
    }

    function validateLastName(lstname) {
        return /^[a-zA-Z]{1,10}$/i.test(lstname);
    }

    function validateEmail(contact) {
        let isEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(contact);

        return isEmail || isPhoneNumber;
    }

    function validatePass(passup) {
        return passup.length > 8;
    }

    function validateConfPass(confirmPass) {
        return confirmPass.length > 8 && confirmPass === passup.val();
    }

    /*Validation form */
    function validateForm() {
        let isValid = true;

        if (frstname.val().trim() === '') {
            setError(frstname, 'Name cannot be empty');
            isValid = false;
        } else if (!validateFirstName(frstname.val().trim())) {
            setError(frstname, 'Enter a valid first name');
            isValid = false;
        } else {
            removeError(frstname);
        }

        if (lstname.val().trim() === '') {
            setError(lstname, 'Name cannot be empty');
            isValid = false;
        } else if (!validateLastName(lstname.val().trim())) {
            setError(lstname, 'Enter a valid first name');
            isValid = false;
        } else {
            removeError(lstname);
        }

        if (contact.val().trim() === '') {
            setError(contact, 'Please enter an email');
            isValid = false;
        } else if (!validateEmail(contact.val().trim())) {
            setError(contact, 'Enter a valid email');
            isValid = false;
        } else {
            removeError(contact);
        }

        if (!bday.val()) {
            setError(bday, 'Date cannot be empty');
            isValid = false;
        } else {
            removeError(bday);
        }

        if (passup.val().trim() === '') {
            setError(passup, 'Please enter a password');
            isValid = false;
        } else if (!validatePass(passup.val())) {
            setError(passup, 'Password invalid format');
            isValid = false;
        } else {
            removeError(passup);
        }

        if (confirmPass.val().trim() === '') {
            setError(confirmPass, 'Please confirm password');
            isValid = false;
        } else if (!validateConfPass(confirmPass.val())) {
            setError(confirmPass, 'Does not match password');
            isValid = false;
        } else {
            removeError(confirmPass);
        }

        return isValid;
    }

    /* Submit Form */
    submitBtn.click(function (event) {
        event.preventDefault();
        let valid = validateForm();
        if (valid) {
            window.sessionStorage.setItem("SignedIn", "true");
            window.history.go(-1);
        }
    });

    $("#pass2").click(function(){
        // Get the current type of the password input field
        let type = $("#password").attr('type');

        // Get the current type of the password input field
        type = (type === 'password') ? 'text' : 'password';
        $("#password").attr('type', type);
    })

    $("#pass3").click(function(){
        // Get the current type of the password input field
        let type = $("#confirmPassword").attr('type');

        // Get the current type of the password input field
        type = (type === 'password') ? 'text' : 'password';
        $("#confirmPassword").attr('type', type);
    })
});