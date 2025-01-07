<!-- # JS Plugins -->
<script src="{{ asset('Frontend/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Frontend/plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('Frontend/plugins/slick/slick.min.js') }}"></script>
<script src="{{ asset('Frontend/plugins/scrollmenu/scrollmenu.min.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('Frontend/js/script.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#loanForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Get form data
            var formData = {
                name: $('#name').val(),
                tel: $('#tel').val(),
                age: $('#age').val(),
                email: $('#email').val(),
                income: $('#income').val(),
                services: $('#services').val(),
                city: $('#city').val(),
            };

            // Send AJAX request with the correct method and URL
            $.ajax({
                type: 'POST', // Use POST method
                url: '{{ route('submit.inquiry') }}', // Use the correct route
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                },
                data: formData,
                success: function(response) {
                    $('#applyLoan').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Thank you for your inquiry!',
                        text: 'We get back to you as soon as possible, typically within 24 hours',
                        confirmButtonColor: '#28a745', // Green color for the "Okay" button
                        confirmButtonText: 'Okay' // Text for the "Okay" button
                    });
                    $('#loanForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    $('.error').text(''); // Clear previous error messages
                    $.each(errors, function(key, value) {
                        $('#' + key).next('.error').text(value).addClass(
                            'is-invalid');
                    });
                }
            });
        });
    });
</script>

</body>

</html>