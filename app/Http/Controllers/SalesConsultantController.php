<?php

namespace App\Http\Controllers;

use App\Application\UseCases\SalesConsultant\CreateSalesConsultantUseCase;
use App\Application\UseCases\SalesConsultant\FindSalesConsultantByIdUseCase;
use App\Application\UseCases\SalesConsultant\FindSalesConsultantUseCase;
use App\Http\Resources\SalesConsultantResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class SalesConsultantController extends Controller
{
    
    protected $createSalesConsultantUseCase;
    protected $findSalesConsultantByIdUseCase;
    protected $findSalesConsultantUseCase;
    public function __construct(CreateSalesConsultantUseCase $createSalesConsultantUseCase, 
    FindSalesConsultantByIdUseCase $findSalesConsultantByIdUseCase,
    FindSalesConsultantUseCase $findSalesConsultantUseCase

    )
    {
        $this->createSalesConsultantUseCase = $createSalesConsultantUseCase;
        $this->findSalesConsultantByIdUseCase = $findSalesConsultantByIdUseCase;
        $this->findSalesConsultantUseCase = $findSalesConsultantUseCase;
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->findSalesConsultantUseCase->execute();
        return SalesConsultantResource::collection($result);
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
        $addres = $request->get('addres');
        $email = $request->get('email');
        $password = $request->get('password');
        $cod_departament = $request->get('cod_departament');
        $cod_province = $request->get('cod_province');
        $cod_district = $request->get('cod_district');
        $role = $request->get('role');
        $response = $this->createSalesConsultantUseCase->execute($document_type, $document_number, 
        $name, $phone, $email, $password, $addres, $cod_departament, $cod_province, $cod_district, $role);
        return $response;

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
}
