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

$("#rate").click(function () {
    var nbe = 0;
    var returne = $(".retour");
    var lib = $(".lib");
    var prix = $(".prix");
    $("#form_rate .require").each(function () {
        if ($.trim($(this).val()) == "") {
            $(this).parent("div").addClass("has-error");
            nbe++;
        } else {
            $(this).parent("div").removeClass("has-error");
        };
    })
    if (nbe == 0) {
        var data = $("#form_rate").serialize();

        $.ajax({
            type: "POST",
            url: "controllers/addrate.php",
            data: data,
            async: true,
            error: (xhr, status, error) => alert(xhr.responseText)

        })
        .done(back => {
            if (back == "Ce plan tarifaire est déjà enregistré") {
                returne.addClass("alert alert-danger").html(back);
                lib.parent("div").addClass("has-error");
                prix.parent("div").removeClass("has-error");

            }
            else if (back == "Le prix doit contenir une valeur numérique") {
                returne.addClass("alert alert-danger").html(back);
                prix.parent("div").addClass("has-error");
                lib.parent("div").removeClass("has-error");

            }
            else {
                returne.removeClass("alert alert-danger").html("");
                lib.parent("div").removeClass("has-error");
                prix.parent("div").removeClass("has-error");
                $(".container-loader").addClass("flex");
                setTimeout(() => location.href = "?p=rate", 2500);
            }
        });

    } else {
        returne.addClass("alert alert-danger").html("Veuillez remplir les champs");
    }
    return false;
});

$(".edit_rate").click(function () {
    var rel= $(this).attr('rel');
    var nbe = 0;
    var returne = $(".retour"+rel);
    var lib = $(".lib"+rel);
    var prix = $(".prix"+rel);
    $(".require"+rel).each(function () {
        if ($.trim($(this).val()) == "") {
            $(this).parent("div").addClass("has-error");
            nbe++;
        } else {
            $(this).parent("div").removeClass("has-error");
        };
    })
    if (nbe == 0) {
        var data = $("#form_edit_rate"+rel).serialize();
        $.ajax({
            type: "POST",
            url: "controllers/editrate.php",
            data: data,
            async: true,
            error: (xhr, status, error) => alert(xhr.responseText)

        })
        .done(back => {
            if (back == "Ce plan tarifaire est déjà enregistré") {
                returne.addClass("alert alert-danger").html(back);
                lib.parent("div").addClass("has-error");
                prix.parent("div").removeClass("has-error");

            }
            else if (back == "Le prix doit contenir une valeur numérique") {
                returne.addClass("alert alert-danger").html(back);
                prix.parent("div").addClass("has-error");
                lib.parent("div").removeClass("has-error");

            }
            else {
                $("#modalEditRate"+rel).modal("hide");
                $(".container-loader").addClass("flex");
                setTimeout(() => location.href = "?p=rate", 2500);
            }
        });

    } else {
        returne.addClass("alert alert-danger").html("Veuillez remplir les champs");
    }
    return false;
});