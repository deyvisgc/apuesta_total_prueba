<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Client\CreateClientUseCase;
use App\Application\UseCases\Client\FindClientByIdUseCase;
use App\Application\UseCases\Client\FindClientUseCase;
use App\Http\Resources\ClientResource;
use App\Http\Traits\SearchApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class ClientController extends Controller
{
    use SearchApiTrait;

    protected $createClientUseCase;
    protected $findClientUseCase;
    protected $findClientByIdUseCase;
    public function __construct(CreateClientUseCase $createClientUseCase, FindClientUseCase $findClientUseCase,
     FindClientByIdUseCase $findClientByIdUseCase

    )
    {
        $this->createClientUseCase = $createClientUseCase;
        $this->findClientUseCase = $findClientUseCase;
        $this->findClientByIdUseCase = $findClientByIdUseCase;
        $this->middleware('auth:api', ['except' => ['store', 'searchDocumentDni']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->findClientUseCase->execute();
        return ClientResource::collection($result);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'document_type' => 'required|string|max:10',
            'document_number' => 'required|string|max:15',
            'name' => 'required|string',
            'phone' => 'required|integer|digits:9',
            'balance' => 'required|numeric|gt:0',
            'addres' => 'required|string|max:200',
            'email' => 'required|email',
            'password' => 'required|string',
            'cod_departament' => 'required|string',
            'cod_province' => 'required|string',
            'cod_district' => 'required|string',
            'role' => 'required|integer',
        ];

        // Realizar la validación
        $validator = validator()->make($request->all(), $rules);

        // Si la validación falla, devolver las reglas de validación al cliente
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        LOG::info("ENTRO AQUI");
        $document_type = $request->get('document_type');
        $document_number = $request->get('document_number');
        $name = $request->get('name');
        $phone = $request->get('phone');
        $balance = $request->get('balance');
        $addres = $request->get('addres');
        $email = $request->get('email');
        $password = $request->get('password');
        $cod_departament = $request->get('cod_departament');
        $cod_province = $request->get('cod_province');
        $cod_district = $request->get('cod_district');
        $role = $request->get('role');
        $response = $this->createClientUseCase->execute($document_type, $document_number, $name, $phone,
        $balance, $email, $password, $addres, $cod_departament, $cod_province, $cod_district, $role);
        return $response;
    }
    public function show($id)
    {
        $result = $this->findClientByIdUseCase->execute($id);
        return new ClientResource($result);
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
        $rules = [
            'document_type' => 'required|string|max:10',
            'document_number' => 'required|string|max:15',
            'name' => 'required|string',
            'phone' => 'required|integer|digits:9',
            'balance' => 'required|numeric|gt:0',
            'addres' => 'required|string|max:200',
            'cod_departament' => 'required|string',
            'cod_province' => 'required|string',
            'cod_district' => 'required|string',
            'role' => 'required|integer',
        ];

        // Realizar la validación
        $validator = validator()->make($request->all(), $rules);

        // Si la validación falla, devolver las reglas de validación al cliente
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // try {
        //     LOG::info("ENTRO AQUI");

        //     $document_type = $request->get('document_type');
        //     $document_number = $request->get('document_number');
        //     $name = $request->get('name');
        //     $phone = $request->get('phone');
        //     $balance = $request->get('balance');
        //     $addres = $request->get('addres');
        //     $cod_departament = $request->get('cod_departament');
        //     $cod_province = $request->get('cod_province');
        //     $cod_district = $request->get('cod_district');
        //     $role = $request->get('role');
        //    $response = $this->createClientUseCase->execute($document_type, $document_number, $name, $phone,
        //      $balance, $email, $password, $addres, $cod_departament, $cod_province, $cod_district, $role);

        //     return $response;
        // } catch (QueryException $e) {
        //     return $e;
        //     return response()->json(['error' => 'Error en la base de datos: ' . $e->getMessage()], 500);
        // } catch (\Exception $e) {
        //     // Manejo de otras excepciones
        //     return response()->json(['error' => 'Error interno del servidor: ' . $e->getMessage()], 500);
        // }
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
