<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Livro;
use Auth;
use App\Http\Requests\CadastrarLivroRequest;
use App\Http\Requests\EditarLivroRequest;

use Illuminate\Http\Request;

class LivroController extends Controller
{
    private $categoria, $livro;

    public function __construct(Categoria $categoria, Livro $livro)
    {
        $this->categoria = $categoria;
        $this->livro = $livro;
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

        $categorias = $this->categoria->all();
        
        if(empty($categorias->toArray())) // retorna para a tela de cadastro de categoria
            return redirect('/categoria/create')->with('error', 'É necessário cadastrar a categoria antes do livro.');
        
        return view('livro', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(cadastrarLivroRequest $request)
    {
        if(auth()->user()->acesso < 1)
            return redirect('/home');

        $data = $request->all();
        $data['quantidadeExemplares'] = 0;    

        $livros = $this->livro->where('codigo', $data['codigo'])->first();

        if($livros != NULL) // códifo duplicado
            return redirect('livro/create')->with('error', 'O código informado já está cadastrado!');

        if ($request->hasFile('capa')) 
            $data['capa'] = $request->file('capa')->store('capas', 'public');
        else
            return redirect('cadastroLivro/create')->with('error', 'Você não selecionou uma foto!');
        
        $this->livro->create($data);

        return redirect('livro/create')->with('success', 'Livro cadastrado com sucesso!');
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
    public function edit($codigo)
    {
        if(auth()->user()->acesso < 1)
            return redirect('/home');

        $livro = $this->livro->where('codigo', $codigo)->first();
        $categorias = $this->categoria->all();
        
        return view('livro', compact('livro', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codigo)
    {
        if(auth()->user()->acesso < 1)
            return redirect('/home');
            
        $data = $request->all();
        $categorias = $this->categoria->all();

        $livro = $this->livro->where('codigo', $codigo)->first();

        if($request->hasFile('capa')) 
            $data['capa'] = $livro->capa;

        $livro->update($data);

        return redirect()->back()->withInput(['categorias'])->with('success', 'Livro atualizado com sucesso!');
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
