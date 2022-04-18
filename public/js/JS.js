function listenCreateSort() {
    document.addEventListener("DOMContentLoaded", function () {
        var table = createDataTableCusto('#DataTable');
        //table.draw();
    });
}

function createDataTableCusto(elementName) {
    return $(elementName).DataTable({
        "paging": false,
        "autoWidth": true,
        "scrollY": "500px",
        "scrollCollapse": true,
        "order" : [1, 'asc'],

        "language": {
            "loadingRecords": "Chargement...",
            "zeroRecords": "Désolé, nous n'avons rien trouvé",
            "emptyTable": "Aucun enregistrement",
            "info": "_TOTAL_ Résultats",
            "infoEmpty": "Aucun enregistrement trouvé",
            "infoFiltered": " sur un total de _MAX_ enregistrements",
            "thousands": " ",
            "search": "Rechercher :"
        }
    });
}

