function get_insee(zipCode) {
	$.ajax({
		url: 'liste-insee.php',
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
			$("#insee").html(optionArray.join(" ")).parents(".insee-holder").css("opacity", 1);	
		},
		error: function (d, r, obj) {
			console.log("error : "+r+", "+d+", "+obj);
		}
	});	
}

function scroll_to_top() {
	$("html, body").animate({ scrollTop: 0 }, "fast");
}

var theFormCookie = $.cookie('form'), 
	theForm = $("form"),
	inseeHolder = $(".insee-holder");

$(document).ready(function() {

	$('.form-step1').siblings().hide(); // hide all except step 1

	$("#zip-code").on('blur', function() {
		get_insee($(this).val());
	});

	$(".date-input").each(function() {
		var theDateField = $(this);
		theDateField.on({
			keyup: function() {		
				if (theDateField.val().length == theDateField[0].size) {
					if (theDateField.val().length == 4) {
						theDateField.blur();
					} else {
						theDateField.next('.date-input').focus();
					}
				}
			},
			blur: function() {
				theDateField.parsley('validate');
			}
		});
	});

	$("button[class$=-btn]").click(function(){

		var validFields = [],
			currentFieldset = $(this).parent("fieldset"),
			clickedButton = $(this);

		if ($("#zip-code").val().length == 5 && $("#insee").val()) {
			get_insee($("#zip-code").val());
		}

		currentFieldset.find("input, select").not("[type=hidden]").each(function(k,v) {
			$(this).parsley('validate');
			if ($(this).parsley('isValid') === true || $(this).parsley('isValid') === null) {
				validFields.push(true);
			} else {
				validFields.push(false);
			}

		});

		if (validFields.indexOf(false) == -1) {
			if (clickedButton.is($(".continue-btn"))) {
				clickedButton.closest('.form-step').hide(0).next('.form-step').show(0, scroll_to_top());
			} else {
				clickedButton.closest('.form-step').hide(0).prev('.form-step').show(0, scroll_to_top());
			}			
			validFields = [];
		}
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
		},
		validators: {
			exactly: function(val, exactly) {
				return val.length === exactly;
			}
		},
		messages: {
			exactly: "%s chiffres exactement."
		}
	});

	theForm.on("submit", function() {
		$.cookie('form', $(this).formParams());
	});

	if (theFormCookie) {
		theForm.formParams(theFormCookie);
		if(theFormCookie.zip_code.length === 5) {
			get_insee(theFormCookie.zip_code);
		}
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