<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fornecedor;

use App\Http\Requests\CadastrarFornecedorRequest;
use App\Http\Requests\EditarFornecedorRequest;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    private $fornecedor, $user;

    public function __construct(Fornecedor $fornecedor, User $user)
    {
        $this->fornecedor = $fornecedor;
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
        return view('fornecedor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastrarFornecedorRequest $request)
    {
        $data = $request->all();

        $fornecedor = $this->fornecedor->find($data['CNPJ']);

        unset($data['confirmarSenha']);

        if(mb_strpos($data['CNPJ'], '.') || mb_strpos($data['CNPJ'], '-') | mb_strpos($data['CNPJ'], ','))
            return redirect('fornecedor/create')->with('error', 'Inseira o CNPJ sem máscara. Máscaras são pontos, hífens e vírgulas.');
        
        if($fornecedor)
            return redirect('fornecedor/create')->with('error', 'O CNPJ informado já está cadastrado.');
        
        $data['password'] = \Hash::make($data['password']);


        $this->fornecedor->create($data);

        return redirect('fornecedor/create')->with('success', 'Fornecedor cadastrado com sucesso!');

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
    public function edit($CNPJ)
    {
        $fornecedor = $this->fornecedor->find($CNPJ);
        $user = $this->user->find($CNPJ);

        return view('fornecedor', compact('fornecedor', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditarFornecedorRequest $request, $cnpj)
    {
        $fornecedor = $this->fornecedor->find($cnpj);

        $data = $request->all();
        $data['cnpj'] = $fornecedor->cnpj; // cnpj Não é alterado.

        if($request['password']){ // alterar senha
            $data['password'] = \Hash::make($data['password']);
            unset($data['confirmarSenha']);
        }else
            $data['password'] = $fornecedor->password; // senha permanece a mesma
        

        $fornecedor->update($data);

        return redirect('fornecedor/'.$cnpj.'/edit')->with('success', 'Fornecedor editado com sucesso!');
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
