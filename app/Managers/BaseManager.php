<?php

namespace App\Managers;

trait BaseManager
{
    /**
     * [getModel description]
     * @return [type] [description]
     */
    public function getModel()
    {
        return new self::$model;
    }

	/**
     * @param array $data
     * @return mixed
     */
	public function create(array $data){
        // $data = $data->except('_token');
		$obj = new self::$model;
		return $obj::create($data);
	}

	/**
     * save a model without massive assignment
     *
     * @param array $data
     * @return bool
     */
    public function saveModel(array $data)
    {
    	$obj = new self::$model;
        foreach ($data as $k => $v) {
            $obj->$k = $v;
        }
        return $obj->save();
    }

    /**
     * @param $id
     * @return mixed
     */
	public function delete($id){
		$obj = new self::$model;
		return $obj::destroy($id);
	}

	/**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
	public function update($request, $id, $attribute = 'id'){
		$obj = new self::$model;
	    return $obj::where($attribute, '=', $id)->update($request);
	}

	/**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
	public function paginate($page = 15, $columns = array('*'))
	{
		$obj = new self::$model;
		return $obj::paginate($page, $columns);
	}

	/**
     * @param array $columns
     * @return mixed
     */
	public function all()
	{
		$obj = new self::$model;
		return $obj::all();
	}

	/**
     * @param array $relations
     * @return $this
     */
    public function with(array $relations)
    {
    	$obj = new self::$model;
        return $obj::with($relations);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
	public function find($id, $columns = array('*')){
		$obj = new self::$model;

        if(is_array($id)){
            $query = $obj->newQuery();
            foreach ($id as $key => $value) {
                $query->where($key, '=', $value);
            }
            return $query->first($columns);
        }else{
            return $obj::find($id, $columns);
        }        
	}

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findMany(array $id, $columns = array('*'))
    {
        $obj = new self::$model;
        return $obj::findMany($id, $columns);//::whereIn('id', [1, 2, 3])->get();
    }

	/**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        $obj = new self::$model;
        return $obj::where($attribute, '=', $value)->first($columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($attribute, $value, $columns = array('*'))
    {
        $obj = new self::$model;
        return $obj::where($attribute, '=', $value)->get($columns);
    }

    /**
     * [maxId description]
     * @return mixed
     */
    public function maxId()
    {
        $obj = new self::$model;
        return $obj::max($obj->getKeyName());
    }

    /**
     * [destroy description]
     * @return mixed
     */
    public function destroy($id='')
    {
        $obj = new self::$model;

        if (is_array($id)) 
        {
            return $obj::destroy($id);
        }
        else
        {
            return $obj::findOrFail($id)->delete();
        }
    }
}
