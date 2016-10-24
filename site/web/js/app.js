$( document ).ready(function(){
    $(".button-collapse").sideNav(); //Barre menu mobile
    $('.materialboxed').materialbox();//Effet d'ombres hover les elements page index
    
    width =$(document).width();//Responsive cadre evenement (horizontal ->vertical)
    if (width <= 600) {
        $(".div-evenement div.hoverable").attr('class', 'card vertical hoverable');
    };

    if ($(".form")[0]){//Page form add/modifier annonce : echange pas position de deux elements pour creer checkbox
        $('input.date-date').removeAttr("type");
        $('input.date-date').prop('type', 'date');
        $(".label_publie").before($(".checkbox_publie"));
    }
})