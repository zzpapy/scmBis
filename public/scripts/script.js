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