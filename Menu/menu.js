//More Variable declaration
let bottom = document.documentElement.scrollHeight;
let upDown = document.getElementsByClassName("up-down-btns");
let upBtn = document.getElementById("up-btn");
let addItems = document.getElementsByClassName("add-btn");
let popContainer = document.getElementsByClassName("pop-up-container")[0];
let popUpMsg = document.getElementsByClassName("pop-up")[0];
let loginBtn = document.getElementById("login-btn");
let checkoutBtn = document.getElementsByClassName("checkout-btn")[0];

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

//to go to the very top and very bottom of the page
function goUp() {
    window.scrollTo(0, 0);
}
function goDown() {
    window.scrollTo(0, bottom);
}
//to display the pop-up
function popUp() {
    disableScroll();
    popContainer.style.display = "flex";
    popContainer.style.alignItems = "center";
    popContainer.style.justifyContent = "center";
    popUpMsg.style.display = "flex";
    popUpMsg.style.flexDirection = "column";
}

//to checkout 
checkoutBtn.addEventListener("click", function () {
    if (window.sessionStorage.getItem("SignedIn") == "true") {
        window.open("../Checkout/checkout.php", "_self");
    }
    else {
        popUp()
    }
})
//changes which of the up and down buttons are available depending on where the user is on the screen
window.addEventListener("scroll", function () {
    bottom = document.documentElement.scrollHeight;
    let y = 0;
    if (bottom < 20000 && bottom >= 10000) {
        y = 0.12
    }
    else if (bottom < 30000 && bottom >= 20000) {
        y = 0.08
    }
    else if (bottom < 30000 && bottom >= 20000) {
        y = 0.06
    }
    else if(bottom<3000){
        y=0.65;
    }
    else {
        y = 0.05
    }
    
    let sHeight = document.documentElement.scrollTop;
    if (sHeight == 0) {
        upDown[0].style.display = "none";
        upDown[1].style.display = "block";
    }
    else if (sHeight > bottom - bottom * y) {
        upDown[0].style.display = "block"
        upDown[1].style.display = "none"
    }
    else {
        upDown[0].style.display = "block"
        upDown[1].style.display = "block"
    }
})
let closePopUp = document.getElementById("close-btn");
//closes the pop-up
closePopUp.addEventListener("click", () => {
    enableScroll();
    popContainer.style.display = "none";
    popUpMsg.style.display = "none";
});

loginBtn.addEventListener("click", function(){
    enableScroll();
    popContainer.style.display = "none";
    popUpMsg.style.display = "none";
});

upDown[0].addEventListener("click", goUp)
upDown[1].addEventListener("click", goDown)

$(document).ready(function () {
    let curCate = 0;
    $(".category-btn").on('click', function () {
        window.scrollTo(0, 0);
        curCate = $(this).val();
        $.post('menu-repository.php', {
            categoryDisplay: curCate
        }).done(function (generateItems, status, xhr) {
            if (status === "success") {
                $('#menu').html(generateItems);
                $('form.card').submit(function (e) {
                    e.preventDefault();
                    if (account !== 3) {
                        let id = parseInt($(this).find("input[name='item_id']").val());
                        let qt = parseInt($(this).find("input[name='quantity']").val());
                        $.post('add_to_cart.php', {
                            item_id: id,
                            quantity: qt
                        }).done(function (response, status, xhr) {
                            if (status === "success") {
                                $("#total-price").text(response);
                                $.post('number_of_items.php').done(function (response, status, xhr) {
                                    if (status === "success") {
                                        $("#countOfItems").html(response);
                                    } else {
                                        console.error("Error getting number of items:", xhr.statusText);
                                    }
                                });
                            } else {
                                console.error("Error adding item to cart:", xhr.statusText);
                            }
                        });
                        $(this).find("input[name='quantity']").val("");
                    }
                    else {
                        popUp();
                    }
            
                });
            } else {
                // Error handling: display error message
                $('#menu').html("An error occurred. Please try again later.");
            }
        });

    });

    $('form.card').submit(function (e) {
        e.preventDefault();
        if (account !== 3) {
            let id = $(this).find("input[name='item_id']").val();
            let qt = $(this).find("input[name='quantity']").val();
            $.post('add_to_cart.php', {
                item_id: id,
                quantity: qt
            }).done(function (response, status, xhr) {
                if (status === "success") {
                    $("#total-price").text(response);
                    $.post('number_of_items.php').done(function (response, status, xhr) {
                        if (status === "success") {
                            $("#countOfItems").html(response);
                        } else {
                            console.error("Error getting number of items:", xhr.statusText);
                        }
                    });
                } else {
                    console.error("Error adding item to cart:", xhr.statusText);
                }
            });
            $(this).find("input[name='quantity']").val("");
        }
        else {
            popUp();
        }

    });


});

