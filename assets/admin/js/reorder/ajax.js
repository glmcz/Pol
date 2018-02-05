$(document).ready(function() {

//reorder albums / photos
    $('#reorder').sortable({
        opacity: '0.5',
            update: function(e, ui){
                newOrder = $(this).sortable("serialize");
                console.log(newOrder);
                $.ajax({
                    url: "http://allatravesti.com/adminpanel/save_order",
                    type: 'POST',
                    data: newOrder,
                    // complete: function(){},
                    success: function(feedback){
                        $("div#info").effect("highlight", {}, 3000);
                    },
                    error: function(){
                        $.jGrowl('Reorder Fail!');
                        return false;
                    }
            });
        }
    });




});


