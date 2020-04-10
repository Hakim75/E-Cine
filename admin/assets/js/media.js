$('.type').change(function(){
    var valeur= $(this).val();
    var film = $(".film");
    if(valeur=="Série"){
        film.removeClass("require");
        film.parent("div").css("display","none");
    }
    else if(valeur=="Film"){
        film.addClass("require");
        film.parent("div").css("display","block");
    }
});

$("#videos").click(function () {
    var nbe = 0;
    var film = $(".film");
    var poster = $('.poster');
    var returne = $(".retour");
    var valeur = $(".type");
    $("#form_videos .require").each(function () {
        if ($.trim($(this).val()) == "") {
            $(this).parent("div").addClass("has-error");
            nbe++;

        } else {
            $(this).parent("div").removeClass("has-error");

        };
    })
    if (nbe == 0) {
        var form = $('#form_videos').get(0);
		var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: "controllers/addmedia.php",
            contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}

        })
        .done(back => {
            if (back == "La taille de l'image ne doit pas dépasser 1M" || back == "Les formats de l'image autorisés sont .jpg, .jpeg, .png") {
                returne.addClass("alert alert-danger").html(back);
                poster.parent("div").addClass("has-error");
                film.parent("div").removeClass("has-error");

            }
            else if (back == "La taille de la vidéo ne doit pas dépasser 750M" || back == "Les formats de vidéo autorisés sont .mp4, .webm, .ogg") {
                returne.addClass("alert alert-danger").html(back);
                film.parent("div").addClass("has-error");
                poster.parent("div").removeClass("has-error");

            }
            else {
                poster.parent("div").removeClass("has-error")
                returne.addClass("alert alert-success").removeClass("alert-danger").html("Vidéo ajoutée avec succès");
                film.parent("div").removeClass("has-error");
                $(".container-loader").addClass("flex");
                setTimeout(() => {
                    if(valeur.val()=="Série"){
                        location.href = "?p=new-episode&serie="+back;
                    }
                    else if(valeur.val()=="Film"){
                        location.href = "?p=new-media";
                    }
                }, 2500);
            }


        });

    } else {
        returne.addClass("alert alert-danger").html("Veuillez renseigner tous les champs");
    }
});