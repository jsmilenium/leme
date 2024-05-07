@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Cadastrar Cliente'])
    <div class="container-fluid py-3 pt-10">
        <div class="row">
            <form  method="POST" action="{{ route('cliente.store') }}">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="nome" class="form-control-label">Nome</label>
                    <input class="form-control" type="text" name="nome" placeholder="Informe o Nome" required value="{{ old('nome') }}" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="cpf" class="form-control-label">CPF<span>*</span></label>
                    <input class="form-control" type="text" name="cpf" placeholder="Informe o CPF" required value="{{ old('cpf') }}" maxlength="11">
                </div>
                <div class="form-group">
                    <label for="data_nasc" class="form-control-label">Data de Nascimento</label>
                    <input class="form-control" type="text" name="data_nasc" placeholder="Informe a Data de Nascimento" required value="{{ old('data_nasc') }}" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="telefone" class="form-control-label">Telefone</label>
                    <input class="form-control" type="text" name="telefone" placeholder="Informe o Telefone" value="{{ old('telefone') }}" maxlength="9">
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