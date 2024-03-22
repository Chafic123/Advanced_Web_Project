$(document).ready(function() {

    // Fetch categories for the filter dropdown
    $.ajax({
        type: 'GET',
        url: 'getCategories.php',
        success: function(data) {
            $('#category').html(data);
        }
    });
    
});