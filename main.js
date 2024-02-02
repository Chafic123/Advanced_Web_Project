let user = ["dana", "pass"]
//opens the account dropdown
function displayAccountInfo() {
    let account = document.getElementsByClassName("account");
    account[0].style.display = "flex"
    account[0].style.flexDirection = "column"
    document.getElementById("nav-bar").style.width = "100%"
}
//closes the account drop-down
function closeAccountInfo() {
    let account = document.getElementsByClassName("account");
    account[0].style.display = "none"
}
//account dropdown for big screens

let accountBtn = document.getElementById("account-icon")
accountBtn.addEventListener("click", () => {
    let account = document.getElementById("account")
    if (account.style.display == "none") {
        displayAccountInfo();
        if (window.sessionStorage.getItem("SignedIn") == "true") {
            document.getElementsByClassName("signed-out")[0].style.display = "none";
            let cur = document.getElementsByClassName("account-info")[0]
            cur.style.display = "flex";
            cur.style.flexDirection = "column";
            document.getElementById("username-text").innerText = user[0];
        }
    }
    else {
        closeAccountInfo()
    }
})


//dropdown for small screens
let pressedDrop = false;
let dropDown = document.getElementsByClassName("drop-nav-bar");
dropDown[0].addEventListener("click", () => {
    if (pressedDrop == false) {
        let navItems = document.getElementsByClassName("nav-items");
        navItems[0].style.display = "block";
        if (window.sessionStorage.getItem("SignedIn") == "true") {
            document.getElementsByClassName("signed-out")[1].style.display = "none";
            let cur = document.getElementsByClassName("account-info")[1]
            cur.style.display = "flex";
            cur.style.flexDirection = "column";
            document.getElementById("username-text2").innerText = user[0];
        }
        pressedDrop = true;
    }
    else {
        let navItems = document.getElementsByClassName("nav-items");
        navItems[0].style.display = "none";
        pressedDrop = false;
    }
})
//sign out for nav on big screens
let btnSignOut = document.getElementById("sign-out-btn")
btnSignOut.addEventListener("click", function () {
    window.sessionStorage.setItem("SignedIn", "false");
    window.sessionStorage.removeItem("order");
    window.sessionStorage.removeItem("totalPrice");
    document.getElementById("account").style.display = "none";
    location.reload()
    document.getElementsByClassName("signed-out")[0].style.display = "block";
    document.getElementsByClassName("account-info")[0].style.display = "none";

})
//sign out for nav on small screens
let btnSignOut2 = document.getElementById("sign-out-btn2")
btnSignOut2.addEventListener("click", function () {
    window.sessionStorage.setItem("SignedIn", "false");
    window.sessionStorage.removeItem("order");
    window.sessionStorage.removeItem("totalPrice");
    let navItems = document.getElementsByClassName("nav-items");
    navItems[0].style.display = "none";
    location.reload()
    document.getElementsByClassName("signed-out")[1].style.display = "block";
    document.getElementsByClassName("account-info")[1].style.display = "none";
})
//used for smooth transitions between pages
const swup = new Swup();

$(document).ready(function(){
    let loginPopup = $(".l");
    let signupPopup=$(".s")
    let loginBtn = $(".login");
    let signupBtn=$(".up");
    let signinX = $(".signX");
    let backdrop = $("#backdrop"); 
    
    // Show login popup and backdrop
    loginBtn.on("click",function(){
      signupPopup.hide();
      loginPopup.show();
      backdrop.show();
    });
  
    signupBtn.on("click",function(){
      loginPopup.hide();
      signupPopup.show();
      backdrop.show();
    });

    /*Function to Remove Error Message*/
    function removeError(element) {
        let parentElement = element.closest('.input-field');
        parentElement.removeClass('error');
        let alertMessage = parentElement.find('small');
        alertMessage.text('');
    }
    
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
      $("#agree").prop("checked", false);
      $(".policy .paragraph").show();
      removeError($("#sign-in-user"));
      removeError($("#sign-in-pass"));
      removeError($("#frst-name-Input"));
      removeError($("#lst-name-Input"));
      removeError($("#ContactInput"));
      removeError($("#bday"));
      removeError($("#password"));
      removeError($("#confirmPassword"));
      $(".policy").removeClass("error");
      $("#policyError").text("");
    });

    $(".togglePassword").on("click",function(){
        // Toggle the eye icon class to switch between open and closed eye icons
        $(this).toggleClass('far fa-eye far fa-eye-slash');
    });
})
