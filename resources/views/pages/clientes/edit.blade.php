@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Cliente'])
    <div class="container-fluid py-3 pt-10">
        <div class="row">
            <form  method="POST" action="{{ route('cliente.update', $cliente->id) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="nome" class="form-control-label">Nome</label>
                    <input class="form-control" type="text" name="nome" placeholder="Informe o Nome" required value="{{ $cliente->nome }}" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="cpf" class="form-control-label">CPF<span>*</span></label>
                    <input class="form-control" type="text" name="cpf" placeholder="Informe o CPF" required value="{{ $cliente->cpf }}" maxlength="11">
                </div>
                <div class="form-group">
                    <label for="data_nasc" class="form-control-label">Data de Nascimento</label>
                    <input class="form-control" type="text" name="data_nasc" placeholder="Informe a Data de Nascimento" required value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cliente->data_nasc)->format('d/m/Y') }}" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="telefone" class="form-control-label">Telefone</label>
                    <input class="form-control" type="text" name="telefone" placeholder="Informe o Telefone" value="{{ $cliente->telefone }}" maxlength="9">
                </div>
                <div class="form-group">
                    <label for="ativo" class="form-control-label">Ativo</label>
                    <select class="form-control" name="ativo" required>
                        <option value="1" {{ $cliente->ativo == 1 ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ $cliente->ativo == 0 ? 'selected' : '' }}>Não</option>
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