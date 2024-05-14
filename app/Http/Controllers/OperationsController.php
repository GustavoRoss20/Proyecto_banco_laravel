<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OperationsController extends Controller
{
    public function GetUsersWithIds()
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $data = User::select('id', 'nombre')->where('id', '!=', $userId)->get();
            return view('operations.transfers', compact('data'));
        }
    }

    public function GetCatServices()
    {
        $data = Services::select('id', 'nombre', 'precio')->get();
        return view('operations.service_payment', compact('data'));
    }

    public function Transfers(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $userId2 = $request->input('usuario');
            $saldo = $request->input('monto');

            if ($saldo < 0) {
                return redirect()->back()->with('error', 'El monto no puede ser negativo.');
            }

            $data1 = User::select('id', 'saldo')->where('id', '=', $userId)->first();
            $data2 = User::select('id', 'saldo')->where('id', '=', $userId2)->first();

            if ($saldo > $data1->saldo) {
                return redirect()->back()->with('error', 'No cuentas con el saldo suficiente.');
            }

            $saldoNuevo1 = $data1->saldo - $saldo;
            $saldoNuevo2 = $data2->saldo + $saldo;

            try {

                DB::statement('call sp_insert_transaccion(?,?,?,?,?)', [$userId, $userId2, $saldoNuevo1, $saldoNuevo2, $saldo]);

                return redirect()->back()->with('success', 'Transferencia realizada con exito.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Hubo un error en la transaccion.');
            }
        }
    }

    public function PayServices(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $precio = $request->input('servicio');

            $data = User::select('id', 'saldo')->where('id', '=', $userId)->first();

            if ($data->saldo < $precio) {
                return redirect()->back()->with('error', 'No cuentas con el saldo suficiente.');
            }

            $saldoNuevo = $data->saldo - $precio;

            try {

                DB::statement('call sp_pagar_servicios(?,?,?)', [$userId, $saldoNuevo, $precio]);

                return redirect()->back()->with('success', 'Pago realizado con exito.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Hubo un error en el pago.');
            }
        }
    }
}
