$(document).ready( function () {
    $('#table_id').DataTable({
        "language": {
            "lengthMenu": "Affichage _MENU_ éléments par page",
            "zeroRecords": "Aucun résultat - sorry",
            "info": "page _PAGE_ de _PAGES_",
            "search":"Recherche",
            "sNext":"suivant",
            "paginate" :{
                "next":"suivant",
                "previous":"précédent"
            },
                
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    });
} );
$(document).ready( function () {
    $('#table_user').DataTable({
        "language": {
            "lengthMenu": "Affichage _MENU_ éléments par page",
            "zeroRecords": "Aucun résultat - sorry",
            "search":"Recherche",
            "paginate" :{
                "next":"suivant",
                "previous":"précédent"
            },
            "info": "page _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    });
} );

// function maPosition(position) {
//     var infopos = "Position déterminée :\n";
//     infopos += "Latitude : "+position.coords.latitude +"\n";
//     infopos += "Longitude: "+position.coords.longitude+"\n";
//     infopos += "Altitude : "+position.coords.altitude +"\n";
//     document.getElementById("infoposition").innerHTML = infopos;
//   }
  
//   if(navigator.geolocation)
//     var test = navigator.geolocation.getCurrentPosition(maPosition);


    //   window.civchat = {
    //     apiKey: 'hMmjJ7',
    //   };

    //   var request = require("request");

// var url = 'https://testscm-sandbox.biapi.pro/2.0/'
// var options = { method: 'GET',
// headers: {
//     'content-type': 'application/json',
//     authorization: 'Bearer rlQh1Dp_DX5kUjZDpxkAfl8puGH8LJoraWCD81qm3eT5BmWeERPocbYfn4sqjNb_OBaOL4OjapRauCFG20Q2xa8nue_oO1NPt84vizgcniaovT6sT67zyec1XCNniUcz',
   
// },
// form:{
//         "email": "myemail@example.org",
//         "password": "test",
//         "application": "testscm"
//       }

// };

// fetch(url,options)
// .then((response) => response.json())
// .catch((error) => console.error(error))
// $form.submit(function (e){

//     e.preventDefault()
//     $form.find('.button').attr("disabled",true)
//     Stripe.createToken({$form}, function(status,response){
//         debugger
//     })
// })

// var stripe = Stripe("pk_test_51HL4HeDz4TKnqe2ZOCU3IUhRRfbZt8WFqE5pWvGc8VuaaUQ3n2PxquMrfgNawh8QlAV1FbO5pKQKUFeeOeo27pDI00pNG9VcQW")

// var elements = stripe.elements()
// var cardElement = elements.create('card')
// var cardElement = elements.getElement('card')
// var $form = $('#paye')

// cardElement.mount('#card-element');

// cardElement.on('change', function(event) {
//     if (event.complete) {
//       // enable payment button
//       console.log('toto')
//     } else if (event.error) {
//       // show validation to customer
//     }
//   })