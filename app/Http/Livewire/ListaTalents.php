<?php

namespace App\Http\Livewire;
use App\Models\Mensajechat;
use App\Models\User;
use Livewire\Component;

class ListaTalents extends Component
{
    public $vendedor;
    public $para = "";
    public $mensajes;
    public $respuesta;
    public $id_servicio;
    public $rCliente;
    public $habilitarInput = false;

    // protected $rules = [
    //     'respuesta' => 'required|min:1'
    // ];


    public function responderM($usuario, $id_servicio){
        $this->habilitarInput = true;
        $this->id_servicio = $id_servicio;
        $this->para = $usuario;
        $this->vendedor = Auth::user()->id;
        $this->mensajes = Mensajechat::where("vendedor","=",$this->vendedor)
                            ->where("cliente","=",$this->para)
                            ->get();
        $this->rCliente = Mensajechat::where("cliente","=",$this->para)
                            ->first();;

    }

    public function enviarRespuesta(){

        $nuevo = new Mensajechat;
        $nuevo->cliente = $this->para;
        $nuevo->vendedor = $this->vendedor;
        $nuevo->mensaje = $this->respuesta;
        $nuevo->envia = Auth::user()->id;
        $nuevo->id_servicio = $this->id_servicio;
        $nuevo->save();

        $this->reset('respuesta');

        $this->mensajes = Mensajechat::where("vendedor","=",$this->vendedor)
        ->where("cliente","=",$this->para)
        ->get();

    }

    public function render()
    {
        $this->vendedor = auth()->user()->id;

        return view('livewire.lista-talents',[
            "datos" => Mensajechat::where("vendedor","=",$this->vendedor)
                ->where("envia","<>",$this->vendedor)
                ->get()
        ]);
    }
}