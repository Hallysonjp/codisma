<!--**
	* @author Daniel Biazon - danielbiazon@gmail.com
	* @pagina desenvolvida usando framework bootstrap,
*-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Contato</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="http://portalcodisma.com.br/favicon.ico">
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">


    <link href="{{url('css/style.css')}}" rel="stylesheet">

    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
{{--    <link rel="shortcut icon" href="{{url('img/favicon.ico')}}">--}}

</head>
<body data-url="{{url('/')}}">
<div class="row overlay">
    <div class="col-md-12 col-xs-12 full-screen bg-black no-padding form">
        <br>
        <div class="container-fluid">
            <div class="container theme-showcase bloco_1 " role="main">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form-horizontal" name="formcontato" method="POST" action="{{url('/matricula/store')}}">
                    @csrf
                    <input type="hidden" id="disciplina_id" value="{{$data['disciplina']}}">
                    <img class="displayed" src="http://portalcodisma.com.br/img/logo-header.png"
                         data-rjs="http://portalcodisma.com.br/img/logo-header.png" alt="Cadastro Curso CODISMA"
                         width="250"/>
                    <div class="form-horizontal">
                        <div class="container" style="width: 80%;">
                            <div class="col-md-12">
                                <div>
                                    <div class="col-md-12">
                                        <div class="page-header page">
                                            <h3>Dados Pessoais</h3>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="nome"
                                                   placeholder="NOME COMPLETO*" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-md-12">

                                            <input type="email" class="form-control" name="email"
                                                   placeholder="SEU E-MAIL*" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control cpf-mask" id="telefone"
                                                   name="contato" required placeholder="CONTATO*">

                                        </div>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control cpf-mask" id="whats" name="whatsapp"
                                                   placeholder="WHATSAPP*" required autocomplete="off"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control cpf-mask" id="data"
                                                   name="datanascimento" required placeholder="Data Nascimento*"
                                                   autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="col-sm-12 mb-12">
                                            <input type="text" class="form-control cpf-mask" id="cpf" name="cpf"
                                                   placeholder="CPF" maxlength="11" required autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control cpf-mask" id="rg" name="rg"
                                                   placeholder="RG*" maxlength="7" required autocomplete="off" />
                                        </div>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" name="nacionalidade"
                                                   placeholder="NACIONALIDADE*" required autocomplete="off"/>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control" name="estadocivil"
                                                   placeholder="ESTADO CIVIL*" required autocomplete="off" />
                                        </div>
                                    </div>


                                    <!--/-----------------------------------------------------------------------------------------------------/ -->
                                    <div class="col-md-12">
                                        <div class="page-header page">
                                            <h3>Endereço</h3>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control cpf-mask" id="cep" name="cep"
                                                   placeholder="CEP*" maxlength="11" required autocomplete="off"/>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control" name="estado" placeholder="ESTADO*"
                                                   required autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control" id="cidade" name="cidade"
                                                   placeholder="CIDADE*" required autocomplete="off"/>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-7">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control" name="rua" placeholder="Rua*"
                                                   required autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">

                                            <input type="number" class="form-control" name="numero" placeholder="Nº*"
                                                   required autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control" id="bairro" name="bairro"
                                                   placeholder="BAIRRO*" required autocomplete="off"/>
                                        </div>
                                    </div>

                                    <!--/-----------------------------------------------------------------------------------------------------/ -->
                                    <div class="col-md-12">
                                        <div class="page-header page">
                                            <h3>Responsáveis</h3>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" name="nomemae"
                                                   placeholder="NOME DA MÃE*" required autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" name="nomepai"
                                                   placeholder="NOME DO PAI*" required autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="nomeresponsavel"
                                                   placeholder="NOME DO RESPONSÁVEL**" required autocomplete="off"/>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="col-sm-12 mb-12">
                                            <input type="text" class="form-control cpf-mask" id="cpfresponsavel"
                                                   name="cpfresponsavel" required placeholder="CPF DO RESPONSÁVEL*"
                                                   maxlength="11" autocomplete="off" />

                                        </div>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control cpf-mask" id="rgresponsavel"
                                                   name="rgresponsavel" required placeholder="RG DO RESPONSÁVEL*" maxlength="7"
                                                   autocomplete="off"/>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-sm-12">
                                            <select class="form-control" name="categoria_id" id="categoria"
                                                    autocomplete="off" required>
                                            <option value="0">Categoria</option>
                                            @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">{{$categoria->title}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-sm-12">
                                            <input class="form-control"
                                                   autocomplete="off" type="text" name="codigo_categoria"
                                                   id="codigo_categoria" placeholder="Sem categoria"/>
                                        </div>
                                    </div>


                                    <!--/-----------------------------------------------------------------------------------------------------/ -->
                                    <div class="col-md-12">
                                        <div class="page-header page">
                                            <h3>CURSO</h3>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-sm-12">
                                            <select class="form-control" name="id_categoria" id="id_categoria"
                                                    autocomplete="off" required>
                                            <option value="">Curso:</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-sm-12">

                                            <select class="form-control" name="turma_id" id="id_sub_categoria">
                                                <option value="">Horário:</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>


                                <div class="form-group col-md-12">

                                    <div class="col-md-4">
                                        <!--<input class="btn btn-success displayed rounded" type="" value="LIMPAR"/>-->
                                        <label class="muda"><input type="checkbox" name="aceita_contrato" id="aceita_contrato"
                                                                   onClick="habilitaBTN()"> Li e aceito o <a href="#ex1"
                                                                                                             class="cor"
                                                                                                             rel="modal:open">CONTRATO</a></label>.
                                    </div>

                                    <div class="col-md-5">

                                        <input class="btn btn-success displayed rounded" name="envia" id="envia"
                                               type="submit" value="CADASTRAR"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery.mask.js') }}"></script>
<script src="{{ url('js/scripts.js') }}"></script>
{{--<script type="text/javascript">--}}
{{--    jQuery.noConflict();--}}
{{--    jQuery(function ($) {--}}
{{--        $("#telefone").mask("(99) 99999-9999");--}}
{{--        $("#whats").mask("(99) 99999-9999");--}}
{{--        $("#cpf").mask("999.999.999-99");--}}
{{--        $("#cpfresponsavel").mask("999.999.999-99");--}}
{{--        $("#cep").mask("99999 - 999");--}}
{{--        $("#data").mask("99/99/9999");--}}
{{--    });--}}
{{--</script>--}}

</body>
</html>
