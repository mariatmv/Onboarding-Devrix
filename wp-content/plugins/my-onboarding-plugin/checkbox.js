jQuery(document).ready(function($) {
    var data = {
        'action': 'enable_filters',
        'is_checked': enabled_filters_object.is_checked      // We pass php values differently!
    };
    // We can also pass the url value separately from ajaxurl for front end AJAX implementations
    jQuery.post(enabled_filters_object.enabled_filters_url, data, function(response) {
        $('#filters_checkbox').on('click', function () {
            let postData = {
                action: 'enable_filters',
                is_checked: $('#filters_checkbox').is(":checked") ? 'checked' : ''
            }

            $.ajax({
                type: "POST",
                data: postData,
                dataType: "json",
                url: enabled_filters_object.enabled_filters_url
            })
        })
    });
});