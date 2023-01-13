<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Funcionario;

use App\Http\Requests\CadastrarFuncionarioRequest;
use App\Http\Requests\EditarFuncionarioRequest;

class FuncionarioController extends Controller
{
    private $funcionario, $user;

    public function __construct(Funcionario $funcionario, User $user)
    {
        $this->funcionario = $funcionario;
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
        return view('funcionario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastrarFuncionarioRequest $request)
    {
        $dataUser = $request->all();
        $dataFuncionario['CPF'] = $dataUser['CPF'];
        $dataFuncionario['status'] = $dataUser['status'];

        unset($dataUser['confirmarSenha']);
        unset($dataUser['status']);

        $user = $this->user->find($request->CPF);

        if(mb_strpos($dataUser['CPF'], '.') || mb_strpos($dataUser['CPF'], '-') | mb_strpos($dataUser['CPF'], ','))
            return redirect('funcionario/create')->with('error', 'Inseira o CPF sem máscara. Máscaras são pontos, hífens e vírgulas.');
        
        if($user)
            return redirect('funcionario/create')->with('error', 'O CPF informado já está cadastrado.');
        
        $emails_iguais = $this->user->where('email', $dataUser['email'])->first();
        if($emails_iguais)
            return redirect('funcionario/create')->with('error', 'O email informado já está cadastrado.');
        
        $dataUser['password'] = \Hash::make($dataUser['password']);

        $this->user->create($dataUser);
        $this->funcionario->create($dataFuncionario);

        return redirect('funcionario/create')->with('success', 'Funcionário cadastrado com sucesso!');

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
        $funcionario = $this->funcionario->find($CPF);
        $user = $this->user->find($CPF);

        return view('funcionario', compact('funcionario', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditarFuncionarioRequest $request, $cpf)
    {
        $user = $this->user->find($cpf);
        $funcionario = $this->funcionario->find($cpf);

        $dataUser = $request->all();
        $dataFuncionario['CPF'] = $funcionario->CPF; // CPF Não é alterado.
        $dataFuncionario['status'] = $dataUser['status'];
        unset($dataUser['status']);

        if($request['password']){ // alterar senha
            $dataUser['password'] = \Hash::make($dataUser['password']);
            unset($dataUser['confirmarSenha']);
        }else
            $dataUser['password'] = $user->password; // senha permanece a mesma
        

        $funcionario->update($dataFuncionario);
        $user->update($dataUser);


        return redirect('funcionario/'.$cpf.'/edit')->with('success', 'Funcionário editado com sucesso!');
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
