function get_insee(zipCode) {
	$.ajax({
		url: '/liste-insee.php',
		type: 'POST',
		cache: false,
		data: "cp="+zipCode,
		success: function (data) {
			var optionArray = [],
				theJsonData = $.parseJSON(data);

			if (theJsonData.length === 0) {
				$("#zip-code, #insee").parents(".control-group").removeClass("success").addClass("error");
				optionArray.push('<option value="">Code postal erronné</option>');
			} else {
				$.each(theJsonData, function(k,v) {
					optionArray.push("<option value="+k+">"+v+"</option>");
				});
			}
			$("#insee").html(optionArray.join(" "));	
		},
		error: function (d, r, obj) {
			console.log("erreur : "+r+", "+d+", "+obj);
		}
	});	
}

$(document).ready(function() {

	var theFormCookie = $.cookie('form'), 
		theForm = $("form");

	$('.step1').siblings().hide(); // hide all except step 1

	$(".date-input").each(function() {
		var theDateField = $(this);
		theDateField.on('keyup', function() {
			if (theDateField.val().length == theDateField[0].maxLength) {
				if (theDateField.val().length == 4) {
					theDateField.blur();
				} else {
					theDateField.next('.date-input').focus();
				}
			}
		});
	});

	$("#zip-code").on("blur", function() {
		get_insee($(this).val());
	});

	$('#continue-btn').click(function(){

		var validFields = [];

		$(".step1").find("input, select").not("[type=hidden]").each(function() {		
			$(this).parsley('validate');
			if (!$(this).parsley('isValid')) {
				validFields.push(false);
			} else {
				validFields.push(true);
			}

		});

		if (validFields.indexOf(false) == -1) {
			$(this).closest('.step').hide(0).next('.step').show(0);
			$("html, body").animate({ scrollTop: 0 }, "fast");
			validFields = [];
		}

		if ($("#zip-code").val().length == 5) {
			get_insee($("#zip-code").val());
		}
	});

	$('#back-btn').click(function(){
		$(this).closest('.step').hide(0).prev('.step').show(0);
		$("html, body").animate({ scrollTop: 0 }, "fast");
		return false;
	});

	theForm.parsley({
		trigger: 'blur',
		successClass: 'success',
		errorClass: 'error',
		errors: {
			classHandler: function(elem,isRadioOrCheckbox) {
				return $(elem).parents(".control-group");
			},
			errorsWrapper: '<div></div>',
			errorElem: '<p class="help-block"></p>'
		}
	});

	theForm.on("submit", function() {
		$.cookie('form', $(this).formParams());
	});

	if (theFormCookie) {
		theForm.formParams(theFormCookie);
	}

	$('#twitter').sharrre({
		share: {
			twitter: true
		},
		enableHover: false,
		enableTracking: true,
		click: function(api, options){
			api.simulateClick();
			api.openPopup('twitter');
		}
	});
	$('#facebook').sharrre({
		share: {
			facebook: true
		},
		enableHover: false,
		enableTracking: true,
		click: function(api, options){
			api.simulateClick();
			api.openPopup('facebook');
		}
	});
	$('#googleplus').sharrre({
		share: {
			googlePlus: true
		},		
		enableHover: false,
		enableTracking: true,
		click: function(api, options){
			api.simulateClick();
			api.openPopup('googlePlus');
		}
	});

});