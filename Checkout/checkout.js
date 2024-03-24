$(document).ready(function () {

    // Apply validation on form submission
    $('#order').click(function (event) {
        preventDefaultt(event);

        // var isValid = true;

        // $('.required').each(function () {
        //     isValid = validateAndHighlight($(this)) && isValid;
        // });
        // if (!isValid) {
        //     valid = false;
        // }
        // else{
            var fullname = $('#fullname').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var city = $('#city').val();
            let fname=fullname.split(' ');
            let f=fname[0];
            let lname=fname[1];
            let id=$('#order').data('account');
            $.ajax({
                type: 'POST',
                url: 'checkout-order.php',
                data: {
                    fname: f,
                    lname:lname,
                    phone: phone,
                    address: address,
                    city: city,
                    id:id,
                },
                success: function(response) {
                    // $(".total-price").html('$0.00');
                    popUp();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        // }
    });

    let valid = true

    // Calculate the total price
    // Function to validate and add red border to bottom
    function validateAndHighlight(input) {
        let isValid = true;

        if (input.attr('name') === 'fullname') {
            var parts = input.val().trim().split(' ');
            isValid = parts.length >= 2;
        } else if (input.attr('name') === 'phone') {
            isValid = /^\+\d+$/.test(input.val().trim());
        // } else if($("#payment-method").val()=""){
        //     isValid=false;
        // 
        }else{
            isValid = input.val().trim() !== '' && $("#payment-method").val().trim() !== '';
        }

        input.css('border-bottom', isValid ? '1px solid black' : '1px solid red');
        return isValid;
    }

    // Apply validation on input change
    $('.required').change(function () {
        validateAndHighlight($(this));
    });

    
//selected city
$("#city").val(city).toString();

    // Close the pop-up when the close button is clicked
    $('#close-btn').click(function () {
        $('#overlay').addClass('hidden');
        $('#popup-container').addClass('hidden');
        $('body').css('overflow', 'auto'); // Allow scrolling again
    });



    $('#payment-method').change(function () {
        if ($(this).val() === 'Cash on Delivery') {
            $('.c').hide(); 
        } else {
            // Show the card number and CVV
            $('.c').show();
        }
    });
 

function preventDefaultt(e) {
    e.preventDefault();
}
function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefaultt(e);
        return false;
    }
}
var supportsPassive = false;
try {
    window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
        get: function () { supportsPassive = true; }
    }));
} catch (e) { }

var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

function disableScroll() {
    window.addEventListener('DOMMouseScroll', preventDefaultt, false); // older FF
    window.addEventListener(wheelEvent, preventDefaultt, wheelOpt); // modern desktop
    window.addEventListener('touchmove', preventDefaultt, wheelOpt); // mobile
    window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}
function enableScroll() {
    window.removeEventListener('DOMMouseScroll', preventDefaultt, false);
    window.removeEventListener(wheelEvent, preventDefaultt, wheelOpt);
    window.removeEventListener('touchmove', preventDefaultt, wheelOpt);
    window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}
//show the popUP
let popContainer = $(".pop-up-container").eq(0);
let popUpMsg = $(".pop-up").eq(0);

function popUp() {
    popContainer.css({
        display: "flex",
        alignItems: "center",
        justifyContent: "center"
    });
    popUpMsg.css({
        display: "flex",
        flexDirection: "column"
    });
    $("body").css("overflow", "hidden")
}

    enableScroll();
    let closePopUp = $("#close-btn");
    closePopUp.on("click", function () {
        popContainer.css("display", "none");
        popUpMsg.css("display", "none");
    });

}); 




