// /public/js/custom.js

jQuery(function($) {
	console.log('Hello form-builder');
	
    $('#build').on("click",function(event){
    	console.log('Saving...');
        var $stickynote = $(this);
        var update_id = $stickynote.attr('id'),
        update_content = $stickynote.html();
        update_id = update_id.replace("stickynote-","");
//        console.log('update_id: ' + update_id);
//        console.log('update_content: ' + $stickynote.html());

        $.post("form-builder/update", {
            id: update_id,
            name: update_content
        },function(data){
            if(data.response == false){
                // print error message
                console.log('could not update');
            }
        }, 'json');

    });
});
