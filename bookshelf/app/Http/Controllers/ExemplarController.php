<?php

namespace App\Http\Controllers;


use App\Models\Exemplar;
use App\Models\Livro;
use App\Models\Socio;
use App\Models\Fornecedor;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CadastrarExemplarRequest;
use App\Http\Requests\EntregarExemplarRequest;
use App\Http\Requests\ReservarExemplarRequest;
use App\Http\Requests\EditarExemplarRequest;

class ExemplarController extends Controller
{
    private $exemplar, $livro, $socio, $fornecedor;

    public function __construct(Exemplar $exemplar, Livro $livro, Socio $socio, Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
        $this->socio = $socio;
        $this->exemplar = $exemplar;
        $this->livro = $livro;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show_entregar(){
        return view('reservar');
    }
    public function entregar(EntregarExemplarRequest $request){
        $exemplar = $this->exemplar->where('codigo', $request->codigo)
                                    ->where('dataEntrega', $request->entrega)
                                    ->first();
        if(!$exemplar)
            return redirect('/exemplar/entregar')->with('error', 'Data de entrega e código informados não equivalem a nenhum exemplar emprestado.');
        
        $livro = $exemplar->livro()->get()[0];

        $livro->quantidadeExemplares++;
        $exemplar->emprestado = 0;
        $exemplar->dataEntrega = NULL;

        $exemplar->save();
        $livro->save();

        return redirect('/exemplar/entregar')->with('success', 'Exemplar devolvido com sucesso.');
        
    }

    public function show_reservar($codigo){
        $livro = $this->livro->find($codigo);
        $exemplar = $livro->exemplares()->first();

        return view('reservar', compact('exemplar'));
    }

    public function reservar(ReservarExemplarRequest $request, $codigo){
        $livro = $this->livro->find($codigo);
        $exemplar = $livro->exemplares()->get()[0];
        $exemplar->emprestado = 1;
        $exemplar->dataEntrega = $request->entrega;
        $livro->quantidadeExemplares--;
        
        $exemplar->save();
        $livro->save();
        
        return redirect('/home')->with('success', 'Exemplar reservado com sucesso.');

    }

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

        return view('exemplar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastrarExemplarRequest $request)
    {
        if(auth()->user()->acesso < 1)
            return redirect('/home');

        $data = $request->all();
        $quantidade = $data['quantidadeExe'];

        // válidar código do livro
        $livro = $this->livro->find($data['codigo']);
        if(!$livro)
            return redirect('exemplar/create')->with('error', 'Código informado não pertence a nenhum livro.');

        if($quantidade <= 0 && $quantidade < 50)
            return redirect('exemplar/create')->with('error', 'A quantidade de exemplares informada deve ser maior que 0 e menor que 50.');

        // validando CNPJ e CPF
        if($data['CPFSocio']){
            if($data['CNPJFornecedor'])
                return redirect('exemplar/create')->with('error', 'Informe apenas um CPF Sócio OU um CNPJ fornecedor.');
            
            $socio = $this->socio->find($data['CPFSocio']);

            if(!$socio)
                return redirect('exemplar/create')->with('error', 'O CPF informado não corresponde a nenhum Sócio.');
            
        }else{
            if(!$data['CNPJFornecedor'])
                return redirect('exemplar/create')->with('error', 'Informe um CPF Sócio OU um CNPJ fornecedor.');
            
            $fornecedor = $this->fornecedor->find($data['CNPJFornecedor']);

            if(!$fornecedor)
                return redirect('exemplar/create')->with('error', 'O CNPJ informado não corresponde a nenhum Fornecedor.');
        }

        $livro->quantidadeExemplares += $quantidade;

        for($i = 0; $i < $quantidade; $i++)
            $this->exemplar->create($data);

        $livro->save();
        if($quantidade == 1)
            return redirect('exemplar/create')->with('success', 'Exemplar cadastrado com sucesso.');
        else
            return redirect('exemplar/create')->with('success', 'Exemplares cadastrados com sucesso.');

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

        $exemplar = $this->exemplar->where('codigo', $codigo)->first();

        return view('exemplar', compact('exemplar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditarExemplarRequest $request, $codigo)
    {
        if(auth()->user()->acesso < 1)
            return redirect('/home');
            
        $data = $request->all();

        $exemplar = $this->exemplar->find($codigo);

        $data['codigo'] = $exemplar->codigo;

        // validando CNPJ e CPF
        if($data['CPFSocio']){
            if($data['CNPJFornecedor'])
                return redirect('exemplar/'.$codigo.'/edit')->with('error', 'Informe apenas um CPF Sócio OU um CNPJ fornecedor.');
            
            $socio = $this->socio->find($data['CPFSocio']);

            if(!$socio)
                return redirect('exemplar/'.$codigo.'/edit')->with('error', 'O CPF informado não corresponde a nenhum Sócio.');
            
        }else{
            if(!$data['CNPJFornecedor'])
                return redirect('exemplar/'.$codigo.'/edit')->with('error', 'Informe um CPF Sócio OU um CNPJ fornecedor.');
            
            $fornecedor = $this->fornecedor->find($data['CNPJFornecedor']);

            if(!$fornecedor)
                return redirect('exemplar/'.$codigo.'/edit')->with('error', 'O CNPJ informado não corresponde a nenhum Fornecedor.');
        }


        $this->exemplar->update($data);

        return redirect('exemplar/'.$codigo.'/edit')->with('success', 'Exemplar editado com sucesso.');
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
