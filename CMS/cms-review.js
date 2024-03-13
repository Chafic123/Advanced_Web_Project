$(document).ready(function(){
    $("input[name='type-of-service']").change(function(){
        let st={typeOfService: $(this).val()}
        $.ajax({
            method: "GET",
            data: st,
            url: 'change-review-options.php',
            success: function(data){
                $("#ratings-cat").html(data)
            }
        })
        $.ajax({
            method: "GET",
            data: st,
            url: 'cms-review-table.php',
            success: function(data){
                $("#review-table").html(data)
            }
        })
    })
})