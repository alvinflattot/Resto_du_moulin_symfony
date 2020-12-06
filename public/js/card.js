const 
    pageTitleSelector = document.querySelector('.page-title span'),
    pageContentSelector = document.querySelector('.page-content'),
    pageView = document.querySelector('.formulaire'),
    pageEditLink = document.querySelector('.edit-link')
;

// console.log(pages)

// pages.forEach(function(page){
//     console.log(page.title)
// });

$('.cards-nav li a').click(function(){

    let mealType = $(this).data('meal-type'); //récupère le type de plats dans la data du bouton
    $('.card-btn-active').removeClass('card-btn-active');
    $(this).addClass('card-btn-active');

    $.ajax({
        type: 'POST',                    // Verbe de la requête (GET, POST, etc..)
        url: 'http://localhost:8000/test-json/',                // Page cible de la requête
        dataType: 'json',               // type de données récupérées (html, json, text, xml, script)
        data:{
            mealType: mealType
        },
        success: function(data){

            console.log(data);
            let 
                pageTitle = data.page.title
                pageContent = data.page.content
            ;
            if (pageEditLink) {
                pageEditLink.setAttribute('href','/modification-menu/'+data.page.type+'');
            }
            pageTitleSelector.innerHTML =  pageTitle ;
            pageContentSelector.innerHTML = pageContent;


        },
        error: function(){

            // Si on rentre ici, c'est que la requête a eu un problème (serveur injoignable, page introuvable, json invalide, etc...)
            alert('Erreur !');
        },
        complete : function(){
            
        }
    });

})

$('#test').on('click', function() {

    $.get('/modification-menu2/', function(data){

        // Affiche dans la console le code source récupéré (c'est un exemple d'utilisation, on fait ce qu'on veux de "data")
        console.log( data );
        pageView.innerHTML = data

    });

})