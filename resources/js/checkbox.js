$(document).ready(function () {
    $('input[type="checkbox"]').on('click', function () {
        let task_id = $(this).attr('id').split('-').pop();

        $.ajax({
            url: 'task/' + task_id + '/status/',
            type: 'POST',
            data: {
                //
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    alert('Success!')
                }
            },
            error: function (error) {
                console.error('Error updating status: ', error);
            }
        });
    });
});
