jQuery(document).ready(function($) {
    var data = {
        'action': 'my_action',
        'is_checked': ajax_object.is_checked      // We pass php values differently!
    };
    // We can also pass the url value separately from ajaxurl for front end AJAX implementations
    jQuery.post(ajax_object.ajax_url, data, function(response) {
        $('#filters_checkbox').on('click', function () {
            let postData = {
                action: 'my_action',
                is_checked: $('#filters_checkbox').is(":checked") ? 'checked' : ''
            }

            $.ajax({
                type: "POST",
                data: postData,
                dataType: "json",
                url: ajax_object.ajax_url
            })
        })
    });
});