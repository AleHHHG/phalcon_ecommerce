$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            // Append the file name and file size
            var tpl = $('<div class="col-md-3"><div class="imagem"><div><div class="progress"><h3>Aguarde ...</h3><div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div></div>');
            // Automatically upload the file once it is added to the queue
            data.context = tpl.appendTo('.produto_imagens');

            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('.progress-bar').css('width',progress+'%');
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        },

        done:function(e,data){
            data.context.find('.imagem').prepend('<img  class="img-responsive" src="http://localhost/ecommerce/files/produtos/'+data.files[0].name+'" />');
            data.context.find('.progress').hide();
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});
