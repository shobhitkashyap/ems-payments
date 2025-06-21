$(document).ready(function () {
    // Common handler for all forms with .ajax-form
    $('.ajax-form').on('submit', function (e) {
        e.preventDefault();

        let $form = $(this);
        let actionUrl = $form.attr('action');
        let method = $form.attr('method') || 'POST';
        let formData = new FormData(this);
        // Clear previous errors
        $form.find('.text-danger.error-text').remove();
        // Optional: Call beforeSubmit if needed
        if (typeof beforeSubmit === 'function') beforeSubmit($form);

        $.ajax({
            url: actionUrl,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $form.find('button[type="submit"]').prop('disabled', true);
            },
            success: function (response) {
                // Optional: Call afterSuccess if needed
                $form[0].reset();
                if (typeof afterSuccess === 'function') afterSuccess(response, $form);
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                setTimeout(function () {
                    window.location.href = response.redirect;
                }
                , 1000);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, messages) {
                        let inputField = $form.find('[name="' + key + '"]');

                        if (inputField.length) {
                            let errorMessage = $('<span>')
                                .addClass('text-danger error-text')
                                .text(messages[0]);

                            // Avoid injecting duplicates
                            if (!inputField.next('.error-text').length) {
                                inputField.after(errorMessage);
                            }
                        }
                    });
                } else {
                    alert('An error occurred. Please try again.');
                }
            },
            complete: function () {
                $form.find('button[type="submit"]').prop('disabled', false);
                // Optional: Call afterComplete if needed
                if (typeof afterComplete === 'function') afterComplete($form);
            }
        });
    });
});
