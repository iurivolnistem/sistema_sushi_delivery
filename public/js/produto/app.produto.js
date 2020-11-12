$(document).ready(function () {

    $('#btnCadastrar').click(function () {
        var formData = new FormData()

        formData.append('nome', $('#nome').val())
        formData.append('descricao', $('#descricao').val())
        formData.append('imagem', $('#imagem')[0].files[0])
        formData.append('valor', $('#valor').val())
        formData.append('_token', $('#_token').val())

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: '/cadastrar/produtos/',
            data: formData,
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function (response) {
                if (response.status == false) {
                    $.each(response.erros, function (i, error) {
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
                if (response.status) {
                    Swal.fire('Sucesso!', response.mensagem, 'success')
                    setTimeout(() => {
                        window.location.reload()
                    }, 2000);
                }
            }
        });
    });

    $('#btnAtualizar').click(function () {
        var formData = new FormData()

        formData.append('nome', $('#nome').val())
        formData.append('descricao', $('#descricao').val())
        formData.append('imagem', $('#imagem')[0].files[0])
        formData.append('valor', $('#valor').val())
        formData.append('_token', $('#_token').val())

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: '/editar/produto/'+ $('#produto').val(),
            data: formData,
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function (response) {
                if(response.status == 'igual'){
                    Swal.fire('', response.mensagem, 'info')
                }
                if (response.status == 'validacao') {
                    $.each(response.erros, function (i, error) {
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
                if (response.status == 'sucesso') {
                    Swal.fire('Sucesso!', response.mensagem, 'success')
                    setTimeout(() => {
                        window.location.href = "/lista/produtos"
                    }, 1500);
                }
            }
        });
    });


    $(document).on("change", ".uploadFile", function () {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
            }
        }
    });
});
