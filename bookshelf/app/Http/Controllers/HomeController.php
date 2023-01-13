<?php

namespace App\Http\Controllers;

use App\Models\Livro;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $livro;

    public function __construct(Livro $livro)
    {
        $this->livro = $livro;
        $this->middleware('auth');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $livros = $this->livro->paginate(4);

        return view('index', compact('livros'));
    }
    public function filtroNome(Request $request)
    {
        $livros = $this->livro->where('nome', 'LIKE', '%' . $request->nome . '%')->paginate(4);
        
        return view('index', compact('livros'));
    }
}
