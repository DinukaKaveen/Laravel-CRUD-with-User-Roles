<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    public function create_medicine(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                "name"=> "required|string",
                "price"=> "required|string",
                "quantity"=> "required|integer",
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $item = Medicine::create([
                'name' => $request->name,
                'price'=> $request->price,
                'quantity'=> $request->quantity,
            ]);
            return response()->json([
                'success' => true,
                'item' => $item,
                'message' => "Item created successfully",
            ], 500);
            
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => "Something went wrong",
            ], 500);
        }
        
    }

    public function update_medicine(Request $request, $id) {
        try {
            
            $validator = Validator::make($request->all(), [
                "name"=> "required|string",
                "price"=> "required|string",
                "quantity"=> "required|integer",
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $medicine = Medicine::find($id);
            if($medicine)
            {
                $medicine->update([
                    'name' => $request->name,
                    'price'=> $request->price,
                    'quantity'=> $request->quantity,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Item updated successfully'
                ], 200);
            }
            else
            {
                return response()-> json([
                    'success' => false,
                    'message' => 'Item not found'
                ], 404);
            }
        }
        catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => "Something went wrong",
            ], 500);
        }
    }

    public function delete_medicine(Request $request, $id) {
        try {
            $medicine = Medicine::find($id);
            if($medicine)
            {
                $medicine->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Item deleted successfully'
                ], 200);
            }
            else
            {
                return response()-> json([
                    'success' => false,
                    'message' => 'Item not found'
                ], 404);
            }
        }
        catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => "Something went wrong",
            ], 500);
        }
    }
}
