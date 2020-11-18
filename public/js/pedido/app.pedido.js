$(document).ready(function (){
    if($(document).find('[class="alert alert-success"]')){
        setTimeout(() => {
            $(document).find('[class="alert alert-success text-center"]').remove()
        }, 3000);
    }
    
    $('.openBtn').on('click', function(){
        let id = $(this).data('pedido')
        $('#myModal').modal({show:true})

        $.ajax({
            type: 'get',
            url: '/pedido/informacao/'+id,
            success: function(response){
                console.log(response)
                $('.modal-title').html('');
                if(response.pedido.status === 0){
                    $('.modal-header').css('background-color', '#4e73df');
                }
                if(response.pedido.status === 1){
                    $('.modal-header').css('background-color', '#f6c23e');
                }
                if(response.pedido.status === 2){
                    $('.modal-header').css('background-color', '#FA7921');
                }
                if(response.pedido.status === 3){
                    $('.modal-header').css('background-color', '#1cc88a');
                }
                $('.modal-title').html('Pedido: #'+response.pedido.id)
                // $('#conteudo-pedido').html('')

                $('#conteudo-pedido #todos-produtos').html('')

                response.pedido.produtos.forEach((produto, index) => {
                    element_produto = '<p>'+ produto.nome + ' - ' + '<strong> Qtde: '+ produto.pivot.quantidade +'</strong> </p>';

                    $('#conteudo-pedido #todos-produtos').append(element_produto)
                })

                $('#conteudo-pedido #pedido-pagamento #pagamento').html('')
                $('#conteudo-pedido #pedido-pagamento #pagamento').append(response.pedido.pagamento == 1 ? 'Cartão de crédito' : response.pedido.pagamento == 2 ? 'Dinheiro sem troco' : 'Dinheiro com troco');
                
                if(response.pedido.troco == '' || response.pedido.troco == null){
                    $('#conteudo-pedido #pedido-troco #troco').html('')
                }
                else{
                    $('#conteudo-pedido #pedido-troco #troco').html('')
                    $('#conteudo-pedido #pedido-troco #troco').append('Troco: R$' + response.pedido.troco);
                }
                
            

                $('#conteudo-pedido #pedido-endereco').html('')
                response.endereco.forEach((endereco, index) => {
                    element_endereco = '<p>'+ endereco.logradouro + ' - '+ endereco.numero +', ' + endereco.bairro + ' - ' + endereco.cidade + ' - ' + endereco.estado + '</p>' + '<p>' + 
                    'Cep: ' + endereco.cep + '</p>';
                    
                    element_complemento = '<p>'+ endereco.complemento +'</p>';  

                    $('#conteudo-pedido #pedido-endereco').append(element_endereco)
                    endereco.complemento != null ? $('#conteudo-pedido #pedido-endereco').append(element_complemento) : ''
                })

                $('#conteudo-pedido #pedido-valor').html('');
                $('#conteudo-pedido #pedido-valor').append('Valor total: R$'+response.pedido.valor);
            }
        })

    });
});