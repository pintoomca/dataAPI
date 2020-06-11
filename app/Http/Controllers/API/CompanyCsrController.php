<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\CompanyCsr;
use Validator;


class CompanyCsrController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $companycsrs = CompanyCsr::all();
        

        return $this->sendResponse($companycsrs->toArray(), 'Company Csr retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $companycsr = CompanyCsr::create($input);


        return $this->sendResponse($companycsr->toArray(), 'Company Csr created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companycsr = CompanyCsr::find($id);


        if (is_null($companycsr)) {
            return $this->sendError('Company Csr not found.');
        }


        return $this->sendResponse($companycsr->toArray(), 'Company Csr retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyCsr $companycsr)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $companycsr->name = $input['name'];
        $companycsr->detail = $input['detail'];
        $companycsr->save();


        return $this->sendResponse($companycsr->toArray(), 'Company Csr updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyCsr $companycsr)
    {
        $companycsr->delete();


        return $this->sendResponse($companycsr->toArray(), 'Company Csr deleted successfully.');
    }
}