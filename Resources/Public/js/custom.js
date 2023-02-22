$(document).ready(function () {
	//For validating the form
	$('#submitButton').click(function (e) {
		cmpId = $('#cmpId').val();
	 	noOfMandatoryFields = 2; //Total number of fields, which needs validation 
	 	validatedFields = 0;
		mandatoryFieldMessage = '<p class="text-danger">Please fill out this field</p>';
		validCmpIdlMessage = '<p class="text-danger">Please enter a valid CMP-ID</p>';
		validRadiobuttonMessage = '<p class="text-danger">Please select a blocking mode</p>';

		if ($('input[name="tx_consentmanagerv2_web_consentmanagerv2consentmanagerv2[type]"]:checked').length == 0) {
			$('#typeError').html(validRadiobuttonMessage);
		} else {
			$('#typeError').html('');
			validatedFields++;
		}
		if (cmpId == '') {
			$('#cmpIdError').html(mandatoryFieldMessage);
		} else {
			if(cmpId == 0){
				$('#cmpIdError').html(validCmpIdlMessage);
			}else{
				$('#cmpIdError').html('');
				validatedFields++;
			}
		}

		// All field after validated true
		if (validatedFields == noOfMandatoryFields) {
			// form submit
			$("#check").submit();
		} else{
			// form not submit
			return false;
		}

	 });

});