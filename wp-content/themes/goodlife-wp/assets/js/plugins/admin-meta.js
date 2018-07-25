jQuery(document).ready(function($){
	// Review Average
	var thb_AverageScoreInput = $('#post_ratings_average'),
			thb_ratings = $('#setting_post_ratings_percentage');
	
	function thb_calculateAverage() {
        var i = 0, thb_TempTotal = 0;
        thb_ratings.find('[id^="post_ratings_percentage_feature_score_"]').each(function() {
            i++;
            thb_TempTotal += parseFloat( $(this).val() );
        });
        var thb_AverageScore = Math.round(thb_TempTotal / i);

        thb_AverageScoreInput.val(thb_AverageScore);

        if ( isNaN(thb_AverageScore) ) { thb_AverageScoreInput.val(''); }

    }

    thb_ratings.find('.ot-numeric-slider-wrap').each(function() {
         var hidden = $('.ot-numeric-slider-hidden-input', this),
            value  = hidden.val(),
            helper = $('.ot-numeric-slider-helper-input', this);
        if ( ! value ) {
          value = hidden.data("min");
          helper.val(value);
        }

        thb_ratings.find('.ot-numeric-slider', this).slider({

            slide: function(event, ui) {
                hidden.add(helper).val(ui.value);
                thb_calculateAverage();
            },
            change: function() {
                OT_UI.init_conditions();
                thb_calculateAverage();
            }
        });
    });

    jQuery(thb_ratings).on('change', '.ot-numeric-slider-hidden-input', function() {
        thb_calculateAverage();
    });

    thb_ratings.on('click', '.option-tree-setting-remove', function(e) {
      if ( $(this).parents('li').hasClass('ui-state-disabled') ) {
        alert(option_tree.remove_no);
        return false;
      }

      var agree = window.confirm(option_tree.remove_agree);

      if (agree) {

          var list = $(this).parents('ul');
          OT_UI.remove(this);
          setTimeout( function() { 
              OT_UI.update_ids(list); 
              thb_calculateAverage();
          }, 200 );
          
      }
      e.preventDefault();
      return false;
  });
	
	// Demo Content Import
	var importBtn = jQuery('#import-demo-content');
	
	importBtn.on("click", function(e){
		e.preventDefault();
		var fetch_images = $('input#thb_fetch_images').prop('checked'),
				demo = $('input[name="option_tree[demo-select]"]:checked').val();
		
		importBtn.addClass('disabled').attr('disabled', 'disabled').unbind('click');

		jQuery.ajax({
			method: "POST",
			url: ajaxurl,
			data: {
				'action': 'thb_import_ajax',
				'fetch_images': fetch_images,
				'demo': demo
			},
			success: function(data){
				jQuery('#option-tree-header-wrap').before('<div id="message" class="updated fade below-h2"><p> Theme Options updated.</p></div>');
			},
			complete: function(){
        window.location.href=window.location.href;
			}
		});
	
	});
});