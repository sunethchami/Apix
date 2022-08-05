<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Car;

class CarController extends Controller
{
    function list($id=null) {
        $cars = $id?Car::find($id):Car::all();
        return $cars;
    }
    
    function store(Request $request) {
        
        $car = new Car;
        $car->model = $request->model;
        $car->type = $request->type;
        $car->owner = $request->owner;
        $car->price = $request->price;
        $result = $car->save();
        
        if($result){
            return ['Result' => 'The data has been added successfully'];
        }else{
            return ['Result' => 'Failed to save the data!'];
        }
        
    }
    
    function update(Request $request) {
        
        $car = Car::find($request->id);
        if($request->model){
            $car->model = $request->model;
        }
        $car->type = $request->type;
        $car->owner = $request->owner;
        $car->price = $request->price;
        $result = $car->save();
        
        if($result){
            return ['Result'=>'The data has been updated successfully'];
        }else{
            return ['Result' =>'Failed to update'];
        }
        
    }
    
    function search($model) {
        $result = Car::where("model","like","%".$model."%")->get();
        
        if(!$result->isEmpty()){
            return $result;
        }else{
            return ['Result' =>'No result found'];
        }
        
    }
    
    function delete($id){
       
        $car = Car::find($id);
        $result = $car->delete();
        
        if($result){
            return ['Result'=>'The data has been deleted successfully'];
        }else{
            return ['Result' =>'Failed to delete'];
        }
          
    }
    
    function testData(Request $request) {
        
        $rules = array(
           'model' => 'required'  
        );
        
        $validator = Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {            
            return response()->json($validator->errors(), 401);
        } else {
            $car = new Car;
            $car->model = $request->model;
            $car->type = $request->type;
            if(isset($request->owner)){
                $car->owner = $request->owner;
            }else{
                $car->owner = NULL;
            }
            if(isset($request->price)) {
                $car->price = $request->price;
            }else{
                $car->price = NULL;
            }
            $result = $car->save();
            if ($result) {
                return ['Result' => 'The data has been added successfully'];
            } else {
                return ['Result' => 'Failed to save the data!'];
            }
        }
    }
    
    function upload(Request $request){
        $result = $request->file('file')->store('apiDocs');
        return ['result'=>$result];
    }
    
    
    
}
