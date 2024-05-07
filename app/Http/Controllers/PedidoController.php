<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Http\Requests\PedidoRequest;
use Carbon\Carbon;
use App\Models\PedidoStatus;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;
use App\Models\PedidosImagens;

class PedidoController extends Controller
{

    public function index()
    {
        $pedidos = Pedido::paginate(10);
        return view('pages.pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $pedido_status = PedidoStatus::all();
        $clientes = Cliente::where('ativo', 1)->orderBy('nome', 'asc')->get();
        return view('pages.pedidos.create', compact('pedido_status', 'clientes'));
    }

    public function store(PedidoRequest $request)
    {
        try{
            $data = date('Y-d-m', strtotime($request->data));
            if ($data > date('Y-m-d')) {
                return redirect()->route('pedido')->with('error', 'Data inválida.');
            }
            $pedido = new Pedido();
            $pedido->produto = $request->produto;
            $pedido->valor = $request->valor;
            $pedido->data = Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d');
            $pedido->cliente_id = $request->cliente_id;
            $pedido->pedido_status_id = $request->pedido_status_id;
            $pedido->save();

            if($request->file('imagem')){
                $nomeOriginal = $request->file('imagem')->getClientOriginalName();
                $caminhoOriginal = storage_path('app/public/pedidos/' . $pedido->id . '/' . $nomeOriginal);
                $request->imagem->move($caminhoOriginal);

                $nomeRedimensionado = 'capa_' . $nomeOriginal;
                $caminhoRedimensionado = storage_path('app/public/pedidos/' . $pedido->id . '/' . $nomeRedimensionado);

                $pedidosImagens = new PedidosImagens();
                $pedidosImagens->pedido_id = $pedido->id;
                $pedidosImagens->imagem = $caminhoOriginal;
                $pedidosImagens->capa = $caminhoRedimensionado;
                $pedidosImagens->save();
            }

            return redirect('pedido')->with('success', 'Pedido cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect('pedido')->with('error', 'Erro ao cadastrar pedido. Error: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $pedido = Pedido::find($request->id);
            if(!$pedido){
                return redirect('pedidos')->with('error', 'Pedido não encontrado.');
            }
            $pedido->delete();
            return redirect('pedidos')->with('success', 'Pedido excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect('pedidos')->with('error', 'Erro ao excluir pedido. Error: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $pedido = Pedido::find($request->id);
        $pedido_status = PedidoStatus::all();
        $clientes = Cliente::where('ativo', 1)->orderBy('nome', 'asc')->get();
        return view('pages.pedidos.edit', compact('pedido', 'pedido_status', 'clientes'));
    }

    public function update(PedidoRequest $request)
    {
        try {
            $data = date('Y-d-m', strtotime($request->data));
            if ($data > date('Y-m-d')) {
                return redirect('pedido/'. $request->id)->with('error', 'Data inválida.');
            }
            $produto = Pedido::where('id', '!=', $request->id)->where('produto', $request->produto)->first();
            if ($produto) {
                return redirect('pedido/'. $request->id)->with('error', 'Produto já cadastrado.');
            }
            $data = date('Y-m-d', strtotime($request->data));
            $pedido = Pedido::find($request->id);
            $pedido->produto = $request->produto;
            $pedido->valor = $request->valor;
            $pedido->data = Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d');
            $pedido->cliente_id = $request->cliente_id;
            $pedido->pedido_status_id = $request->pedido_status_id;
            $pedido->ativo = $request->ativo;
            $pedido->save();

            if($request->hasFile('imagem')){
                $nomeOriginal = $request->file('imagem')->getClientOriginalName();
                $caminhoOriginal = storage_path('app/public/pedidos/' . $pedido->id . '/' . $nomeOriginal);
                $request->imagem->move($caminhoOriginal);

                $nomeRedimensionado = 'capa_' . $nomeOriginal;
                $caminhoRedimensionado = storage_path('app/public/pedidos/' . $pedido->id . '/' . $nomeRedimensionado);

                $pedidosImagens = PedidosImagens::where('pedido_id', $pedido->id)->first();
                $pedidosImagens->imagem = $caminhoOriginal;
                $pedidosImagens->capa = $caminhoRedimensionado;
                $pedidosImagens->save();;
            }

            return redirect('pedidos')->with('success', 'Pedido atualizado com sucesso.');
        } catch (\Exception $e) {
            return redirect('pedido/'. $request->id)->with('error', 'Erro ao atualizar pedido. Error: ' . $e->getMessage());
        }
    }

}
