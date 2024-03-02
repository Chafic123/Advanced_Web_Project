$(document).ready(function () {

    // Open account dropdown
    function displayAccountInfo() {
        $("#account").css({position: 'absolute', right: '-220px'});
        $("#account").animate({
            right: '0'
        }, "slow", function(){
            $("body").css({overflowX: 'hidden'})
        })
        $("#account").css({ display: "flex", flexDirection: "column" });
        $("#nav-bar").width("100%");
    }

    // Close account dropdown
    function closeAccountInfo() {
        $("#account").animate({
          right: "-220px" // Move element 120px to the right
        }, "slow", function() {
            $("body").css({overflowX: 'hidden'});
          // Callback function after animation completes
          $("#account").hide();
        });
      }      

    // Account dropdown for big screens
    $("#account-icon").click(function () {
        let account = $("#account");
        if (account.css("display") === "none") {
            displayAccountInfo();

        } else {
            closeAccountInfo();
        }
    });

    // Dropdown for small screens
    let pressedDrop = false;
    $(".drop-nav-bar").click(function () {
        if (!pressedDrop) {
            $(".nav-items").css({position: 'absolute', right: '-220px'});
            $(".nav-items").animate({
                right: '0'
            }, "slow", function(){
                $("body").css({overflowX: 'hidden'})
            })
            $(".nav-items").css({ display: "flex", flexDirection: "column" });
            $(".nav-items").show();
            if (window.sessionStorage.getItem("SignedIn") === "true") {
                $(".signed-out:last").hide();
                $(".account-info:last").css({ display: "flex", flexDirection: "column" });
                $("#username-text2").text(user[0]);
            }
            pressedDrop = true;
        } else {
            $(".nav-items").animate({
                right: "-220px" // Move element 220px to the right
              }, "slow", function() {
                  $("body").css({overflowX: 'hidden'});
                // Callback function after animation completes
                $(".nav-items").hide();
              });
            pressedDrop = false;
        }
    });

    // Sign out for nav on big screens
    $("#sign-out-btn").click(function () {
        $("#account").hide();
        location.reload();
        $(".signed-out:first").show();
        $(".account-info:first").hide();
    });

    // Sign out for nav on small screens
    $("#sign-out-btn2").click(function () {
        $(".nav-items:first").hide();
        location.reload();
        $(".signed-out:last").show();
        $(".account-info:last").hide();
    });


    // Swup instance (assuming Swup is already loaded as a separate script)
    const swup = new Swup();

    let loginPopup = $(".l");
    let signupPopup=$(".s");
    let loginBtn = $(".login");
    let signupBtn=$(".up");
    let signinX = $(".signX");
    let backdrop = $("#backdrop");
    
    /*Function to Remove Error Message*/
    function removeError(element) {
        let parentElement = element.closest('.input-field');
        parentElement.removeClass('error');
        let alertMessage = parentElement.find('small');
        alertMessage.text('');
    }
    
    // Show login popup and backdrop
    loginBtn.on("click",function(){
      signupPopup.hide();
      loginPopup.show();
      backdrop.show();
      $("#sign-in-user").val("");
      $("#sign-in-pass").val("");
      $("#rem").prop("checked", false);
      removeError($("#sign-in-user"));
      removeError($("#sign-in-pass"));
    });
  
    signupBtn.on("click",function(){
      loginPopup.hide();
      signupPopup.show();
      backdrop.show();
      $("#frst-name-Input").val("");
      $("#lst-name-Input").val("");
      $("#ContactInput").val("");
      $("#bday").val("");
      $("#password").val("");
      $("#confirmPassword").val("");
      removeError($("#frst-name-Input"));
      removeError($("#lst-name-Input"));
      removeError($("#ContactInput"));
      removeError($("#bday"));
      removeError($("#password"));
      removeError($("#confirmPassword"));
    });
    
    // Hide login popup and backdrop
    signinX.click(function () {
      loginPopup.hide();
      signupPopup.hide();
      backdrop.hide();
      $("#sign-in-user").val("");
      $("#sign-in-pass").val("");
      $("#frst-name-Input").val("");
      $("#lst-name-Input").val("");
      $("#ContactInput").val("");
      $("#bday").val("");
      $("#password").val("");
      $("#confirmPassword").val("");
      $("#rem").prop("checked", false);
      removeError($("#sign-in-user"));
      removeError($("#sign-in-pass"));
      removeError($("#frst-name-Input"));
      removeError($("#lst-name-Input"));
      removeError($("#ContactInput"));
      removeError($("#bday"));
      removeError($("#password"));
      removeError($("#confirmPassword"));
    });

    $(".togglePassword").on("click",function(){
        // Toggle the eye icon class to switch between open and closed eye icons
        $(this).toggleClass('far fa-eye far fa-eye-slash');
    });
});