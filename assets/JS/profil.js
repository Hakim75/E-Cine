$(document).ready(function () {
    $("#pass").click(function () {
        var nbe = 0;
        var npass = $(".npass");
        var cpass = $(".cpass");
        var apass = $(".apass");
        var returne = $(".returne_pass");
        $("#form_pass .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("error");
                nbe++;

            } else {
                $(this).parent("div").removeClass("error");

            };
        })
        if (nbe == 0) {
            if ($.trim(npass.val()) != $.trim(cpass.val())) {
                npass.parent("div").addClass("error");
                cpass.parent("div").addClass("error");
                returne.addClass("fail").html("Les Mots de passe ne sont pas identiques");
            } else {
                npass.parent("div").removeClass("error");
                cpass.parent("div").removeClass("error");
                returne.addClass("fail").html("");
                var data = $("#form_pass").serialize();


                $.ajax({
                    type: "POST",
                    url: "controllers/edit_pass.php",
                    data: data,
                    async: true,
                    error: (xhr, status, error) => alert(xhr.responseText)

                })
                    .done(back => {

                        if (back == "Ancien mot de passe incorrect") {
                            returne.addClass("fail").html(back);
                            apass.parent("div").addClass("error");

                        } else {
                            apass.parent("div").removeClass("error");

                            returne.html(back).addClass("success").removeClass("fail");

                            $("#form_pass input").val("");
                        }


                    });
            }

        } else {
            returne.addClass("fail").html("Veuillez remplir les champs");

        }
    });

    $("#profil").click(function () {
        var nbe = 0;
        var pseudo = $(".pseudo");
        var email = $(".email");


        var returne = $(".returne_profil");
        $("#form_profil .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("error");
                nbe++;

            } else {
                $(this).parent("div").removeClass("error");

            };
        })
        if (nbe == 0) {


            returne.addClass("fail").html("");
            var data = $("#form_profil").serialize();



            $.ajax({
                type: "POST",
                url: "controllers/edit_profil.php",
                data: data,
                async: true,
                error: (xhr, status, error) => alert(xhr.responseText)

            })
                .done(back => {
                    if (back == "Le format de votre mail est incorrect" || back == "mail déja utilisé") {
                        returne.addClass("fail").html(back);
                        email.parent("div").addClass("error");
                        pseudo.parent("div").removeClass("error");

                    } else if (back == "pseudo déja utilisé") {
                        returne.addClass("fail").html(back);
                        pseudo.parent("div").addClass("error");
                        email.parent("div").removeClass("error");

                    } else {
                        email.parent("div").removeClass("error");
                        pseudo.parent("div").removeClass("error");
                        returne.removeClass("fail").addClass("success").html(back);


                    }



                });


        } else {
            returne.addClass("fail").html("Veuillez remplir les champs");

        }
    });
});

