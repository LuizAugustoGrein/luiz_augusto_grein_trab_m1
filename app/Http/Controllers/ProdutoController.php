<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view ('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validateData = $request->validate([
            'tipo'      =>      'required|max:35',
            'modelo'    =>      'required|max:35',
            'marca'     =>      'required|max:35',
            'precoVenda'=>      'required',
            'cor'       =>      'required|max:35',
            'peso'      =>      'required',
            'descricao' =>      'required|max:500'
        ]);
        $produto = Produto::create($validateData);
        return redirect('/prod')->with('success','Dados adicionados com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $produto = Produto::findOrFail($id);
        return view('produtos.show',compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $produto = Produto::findOrFail($id);
        return view('produtos.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // criando um objeto para testar/aplicar 
        // validações nos dados da requisição
        $validateData = $request->validate([
            'tipo'      =>      'required|max:35',
            'modelo'    =>      'required|max:35',
            'marca'     =>      'required|max:35',
            'precoVenda'=>      'required',
            'cor'       =>      'required|max:35',
            'peso'      =>      'required',
            'descricao'    =>      'required|max:500'
        ]);
        Produto::whereId($id)->update($validateData);
        return redirect('/prod')->with('success','Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id){
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return redirect('/prod')->with('success', 
        'Dados removidos com sucesso!');
    }
}
