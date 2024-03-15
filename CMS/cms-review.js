$(document).ready(function(){
    $("input[name='type-of-service']").change(function(){
        let st={typeOfService: $(this).val()}
        $.ajax({
            method: "GET",
            data: st,
            url: 'change-review-options.php',
            success: function(data){
                $("#ratings-cat").html(data);
            }
        })
        $.ajax({
            method: "GET",
            data: $("#filter-reviews").serialize(),
            url: 'cms-review-table.php',
            success: function(data){
                $("#review-table").html(data);
            }
        })
    });

    $("#ratings-cat").change(function(){
        if($("#orderOfRating")===null){
            $("#rce").show();
        }
        else{
            $("#rce").hide();
            $("#roe").hide();
            $.ajax({
                method: "GET",
                data: $("#filter-reviews").serialize(),
                url: 'cms-review-table.php',
                success: function(data){
                    $("#review-table").html(data);
                },
                error: function (error) {
                    console.log("Error fetching data. Please try again."+error);
                }
            })
        }
    });

    $("#orderOfRating").change(function(){
        if($("#ratings-cat")===null){
            $("#roe").show();
        }
        else{
            $("#rce").hide();
            $("#roe").hide();
            $.ajax({
                method: "GET",
                data: $("#filter-reviews").serialize(),
                url: 'cms-review-table.php',
                success: function(data){
                    $("#review-table").html(data);
                },
                error: function (error) {
                    console.log("Error fetching data. Please try again."+error);
                }
            })
        }
    });

    $("#reset").click(function(){
        window.location.reload();
    });
})