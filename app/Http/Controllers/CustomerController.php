<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Region;
use App\Models\Commune;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dni' => 'required|string|max:255|unique:customers',
            'email' => 'required|string|email|max:255|unique:customers',
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'commune_id' => 'required|exists:communes,id',
        ]);

        if (!Commune::where('id_com', $request->commune_id)->where('region_id', $request->region_id)->exists()) {

            return response()->json(['success' => false, 'message' => 'La commune no pertenece a la región especificada.'], 400);

        }

        try {

            $customer = Customer::create($validatedData);
            return response()->json(['success' => true, 'customer' => $customer], 201);

        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'No se pudo crear el customer'], 500);

        }
    }

    public function show(Request $request)
    {
        $validatedData = $request->validate([
            'dni' => 'sometimes|required_without:email|string',
            'email' => 'sometimes|required_without:dni|string|email',
        ]);

        $customer = Customer::where('dni', $validatedData['dni'] ?? null)
            ->orWhere('email', $validatedData['email'] ?? null)
            ->where('status', 'A')
            ->first();

        if ($customer) {
            $region = $customer->region;
            $commune = $customer->commune;

            $customerData = [
                'name' => $customer->name,
                'last_name' => $customer->last_name,
                'address' => $customer->address,
                'region' => $region->name,
                'commune' => $commune->name,
            ];

            return response()->json(['success' => true, 'customer' => $customerData], 200);

        } else {

            return response()->json(['success' => false, 'message' => 'Customer no encontrado'], 404);

        }
    }
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if ($customer && ($customer->status == 'A' || $customer->status == 'I')) {

            $customer->status = 'trash';
            $customer->save();
            return response()->json(['success' => true], 200);

        } elseif ($customer && $customer->status == 'trash') {

            return response()->json(['success' => false, 'message' => 'Registro no existe'], 404);

        } else {

            return response()->json(['success' => false, 'message' => 'Customer no encontrado'], 404);

        }
    }
}
