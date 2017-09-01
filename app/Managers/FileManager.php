<?php

namespace App\Managers;

trait FileManager 
{
	public function getS3Path($path)
	{
		return 'https://s3-' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $path . '/';
	}

	private function saveFile($file, $path)
    {
        $fileName = $file->getClientOriginalName();
        $file->storeAs($path, $fileName, 's3');
        return $this->getS3Path($path).$fileName;
    }
}
