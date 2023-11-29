<?php

if (! function_exists('collection')) {
    function collection($data, $code = null, $message = null)
    {
        $code = $code ?? 200;
        $collection = new \stdClass();
        $collection->data = $data;
        $collection->message = $message ?? "";
        return response()->json($collection, $code);
    }
}

if (!function_exists("getArrayWithoutTimestamps")) {
    function getArrayWithoutTimestamps($array)
    {
        return array_flip(array_except(array_flip($array), ['created_at', 'updated_at']));
    }
}

if (!function_exists("truemod")) {
    function truemod($num, $mod)
    {
        return ($mod + ($num % $mod)) % $mod;
    }
}

if (! function_exists('upload')) {
    function upload($request, $name, $file, $folderName)
    {
        $dateTime = \Carbon\Carbon::now()->format('YmdHis');
        $fileName = "{$name}-{$dateTime}." . ($file->getClientOriginalExtension() ?? $file->extension());
        $created  = $file->storeAs($folderName, $fileName);
        if ($created) {
            $request->merge(["file-{$name}" => $fileName]);
        }
        return $created;
    }
}
