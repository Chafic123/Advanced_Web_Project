$(document).ready(function () {
    /*declaration*/
    let form = $('form[name="feedback-form"]');
    let deliveryRadio = $("#DeliveryRadio");
    let inHouseRadio = $("#InHouseRadio");
    let deliveryInfo = $(".Delivery-Active");
    let inHouseInfo = $(".InHouse-Active");

    /* Shows delivery or house accroding to selection */

    // Delivery Clicked 
    deliveryRadio.change(function () {
        if (deliveryRadio.prop('checked')) {
            deliveryInfo.removeClass("hidden");
            inHouseInfo.addClass("hidden");
        } else {
            deliveryInfo.addClass("hidden");
        }
        $(".image").css({"height":"210vh"})
    });

    // In house Clicked 
    inHouseRadio.change(function () {
        if (inHouseRadio.prop('checked')) {
            inHouseInfo.removeClass("hidden");
            deliveryInfo.addClass("hidden");
        }
        $(".image").css({"height":"210vh"})
    });

    /* Reset the ratings when another radio button (order type) is checked */

    // Delivery Checked
    deliveryRadio.click(function () {

        // Resetting the ratings
        $('[id^="star5-deliverytime"]').prop('checked', false);
        $('[id^="star4-deliverytime"]').prop('checked', false);
        $('[id^="star3-deliverytime"]').prop('checked', false);
        $('[id^="star2-deliverytime"]').prop('checked', false);
        $('[id^="star1-deliverytime"]').prop('checked', false);

        $('[id^="star5-foodquality"]').prop('checked', false);
        $('[id^="star4--foodquality]').prop('checked', false);
        $('[id^="star3-foodquality"]').prop('checked', false);
        $('[id^="star2-foodquality"]').prop('checked', false);
        $('[id^="star1-foodquality"]').prop('checked', false);


        $('[id^="star5-cleanliness"]').prop('checked', false);
        $('[id^="star4-cleanliness"]').prop('checked', false);
        $('[id^="star3-cleanliness"]').prop('checked', false);
        $('[id^="star2-cleanliness"]').prop('checked', false);
        $('[id^="star1-cleanliness"]').prop('checked', false);

        $('[id^="star5-packaging"]').prop('checked', false);
        $('[id^="star4-packaging"]').prop('checked', false);
        $('[id^="star3-packaging"]').prop('checked', false);
        $('[id^="star2-packaging"]').prop('checked', false);
        $('[id^="star1-packaging"]').prop('checked', false);

        $('[id^="star5-customerservice"]').prop('checked', false);
        $('[id^="star4-customerservice"]').prop('checked', false);
        $('[id^="star3-customerservice"]').prop('checked', false);
        $('[id^="star2-customerservice"]').prop('checked', false);
        $('[id^="star1-customerservice"]').prop('checked', false);


    });

    // In House Checked
    inHouseRadio.click(function () {
        $('#improve').val(null);

        // Resetting the ratings
        $('[id^="star5-service"]').prop('checked', false);
        $('[id^="star4-service"]').prop('checked', false);
        $('[id^="star3-service"]').prop('checked', false);
        $('[id^="star2-service"]').prop('checked', false);
        $('[id^="star1-service"]').prop('checked', false);

        $('[id^="star5-foodquality2"]').prop('checked', false);
        $('[id^="star4--foodquality2]').prop('checked', false);
        $('[id^="star3-foodquality2"]').prop('checked', false);
        $('[id^="star2-foodquality2"]').prop('checked', false);
        $('[id^="star1-foodquality2"]').prop('checked', false);


        $('[id^="star5-cleanliness2"]').prop('checked', false);
        $('[id^="star4-cleanliness2"]').prop('checked', false);
        $('[id^="star3-cleanliness2"]').prop('checked', false);
        $('[id^="star2-cleanliness2"]').prop('checked', false);
        $('[id^="star1-cleanliness2"]').prop('checked', false);

        $('[id^="star5-atmosphere"]').prop('checked', false);
        $('[id^="star4-atmosphere"]').prop('checked', false);
        $('[id^="star3-atmosphere"]').prop('checked', false);
        $('[id^="star2-atmosphere"]').prop('checked', false);
        $('[id^="star1-atmosphere"]').prop('checked', false);


    });


    /* Form Validation */

    // reseting form fuction after pop-up
    function resetForm() {
        $('body').removeClass('popup-open');
    }


    $('form').submit(function (e) {
        e.preventDefault();
        let validation=validateForm();
        if(validation===true){
            resetForm()
            $(this).unbind('submit').submit()
        }
        else{
            window.scrollTo(0,0);
        }
    });

    // Function to set an error message for a form element
    function setError(element, errorMessage) {
        let parentElement = element.closest('.required-feedback');
        parentElement.addClass('error');
        parentElement.find('small').text(errorMessage);
    }

    // Function to remove error messages for a form element
    function removeError(element) {
        let parentElement = element.closest('.required-feedback');
        parentElement.removeClass('error');
        parentElement.find('small').text('');
    }

    // Function to validate the first name using a regular expression
    function validateFirstName(frstname) {
        return /^[a-zA-Z]{1,10}$/i.test(frstname);
    }

    // Function to validate the last name using a regular expression
    function validateLastName(lstname) {
        return /^[a-zA-Z]{1,10}$/i.test(lstname);
    }

    // Function to validate email or phone number using regular expressions
    function validateEmailOrPhoneNumber(inputValue) {
        const isEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@((([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})|(\d{10,}))$/i.test(inputValue);
        const isPhoneNumber = /^\d{10}$/i.test(inputValue.trim());
        return isEmail || isPhoneNumber;
    }

    // Function to validate the entire form
    function validateForm() {
        let isValid = true;

        // Validation checks for first name
        let frstname = $('#firstname');
        if (frstname.val().trim() === '') {
            setError(frstname, 'Name cannot be empty');
            isValid = false;
        } else if (!validateFirstName(frstname.val().trim())) {
            setError(frstname, 'Enter a valid first name (1 to 10 letters)');
            isValid = false;
        } else {
            removeError(frstname);
        }

        // Validation checks for last name
        let lstname = $('#lastname');
        if (lstname.val().trim() === '') {
            setError(lstname, 'Last Name cannot be empty');
            isValid = false;
        } else if (!validateLastName(lstname.val().trim())) {
            setError(lstname, 'Enter a valid last name (1 to 10 letters)');
            isValid = false;
        } else {
            removeError(lstname);
        }

        // Validation checks for email/phone
        let contactinfo = $('#email-phone');
        if (contactinfo.val().trim() === '') {
            setError(contactinfo, 'Please enter either a mobile number or an email');
            isValid = false;
        } else if (!validateEmailOrPhoneNumber(contactinfo.val().trim())) {
            setError(contactinfo, 'Enter a valid mobile number or email');
            isValid = false;
        } else {
            removeError(contactinfo);
        }

        // Validation checks for delivery/in-house options
        let orderTypeElements = $('input[name="type-of-order"]');
        if (!orderTypeElements.is(':checked')) {
            setError(orderTypeElements.first(), 'Please select an order type');
            isValid = false;
        } else {
            orderTypeElements.each(function () {
                removeError($(this));
            });
        }

        return isValid
        
    }
})



