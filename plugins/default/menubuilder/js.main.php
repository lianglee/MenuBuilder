//<script>
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
			$('body').on('click', '.menubuilder-icon-select', function(){
				 	$('.menu-builder-icons-selected').removeClass('menu-builder-icons-selected');
					if(!$(this).hasClass('menu-builder-icons-selected')){
							$(this).addClass('menu-builder-icons-selected');	
							$('input[name="icon_name"').val($(this).attr('data-icon'));
							$('input[name="icon_unicode"').val($(this).attr('data-key'));
					}
			});
			$('body').on('click', '#menu-builder-next', function(){
						$('.menubuilder-main-form').addClass("d-none");
						$('.menu-builder-icons').removeClass('d-none');
			});		
			$('body').on('change', '#menu-select-type', function(){
					$type = $(this).val();											 
					Ossn.PostRequest({
               			 url: Ossn.site_url+'menubuilder/submenu?type='+$type,
               			 beforeSend: function(request) {
                  				  $('.menu-select-sub').html('<div class="ossn-loading-menubuilder"></div>');
                		},
                		callback: function(callback) {
                  				if(callback){
										$('.menu-select-sub').html(callback);	
								}
               			 }
           			 });
			});	
			$replaceIcons = function($element){
      					$val = $(this).text();
						$icon = $(this).attr('data-menubuilder-icon');
      					$text = $val.charAt(0).toUpperCase() + $val.slice(1);
      					$(this).html('<i class="'+$icon+'"></i>'+$text);																
			};
			$('.menubuilder-item-topbar-admin').each($replaceIcons);
			$('.menubuilder-item-admin-sidemenu').each($replaceIcons);
			$('.menubuilder-item-footer').each($replaceIcons);
			
			//special case
			$('[class*=menu-topbar-dropdown-menubuilder]').each(function($element){
						$val = $(this).text();
						$icon = $(this).attr('data-menubuilder-icon');
      					$text = $val.charAt(0).toUpperCase() + $val.slice(1);
						$(this).html('<i class="'+$icon+'"></i>'+$text);																
			});

	});
});
