@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link href="/assets/css/select2.min.css" rel="stylesheet" />
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Pedido'])
    <div class="container-fluid py-3 pt-10">
        <div class="row">
            <form  method="POST" action="{{ route('pedido.update', $pedido->id) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="produto" class="form-control-label">Produto<span>*</span></label>
                    <input class="form-control" type="text" name="produto" placeholder="Informe o Produto" required value="{{ $pedido->produto }}" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="valor" class="form-control-label">Valor<span>*</span></label>
                    <input class="form-control" type="text" name="valor" placeholder="Informe o Valor" required value="{{ $pedido->valor }}" maxlength="11">
                </div>
                <div class="form-group">
                    <label for="data" class="form-control-label">Data<span>*</span></label>
                    <input class="form-control" type="text" name="data" placeholder="Informe a Data" required value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pedido->data)->format('d/m/Y') }}" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="cliente_id" class="form-control-label">Cliente<span>*</span></label>
                    <select class="form-control" name="cliente_id" required>
                        <option value="">Selecione</option>
                        @foreach ($clientes as $cliente)
                            @if ($pedido->cliente_id == $cliente->id)
                                <option value="{{ $cliente->id }}"
                                        selected>{{ $cliente->nome }}
                                </option>
                            @else
                                <option
                                    value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pedido_status" class="form-control-label">Status<span>*</span></label>
                    <select class="form-control" name="pedido_status_id" required>
                        <option value="">Selecione</option>
                        @foreach ($pedido_status as $pedidoStatus)
                            @if ($pedido->pedido_status_id == $pedidoStatus->id)
                                <option value="{{ $pedidoStatus->id }}"
                                        selected>{{ $pedidoStatus->descricao }}
                                </option>
                            @else
                                <option
                                    value="{{ $pedidoStatus->id }}">{{ $pedidoStatus->descricao }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="imagem" class="form-control-label">Imagem</label>
                    <input class="form-control" type="file" name="imagem" placeholder="Informe a Imagem" value="{{ old('imagem') }}">
                </div>
                <div class="form-group">
                    <label for="ativo" class="form-control-label">Ativo</label>
                    <select class="form-control" name="ativo" required>
                        <option value="1" {{ $pedido->ativo == 1 ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ $pedido->ativo == 0 ? 'selected' : '' }}>Não</option>
                    </select>
                </div>
                @if ($errors->any())
                    <div class="text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="text-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="text-success">
                        {{ session()->get('success') }}
                    </div> 
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset ('/assets/js/select2.min.js') }}"></script>
@endsection