@extends('layouts.app')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Basic Data Tables example with responsive plugin</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Turma</th>
                                <th>Contato</th>
                                <th>Status</th>
                                <th>Data nascimento</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($matriculas as $matricula)
                                <tr>
                                    <td>{{ $matricula->nome }}</td>
                                    <td>{{ $matricula->title }} - {{ $matricula->horario }}</td>
                                    <td>
                                        <p>{{ $matricula->contato }}</p>
                                        <p>{{ $matricula->whatsapp }} <i class="fa fa-whatsapp" aria-hidden="true"></i></p>
                                        <p>{{ $matricula->email }}</p>
                                    </td>
                                    <td><span class="label label-<?= $matricula->status_pagamento == 'paid' ? 'primary' : 'danger' ?>">
                                            @if($matricula->status_pagamento == 'paid') Pago @else Pendente @endif
                                        </span>
                                    </td>
                                    <td>{{ $matricula->datanascimento }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Turma</th>
                                <th>Contato</th>
                                <th>Status</th>
                                <th>Data nascimento</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
