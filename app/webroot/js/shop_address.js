$(document).ready(function(){

    $('#OrderSameaddress').bind('change', function () {

        if($('#OrderSameaddress').prop('checked')) {

            $('#OrderShippingAddress').val($('#OrderBillingAddress').val());
            $('#OrderShippingAddress2').val($('#OrderBillingAddress2').val());
            $('#OrderShippingCity').val($('#OrderBillingCity').val());
            $('#OrderShippingState').val($('#OrderBillingState').val());
            $('#OrderShippingZip').val($('#OrderBillingZip').val());
            $('#OrderShippingCountry').val($('#OrderBillingCountry').val());


        } else {

            $("#OrderShippingAddress").val('');
            $('#OrderShippingAddress2').val('');
            $('#OrderShippingCity').val('');
            $('#OrderShippingState').val('');
            $('#OrderShippingZip').val('');
            $('#OrderShippingCountry').val('');

        }

    });

});