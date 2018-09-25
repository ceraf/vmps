$(function() {
    $('#add_img, #edit_img').click(function(e){
		$(this).parent().parent().find('input[type=file]').click();
	})
	
    $('[rel=mac]').mask('AA:AA:AA:AA:AA:AA', {'translation': {
        A: {pattern: /[a-fA-F0-9]/}
      }
    });

    $('[rel=ip]').mask('009.009.009.009');

    
    $('#del_img').click(function(e){
                $('.preview_field img').attr('src', '/admin/images/no-preview-big.jpg');
                $('#preview_file_name').text('');
                $('#preview_fiels').val('');
                $('.preview_field input').val('');
                $('#add_img').show();
                $('#edit_img').hide();
                $('#del_img').hide();        
    })    
    
	$('[action$="/delete"]').click(function(e){
		var res = confirm('Remove anyway?');
		if (res) {
			var form = $('<form action="' + $(this).attr('action') + '" method="POST" />');
			$('<input type="hidden" name="delete_id" value="' + $(this).attr('param') + '"/>').appendTo(form);
			$('<input style="display: none" type="submit" name="submit"/>').appendTo(form);
			form.appendTo($('body'));
			form.find('[type=submit]').click();
		}
	}) 
	
    $('.preview_field input').change(function(e){

                var file = this.files[0];
				var aImg = $('.preview_field img');
				var reader = new FileReader();
				reader.onload = (function(aImg) {
					return function(e) {
						aImg.attr('src', e.target.result);
					};
				})(aImg);
					
				reader.readAsDataURL(file);
                $('#preview_file_name').text(file.name);
                $('#add_img').hide();
                $('#edit_img').show();
                $('#del_img').show();

	})
    
    $('a[sort-by]').click(function(e){
        var sort = $(this).attr('sort-by');
        var form = $('<form action="" method="POST" />');
        $('<input type="hidden" name="sort_by" value="' + sort + '"/>').appendTo(form);
        $('<input style="display: none" type="submit" name="submit"/>').appendTo(form);
        form.appendTo($('body'));
        form.find('[type=submit]').click();
    })
});