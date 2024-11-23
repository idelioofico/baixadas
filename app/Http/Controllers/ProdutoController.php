<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $meses = Produto::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
        if (Produto::first()) {
            $mes = Produto::first()->created_at->format('Y-m');
            $data = $mes;
            $produtos = Produto::where('status', 1)->where('created_at', 'LIKE', '%' . $mes . '%')->orderBy('nome', 'asc')->paginate(20);
        } else {
            $mes = Produto::get();
            $data = $mes;
            $produtos = Produto::where('status', 1)->where('created_at', 'LIKE', '%' . $mes . '%')->orderBy('nome', 'asc')->paginate(20);

        }
        return view('admin.produto.index', compact('produtos', 'meses', 'data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::where('status', 1)->where('parent_id', 0)->get();
        $subcategorias= Categoria::where('status', 1)->where('parent_id','!=', 0)->get();

        $unidade = \App\Models\Unidade::all();

        return view('admin.produto.create', compact('categorias', 'unidade', 'subcategorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'codigo' => 'required',
                'nome' => 'required',
                'categoria_id' => 'required',
                'parent_id' => 'required',
                'imagem' => '',
                'controle_quantidade' => '',
                'quantidade_minima' => '',
                'unidade_total' => 'required',
                'localozacao_no_armazem' => ''
            ]);
    
            $completeName = '';
            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                $name = Str::slug($request->nome, '-');
                $name2 = uniqid(date('HisYmd'));
                $type = $request->file('imagem')->extension();
                $completeName = $name . '-' . $name2 . '.' . $type;
                $request->file('imagem')->move(public_path('imagens/'), $completeName);
                // return 'ok';
            }
            $produto = Produto::create([
    
                'codigo' => $data['codigo'],
                'nome' => $data['nome'],
                'categoria_id' => $data['categoria_id'],
                'parent_id' => $data['parent_id'],
                'imagem' => $completeName,
                'unidade_total' => $data['unidade_total'],
                'controle_quantidade' => $data['controle_quantidade'],
                'quantidade_minima' => $data['quantidade_minima'],
                'localozacao_no_armazem' => $data['localozacao_no_armazem']
    
            ]);
     
            return redirect()->route('produto.show', $produto->id);
        } catch (\Throwable $error) {
            return $error;
        }
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
        $produto = Produto::where('status', 1)->find($id);
        $categorias = Categoria::where('status', 1)->where('parent_id', 0)->get();
        return view('admin.produto.show', compact('produto', 'categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http'\Response
     */
    public function edit($id)
    {
        //
        $produto = Produto::where('status', 1)->find($id);
        $categorias = Categoria::where('status', 1)->where('parent_id', 0)->get();
        return view('admin.produto.edit', compact('produto', 'categorias'));
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


        $data = $request->validate([
            'codigo' => 'required',
            'nome' => 'required',
            'categoria_id' => 'required',
            'parent_id' => 'required',
            'imagem' => '',
            'controle_quantidade' => '',
            'quantidade_minima' => '',
            // 'quantidade_total' => 'required',
            'unidade_total' => 'required',
            'localozacao_no_armazem' => ''
        ]);

        if (!$produto = Produto::where('status', 1)->find($id)) {
            return redirect()->back();
        }

        $completeName = $produto->imagem;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $img = public_path('imagens/' . $produto->imagem);

            if (file_exists($img)) {
                unlink($img);
            }

            $name = Str::slug($request->nome, '-');
            $name2 = uniqid(date('HisYmd'));
            $type = $request->file('imagem')->extension();
            $completeName = $name . '-' . $name2 . '.' . $type;
            $request->file('imagem')->move(public_path('imagens/'), $completeName);
            // return 'ok';
        }

        $produto->update([

            'codigo' => $data['codigo'],
            'nome' => $data['nome'],
            'categoria_id' => $data['categoria_id'],
            'parent_id' => $data['parent_id'],
            'imagem' => $completeName,
            // 'quantidade_total' => $data[''],
            'controle_quantidade' => $data['controle_quantidade'],
            'quantidade_minima' => $data['quantidade_minima'],
            'unidade_total' => $data['unidade_total'],
            'localozacao_no_armazem' => $data['localozacao_no_armazem']

        ]);

        return redirect()->route('produto.show', $id);
        // return redirect()->route('produto.index');
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


        if (!$produto = Produto::where('status', 1)->find($id)) {
            return response()->json('Não foi possivel encontrar o produto', 402);
        }

        $produto->update(['status' => 0]);

        return redirect()->route('pesquisas.index');
        // return response()->json('Produto deletado com sucesso', 200);
    }

    // Pesquisa function
    public function pesquisa(Request $request)
    {

        $filters = $request->except('_token');
        $meses = Produto::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });

        // Pesquisa por data
        if ($request->data) {
            $data = $request->data;
            $produtos = Produto::with('categoria.father')->where('status', 1)->whereHas('categoria', function ($q) {
                $q->where('status', 1);
            })->where('created_at', 'LIKE', '%' . $request->data . '%')
                ->orderBy('nome', 'asc')->get();

            // return view('admin.stock.index', compact('produtos', 'meses', 'filters', 'data'));
            return response()->json(['produtos' => $produtos], 200);
        }

        // Pesquisa por filtros
        if ($request->codigo || $request->nome || $request->categoria || $request->subcategoria) {

            $data = '';
            // Pesquisa Fornecedor
            $produtos = $this->filtros($request);
            return response()->json(['produtos' => $produtos], 200);
        }

        // Pesquisa total por search
        if ($request->pesquisa) {
            $produtos = $this->searchtotal($request);
            return response()->json(['produtos' => $produtos], 200);
        }

        // Pesquisa vazia

        $meses = Produto::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
        $mes = Produto::first();
        $data = $mes;

        $produtos = Produto::with('categoria.father')->whereHas('categoria', function ($q) {
                $q->where('status', 1);
            })->where('status', 1)->orderBy('nome', 'asc')->get();

        return response()->json(['produtos' => $produtos, 'meses' => $meses, 'data' => $data]);
        return view('admin.stock.index', compact('produtos', 'meses', 'data'));
    }

    // Filtros
    public function filtros($request)
    {
        return $produtos = Produto::with('categoria.father')->whereHas('categoria', function ($q) {
                $q->where('status', 1);
            })->where('status', 1)->Where('nome', 'LIKE', $request->nome . '%')->Where('codigo', 'LIKE', $request->codigo . '%')
            ->WhereHas('categoria', function ($q) use ($request) {
                $q->where('nome', 'LIKE', $request->subcategoria . '%');
            })
            ->WhereHas('categoria', function ($q) use ($request) {
                $pai = $request;
                $q->WhereHas('father', function ($f) use ($pai) {
                    $f->where('nome', 'LIKE', $pai->categoria . '%');
                });
            })
            ->get();
    }

    // Pesquisa total de search
    public function searchtotal($request)
    {
        return $produtos = Produto::with('categoria.father')->whereHas('categoria', function ($q) {
                $q->where('status', 1);
            })->where('status', 1)->Where('nome', 'LIKE', $request->pesquisa . '%')->orWhere('codigo', 'LIKE', $request->pesquisa . '%')
            ->orWhereHas('categoria', function ($q) use ($request) {
                $q->where('nome', 'LIKE', $request->pesquisa . '%');
            })
            ->orWhereHas('categoria', function ($q) use ($request) {
                $pai = $request;
                $q->WhereHas('father', function ($f) use ($pai) {
                    $f->where('nome', 'LIKE', $pai->pesquisa . '%');
                });
            })
            // ->orWhere('pendente', 'LIKE', $pendente . '%')
            ->get();
    }



    function pendente($pendente)
    {
        $pendente;
        return $produtos = Produto::where('status', 1)->Where('pendente', 'LIKE', $pendente . '%')
            ->paginate(20);
    }
}
