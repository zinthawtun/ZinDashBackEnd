<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;

use App\Http\Controllers\API\APIBaseController as BaseController;

use App\Note;

use Validator;


class NotesController extends BaseController

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $note = Note::all();


        return $this->sendResponse($note->toArray(), 'Notess retrieved successfully.');

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

            'body' => 'required'

        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());

        }


        $note = Note::create($input);


        return $this->sendResponse($note->toArray(), 'Notes created successfully.');

    }


    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $note = Note::find($id);


        if (is_null($note)) {

            return $this->sendError('Notes not found.');

        }


        return $this->sendResponse($note->toArray(), 'Notes retrieved successfully.');

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Note $note)

    {

        $input = $request->all();


        $validator = Validator::make($input, [

            'name' => 'required',

            'body' => 'required'

        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());

        }


        $note->name = $input['name'];

        $note->detail = $input['body'];

        $note->save();


        return $this->sendResponse($note->toArray(), 'Notes updated successfully.');

    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Note $note)

    {

        $note->delete();


        return $this->sendResponse($note->toArray(), 'Notes deleted successfully.');

    }

}
