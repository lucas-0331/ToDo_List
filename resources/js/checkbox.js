$(document).ready(function () {
    $('input[type="checkbox"]').on('click', function () {
        let task_id = $(this).attr('id').split('-').pop();

        $.ajax({
            url: '/update_status/' + task_id,
            type: 'POST',
            data: {
                //
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    $('#success_message').text(response.success);
                }
            },
            error: function (error) {
                console.error('Error updating status: ', error);
            }
        });
    });
});
