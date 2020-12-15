var baseUrl = $("body").data('url');

$("#categoria").on("change", function () {
    $('#id_categoria').html('');
    var cat = $(this).val();
    var campoCodigo = $('#codigo_categoria');

    switch (cat) {
        case "1": campoCodigo.attr('placeholder', 'Matrícula do SIAPE'); break;
        case "2": campoCodigo.attr('placeholder', 'Curso e número da matrícula'); break;
        case "3": campoCodigo.attr('placeholder', 'Nome do(a) Professor(a)'); break;
        case "4": campoCodigo.attr('placeholder', 'Nome do convênio'); break;
        case "0": campoCodigo.attr('placeholder', 'Sem categoria'); break;
    }

    if(cat !== "0"){
        var disciplinaId = $("#disciplina_id").val();
        $.ajax({
            url: baseUrl + "/turmas/" + disciplinaId + "/" + cat,
            type: "get",
            success: function (result) {
                $('#id_categoria').append("<option value='0'>Curso:</option>");
                $.each(result, function (k, v) {
                    $('#id_categoria').append("<option value='"+v.id+"'>R$ "+ number_to_price(v.valor) + " | "+v.title+"</option>");
                })
            }
        });
    }
});

$("#id_categoria").on('change', function () {
    $('#id_sub_categoria').html('');
    var curso = $(this).val();

    if(curso !== "0"){
       $.ajax({
           url: baseUrl + "/cursos/" + curso,
           type: "get",
           success: function (result) {
               $('#id_sub_categoria').append("<option value='0'>Horário:</option>");
               $.each(result, function (k, v) {
                   $('#id_sub_categoria').append("<option value='"+v.id+"'> "+v.horario+"</option>");
               })
           }
       });
    }
});

$("#telefone").mask("(99) 99999-9999");
$("#whats").mask("(99) 99999-9999");
$("#cpf").mask("999.999.999-99");
$("#cpfresponsavel").mask("999.999.999-99");
$("#cep").mask("99999 - 999");
$("#data").mask("99/99/9999");

function price_to_number(v){
    if(!v){return 0;}
    v=v.split('.').join('');
    v=v.split(',').join('.');
    return Number(v.replace(/[^0-9.]/g, ""));
}

function number_to_price(v){
    if(v==0){return '0,00';}
    v=parseFloat(v);
    v=v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    v=v.split('.').join('*').split(',').join('.').split('*').join(',');
    return v;
}

$("form:not('.ajax_off')").submit(function (e) {
    e.preventDefault();
    var form = new FormData(this);
    var token = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        dataType: "json",
        data: form,
        processData: false,
        contentType: false,
        success: function (response) {

            if(response.success){
                var code = response.code;
                var callback = {
                    success : function(transactionCode) {

                        $.ajax({
                            url: baseUrl + "/matricula/transaction",
                            type: "post",
                            data: {transactionCode: transactionCode, code: code},
                            headers: {'X-CSRF-TOKEN': token},
                            success: function (result){
                                if(result.success){
                                    window.location.href = baseUrl + "/success";
                                }
                            }
                        });


                        //Insira os comandos para quando o usuário finalizar o pagamento.
                        //O código da transação estará na variável "transactionCode"
                        console.log("Compra feita com sucesso, código de transação: " + transactionCode);
                    },
                    abort : function() {
                        //Insira os comandos para quando o usuário abandonar a tela de pagamento.
                        console.log("abortado");
                    }
                };
                //Chamada do lightbox passando o código de checkout e os comandos para o callback
                var isOpenLightbox = PagSeguroLightbox(code, callback);
                // Redireciona o comprador, caso o navegador não tenha suporte ao Lightbox
                if (!isOpenLightbox){
                    location.href="https://pagseguro.uol.com.br/v2/checkout/payment.html?code=" + code;
                    console.log("Redirecionamento")
                }else{
                    $("body").mouseleave( function (event) {
                        event.preventDefault();
                        swal({
                            title: "Ops",
                            text: "Você só deverá fechar esta janela quando concluir o processo de pagamentos do PagSeguro. \n O processo só será concluído ao fechar o pop-up do PagSeguro.",
                            icon: "warning",
                            button: "Ok!",
                        });
                    });
                }
            }

            if (response.swl_alert) {
                swal({
                    title: response.title,
                    text: response.text,
                    icon: response.icon,
                    button: response.button,
                });
            }

            if (response.redirect) {
                window.location.href = response.redirect;
            }

            //reload
            if (response.reload) {
                window.location.reload();
            }
            $("overlay").css('display', 'none');
        }
    });

});

