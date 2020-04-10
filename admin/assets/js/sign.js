$(document).ready(function () {
    $("#sign-in").click(function () {
        var nbe = 0;
        var returne = $(".retour");
        $("#form_sign-in .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("has-error");
                nbe++;
            } else {
                $(this).parent("div").removeClass("has-error");
            };
        })
        if (nbe == 0) {

            returne.addClass("alert alert-danger").html("");
            var data = $("#form_sign-in").serialize();

            $.ajax({
                type: "POST",
                url: "controllers/signin.php",
                data: data,
                async: true,
                error: (xhr, status, error) => alert(xhr.responseText)

            })
                .done(back => {
                    if (back == "Identifiant ou mot de passe incorrect") {
                        returne.addClass("alert alert-danger").html(back);
                        $(".require").parent("div").addClass("has-error");
                    }
                    else {
                        returne.removeClass("alert alert-danger").html(back);
                        $(".container-loader").addClass("flex");
                        $(".form-control").parent("div").removeClass("has-error");
                        setTimeout(() => location.href = "?p=dashboard", 3000);
                    }

                });


        } else {
            returne.addClass("alert alert-danger").html("Veuillez remplir les champs");
        }
        return false;
    });

    $("#sign-up").click(function () {
        var nbe = 0;
        var email = $(".email");
        var returne = $(".retour");
        $("#form_sign-up .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("has-error");
                nbe++;

            } else {
                $(this).parent("div").removeClass("has-error");

            };
        })
        if (nbe == 0) {
            var data = $("#form_sign-up").serialize();

            $.ajax({
                type: "POST",
                url: "controllers/signup.php",
                data: data,
                async: true,
                error: (xhr, status, error) => alert(xhr.responseText)

            })
                .done(back => {
                    if (back == "Le format du mail est incorrecte" || back == "mail déja utilisé") {
                        returne.addClass("alert alert-danger").html(back);
                        email.parent("div").addClass("has-error");

                    }else {
                        $("#modalAddAdmin").modal("hide");
                        $(".container-loader").addClass("flex");
                        setTimeout(() => location.href = "?p=admins", 2500);
                    }


                });

        } else {
            returne.addClass("alert alert-danger").html("Veuillez remplir les champs");
        }
    });
});

