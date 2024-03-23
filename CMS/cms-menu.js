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
    
    var num= null;
    $(".editm").on("click", function () {
        num=$(this).data("id");
        $("#id").val(num);
    });

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

    $("#search").keyup(function(){
        menuItemTable();
    });

    $("#cat").change(function(){
        menuItemTable();
    });

});