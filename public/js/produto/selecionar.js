$(document).ready(function (){
    $(document).delegate('#btnAdicionar', 'click', function () {
        $.ajax({
            type: 'post',
            url: '/produtos/sabores/vincular',
            data: {sabor: $('#sabor').val(), id_produto: $('#produto').val(), valor_sabor: $('#valor_sabor').val(), _token: $('#_token').val()},
            success: function(data){
                if (data.status == false) {
                    $.each(data.erros, function (i, error) {
                        var formulario = $(document).find('[name="' + i + '"]')
                        formulario.addClass('is-invalid')
                        formulario.after($('<span class="invalid-feedback">' + error[0] + '</span>'))

                        setTimeout(() => {
                            var mensagens = $(document).find('[class="invalid-feedback"]')
                            mensagens.remove()
                            formulario.removeClass('is-invalid')
                        }, 6000);
                    });
                }
                if(data.status == 'vinculado'){
                    Swal.fire('Erro', data.mensagem, 'error')
                }
                if(data.status == true){
                    Swal.fire('Sucesso!', data.mensagem, 'success')
                    setTimeout(() => {
                        document.location.reload()
                    }, 3000);
                }
            }
        });
    });
});