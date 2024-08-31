<?php
// FileHelper.php

if (!function_exists('fileToUrl')) {
    function fileToUrl($filePath)
    {
        $pathWithoutPublic = str_replace('public/', '', $filePath);
        $baseUrl = url('/');
        $url = $baseUrl . '/storage/' . $pathWithoutPublic;
        
        return $url;
    }
}

if (!function_exists('fileExist')) {
    function fileExist($url)
    {
        $fileExists = false;
        try {
            $response = \Illuminate\Support\Facades\Http::get($url);
            $statusCode = $response->status();
            $fileExists = ($statusCode >= 200 && $statusCode < 400);
        } catch (\Exception $e) {
            // Handle exceptions if the URL is unreachable or throws an error
            $fileExists = false;
        }

        return $fileExists;
    }
}
