$(document).ready(function() {
    let checkoutBtn = $(".checkout-btn").eq(0);
    let popContainer = $(".pop-up-container1").eq(0);
    let popUpMsg = $(".pop-up").eq(0);
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

    // Popup

    function popUp1() {
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
    
    checkoutBtn.on("click", function () {
        if (window.sessionStorage.getItem("SignedIn") == "true") {
            window.open("../Checkout/checkout.php", "_self");
        } else {
            alert("Please login first");
        }
    });
    
    // Closes the pop-up
    closePopUp.on("click", function () {
        enableScroll();
        popContainer.css("display", "none");
        popUpMsg.css("display", "none");
    });
//update ajax
    // $(document).ready(function() {
    //     $(".update-btn").on("click", function() {
    //         let $row = $(this).closest("tr");
    //         let itemId = $row.data("itemnum");
    //         let accountNum = $row.data("accountnum");
    //         let newQuantity = $row.find(".quantity-input").val();
    
    //         $.ajax({
    //             type: "GET",
    //             url: "updatequantity.php",
    //             data: { itemNum: itemId, quantity: newQuantity, accountNum: accountNum },
    //             success: function(response) {
    //                 let newPrice = parseFloat(response); 
    //                 $row.find(".price").text(newPrice.toFixed(2)); 
    //             },
    //             error: function(error) {
    //                 console.error("Error updating item quantity:", error);
    //             }
    //         });
    //     });
    // });
    
    //delete ajax

    $(".delete-link").on("click", function (e) {
        e.preventDefault();
    
        let itemId = $(this).closest("tr").data("itemnum");
        let accountNum = $(this).closest("tr").data("accountnum");
    
        popUp1();
    
        $("#yes").on("click", function () {
            enableScroll();
            popContainer.css("display", "none");
            popUpMsg.css("display", "none");
            $.ajax({
                type: "GET",
                url: "delete.php",
                data: { itemNum: itemId, accountNum: accountNum },
                success: function() {
                    $('tr[data-itemnum="' + itemId + '"][data-accountnum="' + accountNum + '"]').remove();
                    window.location.reload(true);
                    if($("#cart-table tbody tr").length === 0) {

                        $("#cart-table").after("<p>Your cart is empty.</p>");
                        $("#cart-table").remove(); 
                    }
                },
                error: function (error) {
                    console.error("Error deleting item:", error);
                }
            });
            
        });
    
        $("#no").on("click", function () {
            popContainer.css("display", "none");
            popUpMsg.css("display", "none");
        });
    });
});

