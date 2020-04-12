$(document).ready(function () {
    $("#sign-up").click(function () {
        var nbe = 0;
        var pass = $(".pass");
        var cpass = $(".cpass");
        var pseudo = $(".pseudo");
        var email = $(".email");
        var returne = $(".returne");
        $("#form_sign-up .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("error");
                nbe++;

            } else {
                $(this).parent("div").removeClass("error");

            };
        })
        if (nbe == 0) {
            if ($.trim(pass.val()) != $.trim(cpass.val())) {
                pass.parent("div").addClass("error");
                cpass.parent("div").addClass("error");
                returne.addClass("fail").html("Les Mots de passe ne sont pas identiques");
            } else {
                pass.parent("div").removeClass("error");
                cpass.parent("div").removeClass("error");
                returne.removeClass("fail").html("");
                var data = $("#form_sign-up").serialize();


                $.ajax({
                    type: "POST",
                    url: "controllers/signup.php",
                    data: data,
                    async: true,
                    error: (xhr, status, error) => alert(xhr.responseText)

                })
                    .done(back => {
                        if (back == "Le format de votre mail est incorrecte" || back == "mail déja utilisé") {
                            returne.addClass("fail").html(back);
                            email.parent("div").addClass("error");
                            pseudo.parent("div").removeClass("error");

                        } else if (back == "pseudo déja utilisé") {
                            returne.addClass("fail").html(back);
                            pseudo.parent("div").addClass("error");
                            email.parent("div").removeClass("error");

                        } else {

                            $("#form_sign-up").html(back).addClass("success");

                            setTimeout(() => location.href = "?p=sign-in", 5000);
                        }


                    });
            }

        } else {
            returne.addClass("fail").html("Veuillez remplir les champs");

        }
    });

    $("#sign-in").click(function () {
        var nbe = 0;
        var pass = $(".pass");
        var login = $(".login");


        var returne = $(".returne");
        $("#form_sign-in .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("error");
                nbe++;

            } else {
                $(this).parent("div").removeClass("error");

            };
        })
        if (nbe == 0) {


            returne.removeClass("fail").html("");
            var data = $("#form_sign-in").serialize();


            $.ajax({
                type: "POST",
                url: "controllers/signin.php",
                data: data,
                async: true,
                error: (xhr, status, error) => alert(xhr.responseText)

            })
                .done(back => {
                    if (back == "Identifiant ou mot de passe incorrects") {
                        returne.addClass("fail").html(back);
                        login.parent("div").addClass("error");
                        pass.parent("div").addClass("error");

                    }
                    else {

                        returne.removeClass("fail").html(back).addClass("success");
                        $(".container-loader").addClass("flex");
                        login.parent("div").removeClass("error");
                        pass.parent("div").removeClass("error");

                        setTimeout(() => location.href = "?p=dashboard", 3000);
                    }


                });


        } else {
            returne.addClass("fail").html("Veuillez remplir les champs");

        }
    });
});

