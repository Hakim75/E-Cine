$(document).ready(function () {

    $("#paiement").click(function () {
        var nbe = 0;
        var email = $(".email");

        var returne = $(".returne");
        $("#form_paiement .require").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).parent("div").addClass("error");
                nbe++;

            } else {
                $(this).parent("div").removeClass("error");

            };
        })
        if (nbe == 0) {
            returne.removeClass("fail").html("");
            var data = $("#form_paiement").serialize();

            $.ajax({
                type: "POST",
                url: "controllers/subscription.php",
                data: data,
                async: true,
                error: (xhr, status, error) => alert(xhr.responseText)

            })
            .done(back => {
                if (back == "Le format de votre mail est incorrect") {
                    returne.addClass("fail").html(back);
                    email.parent("div").addClass("error");
                }
                else {
                    $("#form_paiement").addClass("success").html("Merci de nous faire confiance, attendez confirmation de votre abonnement");
                    setTimeout(() => location.href = "?p=dashboard", 5000);
                }


            });


        } else {
            returne.addClass("fail").html("Veuillez remplir les champs");
        }
    });
});

