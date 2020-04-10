$("#categories").click(function () {
    var nbe = 0;
    var returne = $(".retour");
    $("#form_categories .require").each(function () {
        if ($.trim($(this).val()) == "") {
            $(this).parent("div").addClass("has-error");
            nbe++;
        } else {
            $(this).parent("div").removeClass("has-error");
        };
    })
    if (nbe == 0) {
        var data = $("#form_categories").serialize();

        $.ajax({
            type: "POST",
            url: "controllers/addcategorie.php",
            data: data,
            async: true,
            error: (xhr, status, error) => alert(xhr.responseText)

        })
            .done(back => {
                if (back == "Cette catégorie est déjà enregistrée") {
                    returne.addClass("alert alert-danger").html(back);
                    $(".require").parent("div").addClass("has-error");

                }else {
                    returne.removeClass("alert alert-danger").html("");
                    $(".require").parent("div").removeClass("has-error");
                    $(".container-loader").addClass("flex");
                    setTimeout(() => location.href = "?p=categories", 2500);
                }


            });

    } else {
        returne.addClass("alert alert-danger").html("Veuillez remplir les champs");
    }
    return false;
});

$(".edit_categorie").click(function () {
    var rel= $(this).attr('rel');
    var nbe = 0;
    var returne = $(".retour"+rel);
    $(".require"+rel).each(function () {
        if ($.trim($(this).val()) == "") {
            $(this).parent("div").addClass("has-error");
            nbe++;
        } else {
            $(this).parent("div").removeClass("has-error");
        };
    })
    if (nbe == 0) {
        var data = $("#form_edit_categorie"+rel).serialize();
        $.ajax({
            type: "POST",
            url: "controllers/editcategorie.php",
            data: data,
            async: true,
            error: (xhr, status, error) => alert(xhr.responseText)
        })
        .done(back => {
            if (back == "Cette catégorie est déjà enregistrée") {
                returne.addClass("alert alert-danger").html(back);
                $(".require"+rel).parent("div").addClass("has-error");

            }else {
                $("#modalEditCategories"+rel).modal("hide");
                $(".container-loader").addClass("flex");
                setTimeout(() => location.href = "?p=categories", 2500);
            }
        });

    } else {
        returne.addClass("alert alert-danger").html("Veuillez remplir les champs");
    }
    return false;
});