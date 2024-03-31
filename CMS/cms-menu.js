$(document).ready(function() {
    // Fetch categories for the filter dropdown
    $.ajax({
        type: 'POST',
        url: 'getCategories.php',
        success: function(data) {
            $('.category').html('<option value="" disabled selected>Select Category</option>' + data);
            $("#cat").html('<option value="All" selected>All</option>' + data)
        },
        error:function(error){
            console.error(error);
        }        
    });

    //making items active
    $(".active").on("change", function(){
        var id = {id: $(this).data('id')};
        $.ajax({
            type: 'POST',
            url: 'active-menu.php',
            data: id,
            success: function(data){
                console.log(data);
            },
            error:function(error){
                console.error(error);
            } 
        });     
    });
    
    //show id number in an input
    $(".editm").on("click", function () {
        var num=$(this).data("id");
        $("#id").val(num);
    });

    //display menu item table
    function menuItemTable(){
        $.ajax({
            type: 'POST',
            url: 'filter-menu.php',
            data: $("#filter-menu").serialize(),
            success: function(data){
                $("#menuitems").html(data);
            },
            error:function(error){
                console.error(error);
            } 
        });
    }

    //apply filter when typing in search input
    $("#search").keyup(function(){
        menuItemTable();
    });

    //apply filter when selecting a category
    $("#cat").change(function(){
        menuItemTable();
    });

    //validate form
    let valid=true;

    /*Function to Add Error Message*/
    function setError(element, errorMessage) {
        let parentElement = element.closest('.form-group');
        parentElement.addClass('error');
        let alertMessage = parentElement.find('small');
        alertMessage.text(errorMessage);
        valid=false;
    }

    /*Function to Remove Error Message*/
    function removeError(element) {
        let parentElement = element.closest('.form-group');
        parentElement.removeClass('error');
        let alertMessage = parentElement.find('small');
        alertMessage.text('');
        valid=true;
    }

    //check if inputs are empty!
    function empty(element){
        let item=element;
        if(item.find(":selected").val()==="" || item.val().trim() === ''){
            setError(element, "Field can't be empty!");
        }
        else{
            removeError(element);
        }
    }

    let addname= $("#addForm #name");
    let editname=$("#editForm #name");
    let category=$("#category");
    let description=$( "#descr");
    let price=$( "#price");
    let photo=$("#photo");

    //validate name
    addname.keyup(function(){
        $.ajax({
            type: "POST",
            url: "check-name.php",
            data: $("#addForm").serialize(),
            success: function(response){
                if(response!==""){
                    setError(addname, response);
                }
                else{
                    removeError(addname);
                }
            },
            error: function(error){
                console.log(error);
            }
        })
    })

    editname.keyup(function(){
        $.ajax({
            type: "POST",
            url: "check-name.php",
            data: $("#editForm").serialize(),
            success: function(response){
                if(response!==""){
                    setError(editname, response);
                }
                else{
                    removeError(editname);
                }
            },
            error: function(error){
                console.log(error);
            }
        })
    })

    category.change(function(){
        removeError(category);
    })
    description.keyup(function(){
        removeError(description);
    })
    price.keyup(function(){
        removeError(price);
    })

    //validate image
    photo.change(function(){
        file=photo.val(); 
        fileName=file.split('.').shift();
        console.log(fileName);
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();
        var arrayExtensions = ["jpg" , "jpeg", "png"];
        if(arrayExtensions.lastIndexOf(ext)===-1){
            setError(photo, "Unaccepted file format! Please upload image of type jpg, jpeg or png.");
        }
        else{
            removeError(photo);
        }
    })

    //add menu item
    $("#add").click(function(e){
        empty(addname);
        empty(category);
        empty(description);
        empty(price);
        empty(photo);

        if(!valid){
            e.preventDefault();
            
        }
    })

    //edit menu item
    $("#editItem").click(function(e){
        if(editname.val().trim()==='' && category.find(":selected").val()==='' && description.val().trim()==='' && price.val().trim()==='' && photo.val().trim()===''){
            e.preventDefault();
            $("#editForm h6").css("color", "red");
        }
    })
});