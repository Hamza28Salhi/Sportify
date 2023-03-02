$(document).ready(function() {
    // Hide the second form initially
    $('second-form').hide();

    // Listen for changes to the show_second_form field
    $('input[name="registrationForm[show_second_form]"]').on('change', function() {
        if ($(this).prop('checked')) {
            // Check if the selected role includes ROLE_1
            if ($.inArray('ROLE_BOBO', $('select[name="firstForm[roles][]"]').val()) !== -1) {
                // Show the second form if the checkbox is checked and the user has ROLE_1
                $('second-form').show();
            }
        } else {
            // Hide the second form if the checkbox is unchecked
            $('second-form').hide();
        }
    });
});
