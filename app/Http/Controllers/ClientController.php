<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataPersonalResource;
use App\Http\Traits\SearchApiTrait;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use SearchApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function searchDocumentDni(string $numberDocument) {
        $response =  $this->searchDocument($numberDocument);
         // Verifica si la propiedad 'data' está presente en los datos de la solicitud
        if (isset($response['data'])) {
            // Si 'data' está presente, pasa los datos al recurso
            $data = $response['data'];
            return [
                'nombre_completo' => $data["nombre_completo"],
                'direccion' => $data["direccion"],
                'success'=> true,
                'numero'=> $data["numero"]
            ];
        } else {
            return response()->json(['error' => 'No existe informaciòn para el dni: '.$numberDocument], 400);
        }
    }
}
