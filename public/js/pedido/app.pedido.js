$(document).ready(function (){
    $('.openBtn').on('click', function(){
        let id = $(this).data('pedido')
        $('#myModal').modal({show:true})

        $.ajax({
            type: 'get',
            url: '/pedido/informacao/'+id,
            success: function(response){
                $('.modal-title').html('');
                if(response.pedido.status === 'Aguardando'){
                    $('.modal-header').css('background-color', '#4e73df');
                }
                if(response.pedido.status === 'Preparo'){
                    $('.modal-header').css('background-color', '#f6c23e');
                }
                if(response.pedido.status === 'Saiu'){
                    $('.modal-header').css('background-color', '#FA7921');
                }
                if(response.pedido.status === 'Entregue'){
                    $('.modal-header').css('background-color', '#1cc88a');
                }
                $('.modal-title').html('Pedido: #'+response.pedido.id)
                // $('#conteudo-pedido').html('')

                $('#conteudo-pedido #todos-produtos').html('')

                response.pedido.produtos.forEach((produto, index) => {
                    element_produto = '<p>'+ produto.nome + ' - ' + '<strong> Qtde: '+ produto.pivot.quantidade +'</strong> </p>';

                    $('#conteudo-pedido #todos-produtos').append(element_produto)
                })

                // $('#conteudo-pedido #pedido-cliente').html('')
                // $('#conteudo-pedido #pedido-cliente').append('<strong>Cliente: </strong>'+response.pedido.cliente.nome)

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