<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CadastrarCategoriaRequest;
use App\Http\Requests\EditarCategoriaRequest;
use Auth;

class CategoriaController extends Controller
{
    private $categoria;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->acesso < 1)
            return redirect('/home');

        return view('categoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(cadastrarCategoriaRequest $request)
    {
        if(auth()->user()->acesso < 1)
            return redirect('/home');

        $data = $request->all();

        $this->categoria->create($data);

         return redirect('/categoria/create')->with('success', 'Categoria cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->acesso < 1)
            return redirect('/home');

        $categoria = $this->categoria->find($id);

        return view('categoria', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->acesso < 1)
            return redirect('/home');
            
        $data = $request->all();
        $elemento = $this->categoria->find($id);

        $elemento->update($data);

        return redirect('/categoria/'. $id .'/edit')->with('success', 'Categoria editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
