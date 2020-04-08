$(document).ready(function () {
    $("#sign-in").click(function () {
        var nbe = 0;
        $("#form_sign-up .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("error");
                nbe++;

            } else {
                $(this).parent("div").removeClass("error");

            };
        })
    });
});

