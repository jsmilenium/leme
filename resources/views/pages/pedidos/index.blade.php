@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="<?php echo asset('assets/css/sweetalert2.min.css'); ?>" type="text/css">
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Listagem de Pedidos'])
    <div class="container-fluid py-3 pt-10">
        <div class="row">
            <div class="card">
                <div class="table-responsive">
                    @if(count($pedidos))
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Produto</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">valor</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Data</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Cliente</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Pedido Status</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Ativo</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedidos as $pedido)
                                <tr>
                                    <td class="text-xs font-weight-bold mb-0">{{ $pedido->id }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $pedido->produto }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $pedido->valor }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pedido->data)->format('d/m/Y') }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $pedido->cliente->nome }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $pedido->pedidoStatus->descricao }}</td>                                    
                                    <td class="align-middle text-left text-sm">
                                        @if($pedido->ativo == 1)
                                            Sim
                                        @else
                                            Não
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-xs" href="{{ route('pedido.edit', $pedido->id) }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-xs">
                                            <form action="{{ route('pedido.destroy', $pedido->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="show_confirm" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="text-center">
                            {!! $pedidos->links() !!}
                        </div>
                        @else
                            <div class="text-gray-600 text-center mt-8">
                                <p class="text-lg mb-2">Nenhum pedido encontrado.</p>
                            </div>
                        @endif
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
    <script src="{{ asset ('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset ('assets/js/excluir.js') }}"></script>
@endsection