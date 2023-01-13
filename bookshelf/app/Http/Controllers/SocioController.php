<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Socio;

use App\Http\Requests\CadastrarSocioRequest;
use App\Http\Requests\EditarSocioRequest;

use Illuminate\Http\Request;

class SocioController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('socio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastrarSocioRequest $request)
    {
        $dataUser = $request->all();
        $dataSocio['CPF'] = $dataUser['CPF'];
        $dataSocio['endereco'] = $dataUser['endereco'];
        $dataSocio['status'] = $dataUser['status'];

        unset($dataUser['confirmarSenha']);
        unset($dataUser['status']);
        unset($dataUser['endereco']);

        $user = $this->user->find($request->CPF);

        if(mb_strpos($dataUser['CPF'], '.') || mb_strpos($dataUser['CPF'], '-') | mb_strpos($dataUser['CPF'], ','))
            return redirect('socio/create')->with('error', 'Inseira o CPF sem máscara. Máscaras são pontos, hífens e vírgulas.');
        
        if($user)
            return redirect('socio/create')->with('error', 'O CPF informado já está cadastrado.');
        
        $emails_iguais = $this->user->where('email', $dataUser['email'])->first();
        if($emails_iguais)
            return redirect('socio/create')->with('error', 'O email informado já está cadastrado.');
        
        $dataUser['password'] = \Hash::make($dataUser['password']);

        $this->user->create($dataUser);
        $this->socio->create($dataSocio);

        return redirect('socio/create')->with('success', 'Sócio cadastrado com sucesso!');

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
    public function edit($CPF)
    {
        $socio = $this->socio->find($CPF);
        $user = $this->user->find($CPF);

        return view('socio', compact('socio', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditarSocioRequest $request, $cpf)
    {
        $user = $this->user->find($cpf);
        $socio = $this->socio->find($cpf);

          
        $dataUser = $request->all();
        $datasocio['CPF'] = $socio->CPF; // CPF Não é alterado.
        $datasocio['status'] = $dataUser['status'];
        $datasocio['endereco'] = $dataUser['endereco'];
        unset($dataUser['status']);
        unset($dataUser['endereco']);

        $emails_iguais = $this->user->where('email', $dataUser['email'])->first();
        if($emails_iguais && $dataUser['email'] != $user->email)
            return redirect('socio/'.$cpf.'/edit')->with('error', 'O email informado já está cadastrado.');

        if($request['password']){ // alterar senha
            $dataUser['password'] = \Hash::make($dataUser['password']);
            unset($dataUser['confirmarSenha']);
        }else
            $dataUser['password'] = $user->password; // senha permanece a mesma
        

        $socio->update($datasocio);
        $user->update($dataUser);


        return redirect('socio/'.$cpf.'/edit')->with('success', 'Sócio editado com sucesso!');
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
