function get_insee(zipCode, zipCodeId, inseeId) {
	$.ajax({
		url: 'php/curl_misterassur.php',
		type: 'POST',
		cache: false,
		data: "service=insee&zip_code="+zipCode,
		success: function (data) {			

			var optionArray = [],
				theJsonData = $.parseJSON(data).item,
				key,
				count = 0;

			for (key in theJsonData) {
				if(theJsonData.hasOwnProperty(key)) {
					count++;
				}
			}

			if ($.isEmptyObject(theJsonData)) {
				$("#"+zipCodeId+", #"+inseeId).parents(".control-group").removeClass("success").addClass("error");
				optionArray.push('<option value="">Code postal erroné</option>');
			} else {

				if (count > 2) {
					$.each(theJsonData, function(k,v) {
						optionArray.push("<option value="+v.insee+">"+v.ville+"</option>");
					});
				} else {
					optionArray.push("<option value="+theJsonData.insee+">"+theJsonData.ville+"</option>");
				}

			}
			$("#"+inseeId).html(optionArray.join(" ")).parents(".insee-holder").css("opacity", 1);	
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

	$("#fit-text-heading").fitText(1.2);

	$('.form-step1').siblings().hide(); // hide all except step 1

	$("#zip-code").on('blur', function() {
		get_insee($(this).val(), $(this).attr("id"), "insee");
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

		if ($("#zip-code").val().length == 5) {
			get_insee($("#zip-code").val(), "zip-code", "insee");
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
		urlCurl: "php/sharrre.php",
		click: function(api, options){
			api.simulateClick();
			api.openPopup('googlePlus');
		}
	});

});