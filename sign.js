$(document).ready(function () {

    /*Declarations */
    let email = $("#sign-in-user");
    let passin = $("#sign-in-pass");
    let frstname = $("#frst-name-Input");
    let lstname = $("#lst-name-Input");
    let contact = $("#ContactInput");
    let bday = $("#bday");
    let passup = $("#password");
    let confirmPass = $("#confirmPassword");
    let loginPopup = $(".l");
    let signupPopup = $(".s");
    let backdrop = $("#backdrop");

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

    /* Input Vaalidation Functions */
    function validateFirstName(frstname) {
        return /^[a-zA-Z]{1,10}$/i.test(frstname);
    }

    function validateLastName(lstname) {
        return /^[a-zA-Z]{1,10}$/i.test(lstname);
    }

    function validateEmail(contact) {
        let isEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(contact);
        return isEmail;
    }

    function validateBday(bday) {
        let today = new Date();
        let bd = new Date(bday);
        let currYear = today.getFullYear();
        let bdYear = bd.getFullYear();
        if (currYear - bdYear < 12) {
            return false;
        }
        return true;
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
            setError(lstname, 'Enter a valid last name');
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
        } else if (!validateBday(bday.val())) {
            setError(bday, 'Age restriction');
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

    /*Submit Sign In Form*/
    $("#loginF").submit(function (e) {
        e.preventDefault();

        // Check if the entered email is empty
        if ((email.val().trim() === '' || email.val().trim() === '' && passin.val().trim() != '') && !validateEmail(email)) {
            setError(email, 'Please enter a valid email');
        }
        else {
            removeError(email);
        }

        // Check if the password empty
        if ((passin.val().trim() === '' || passin.val().trim() === '' && email.val().trim() != '') && !validatePass(passin)) {
            setError(passin, 'Please enter a password');
        }
        else {
            removeError(passin);
        }

        $.ajax({
            type: "POST",
            url: "../process_login.php",
            method: 'POST',
            dataType: "json",
            data: $('#loginF').serialize(),
            success: function (response) {
                if (response.success && response.message === "Login successful") {
                    removeError(passin);
                    removeError(email);
                    email.val("");
                    passin.val("");
                    $("#rem").prop("checked", false);
                    window.sessionStorage.setItem('SignedIn', 'true');
                    location.reload(true);
                    loginPopup.hide();
                    backdrop.hide();
                } else if (response.success && response.message === "is admin") {
                    removeError(passin);
                    removeError(email);
                    $("#sign-in-user").val("");
                    $("#sign-in-pass").val("");
                    $("#rem").prop("checked", false);
                    window.location.href = "../CMS/cms.php";
                    loginPopup.hide();
                    backdrop.hide();
                } else {
                    setError(passin, "Invalid email or password.");
                }
            },
            error: function (error) {
                // Log an error message if there's an issue fetching data
                console.error('Error fetching data:', error);
            }
        });
    });

    /* Submit Sign Up Form */
    $("#signupF").submit(function (e) {
        e.preventDefault();
        let valid = validateForm();
        if (valid) {
            $.ajax({
                type: "POST",
                url: "../process_signup.php",
                method: 'POST',
                dataType: "json",
                data: $('#signupF').serialize(),
                success: function (response) {
                    if (response.success) {
                        frstname.val("");
                        lstname.val("");
                        contact.val("");
                        bday.val("");
                        passup.val("");
                        confirmPass.val("");
                        window.sessionStorage.setItem('SignedIn', 'true');
                        location.reload(true);
                        signupPopup.hide();
                        backdrop.hide();
                    } else if (!response.success && response.message === "email error") {
                        setError(contact, "Email already exists");
                    } else {
                        console.error(response.message);
                    }
                },
                error: function (error) {
                    // Log an error message if there's an issue fetching data
                    console.error('Error fetching data:', error);
                }
            });
        }
    });


    $("#pass1").click(function () {
        // Get the current type of the password input field
        let type = $("#sign-in-pass").attr('type');

        // Get the current type of the password input field
        type = (type === 'password') ? 'text' : 'password';
        $("#sign-in-pass").attr('type', type);
    })

    $("#pass2").click(function () {
        // Get the current type of the password input field
        let type = $("#password").attr('type');

        // Get the current type of the password input field
        type = (type === 'password') ? 'text' : 'password';
        $("#password").attr('type', type);
    })

    $("#pass3").click(function () {
        // Get the current type of the password input field
        let type = $("#confirmPassword").attr('type');

        // Get the current type of the password input field
        type = (type === 'password') ? 'text' : 'password';
        $("#confirmPassword").attr('type', type);
    })
})
