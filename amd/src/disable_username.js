define(['core/notification', 'jquery'], function(Notification, $) {
    return {
        init: function() {
            $('#id_use_studentid').change(function() {
                if ($(this).is(':checked')) {
                    $('#id_username').prop('disabled', true);
                } else {
                    $('#id_username').prop('disabled', false);
                }
            });
        }
    };
});