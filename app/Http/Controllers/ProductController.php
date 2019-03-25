<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\User;
use App\Address;
use Image;

class ProductController extends Controller
{
    public function __construct() {
      $this->middleware('is_admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        /* return with all records. */
        // $products = Product::all();
        // $products = Product::paginate(5);
        $products = Product::paginate(config('constants.PAGINATION'));
        return view('products.index', compact('products'));
        /* return with json format.  */
        // return Product::paginate(5);
      } catch (\Throwable $e) {
          throw $e;
      }  
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
      return redirect('/products')->with('message', ['success','Product has been added!']);
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
      $images  = glob(public_path('/prod_imgs').'/'.strval($product->id).'_*.png');
      
      return view('products.edit', compact('product', 'images'));
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
        'prod_qty'   => 'required|integer',
        'prod_img[]' => 'image'
      ]);
      $product = Product::find($id);
      $product->prod_name  = $request->get('prod_name');
      $product->prod_desc  = $request->get('prod_desc');
      $product->prod_price = $request->get('prod_price');
      $product->prod_qty   = $request->get('prod_qty');
      $product->save();
      
      // Save upload files
      $images = $request->file('prod_img');
      foreach ($images as $key => $image) {
        $img = Image::make($image);
        $img->fit(600,600);
        $img->save(public_path('/prod_imgs').'/'.$id.'_'.$key.'.png');
      }
  
      return redirect('/products')->with('message', ['success', 'The product has been updated!']);
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
      return redirect('/products')->with('message', ['danger', 'The product has been deleted!']);
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
    
    public function show_cart()
    {
      $cart  = session()->get('cart');
      $total = 0;
      if (isset($cart)) {  
        foreach($cart as $id => $product) {
          $total = $total + $product['prod_subtotal'];
        }
      }

      return view('products.cart', compact('cart', 'total')); 
    }


    // add to cart
    public function add_to_cart($id) 
    {
      $product = Product::find($id);
 
      if($product) { 
        $cart = session()->get('cart');
        
        if(isset($cart[$id])) {
          // if cart not empty and product exist then increment amount
          $cart[$id]['prod_amount']++;
          $cart[$id]['prod_subtotal'] = $cart[$id]['prod_price'] * $cart[$id]['prod_amount']; 
        } else {
          // if item not exist in cart then add to cart with amount = 1
          $cart[$id] = [
            "prod_name"     => $product->prod_name,
            "prod_desc"     => $product->prod_desc,
            "prod_price"    => $product->prod_price,
            "prod_amount"   => 1,
            "prod_subtotal" => $product->prod_price
          ];
        }
 
        session()->put('cart', $cart);
        return redirect()->back()->with('message', ['success', 'Product added to cart successfully!']);

      } else {
        abort(404);
      }
    }
    
    public function cart_quantity_up($id) 
    { 
      $cart = session()->get('cart');
      $cart[$id]['prod_amount']++;
      $cart[$id]['prod_subtotal'] = $cart[$id]['prod_price'] * $cart[$id]['prod_amount'];
      session()->put('cart', $cart);
      session()->flash('message', ['success', 'Cart updated successfully']);
      return redirect()->back();
    }
    
    public function cart_quantity_down($id) 
    {
      $cart = session()->get('cart');
      if ($cart[$id] == 1) {
        unset($cart[$id]);
      } else {
        $cart[$id]['prod_amount']--;
        $cart[$id]['prod_subtotal'] = $cart[$id]['prod_price'] * $cart[$id]['prod_amount']; 
      }
      session()->put('cart', $cart);
      session()->flash('message', ['success', 'Cart updated successfully']);
      return redirect()->back();
    }
    
    
    // delete an item in the shopping cart
    public function cart_item_delete($id) 
    {
      $cart = session()->get('cart');
      if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
        session()->flash('message', ['warning', 'A cart item deleted successfully!']);
        return redirect()->back();
      }
    }

    // empty cart
    public function empty_cart() 
    {
      if (session('cart')) {
        session()->forget('cart');
      }
      return redirect()->back()->with('message', ['warning', 'Cart is empty!']);
    }

}
