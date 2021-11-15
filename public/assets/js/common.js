function commonStatusMessage(data, indexUrl) {
    if (data.status == 'success') { //0
        swal(data.message, "success");
        if (indexUrl) {
            window.location.href = indexUrl;
        }
        return true;
    } else if (data.status == 'error') { //1
        // toastr.error(data.message); 
        $.each(data.errors, function (i) {
            $('#' + i).parent().find('.invalid-feedback').remove();
            $.each(data.errors[i], function (key, val) {
                $('#' + i).addClass('is-invalid');
                $('#' + i).parent().append('<div class="invalid-feedback" for="' + i + '">' + val + '</div>');
            });
        });
        swal(data.message, "danger");
    } else if (data.status == 'exist') { //2
        swal(data.message, "warning");
    }
}

function commonConfirmDelete(deleteUrl, indexUrl) {
    swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: deleteUrl,
                type: "GET",
                data: {'_method': 'GET'},
                dataType: 'json',
                processing: true,
                serverSide: true,
                success: function (data) {
                    swal.fire(
                            'Deleted!',
                            data.message,
                            'success'
                            );
                    window.location.href = indexUrl;
                },
                error: function (data) {
                    console.log(data.statusText);
                    swal.fire({
                        title: 'Opps...',
                        text: data.statusText,
                        type: 'error',
                        timer: '1500'
                    });
                }
            })
        }
    });
}
