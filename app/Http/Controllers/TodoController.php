<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Todo;

use App\Managers\ManagerFactory as Manager;

class TodoController extends Controller
{
    // public function __invoke()
    // {
    //     return Todo::all();
    // }
    
    private $todoMananger;

	public function __construct()
    {
        $this->todoMananger = Manager::createManger(Manager::TodoManager);
    } 

    protected function validator(array $data, $rules)
    {

    	// $messages = array(
	    //     'required' => 'The :attribute is really really really important.',
	    //     'same'  => 'The :others must match.'
	    // );
	    
	    $rules = $rules ? $rules : [
	    	'user_id' => 'required',
	        'task'    => 'required',
	        'done'    => 'required',
	    ];

        return \Validator::make($data, $rules);
    }

    public function index()
	{
		return $this->listResponse($this->todoMananger->all());
	}

	public function store(Request $request)
	{
		return $this->create($request);
	}

    public function create(Request $request)
	{
	    $validator = $this->validator($request->all(), null);
		
		if ($validator->fails()) {
			return $this->clientErrorResponse($validator->messages());
		}

		try{
			$player = $this->todoMananger->create($request->all());
			return $this->createdResponse($player);
		} catch(\Exception $e){
			return $this->clientErrorResponse($e->getMessage());
		}
	}

	public function show(Request $request, $id)
	{
		return 'implement';
	}

	public function edit(Request $request, $id)
	{
		return 'implement';
	}

	public function update(Request $request, $id)
	{
		try{
			$this->todoMananger->update($request->all(), $id, 'id');
			return $this->createdResponse($request->all());
		}catch(\Exception $e){
			return $this->clientErrorResponse($e->getMessage());
		}
	}

	public function destroy($id)
	{
		try{
			$this->todoMananger->delete($id);
			return $this->deletedResponse();
		}catch(\Exception $e){
			return $this->clientErrorResponse($e->getMessage());
		}
		
	}
}
