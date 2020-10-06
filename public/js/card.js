$('.cards-nav li').click(function(){


    let $type = ( $(this).data('type') )

    // let mealType = $(this).data('type'); //récupère le type de plats dans la data du bouton


    $.ajax({
        type: 'GET',                    // Verbe de la requête (GET, POST, etc..)
        url: 'http://localhost:8000/test-json/',                // Page cible de la requête
        dataType: 'json',               // type de données récupérées (html, json, text, xml, script)
        data:{
            type: type
        },
        success: function(data){

            // Si on rentre ici, c'est que la requête s'est bien déroulée
            console.log(data);

            $('.card-title').text(data.pages[0].title)
            $('.card-content').text(data.pages[0].content)

            // data.forEach(function(page){
                
            //     let newPage = page.title;
            //     console.log(newPage);

            // })

        },
        error: function(){

            // Si on rentre ici, c'est que la requête a eu un problème (serveur injoignable, page introuvable, json invalide, etc...)
            alert('Erreur !');
        }
    });
})