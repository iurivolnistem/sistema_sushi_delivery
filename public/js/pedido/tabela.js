$(document).ready(function (){

    if($(document).find('[class="alert alert-success"]')){
        setTimeout(() => {
            $(document).find('[class="alert alert-success text-center"]').remove()
        }, 3000);
    }

    $('#pedidos_table').DataTable({
        language:{
            "info": "Mostrando _START_ de: _TOTAL_ pedidos",
            "lengthMenu":     "Mostrando _MENU_",
            "search":         "Pesquisar:",
            "infoFiltered":   "(filtrado de um total de _MAX_ pedidos)",
            "infoEmpty":      "Mostrando 0 pedidos",
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
        window.location = '/exportar/pedidos'
    });
});