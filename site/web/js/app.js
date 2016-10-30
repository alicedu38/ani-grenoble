$( document ).ready(function(){
    $(".button-collapse").sideNav(); //Barre menu mobile
    $('.materialboxed').materialbox();//Effet d'ombres hover les elements page index 

    //Scroll to top
    //Check to see if the window is top if not then display button
    $(document).scroll(function(){
        if ($(this).scrollTop() > 150) {//Si srocll de plus de 150px, alors affiche balise a scroll-to-top
            $('.back-to-top').fadeIn();// fadeIn() -> affiche un element
        } else {
            $('.back-to-top').fadeOut();
        }
    });
    
    //Click event to scroll to top
    $('.back-to-top').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });
})

$( document ).ready(function(){
    $( "span" ).remove( ".sr-only" );//Suprrime span dans bar des droits utilisateurs
    $( ".connexion form label:nth-child(7)" ).remove( "label" );//Supprime remember me (se souvenir de moi) de form de connexion
    $('h2').after('<hr>');
    $(".connexion input#_submit").attr('class', 'btn');
    $(".register form select").attr('class', 'browser-default');

    width =$(document).width();//Responsive cadre evenement (horizontal to vertical)
    if (width <= 600) {
        $(".div-evenement div.hoverable").attr('class', 'card vertical hoverable');
    };

    if ($(".form")[0]){//Page form add/modifier annonce : 
        //$('input.date-date').removeAttr("type");//Suprrime l'attribut type
        //$('input.date-date').prop('type', 'date');//Recréer l'attibut type et prend pour valeur "date"
        $(".label_publie").before($(".checkbox_publie"));//echange pas position de deux elements pour creer checkbox
    }
})