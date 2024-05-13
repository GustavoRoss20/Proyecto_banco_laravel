<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function getDataUser(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $data = User::where('id', $userId)->first();

            return view('users.profile', compact('data'));
        }
    }

    public function updateData(Request $request)
    {
        $userId = Auth::id();
        $usuario = User::findOrFail($userId);

        // Actualiza los datos del usuario con la información del formulario
        $usuario->update($request->all());

        // Recargar la información del usuario autenticado
        // Obtener la instancia del usuario autenticado fresca y actualizar la sesión de Auth
        $usuarioActualizado = User::findOrFail($userId);
        Auth::setUser($usuarioActualizado);

        return redirect()->route('profile')->with('success', 'Perfil actualizado correctamente.');
    }

    public function registerUser(Request $request)
    {
        // Crear el usuario y guardar en la base de datos
        $user = new User($request->all());

        // Intentar guardar y verificar si la inserción fue exitosa
        if ($user->save()) {
            // La inserción fue exitosa
            return redirect()->back()->with('success', 'Usuario registrado con éxito.');
        } else {
            // La inserción falló
            return redirect()->back()->with('error', 'Hubo un problema al registrar al usuario.');
        }
    }

    public function showAll(Request $request)
    {
        $users = User::all(); // Obtener todos los usuarios
        return view('users.show_all', compact('users')); // Pasar los usuarios a la vista
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('showAllUsers')->with('success', 'Usuario eliminado con éxito.');
    }

    public function showAllDesc(Request $request)
    {
        $users = User::orderBy('saldo', 'asc')->get(); // Obtener todos los usuarios
        return view('queries.desc', compact('users')); // Pasar los usuarios a la vista
    }

    public function showAllAscd(Request $request)
    {
        $users = User::orderBy('saldo', 'desc')->get(); // Obtener todos los usuarios
        return view('queries.ascd', compact('users')); // Pasar los usuarios a la vista
    }

    public function showDataCharts(Request $request)
    {
        $users = User::orderBy('saldo', 'desc')->get(); // Obtener todos los usuarios
        return view('files.charts', compact('users')); // Pasar los usuarios a la vista
    }
}
