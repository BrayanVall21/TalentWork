<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contract;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use App\Models\use_tal;

class ContractController extends Controller
{


    public function contractProcess(Request $request){
        $validationConfirm = $this->validationRegisterContract($request);
        if($validationConfirm->fails()){
            $errorRegisterFailed = "No se pudo ejecutar el contrato por las siguientes razones : "; 
            return back()->withErrors($validationConfirm,'contractProccessForm')->with('contractFailed',$errorRegisterFailed)->withInput();
        }     

        //1 : Para oficios
        //2 : Para talentos
        $message = $this->contractCreate($request);
        return back()->with('contractMessage',$message);

    }



    public function contractCreate(Request $request){
        $message='';
        switch($request->typeOfJob){
            case 1:
                $message = "Contratado el oficio correctamente";
                $contractNow = Contract::create([
                    'con_contract_date'=>$request->dateForm,
                    'con_hour'=>$request->hourForm,
                    'con_address'=>$request->addressForm,
                    'con_description'=>$request->descriptionForm,
                    'con_price'=>$request->priceOffer,
                    'con_initial'=>Carbon::now(),
                    'use_offer'=>$request->userOffer,
                    'use_receive'=>auth()->user()->id,
                    'use_occ_id'=>$request->serviceOffer,
                ]);
        
                break;
            case 2:
                $message = "Contratado el talento correctamente";
                $contractNow = Contract::create([
                    'con_contract_date'=>$request->dateForm,
                    'con_hour'=>$request->hourForm,
                    'con_address'=>$request->addressForm,
                    'con_description'=>$request->descriptionForm,
                    'con_price'=>$request->priceOffer,
                    'con_initial'=>Carbon::now(),
                    'use_offer'=>$request->userOffer,
                    'use_receive'=>auth()->user()->id,
                    'use_tal_id'=>$request->serviceOffer,
                ]);

                break;
            default:
                $message = "Error no se pudo crear el contrato";
                break;
        }
        return $message;
    }

    public function validationRegisterContract(Request $request){
        $fieldCreate= [
            'userOffer'=>'required|integer|min:0',
            'priceOffer'=>'required|numeric|between:0,9999.99',
            'dateForm'=>'required|date',
            'hourForm'=>'required',
            'addressForm'=>'required|string',
            'descriptionForm'=>'required|string',
            'serviceOffer'=>'required'
        ];
        $messageError=[
            'required' =>'Este campo ":attribute" es obligatorio',
            'integer'=>'":attribute" Debe ser numero entero',
            'between:0,9999.99'=>'":attribute" Fuera del rango',
            'numeric'=>'":attribute" Debe ser numerico',
            'min:0'=>'":attribute" Minimo es 0',
            'string'=>'":attribute" Debe ser texto'
        ];
        $validacion = Validator::make($request->all(),$fieldCreate,$messageError);
        return $validacion;

        
    }
}
