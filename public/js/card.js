const 
    pageTitleSelector = document.querySelector('.page-title'),
    pageContentSelector = document.querySelector('.page-content'),
    pageView = document.querySelector('.formulaire')
;

$('.cards-nav li button').click(function(){

    let mealType = $(this).data('meal-type'); //récupère le type de plats dans la data du bouton

    $.ajax({
        type: 'POST',                    // Verbe de la requête (GET, POST, etc..)
        url: 'http://localhost:8000/test-json/',                // Page cible de la requête
        dataType: 'json',               // type de données récupérées (html, json, text, xml, script)
        data:{
            mealType: mealType
        },
        success: function(data){

            let 
                pageTitle = data.page.title
                pageContent = data.page.content
            ;

            pageTitleSelector.innerHTML = '<i class="fas fa-utensils"></i><span class="px-2">' + pageTitle + '</span><i class="fas fa-utensils "></i>';
            pageContentSelector.innerHTML = pageContent;


        },
        error: function(){

            // Si on rentre ici, c'est que la requête a eu un problème (serveur injoignable, page introuvable, json invalide, etc...)
            alert('Erreur !');
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