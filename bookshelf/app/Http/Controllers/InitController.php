<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Socio;

use App\Http\Requests\CadastrarSocioRequest;


use Illuminate\Http\Request;

class InitController extends Controller
{
    private $socio, $user;

    public function __construct(Socio $socio, User $user)
    {
        $this->socio = $socio;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('telaInicial');
    }

    public function cadastro(CadastrarSocioRequest $request){

        $dataUser = $request->all();
        $dataSocio['CPF'] = $dataUser['CPF'];
        $dataSocio['endereco'] = $dataUser['endereco'];

        $dataUser['acesso'] = 0;
        
        unset($dataUser['confirmarSenha']);
        unset($dataUser['endereco']);

        $user = $this->user->find($request->CPF);

        if(mb_strpos($dataUser['CPF'], '.') || mb_strpos($dataUser['CPF'], '-') | mb_strpos($dataUser['CPF'], ','))
            return redirect('/')->with('error', 'Inseira o CPF sem máscara. Máscaras são pontos, hífens e vírgulas.');
        
        if($user)
            return redirect('/')->with('error', 'O CPF informado já está cadastrado.');
        
        $emails_iguais = $this->user->where('email', $dataUser['email'])->first();
        if($emails_iguais)
            return redirect('/')->with('error', 'O email informado já está cadastrado.');
        
        $dataUser['password'] = \Hash::make($dataUser['password']);

        $this->user->create($dataUser);
        $this->socio->create($dataSocio);

        return redirect('/login')->with('success', 'Sócio cadastrado com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
