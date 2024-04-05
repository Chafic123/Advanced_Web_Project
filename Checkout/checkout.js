$(document).ready(function () {
    
    //selected city
    $("#city").val(city).toString();

     /*Function to Add Error Message*/
     function setError(element, errorMessage) {
        let parentElement = element.closest('.formC');
        parentElement.addClass('error');
        let alertMessage = parentElement.find('small');
        alertMessage.text(errorMessage);
    }

    /*Function to Remove Error Message*/
    function removeError(element) {
        let parentElement = element.closest('.formC');
        parentElement.removeClass('error');
        let alertMessage = parentElement.find('small');
        alertMessage.text('');
    }

    //check if inputs are empty!
    function empty(element){
        let item=element;
        if(item.find("option:selected").val()==='' || item.val().trim() === ''){
            setError(element, "*Cannot be Empty");
            return true;
        }
        else{
            removeError(element);
            return false;
        }
    }

    var validPaymentMethod=false;
    var paymentMethod="";
    var ed=null;
    $("#ed").change(function(){
        ed=$(this).val();
    })


    $('#order').click(function (event) {
        event.preventDefault();

        var validRequired=true;
        var validPaymnetLbl=true;

        var parts = $("#fullname").val().trim().split(' ');
        if(empty($("#fullname")) || empty($("#phone")) || empty($("#address")) || empty($("#city"))){
            empty($("#fullname"));
            empty($("#phone"));
            empty($("#address"));
            empty($("#city"));
            validRequired=false;
        }

        if(!(parts.length >= 2) || !$("#phone").val().match(/^\d+$/) || !$("#cn").val().match(/^\d+$/) || !$("#cvv").val().match(/^\d+$/)){
            if(!(parts.length >= 2)){
                setError($("#fullname"),'*Please enter a valid  name!');
                validRequired = false;
            }
            if(!$("#phone").val().match(/^\d+$/)){
                setError($("#phone"),'*Please enter a valid  phone number!');
                validRequired = false;
            }
            if (paymentMethod !== "" && paymentMethod !== 'Cash on Delivery') {
                if(empty($("#cn")) || ed==="" || empty($("#cvv"))){
                    empty($("#cn"));
                    empty($("#ed"));
                    empty($("#cvv"));
                    validPaymnetLbl=false;
                }
                else if(!$("#cn").val().match(/^\d+$/)){
                    setError($("#cn"),'*Please enter a valid  credit card number!');
                    validPaymnetLbl=false;
                }
                else if(!$("#cvv").val().match(/^\d+$/)){
                    setError($("#cvv"),'*Please enter a valid  CVV!');
                    validPaymnetLbl=false;
                }
            }
            else{
                validPaymnetLbl=true;
            }
        }
        else{
            validRequired=true;
            validPaymnetLbl=true;
            removeError($("#fullname"));
            removeError($("#phone"));
            removeError($("#cn"));
            removeError($("#cvv"));
        }

        if(!validPaymentMethod){
            empty($("#payment-method"));
        }
        else{
            removeError($("#payment-method"));
        }

        if (validPaymentMethod && validPaymnetLbl && validRequired) {
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
                success: function (data) {
                    popUp();
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }
    });
    
    $('#payment-method').change(function () {
        if ($(this).val() === 'Cash on Delivery') {
            $('.c').hide();        
        } else {
            $('.c').show();
        }
        validPaymentMethod=true;
        paymentMethod=$(this).val();
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
        disableScroll();
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

    let closePopUp = $("#close-btn");
    closePopUp.on("click", function () {
        enableScroll();
        popContainer.css("display", "none");
        popUpMsg.css("display", "none");
        window.location.href='../Menu/menu.php'
    });

});