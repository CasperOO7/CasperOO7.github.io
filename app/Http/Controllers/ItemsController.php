<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemsController extends Controller
{
    public function index()
    {
        return view('Items.index',[
            'items'=>Items::latest()->filter(request(['tag','search']))->paginate(5)]);

    }
    public function show(Items $item)
    {
        return view('Items.show',['item'=>$item]);

    }
    public function create()
    {
        return view('Items.create');

    }

    public function store(Request $request)
    {
        $formfields=$request->validate([
            'title'=>'required',
            'company'=>['required',Rule::unique('items','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);
        $formfields['user_id']=auth()->id();

        if($request->hasFile('logo')){
            $formfields['logo']=$request->file('logo')->store('logos','public');
        }
        
        Items::create($formfields);

        return redirect('/')->with('message','Job created successfully');
    }

    public function edit(Items $item)
    {
        return view('Items.edit',['item'=> $item]);
        
    }


    public function update(Request $request,Items $item)
    {
        $formfields=$request->validate([
            'title'=>'required',
            'company'=>'required',
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasFile('logo')){
            $formfields['logo']=$request->file('logo')->store('logos','public');
        }
        $item->update($formfields);
        return back()->with('message','Job updated successfully');
    }

    public function destroy(Items $item)
    {
        $item->delete();
        return redirect('/')->with('message','Job deleted successfully');
    }
}
