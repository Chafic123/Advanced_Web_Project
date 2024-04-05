// $(document).ready(function () {

//         $('#order').click(function (event) {
//             event.preventDefault();
//             let isValid1 = true;
//             let isValid2 = true;
            
//             $('.required').each(function () {
//                 if (!validateAndHighlight($(this))) {
//                     isValid1 = false;
//                 }
//             });
        
//             if ($('#payment-method').val() !== 'Cash on Delivery') {
//                 $('.payment-lbl').each(function () {
//                     if (!validateAndHighlight($(this))) {
//                         isValid2 = false;
//                     }
//                 });
//             } else {
//                 if ($(this).val() === 'Cash on Delivery') {
//                     $('.c').hide();
//                 } else {
//                     $('.c').show();
//                 }
//                 isValid2 = true;
//             }
        
//             if (isValid1 && isValid2) {
//                 $.ajax({
//                     type: 'POST',
//                     url: 'checkout-order.php',
//                     data: $('#formOrder').serialize(),
//                     success: function (response) {
//                         popUp();
//                     },
//                     error: function (xhr) {
//                         console.error(xhr.responseText);
//                     }
//                 });
//             }
//         });
//     });
//     $('#payment-method').change(function () {
//         if ($(this).val() === 'Cash on Delivery') {
//             $('.c').hide();
//         } else {

//             $('.c').show();
//         }
//     });
//    // Check if payment method is "Cash on Delivery"
// //    if ($('#payment-method').val() === 'Cash on Delivery') {
// //     // Clear card number and CVV fields
// //     $('.payment-lbl').val('');
// // } else {
// //     // Validate card number and CVV fields
// //     $('.payment-lbl').each(function () {
// //         if (!validateAndHighlight($(this))) {
// //             isValid2 = false;
// //         }
// //     });
// // }

//     function validateAndHighlight(input) {
//         let isValid = true;

//         if (input.attr('name') === 'fullname') {
//             var parts = input.val().trim().split(' ');
//             isValid = parts.length >= 2;
//         } else if (input.attr('name') === 'phone') {
//             isValid = /^\+\d+$/.test(input.val().trim());
//         } else {
//             isValid = input.val().trim() !== '';
//         }

//         if (isValid) {
//             input.css('border', '1px solid black');
//             input.siblings('.error-message').remove(); 
//         } else {
//             input.siblings('.error-message').remove();
//             input.after(`<span class="error-message"
//             style="font-size: 14px;
//             font-style: italic;
//             font-weight: bold;
//             color: #ce5b68;
//             ">
//             *Cannot be Empty</span>`);
//         }
//         return isValid;
//     }

//     //selected city
//     $("#city").val(city).toString();

//     // Close the pop-up when the close button is clicked
//     $('#close-btn').click(function () {
//         $('#overlay').addClass('hidden');
//         $('#popup-container').addClass('hidden');
//         $('body').css('overflow', 'auto'); // Allow scrolling again
//         window.location.href='../Menu/menu.php'
//     });

//     function preventDefaultt(e) {
//         e.preventDefault();
//     }
//     function preventDefaultForScrollKeys(e) {
//         if (keys[e.keyCode]) {
//             preventDefaultt(e);
//             return false;
//         }
//     }
//     var supportsPassive = false;
//     try {
//         window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
//             get: function () { supportsPassive = true; }
//         }));
//     } catch (e) { }

//     var wheelOpt = supportsPassive ? { passive: false } : false;
//     var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

//     function disableScroll() {
//         window.addEventListener('DOMMouseScroll', preventDefaultt, false); // older FF
//         window.addEventListener(wheelEvent, preventDefaultt, wheelOpt); // modern desktop
//         window.addEventListener('touchmove', preventDefaultt, wheelOpt); // mobile
//         window.addEventListener('keydown', preventDefaultForScrollKeys, false);
//     }
//     function enableScroll() {
//         window.removeEventListener('DOMMouseScroll', preventDefaultt, false);
//         window.removeEventListener(wheelEvent, preventDefaultt, wheelOpt);
//         window.removeEventListener('touchmove', preventDefaultt, wheelOpt);
//         window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
//     }
//     //show the popUP
//     let popContainer = $(".pop-up-container").eq(0);
//     let popUpMsg = $(".pop-up").eq(0);

//     function popUp() {
//         popContainer.css({
//             display: "flex",
//             alignItems: "center",
//             justifyContent: "center"
//         });
//         popUpMsg.css({
//             display: "flex",
//             flexDirection: "column"
//         });
//         $("body").css("overflow", "hidden")
//     }

//     enableScroll();
//     let closePopUp = $("#close-btn");
//     closePopUp.on("click", function () {
//         popContainer.css("display", "none");
//         popUpMsg.css("display", "none");
//     });


$(document).ready(function () {

    $('#order').click(function (event) {
        event.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'checkout-order.php',
                data: $('#formOrder').serialize(),
                success: function (response) {
                    popUp();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        
    });

    $('#payment-method').change(function () {
        if ($(this).val() === 'Cash on Delivery') {
            $('.c').hide();
        } else {
            $('.c').show();
        }
    });

    //selected city
    $("#city").val(city);

    // Close the pop-up when the close button is clicked
    $('#close-btn').click(function () {
        $('#overlay').addClass('hidden');
        $('#popup-container').addClass('hidden');
        $('body').css('overflow', 'auto'); // Allow scrolling again
        window.location.href = '../Menu/menu.php';
    });

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
        $("body").css("overflow", "hidden");
    }

    enableScroll();
    let closePopUp = $("#close-btn");
    closePopUp.on("click", function () {
        popContainer.css("display", "none");
        popUpMsg.css("display", "none");
    });

});



