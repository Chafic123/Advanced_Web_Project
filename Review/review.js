$(document).ready(function () {
    let popContainer = document.getElementsByClassName("pop-up-container")[0];
    let popUpMsg = document.getElementsByClassName("pop-up")[0];

    //keys to be disabled
    // left: 37, up: 38, right: 39, down: 40,
    // spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
    var keys = { 37: 1, 38: 1, 39: 1, 40: 1, 33: 1, 34: 1, 35: 1, 36: 1 };

    //prevents the default of each key
    function preventDefaultt(e) {
        e.preventDefault();
    }
    function preventDefaultForScrollKeys(e) {
        if (keys[e.keyCode]) {
            preventDefaultt(e);
            return false;
        }
    }

    // modern Chrome requires { passive: false } when adding event
    var supportsPassive = false;
    try {
        window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
            get: function () { supportsPassive = true; }
        }));
    } catch (e) { }

    var wheelOpt = supportsPassive ? { passive: false } : false;
    var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

    // call this to Disable
    function disableScroll() {
        window.addEventListener('DOMMouseScroll', preventDefaultt, false); // older FF
        window.addEventListener(wheelEvent, preventDefaultt, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefaultt, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);
    }

    // call this to Enable
    function enableScroll() {
        window.removeEventListener('DOMMouseScroll', preventDefaultt, false);
        window.removeEventListener(wheelEvent, preventDefaultt, wheelOpt);
        window.removeEventListener('touchmove', preventDefaultt, wheelOpt);
        window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
    }

    function popUp() {
        disableScroll();
        popContainer.style.display = "flex";
        popContainer.style.alignItems = "center";
        popContainer.style.justifyContent = "center";
        popUpMsg.style.display = "flex";
        popUpMsg.style.flexDirection = "column";
    }
    //closes the pop-up
    $("#close-btn").click(() => {
        enableScroll();
        popContainer.style.display = "none";
        popUpMsg.style.display = "none";
        resetForm(); //resets form
    })
    /*declaration*/
    let form = $('form[name="feedback-form"]');
    let deliveryRadio = $("#DeliveryRadio");
    let inHouseRadio = $("#InHouseRadio");
    let deliveryInfo = $(".Delivery-Active:first");
    let inHouseInfo = $(".InHouse-Active:first");

    /* Reset the ratings when another radio button (order type) is checked */
    function inHouseRatingsReset() {
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
    }

    function delReset() {
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
    }
    // Delivery Checked
    deliveryRadio.click(function () {
        // Resetting the ratings
        delReset();
        inHouseRatingsReset();
        if (deliveryRadio.prop('checked')) {
            deliveryInfo.removeClass("hidden");
            inHouseInfo.addClass("hidden");
        } else {
            deliveryInfo.addClass("hidden");
        }
        $(".image").css({ "height": "210vh" })
    });

    // In House Checked
    inHouseRadio.click(function () {
        $('#improve').val(null);
        // Resetting the ratings
        inHouseRatingsReset();
        delReset();
        if (inHouseRadio.prop('checked')) {
            inHouseInfo.removeClass("hidden");
            deliveryInfo.addClass("hidden");
        }
        $(".image").css({ "height": "210vh" })
    });

    /* Form Validation */

    // reseting form fuction after pop-up
    function resetForm() {
        window.scrollTo(0,0);
        // $("#main").load(location.href + " #main>*");
        $("#main").load("review.php");
    }

    $('form').submit(function (e) {
        e.preventDefault();

        // Call the validation function and store the result
        let validation = validateForm();

        if (validation === true) {
            // Get form field values
            let fname = $("#firstname").val().toString();
            let lname = $("#lastname").val().toString();
            let email = $("#email-phone").val().toString();
            let service = $("input[name='type-of-order']:checked").val();
            // Delivery service fields
            let delF1 = $("input[name='rate-deliverytime']:checked").val();
            let delF2 = $("input[name='rate-foodquality']:checked").val();
            let delF3 = $("input[name='rate-cleanliness']:checked").val();
            let delF4 = $("input[name='rate-packaging']:checked").val();
            let delF5 = $("input[name='rate-customerservice']:checked").val();
            let delMsg = $("#improve").val()?.toString();

            // In-house service fields
            let loc = $("#Select").val()?.toString();
            let inF1 = $("input[name='rate-service']:checked").val();
            let inF2 = $("input[name='rate-foodquality2']:checked").val();
            let inF3 = $("input[name='rate-cleanliness2']:checked").val();
            let inF4 = $("input[name='rate-atmosphere']:checked").val();
            let inMsg = $("#improve2").val()?.toString();

            if (delMsg === null) {
                delMsg = ""; // Assign an empty string if message is empty
            }
            if (inMsg === null) {
                inMsg = ""; // Assign an empty string if message is empty
            }

            // Send data using POST request
            $.post('review-repository.php', {
                firstname: fname,
                lastname: lname,
                email: email,
                typeOfOrder: service,
                // Delivery service data
                ratedeliverytime: delF1,
                ratefoodquality: delF2,
                ratecleanliness: delF3,
                ratepackaging: delF4,
                ratecustomerservice: delF5,
                delMsg: delMsg,
                // In-house service data
                location: loc,
                rateservice: inF1,
                ratefoodquality2: inF2,
                ratecleanliness2: inF3,
                rateatmosphere: inF4,
                inMsg: inMsg
            })
                .done(function (response, status, xhr) {
                    // Success handler
                    console.log(response);
                    popUp();
                })
                .fail(function (xhr, status, error) {
                    // Error handler
                    console.error("Error:", status, error);
                });
        } else {
            // Scroll to the top of the page if validation fails
            window.scrollTo(0, 0);
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



