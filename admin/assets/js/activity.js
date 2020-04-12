var selected = $(".titre option:selected").val();
recupRealAndDate(selected);

function recupRealAndDate(id){
    $.ajax({
        type: "GET",
        url: "controllers/recupDefaultSelected.php",
        data: "id="+id,
        async: true,
        error: (xhr, status, error) => alert(xhr.responseText)

    })
    .done(back => {
        var backs = back.split("-/-");
        $(".real").val(backs[0]);
        $(".sortie").val(backs[1]);
    });
}

$(".titre").change(function(){
    var valeur = $(this).val();
    recupRealAndDate(valeur);
});

$(".type").change(function(){
    var valeur = $(this).val();
    $.ajax({
        type: "GET",
        url: "controllers/recupMedia.php",
        data: "type="+valeur,
        async: true,
        error: (xhr, status, error) => alert(xhr.responseText)
    })
    .done(back => {
        $(".titre").html(back);
        var newval = $(".titre option:selected").val();
        recupRealAndDate(newval); 
    });
});


$("#addbanner").click(function () {
    var nbe = 0;
    var banniere = $(".banniere");
    var returne = $(".retour");
    $("#form_banner .require").each(function () {
        if ($.trim($(this).val()) == "") {
            $(this).parent("div").addClass("has-error");
            nbe++;
        } else {
            $(this).parent("div").removeClass("has-error");
        };
    })
    if (nbe == 0) {
        var form = $('#form_banner').get(0);
		var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: "controllers/addbanner.php",
            contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
        })
        .done(back => {
            if(back == "ok") {
                banniere.parent("div").removeClass("has-error");
                $("#modalAddBanner").modal("hide");
                $(".container-loader").addClass("flex");
                setTimeout(()=> location.href = "?p=banner", 2500);
            }
            else{
                returne.addClass("alert alert-danger").html(back);
                banniere.parent("div").addClass("has-error");
            }
        });
    } else {
        returne.addClass("alert alert-danger").html("Veuillez renseigner tous les champs");
    }
});

$(".edit_banner").click(function () {
    var rel = $(this).attr("rel");
    var nbe = 0;
    var banniere = $(".banniere"+rel);
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
        var form = $('#form_edit_banner'+rel).get(0);
		var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: "controllers/editbanner.php",
            contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
        })
        .done(back => {
            if(back == "ok") {
                returne.addClass("alert alert-success").html("La modification a été effectuée avec succès").removeClass("alert-danger");
                banniere.parent("div").removeClass("has-error");
                $("#modalEditBanner"+rel).modal("hide");
                $(".container-loader").addClass("flex");
                setTimeout(()=> location.href = "?p=banner", 2500);
            }
            else{
                returne.addClass("alert alert-danger").html(back);
                banniere.parent("div").addClass("has-error");
            }
        });
    } else {
        returne.addClass("alert alert-danger").html("Veuillez renseigner tous les champs");
    }
});
