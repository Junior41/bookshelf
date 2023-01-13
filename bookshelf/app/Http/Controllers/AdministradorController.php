<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Administrador;

use App\Http\Requests\CadastrarAdministradorRequest;
use App\Http\Requests\EditarAdministradorRequest;


class AdministradorController extends Controller
{
    private $administrador, $user;

    public function __construct(Administrador $administrador, User $user)
    {
        $this->administrador = $administrador;
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
        return view('administrador');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastrarAdministradorRequest $request)
    {
        $dataUser = $request->all();
        $dataAdministrador['CPF'] = $dataUser['CPF'];

        unset($dataUser['confirmarSenha']);

        $user = $this->user->find($request->CPF);

        if(mb_strpos($dataUser['CPF'], '.') || mb_strpos($dataUser['CPF'], '-') | mb_strpos($dataUser['CPF'], ','))
            return redirect('administrador/create')->with('error', 'Inseira o CPF sem máscara. Máscaras são pontos, hífens e vírgulas.');
        
        if($user)
            return redirect('administrador/create')->with('error', 'O CPF informado já está cadastrado.');
        
        $emails_iguais = $this->user->where('email', $dataUser['email'])->first();
        if($emails_iguais)
            return redirect('administrador/create')->with('error', 'O email informado já está cadastrado.');
        
        $dataUser['password'] = \Hash::make($dataUser['password']);

        $this->user->create($dataUser);
        $this->administrador->create($dataAdministrador);

        return redirect('administrador/create')->with('success', 'Administrador cadastrado com sucesso!');

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
        $administrador = $this->administrador->find($CPF);
        $user = $this->user->find($CPF);

        return view('administrador', compact('administrador', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditarAdministradorRequest $request, $cpf)
    {
        $user = $this->user->find($cpf);
        $administrador = $this->administrador->find($cpf);

        $dataUser = $request->all();
        $dataAdministrador['CPF'] = $administrador->CPF; // CPF Não é alterado.

        $emails_iguais = $this->user->where('email', $dataUser['email'])->first();
        if($emails_iguais && $dataUser['email'] != $user->email)
            return redirect('administrador/'.$cpf.'/edit')->with('error', 'O email informado já está cadastrado.');


        if($request['password']){ // alterar senha
            $dataUser['password'] = \Hash::make($dataUser['password']);
            unset($dataUser['confirmarSenha']);
        }else
            $dataUser['password'] = $user->password; // senha permanece a mesma
        

        $administrador->update($dataAdministrador);
        $user->update($dataUser);


        return redirect('administrador/'.$cpf.'/edit')->with('success', 'Administrador editado com sucesso!');

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
