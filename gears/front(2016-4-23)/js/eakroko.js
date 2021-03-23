$(document).ready(function () {

    if ($(".complexify-me").length > 0) {
        $(".complexify-me").complexify(function (valid, complexity) {
            if (complexity < 40) {
                $(this).parent().find(".progress .bar").removeClass("bar-green").addClass("bar-red");
            } else {
                $(this).parent().find(".progress .bar").addClass("bar-green").removeClass("bar-red");
            }

            $(this).parent().find(".progress .bar").width(Math.floor(complexity) + "%").html(Math.floor(complexity) + "%");
        });
    }



    // Validation
    if ($('.form-validate').length > 0) {
        $('.form-validate').each(function () {
            var id = $(this).attr('id');
            $("#" + id).validate({
                errorElement: 'span',
                errorClass: 'help-block has-error',
                errorPlacement: function (error, element) {
                    if (element.parents("label").length > 0) {
                        element.parents("label").after(error);
                    } else {
                        element.after(error);
                    }
                },
                highlight: function (label) {
                    $(label).closest('.form-group').removeClass('has-error has-success').addClass('has-error');
                },
                success: function (label) {
                    label.addClass('valid').closest('.form-group').removeClass('has-error has-success').addClass('has-success');
                },
                onkeyup: function (element) {
                    $(element).valid();
                },
                onfocusout: function (element) {
                    $(element).valid();
                }
            });
        });
    }

});