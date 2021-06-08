$ = jQuery;
jQuery(document).ready(function() {
    $('#searchUrlBtn').on( 'click', function() {
        let value_of_url = $('#amazonUrl').val();
        $.post( amazon_search_object.amazon_search_url, { data : { 'amazon_url' : value_of_url }, action : 'amazon_search' }, function(status) {
            $('#container').html(  status  );
        });
    });
});