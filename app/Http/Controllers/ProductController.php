<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /* return with all records. */
      // $products = Product::all();
      $products = Product::paginate(5);
      return view('products.index', compact('products'));
      /* return with json format.  */
      // return Product::paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
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
      $request->validate([
        'prod_name'  => 'required',
        'prod_desc'  => 'required',
        'prod_price' => 'required|integer',
        'prod_qty'   => 'required|integer'
      ]);
      $product = new Product([
        'prod_name'  => $request->get('prod_name'),
        'prod_desc'  => $request->get('prod_desc'),
        'prod_price' => $request->get('prod_price'),
        'prod_qty'   => $request->get('prod_qty')
      ]);
      $product->save();
      return redirect('/products')->with('success','Product has been added!');
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
      $product = Product::find($id);
      return view('products.edit', compact('product'));
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
      $request->validate([
        'prod_name'  => 'required',
        'prod_desc'  => 'required',
        'prod_price' => 'required|integer',
        'prod_qty'   => 'required|integer'
      ]);
      $product = Product::find($id);
      $product->prod_name  = $request->get('prod_name');
      $product->prod_desc  = $request->get('prod_desc');
      $product->prod_price = $request->get('prod_price');
      $product->prod_qty   = $request->get('prod_qty');
      $product->save();
      return redirect('/products')->with('success', 'Product has been updated!');
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
      $product = Product::find($id);
      $product->delete();
      return redirect('/products')->with('success', 'Product has been deleted!');
    }

    public function search(Request $request)
    {
      $request->validate([
        'keyword' => 'required'
      ]);

      // single keyword
      // $keyword = $request->get('keyword'); 
      // $products = Product::where('prod_name', 'like', '%'.$keyword.'%')
      //   ->orWhere('prod_desc', 'like', '%'.$keyword.'%')->get();

      // $products = Product::paginate(5);

      // multiple keywords
      $keywords = explode(' ', $request->get('keyword'));
      $where = '';
      foreach ($keywords as $id => $word) {
        if ($id <> 0) {
          $where = $where.'or ';
        }
        $where = $where."prod_name like '%{$word}%' or prod_desc like '%{$word}%'";  
      }
      $sql = "$where ORDER BY 'prod_id' DESC";
      $products = Product::whereRaw($sql)->get();

      return view('products.index', compact('products'));
    }
}
