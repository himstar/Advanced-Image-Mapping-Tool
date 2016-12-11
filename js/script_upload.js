$(function(){

    var container = $('#uploadProcess');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#uploadForm').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<div class="working hidden"><p></p><span></span><div class="progress"><i></i></div></div>');
            container.html('<img src="./img/loading.gif" width="140px">');
            // Append the file name and file size
		var maxLength = 40;
		var name = data.files[0].name;
		if(name.length >= maxLength - 3)
			name = name.substring(0, maxLength) + '...';
		var text = name + ' (' + formatFileSize(data.files[0].size) + ') - ';
            tpl.find('p').text(text).append('<i>0</i>%');
			
            // Add the HTML to the Container element
            data.context = tpl.appendTo(container);
		
		// wait just a small time before showing uploading process container
		tpl.delay(500).slideDown(300);
		

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
			
        },

        progress: function(e, data){

			// progress bar
			container.html('<img src="./img/loading.gif" width="140px">');

			
		},

		done: function(e, data) {
			// finished upload -> show image-mapping
			var json = $.parseJSON(data.result);
			
			if(json.status == 'error')
			{
				container.delay(5000).slideUp(400, function() { 
					$(this).empty();
					$('<div class="error"></div>').insertAfter('#uploadProcess');
					$('.error').html(' Invalid File Type !!');
					$('.error').delay(400 + 400).slideDown(400).delay(3000).slideUp(400, function(){ $(this).remove(); });
	
				});
		}
			else
			{
				$('#imagemap4posis #mapContainer').find('img').attr('src', json['file']);
				//$('#imagemap4posis #mapContainer').find('img').attr('width', '').attr('height', '');
				removeErrorMessage();
				removeOldMapAndValues();
				$('#navi').attr('currentValue', '#imagemap4posis');

				imgvalue = json['file'];
				
				// hide upload area and show imagemap generator
				$('#upload').slideUp(400, function() {
					$('#uploadUndo, #uploadUndo2').show();
					$('#imagemap4posis').slideDown(400, function() {
						resizeHtml();
					});
					loadImagemapGenerator(json['width'], json['height']);
					
					// clean  upload container
					container.empty();
				});
			}
		},
		
		fail:function(e, data){
			// Something has gone wrong!
			$('<div class="error"></div>').insertAfter('#uploadProcess');
		}

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number')
            return '';
        if (bytes >= 1000000000)
            return (bytes / 1000000000).toFixed(0) + ' GB';
        if (bytes >= 1000000)
            return (bytes / 1000000).toFixed(0) + ' MB';
        return (bytes / 1000).toFixed(0) + ' KB';
    }

});
