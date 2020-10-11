<?php
/**
 * global helpers
 *
 */

use App\Lib\MyHelper;

if (! function_exists('adminFeature')) {
	/**
	 * for check admin feature
	 * @param  string $url
	 * @param  array $data
	 * @return array
	 */
    function adminFeature($granted) {
        return MyHelper::hasAccess($granted,session('granted_features'));
    }
}

if (! function_exists('validateRequest')) {
	/**
	 * for validation all request
	 * @param  string $url
	 * @param  array $data
	 * @return array
	 */
    function validateRequest($request, $validation) {
        $validator = Validator::make($request, $validation);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->all());
        }
    }
}

if (! function_exists('encSlug')) {
	/**
	 * for encript id slug
	 * @param  string $url
	 * @param  array $data
	 * @return array
	 */
    function encSlug($data) {
        return MyHelper::encSlug($data);
    }
}

if (! function_exists('decSlug')) {
	/**
	 * for decript id slug
	 * @param  string $url
	 * @param  array $data
	 * @return array
	 */
    function decSlug($data) {
        return MyHelper::decSlug($data);
    }
}


