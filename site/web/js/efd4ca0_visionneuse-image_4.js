$(document).on('click','.photos .photo a img', function(e) {
    e.preventDefault();
    var imageSrc = $(this).attr("src");
    $('.photos .photo').removeClass("show");
    $(this).closest('.photos .photo').addClass("show");

    if ($('#lightbox').length > 0) { // #lightbox exists
        //insert img tag with clicked link's href as src value
        $('#lightbox .contenu').html('<span class="left col l1 m1 s1" aria-hidden="true"><i class="material-icons">chevron_left</i></span><img class="col l10 m10 s10" style="max-height: '+ ($(window).height()-100) +'px;" src="' + imageSrc + '" /><span class="right col l1 m0 s1" aria-hidden="true"><i class="material-icons">chevron_right</i></span>');
        $('#lightbox').show();
    }else { //#lightbox does not exist
        //create HTML markup for lightbox window
        var lightbox =
        '<div id="lightbox" class="row">' +
        '<div class="col l12 m12 s12"><span class="close" aria-hidden="true"><i class="material-icons">close</i></span></div>' +
        '<div class="contenu col l10 m10 s10">' + //insert clicked link's href into img src
        '<span class="left col l1 m1 s1" aria-hidden="true"><i class="material-icons">chevron_left</i></span>'+
        '<img class="col l10 m10 s10" style="max-height: '+ ($(window).height()-100) +'px;" src="' + imageSrc+'" />' +
        '<span class="right col l1 m1 s1" aria-hidden="true"><i class="material-icons">chevron_right</i></span>'+
        '</div>' +
        '</div>';
        //insert lightbox HTML into page
        $('body').append(lightbox);

        //Image dans viewport du navigateur
        //$('#lightbox img').css('max-height', $(window).height()-100);
        console.log('li');
    }
});

//Hide la lightbox si clique sur croix en haut à droite
$(document).on('click', '#lightbox span.close', function(){
    $('#lightbox').hide();
});

function boucleVisionneuse(sens) {
    /*Récupère le src de l'img du li suivant et le met dans le lightbox*/
    if (sens == "prev") {
        var PrecSuivli = $('.photos .photo.show').prev('div');
    }else{
        var PrecSuivli = $('.photos .photo.show').next('div');
    }
    var imgPrecSuivli = PrecSuivli.find('img');
    var imgSrc = imgPrecSuivli.attr("src");

    if (imgSrc != null) {
        $('.photos .photo').removeClass("show");
        PrecSuivli.addClass("show");

        $('#lightbox .contenu').html('<span class="left col l1 m1 s1" aria-hidden="true"><i class="material-icons">chevron_left</i></span><img class="col l10 m10 s10" src="' + imgSrc + '" /><span class="right col l1 m1 s1" aria-hidden="true"><i class="material-icons">chevron_right</i></span>');
        $('#lightbox').show();
    }else{
        /*Boucle : retour à la première image*/
        if (sens == "prev") {
            var premierDernierLi = $('.photos .photo').last();
        }else{
            var premierDernierLi = $('.photos .photo').first();
        }
        var imgPremierDernierLi = premierDernierLi.find('img');
        var imgSrcPremierDernierLi = imgPremierDernierLi.attr("src");

        $('.photos .photo').removeClass("show");
        premierDernierLi.addClass("show");

        $('#lightbox .contenu').html('<span class="left col l1 m1 s1" aria-hidden="true"><i class="material-icons">chevron_left</i></span><img class="col l10 m10 s10" src="' + imgSrcPremierDernierLi + '" /><span class="right col l1 m1 s1" aria-hidden="true"><i class="material-icons">chevron_right</i></span>');
        $('#lightbox').show();
    }

    //Image dans viewport du navigateur
    $('#lightbox img').css('max-height', $(window).height()-100);
    console.log('lu');
}

//Image suivante
$(document).on('click', '#lightbox .contenu span.right', function(){
    boucleVisionneuse('next');
});

//Image précédente
$(document).on('click', '#lightbox .contenu span.left', function(){
    boucleVisionneuse('prev');
});



//Retire la visionneuse de photos si click à coté
$(document).mouseup(function (e){
    var container = $("#lightbox .contenu");

    if (!container.is(e.target) // if the target of the click isn't the container...
    && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $("#lightbox").hide();
    }
});
