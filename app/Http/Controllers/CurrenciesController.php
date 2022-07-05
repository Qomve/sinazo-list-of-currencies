<?php

namespace App\Http\Controllers;


use App\ListOfCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CurrenciesController extends Controller
{
    //CURRENCY INDEX
    public function currencyIndex(){
        $currency = ListOfCurrency::all();
        return view('currencies.list-of-currency-index',compact('currency'));
    }

    //STORE CURRENCY
    public function storeCurrencyInformation(Request $request)
    {
        $request->validate([
            'code' => 'required|max:3|string|unique:list_of_currencies',
            'name' => 'required|string|unique:list_of_currencies'
        ]);
        try {
            $input = $request->all();
            DB::beginTransaction();
            $createCurrency = ListOfCurrency::create(['code' => $input['code'], 'name' => $input['name']]);

            DB::commit();
            return redirect()
                ->to('/')
                ->withInput()
                ->with('success_message', 'Currency created successfully.');


        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    //EDIT CURRENCY
    PUBLIC FUNCTION editListOfCurrency(ListOfCurrency $listOfCurrency){
        return view('currencies.edit-list-of-currency',compact('listOfCurrency'));
    }

    //UPDATE CURRENCY
    public function updateCurrencyInformation(Request $request, ListOfCurrency $listOfCurrency)
    {
        $request->validate([
            'code' => 'required|max:3|string',
            'name' => 'required|string'
        ]);
        DB::beginTransaction();

        try {
            $input = $request->all();
            $listOfCurrency->update(['code' => $input['code'], 'name' => $input['name']]);
            $listOfCurrency->save();
            DB::commit();


            return redirect()
                ->to('/')
                ->withInput()
                ->with('success_message', 'Currency Update successfully.');


        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Currency could not be saved ' . $e->getMessage()], 400);
        }
    }

    //DELETE CURRENCY
    public function deleteCurrency($id)
    {
        DB::beginTransaction();
        $currency = ListOfCurrency::find($id);

        try {

            if (isset($currency)) {
                $currency->forceDelete();
            }
            DB::commit();
            return response()->json(['message' => 'Currency deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Currency can not be deleted ' . $e->getMessage()], 500);
        }
    }

}
