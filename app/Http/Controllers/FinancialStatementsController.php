<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancialStatementsController extends Controller
{
    public function getSaldoData()
    {
        if (Auth::check()) {
            $id = Auth::id();

            $egresos = DB::select('CALL sp_select_egresos(?)', [$id]);
            $egresosCollection = collect($egresos);
            $totalEgresos = $egresosCollection->sum('monto');


            $ingresos = DB::select('CALL sp_select_ingresos(?)', [$id]);
            $ingresosCollection = collect($ingresos);
            $totalIngresos = $ingresosCollection->sum('monto');

            return view('financial_statements.balance')
                ->with('egresos', $egresos)
                ->with('totalEgresos', $totalEgresos)
                ->with('ingresos', $ingresos)
                ->with('totalIngresos', $totalIngresos);
        }
    }

    public function getInfoLoans()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $data = Loans::select('id', 'cliente_id', 'referencia', 'total_prestado', 'total_pagar', 'cantidad_actual', 'liquidado')->where('cliente_id', '=', $id)->get();
            return view('financial_statements.loans', compact('data'));
        }
    }

    public function InsertLoans(Request $request)
    {
        if (Auth::check()) {
            $id = Auth::id();
            $references = $request->input('referencia');
            $monto = $request->input('monto');
            $montoFinal = $request->input('montoTotal');

            $data = User::select('id', 'saldo')->where('id', '=', $id)->first();

            $saldoUserFinal = $data->saldo + $monto;

            try {

                DB::statement('CALL sp_insert_prestamo(?,?,?,?,?)', [$id, $references, $monto, $montoFinal, $saldoUserFinal]);

                return redirect()->back()->with('success', 'Prestamo realizado con exito.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Hubo un error en el prestamo.');
            }
        }
    }

    public function payLoan(Request $request)
    {
        if (Auth::check()) {
            $idUser = Auth::id();
            $idLoan = $request->input('idLoan');
            $monto = $request->input('monto');

            $dataUser = User::select('id', 'saldo')->where('id', '=', $idUser)->first();
            $dataLoan = Loans::select('id', 'cliente_id', 'total_prestado', 'total_pagar', 'cantidad_actual', 'liquidado')->where('id', '=', $idLoan)->first();

            if ($monto > $dataUser->saldo) {
                return redirect()->back()->with('error', 'No cuentas con el saldo suficiente.');
            }

            if ($monto > $dataLoan->total_pagar) {
                return redirect()->back()->with('error', 'Excedes el pago.');
            }

            $abono = $dataLoan->cantidad_actual + $monto;

            if ($abono >= $dataLoan->total_pagar) {
                $liquidado = 1;
            } else {
                $liquidado = 0;
            }

            $newSaldo = $dataUser->saldo - $monto;
            
            try {
                DB::statement('CALL sp_depositar_prestamo(?,?,?,?,?,?)', [$idUser, $idLoan, $monto, $abono, $liquidado, $newSaldo]);
                return redirect()->back()->with('success', 'Pago realizado con exito.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Ocurrio un error al realizar el pago.');
            }
        }
    }
}
