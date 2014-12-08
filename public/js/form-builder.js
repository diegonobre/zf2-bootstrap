// /public/js/custom.js

jQuery(function($) {
	console.log('Hello form-builder');
	
    $('#save').on("click",function(event){
    	console.log('Saving...');
        var $formbuilder = $(this);
        var update_id = $formbuilder.attr('id'),
        console.log('update_id: ' + update_id);
        update_content = $formbuilder.html();
        update_id = update_id.replace("save-","");
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
