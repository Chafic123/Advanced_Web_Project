$(document).ready(function(){
    function reviewtable(){
        $.ajax({
            method: "POST",
            data: $("#filter-reviews").serialize(),
            url: 'cms-review-table.php',
            success: function(data){
                $("#review-table").html(data);
            }
        })
    }

    $("input[name='type-of-service']").change(function(){
        let st={typeOfService: $(this).val()}
        $.ajax({
            method: "POST",
            data: st,
            url: 'change-review-options.php',
            success: function(data){
                $("#ratings-cat").html(data);
            }
        })
        
        reviewtable();
    });

    $("#ratings-cat").change(function(){
        reviewtable();
    });

    $("#order-rate").change(function(){
        reviewtable();
    });

    $("#reset").click(function(){
        window.location.reload();
    });
})