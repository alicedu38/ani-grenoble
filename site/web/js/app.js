$( document ).ready(function(){
    $(".button-collapse").sideNav(); //Barre menu mobile
    $('.materialboxed').materialbox();//Effet d'ombres hover les elements page index
    $( "span" ).remove( ".sr-only" );//Suprrime span dans bar des droits
    
    width =$(document).width();//Responsive cadre evenement (horizontal ->vertical)
    if (width <= 600) {
        $(".div-evenement div.hoverable").attr('class', 'card vertical hoverable');
    };

    if ($(".form")[0]){//Page form add/modifier annonce : 
        $('input.date-date').removeAttr("type");//Suprrime l'attribut type
        $('input.date-date').prop('type', 'date');//Recréer l'attibut type et prend pour valeur "date"
        $(".label_publie").before($(".checkbox_publie"));//echange pas position de deux elements pour creer checkbox
    }
})