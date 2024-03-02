$(document).ready(function () {
    let tot = 0;

    var keys = { 37: 1, 38: 1, 39: 1, 40: 1, 33: 1, 34: 1, 35: 1, 36: 1 };

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
        window.addEventListener('DOMMouseScroll', preventDefaultt, false);
        window.addEventListener(wheelEvent, preventDefaultt, wheelOpt);
        window.addEventListener('touchmove', preventDefaultt, wheelOpt);
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);
    }

    function enableScroll() {
        window.removeEventListener('DOMMouseScroll', preventDefaultt, false);
        window.removeEventListener(wheelEvent, preventDefaultt, wheelOpt);
        window.removeEventListener('touchmove', preventDefaultt, wheelOpt);
        window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
    }

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
    }

    let closePopUp = $("#close-btn");
    closePopUp.on("click", function () {
        enableScroll();
        popContainer.css("display", "none");
        popUpMsg.css("display", "none");
    });

    // removing items
    let removeBtn = $(".remove-btn");
    removeBtn.on("click", function () {
        popUp();
        let yesBtn = $("#yes");
        yesBtn.on("click", function () {
            location.reload();
        });
        $("#no").on("click", function () {
            enableScroll();
            popContainer.css("display", "none");
            popUpMsg.css("display", "none");
        });
    });

    // determines the page display depending on whether the cart is empty or not
    $(window).on("load", function () {
        let tableBody = $("#cart-items-body");
        let emptyCart = $("#empty-cart");
        let totalDiv = $("#total-div");
        if (tableBody.children().length === 0) {
            tableBody.parent().css("display", "none");
            totalDiv.css("display", "none");
            emptyCart.css("display", "flex");
            $("body > h1").css("display", "none");
        } else {
            tableBody.parent().css("display", "table");
            totalDiv.css({
                display: "flex",
                flexDirection: "row",
                alignItems: "flex-end"
            });
            emptyCart.css("display", "none");
            $("body > h1").css("display", "block");
        }
    });

    // checkout button
    let checkoutBtn = $(".checkout-btn").eq(0);
    checkoutBtn.on("click", function () {
        if (account!=3) {
            window.open("../Checkout/checkout.php", "_self");
        }
    });

    // Update the price in a pop-up message
    $(document).on('DOMContentLoaded', function () {
        var updateButtons = $('.update-btn');

        updateButtons.on('click', function () {
            var itemNum = $(this).data('itemnum');
            var quantityInput = $(this).closest("tr").find('.quantity-input');
            var currentQuantity = quantityInput.val();

            var confirmed = window.confirm('Do you want to update the quantity?');

            if (confirmed) {
                window.location.href = 'update_quantity.php?itemNum=' + itemNum + '&quantity=' + currentQuantity;
            }
        });
    });

    // Confirm the delete
    $(".delete-link").on("click", function () {
        var itemnum = $(this).data("ItemNum");
        var confirmDelete = confirm("Are you sure you want to delete this item?");
        if (confirmDelete) {
            window.location.href = "Delete.php?itemNum=" + itemnum;
        }
    });
});