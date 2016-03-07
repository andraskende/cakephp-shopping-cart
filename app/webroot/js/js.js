$(document).ready(function(){

    $("#s").autocomplete({

        minLength: 2,
        select: function(event, ui) {
            $("#s").val(ui.item.label);
            $("#searchform").submit();
        },
        source: function (request, response) {
            $.ajax({
                url: Shop.basePath + "products/searchjson",
                data: {
                    term: request.term
                },
                dataType: "json",
                success: function(data) {
                    response($.map(data, function(el, index) {
                        return {
                            value: el.Product.name,
                            name: el.Product.name,
                            image: el.Product.image
                        };
                    }));
                }
            });
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li></li>")
            .data("item.autocomplete", item)
            .append("<a><img width='40' src='" + Shop.basePath + "images/small/" + item.image + "' /> " + item.name + "</a>")
            .appendTo(ul)
    };

});
