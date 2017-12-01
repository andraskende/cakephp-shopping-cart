$(document).ready(function(){

	cardtype($('#OrderCreditcardNumber').val());

	$('#OrderCreditcardNumber').keyup(function() {
		cardtype($('#OrderCreditcardNumber').val());
	});

    $("#OrderReviewForm").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        errorClass: 'error',
        rules: {
            "data[Order][creditcard_number]": {
                required: true,
                digits: true,
                minlength: 15,
                maxlength: 16,
                creditcard: true
            },
            "data[Order][creditcard_code]": {
                required: true,
                digits: true,
                minlength: 3,
                maxlength: 4
            }
        },
        messages: {
            "data[Order][creditcard_number]": {
                required: "Enter Credit Card Number",
                digits: "Numeric Only",
                minlength: $.validator.format("Enter at least {0} digits"),
                maxlength: $.validator.format("Enter maximum {0} digits"),
                creditcard: "Enter Valid Credit Card Number"
            },
            "data[Order][creditcard_code]": {
                required: "Enter CVC Code",
                digits: "Numeric Only",
                minlength: $.validator.format("Enter at least {0} digits"),
                maxlength: $.validator.format("Enter maximum {0} digits")
            }
        }
    });

    $("#cscpop").popover({
        container: 'body',
        html: true,
        trigger: 'hover'
    });

});


function cardtype(num) {

    if(num.length == 1) {

        if(num == 4){
            $('#OrderCreditcardNumber').attr('style', 'background: url("'+Shop.basePath+'img/cards/4.png") no-repeat right 5px center !important');
        }
        else if(num == 5){
            $('#OrderCreditcardNumber').attr('style', 'background: url("'+Shop.basePath+'img/cards/5.png") no-repeat right 5px center !important');
        }
        else if(num == 3){
            $('#OrderCreditcardNumber').attr('style', 'background: url("'+Shop.basePath+'img/cards/3.png") no-repeat right 5px center !important');
        }
        else if(num == 6){
            $('#OrderCreditcardNumber').attr('style', 'background: url("'+Shop.basePath+'img/cards/6.png") no-repeat right 5px center !important');
        }

    } else if(num.length < 1){
        $('#OrderCreditcardNumber').attr('style', 'background: url("'+Shop.basePath+'img/cards/cards.png") no-repeat right 5px center !important');
    }

    return true;

}