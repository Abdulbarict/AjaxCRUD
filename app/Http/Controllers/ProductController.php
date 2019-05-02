<?php

namespace App\Http\Controllers;
use App\Category;
use App\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Products::all()->join('categories','categories.id','products.cat_id');
        $categories= Category::all();
         return view('product',compact(['categories','product']));

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
         $validator = Validator::make($request->all(), [
            'pro_name' => 'required',
            'pro_category' => 'required',
            'pro_img' => 'required|image|mimes:jpeg,png,jpg,gif',
            
        ]);
         if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
         }
        $image = $request->file('pro_img');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $pro = Products::create([
            'cat_id' => $request->pro_category,
            'pro_name' => $request->pro_name,
            'pro_image' => $new_name, 

        ]);
        $pro->save();
        // $success['token'] =  $cat->createToken('AjaxCRUD')->accessToken;
        return response()->json(['success'=>'Product Inserted'], 200); 
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
