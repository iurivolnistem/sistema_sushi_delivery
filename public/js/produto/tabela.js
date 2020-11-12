$(document).ready(function (){

    if($(document).find('[class="alert alert-info text-center"]')){
        setTimeout(() => {
            $(document).find('[class="alert alert-info text-center"]').remove()
        }, 3000);
    }

    $('#produtos_table').DataTable({
        language:{
            "info": "Mostrando _START_ de: _TOTAL_ produtos",
            "lengthMenu":     "Mostrando _MENU_",
            "search":         "Pesquisar:",
            "infoFiltered":   "(filtrado de um total de _MAX_ produtos)",
            "infoEmpty":      "Mostrando 0 produtos",
            "processing":     "Processando...",
            "loadingRecords": "Carregando...",
            "zeroRecords":    "Nenhum registro encontrado",
            "paginate": {
                "first":      "Primeiro",
                "last":       "Ultimo",
                "next":       "Próximo",
                "previous":   "Anterior"
            },
        }
    });

    $('#btnExportar').click(function (){
        window.location = '/exportar/produtos'
    });
});