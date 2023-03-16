export function newMember() {
    var $newMemberForm = $("form#newMemberForm");
    var $submitBtn = $('#submitBtn');

    $newMemberForm.on('submit', function(event) {
        event.preventDefault(); // prevent default form submit behavior
        // Disable submit button and add loading state class
        $submitBtn.prop('disabled', true).addClass('loading');
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
        }).done(function(response) {
            if (response.redirect_url) {
                window.location.href = response.redirect_url;
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + textStatus + ' - ' + errorThrown);
        }).always(function() {
            // Enable submit button and remove loading state class
            $submitBtn.prop('disabled', false).removeClass('loading');
        });
    });
}
