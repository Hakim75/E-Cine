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


    $(".favoris").click(function () {
        var pref = $(this).attr("rel");
        var data_change = $(this).attr("data-change");
        if (data_change == 0) {
            $(this).attr("data-change", "1");
            $.ajax({
                type: "GET",
                url: "controllers/excluded.php",
                data: "addPref=" + pref,
                async: true,
                error: (xhr, status, error) => alert(xhr.responseText)
            })
                .done(back => {
                    $(".favoris").html('Retirer des favoris <i class= "fas fa-heart"></i> ');
                    $(".favoris").addClass("active").addClass("remove").removeClass("add");
                });
        } else {
            $(this).attr("data-change", "0");
            $.ajax({
                type: "GET",
                url: "controllers/excluded.php",
                data: "remPref=" + pref,
                async: true,
                error: (xhr, status, error) => alert(xhr.responseText)
            })
                .done(back => {
                    $(".favoris").html('Ajouter aux favoris <i class="far fa-heart"></i>');
                    $(".favoris").removeClass("active").addClass("add").removeClass("remove");
                });
        }
    });
});


var select = $(".select option:selected").val();
var episodes = $(".episodes");
changeEpisode(select, episodes);
$(".select").change(function () {
    var valeur = $(this).val();
    var ep = $(".episodes");
    changeEpisode(valeur, ep);
});
function changeEpisode(saison, episode) {
    $.ajax({
        type: "GET",
        url: "controllers/recupEpisode.php",
        data: "s=" + saison,
        async: true,
        error: (xhr, status, error) => alert(xhr.responseText)
    })
        .done(back => {
            episode.html(back);
        });
}