// Fix index of array in <=IE8
if(!Array.prototype.indexOf) {
    Array.prototype.indexOf = function(needle) {
        for(var i = 0; i < this.length; i++) {
            if(this[i] === needle) {
                return i;
            }
        }
        return -1;
    };
}

jQuery.noConflict();

jQuery(document).ready(function($) {

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
				$("#"+inseeId).html(optionArray.join(" "));
				$(".insee-holder").css("opacity", 1);	
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

	$("#fit-text-heading").fitText(1.4);

	$('.datepicking').datepicker({
		weekStart: 1
	});

	$('.form-step1').siblings().hide(); // hide all except step 1

	$("#zip-code").on('blur', function() {
		get_insee($(this).val(), $(this).attr("id"), "insee");
	});

	$("button[class$=-btn]").click(function(){

		var validFields = [],
			currentFieldset = $(this).parent("fieldset"),
			clickedButton = $(this);

		if ($("#zip-code").val().length == 5) {
			get_insee($("#zip-code").val(), "zip-code", "insee");
		}

		if (clickedButton.is($(".continue-btn"))) {

			currentFieldset.find("input:visible, select:visible").each(function(k,v) {
				$(this).parsley('validate');
				if ($(this).parsley('isValid') === true || $(this).parsley('isValid') === null) {
					validFields.push(true);
				} else {
					validFields.push(false);
				}

			});

			if (validFields.indexOf(false) == -1) {				
				clickedButton.closest('.form-step').hide(0).next('.form-step').show(0, scroll_to_top());
				validFields = [];
			}

		} else {
			clickedButton.closest('.form-step').hide(0).prev('.form-step').show(0, scroll_to_top());
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
			},
			msphone: function(val, msphone) {			
				var invalidPhones = ["0000000000", "0123456789", "0101010101", "0100000000", "0200000000", "0300000000", "0400000000", "0500000000", "0600000000", "0700000000", "0800000000", "0900000000"];
				if (val.match(/^00/) || invalidPhones.indexOf(val) > -1) {
					return false;
				} else {
					return true;
				}
			},
			aftertoday: function(val, beforeToday) {
				var today = new Date(),
					valTemp = val.split("-"),
					theDate = new Date(valTemp[1]+"-"+valTemp[0]+"-"+valTemp[2]);
					
				return today < theDate;
			},
			beforetoday: function(val, afterToday) {
				var today = new Date(),
					valTemp = val.split("-"),
					theDate = new Date(valTemp[1]+"-"+valTemp[0]+"-"+valTemp[2]);
					
				return today > theDate;
			}
		},
		messages: {
			exactly: "%s chiffres exactement.",
			msphone: "Téléphone invalide.",
			aftertoday: "Cette date doit être postérieure à aujourd'hui",
			beforetoday: "Cette date doit être antérieure à aujourd'hui"
		},
		listeners: {
			onFormSubmit: function ( isFormValid, event, ParsleyForm ) {
				if (isFormValid) {
					$("button[type=submit]").prop("disabled", true);
				}
			},
			onFieldValidate: function(e) {
				if (!$(e).is(':visible')) {
					return true
				}
				return false;
			},
			onFieldError: function (elem, constraints, ParsleyField) {
				console.log(elem);
			}
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