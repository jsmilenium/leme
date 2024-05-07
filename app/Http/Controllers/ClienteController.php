<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;
use Carbon\Carbon;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::paginate(10);
        return view('pages.clientes.index', compact('clientes'));
    }

    public function store(ClienteRequest $request)
    {
        try{
            $data_nasc = date('Y-d-m', strtotime($request->data_nasc));
            if ($data_nasc > date('Y-m-d')) {
                return redirect()->route('cliente')->with('error', 'Data de nascimento inválida.');
            }
            $cliente = new Cliente();
            $cliente->nome = $request->nome;
            $cliente->cpf = $request->cpf;
            $cliente->data_nasc = Carbon::createFromFormat('d/m/Y', $request->data_nasc)->format('Y-m-d');
            $cliente->telefone = $request->telefone;
            $cliente->save();

            return redirect()->route('cliente')->with('success', 'Cliente cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('cliente')->with('error', 'Erro ao cadastrar cliente. Error: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $cliente = Cliente::find($request->id);
            if(!$cliente){
                return redirect()->route('clientes')->with('error', 'Cliente não encontrado.');
            }
            $cliente->delete();
            return redirect()->route('clientes')->with('success', 'Cliente excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('clientes')->with('error', 'Erro ao excluir cliente. Error: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $cliente = Cliente::find($request->id);
        return view('pages.clientes.edit', compact('cliente'));
    }

    public function update(ClienteRequest $request)
    {
        try {
            $data_nasc = date('Y-d-m', strtotime($request->data_nasc));
            if ($data_nasc > date('Y-m-d')) {
                return redirect('cliente/'. $request->id)->with('error', 'Data de nascimento inválida.');
            }
            $nome = Cliente::where('id', '!=', $request->id)->where('nome', $request->nome)->first();
            if ($nome) {
                return redirect('cliente/'. $request->id)->with('error', 'Nome já cadastrado.');
            }
            $cpf = Cliente::where('id', '!=', $request->id)->where('cpf', $request->cpf)->first();
            if ($cpf) {
                return redirect('cliente/'. $request->id)->with('error', 'CPF já cadastrado.');
            }
            $data_nasc = date('Y-m-d', strtotime($request->data_nasc));
            $cliente = Cliente::find($request->id);
            $cliente->nome = $request->nome;
            $cliente->cpf = $request->cpf;
            $cliente->data_nasc = Carbon::createFromFormat('d/m/Y', $request->data_nasc)->format('Y-m-d');
            $cliente->telefone = $request->telefone;
            $cliente->ativo = $request->ativo;
            $cliente->save();

            return redirect()->route('clientes')->with('success', 'Cliente atualizado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('clientes')->with('error', 'Erro ao atualizar cliente. Error: ' . $e->getMessage());
        }
    }

}
