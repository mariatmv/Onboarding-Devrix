jQuery(document).ready(function ($) {
    let data = {
        'action': 'update_activity',
    };

    jQuery.post(activity_object.ajaxurl, data, function(response) {
        $('.activity_checkbox').on('click', function () {
            let postData = {
                action: 'update_activity',
                post_id: $(this).attr('id'),
            }

            $.ajax({
                type: "POST",
                data: postData,
                dataType: "json",
                url: activity_object.ajaxurl
            })
        })
    });
})