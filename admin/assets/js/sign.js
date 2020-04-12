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

            returne.removeClass("alert alert-danger").html("");
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
                        returne.removeClass("alert alert-danger").html("");
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

    $("#pass").click(function () {
        var nbe = 0;
        var npass = $(".npass");
        var cpass = $(".cpass");
        var apass = $(".apass");
        var returne = $(".retour-pass");
        $("#form_pass .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("has-error");
                nbe++;

            } else {
                $(this).parent("div").removeClass("has-error");

            };
        })
        if (nbe == 0) {
            if ($.trim(npass.val()) != $.trim(cpass.val())) {
                npass.parent("div").addClass("has-error");
                cpass.parent("div").addClass("has-error");
                returne.addClass("alert alert-danger").html("Les Mots de passe ne sont pas identiques");
            } else {
                npass.parent("div").removeClass("has-error");
                cpass.parent("div").removeClass("has-error");
                returne.removeClass("alert alert-danger").html("");
                var data = $("#form_pass").serialize();


                $.ajax({
                    type: "POST",
                    url: "controllers/editpass.php",
                    data: data,
                    async: true,
                    error: (xhr, status, error) => alert(xhr.responseText)

                })
                .done(back => {

                    if (back == "Ancien mot de passe incorrect") {
                        returne.addClass("alert alert-danger").html(back);
                        apass.parent("div").addClass("has-error");

                    } else {
                        apass.parent("div").removeClass("has-error");

                        returne.html(back).addClass("alert alert-success").removeClass("alert-danger");

                        $("#form_pass input").val("");
                    }

                });
            }

        } else {
            returne.addClass("alert alert-danger").html("Veuillez remplir les champs");
        }
    });

    $("#profil").click(function () {
        var nbe = 0;
        var pseudo = $(".pseudo");


        var returne = $(".retour-profil");
        $("#form_profil .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("has-error");
                nbe++;

            } else {
                $(this).parent("div").removeClass("has-error");

            };
        })
        if (nbe == 0) {


            returne.removeClass("alert alert-danger").html("");
            var data = $("#form_profil").serialize();



            $.ajax({
                type: "POST",
                url: "controllers/editprofil.php",
                data: data,
                async: true,
                error: (xhr, status, error) => alert(xhr.responseText)

            })
            .done(back => {
                if (back == "pseudo déja utilisé") {
                    returne.addClass("alert alert-danger").html(back);
                    pseudo.parent("div").addClass("has-error");

                } else {
                    pseudo.parent("div").removeClass("has-error");
                    returne.removeClass("alert-danger").addClass("alert alert-success").html(back);
                }
            });

        } else {
            returne.addClass("alert alert-danger").html("Veuillez remplir les champs");
        }
    });
});

