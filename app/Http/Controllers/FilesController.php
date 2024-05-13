<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FilesController extends Controller
{
    //Get data users
    public function GetDataUsers()
    {
        $users = User::select('id', 'nombre', 'apellido_paterno', 'apellido_materno', 'saldo')->get();
        return response()->json($users);
    }

    public function GetDataWithConditionals(Request $request)
    {
        //Conditionals
        $comparison = $request->input('comparacion');
        $value = $request->input('porcentaje');
        //Query
        return User::select('id', 'nombre', 'apellido_paterno', 'apellido_materno', 'saldo')
            ->where('saldo', $comparison, $value)
            ->get();
    }

    public function GenerateFileTxt(Request $request)
    {
        $data = $this->GetDataWithConditionals($request);
        $contentTxt = '';
        foreach ($data as $register) {
            $contentTxt .= "{$register->id},{$register->nombre} {$register->apellido_paterno} {$register->apellido_materno}, {$register->saldo}\n";
        }

        return Response::streamDownload(function () use ($contentTxt) {
            echo $contentTxt;
        }, 'fileTxt.txt');
    }

    public function GenerateFileCsv(Request $request)
    {
        $data = $this->GetDataWithConditionals($request);

        return Response::streamDownload(function () use ($data) {
            //Open file in memory to write file
            $file = fopen('php://output', 'w');

            //Headers 
            fputcsv($file, ['Id', 'Nombre', 'Apellido paterno', 'Apellido materno', 'Saldo']);

            //Data
            foreach ($data as $register) {
                fputcsv($file, [$register->id, $register->nombre, $register->apellido_paterno, $register->apellido_materno, $register->saldo]);
            }

            //Close file in memory
            fclose($file);
        }, 'FileCsv.csv');
    }

    public function GenerateFileXml(Request $request)
    {
        $data = $this->GetDataWithConditionals($request);

        return Response::streamDownload(function () use ($data) {

            $xml = new \DOMDocument();
            $xml->encoding = 'UTF-8';
            $xml->xmlVersion = '1.0';
            $xml->formatOutput = true;

            //node root
            $root = $xml->createElement('Registro');
            $xml->appendChild($root);

            //Add nodes with data
            foreach ($data as $register) {
                $node = $xml->createElement('Usuario');
                $node->appendChild($xml->createElement('Id', $register->id));
                $node->appendChild($xml->createElement('Nombre', $register->nombre));
                $node->appendChild($xml->createElement('ApellidoPaterno', $register->apellido_paterno));
                $node->appendChild($xml->createElement('ApellidoMaterno', $register->apellido_materno));
                $node->appendChild($xml->createElement('Saldo', $register->saldo));
                $root->appendChild($node);
            }

            //Print in xml file
            echo $xml->saveXML();
        }, 'FileXml.xml');
    }
}
