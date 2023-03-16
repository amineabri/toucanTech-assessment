function search() {
    var $searchForm = $("#searchForm");
    var $submitBtn = $('#submitBtn');
    var $results = $("div#results");
    var $resultTBody = $('#result tbody');

    $results.hide();
    $searchForm.submit(function(event) {
        event.preventDefault();
        // Disable submit button and add loading state class
        $submitBtn.prop('disabled', true).addClass('loading');

        $.ajax({
            url: "http://localhost:8000/api/search",
            type: "GET",
            data: $(this).serialize(),
            dataType: 'json'
        })
            .done(function(result) {
                $resultTBody.empty();
                var data = result.data;
                var row = $('<tr>')
                    .append($('<td>').text(data.firstname))
                    .append($('<td>').text(data.lastname))
                    .append($('<td>').text(data.email))
                ;
                $resultTBody.append(row);
                $results.show();
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $resultTBody.empty();
                console.log('Error: ' + textStatus + ' - ' + errorThrown);
            })
            .always(function() {
                // Enable submit button and remove loading state class
                $submitBtn.prop('disabled', false).removeClass('loading');
            });
    });
}

export { search };
