<?php

namespace App\Http\Controllers;

use App\Http\Requests\Form\SendFormRequest;
use App\Services\Form\SendFormService;
use App\Models\Form;
use Illuminate\Http\Request;

/**
 * class FormController
 *
 * @property SendFormService $sendFormService
 */
class FormController extends Controller
{
    protected $sendFormService;

    public function __construct(SendFormService $sendFormService)
    {
        $this->sendFormService = $sendFormService;
    }

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
     * @param  \App\Http\Requests\Form\SendFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SendFormRequest $request)
    {
        $processData = [
            ['sign_user_id' => auth()->user()->id]
        ];
        $data = $request->validated();
        $form = $this->sendFormService->sendForm(
            $data['form_name'],
            $data['form_template_id'],
            $processData
        );
        $id = $form ? $form->id : null;

        return response()->json([
            'success' => (bool) $id,
            'id' => $id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }
}
