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
        var name=$(this).data("name");
        var desc=$(this).data("desc");
        $("#id").val(num);
        editname.val(name);
        description.val(desc);
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
            return true;
        }
        else{
            removeError(element);
            return false;
        }
    }
    let addForm =$("#addForm");
    let editForm=$("#editForm");
    let addname= $("#addForm #name");
    let editname=$("#editForm #name");
    let category=$("#category");
    let description=$( "#descr");
    let price=$( "#price");
    let photo=$("#photo");

    function validateName(form, element){
        $.ajax({
            type: "POST",
            url: "check-name.php",
            data: form.serialize(),
            success: function(response){
                if(response!==""){
                    setError(element, response);
                }
                else{
                    removeError(element);
                }
            },
            error: function(error){
                console.log(error);
            }
        })
    }

    //validate name
    addname.keyup(function(){
        validateName(addForm, addname);    
    })

    editname.keyup(function(){
        validateName(editForm, editname);    
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

    function validatePhoto(photo){
        file=photo.val();
        if(file!==""){
            fileName=file.split('.').shift();
            var ext = file.split(".");
            ext = ext[ext.length-1].toLowerCase();
            var arrayExtensions = ["jpg" , "jpeg", "png"];
            if(arrayExtensions.lastIndexOf(ext)===-1){
                setError(photo, "Unaccepted file format! Please upload image of type jpg, jpeg or png.");
                return false;
            }
            else{
                removeError(photo);
                return true;
            }
        } 
        return true;
    }

    //validate image
    photo.change(function(){
        validatePhoto(photo);
    })

    //add menu item
    $("#add").click(function(e){
        e.preventDefault();

        if($("#nameA").html()!=="" || !validatePhoto(photo)){
            e.preventDefault();
        }
        else if(addname.val().trim()==='' || empty(category) || empty(description) || empty(price) || empty(photo)) {
            empty(addname);
            empty(category);
            empty(description);
            empty(price);
            empty(photo);
        }    
        else{
            addForm.unbind('submit').submit();
        }    
    })

    //edit menu item
    $("#editItem").click(function(e){
        e.preventDefault();
        if(editname.val().trim()==='' && category.find(":selected").val()==='' && description.val().trim()==='' && price.val().trim()==='' && photo.val().trim()===''){
            $("#editForm h6").css("color", "red");
        }
        else if(!validatePhoto(photo) || $("#nameE").html()!==""){
            $("#editForm h6").css("color", "red");
        }
        else{
            editForm.unbind('submit').submit();
        }
    })

    $(".closee").on('click', function () {
        editname.val('');
        category.find(":selected").val(''); 
        description.val('');
        price.val('');
        photo.val('');
        removeError(editname);
        removeError(photo);
        $("#editForm h6").css("color", "default");
    })
});