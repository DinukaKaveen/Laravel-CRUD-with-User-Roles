<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function create_customer(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                "name"=> "required|string",
                "phone"=> "required|string",
                "address"=> "required|string",
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $customer = Customer::create([
                'name' => $request->name,
                'phone'=> $request->phone,
                'address'=> $request->address,
            ]);
            return response()->json([
                'success' => true,
                'customer' => $customer,
                'message' => "Customer created successfully",
            ], 500);
            
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => "Something went wrong",
            ], 500);
        }

    }

    public function update_customer(Request $request, $id) {
        try {

            $validator = Validator::make($request->all(), [
                "name"=> "required|string",
                "phone"=> "required|string",
                "address"=> "required|string",
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $customer = Customer::find($id);
            if($customer)
            {
                $customer->update([
                    'name' => $request->name,
                    'phone'=> $request->phone,
                    'address'=> $request->address,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Customer updated successfully'
                ], 200);
            }
            else
            {
                return response()-> json([
                    'success' => false,
                    'message' => 'Customer not found'
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

    public function delete_customer(Request $request, $id) {
        try {
            $customer = Customer::find($id);
            if($customer)
            {
                $customer->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Customer deleted successfully'
                ], 200);
            }
            else
            {
                return response()-> json([
                    'success' => false,
                    'message' => 'Customer not found'
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
