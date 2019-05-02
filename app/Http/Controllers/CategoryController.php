<?php

namespace App\Http\Controllers;
use Validator;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {

            $category=Category::all();
        
            return [
                'data'=>$category
            ];
        }

        return view('category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getAllCategory()
    // {
    //     $category = Category::all();
    //     return response()->json(['category' => $category],200);
        
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'cat_name' => 'required',
            
        ]);
         if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
         }

        $cat = Category::create($request->all());
        $cat->save();
        // $success['token'] =  $cat->createToken('AjaxCRUD')->accessToken;
        return response()->json(['success'=>'Category Inserted'], 200); 


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Category::find($id);
         return response()->json([
            'error' => false,
            'cat'  => $cat,
        ], 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**w
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cat_name' => 'required',
            
        ]);
         if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
         }

         $cat = Category::find($id);
         $cat->cat_name = $request->cat_name;
         $cat->save();

        return response()->json([
            'error' => false,
            'cat'  => $cat,
        ], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::destroy($id);
        return response()->json([
            'error' => false,
            'cat'  => $cat,
        ], 200);
    }
}
