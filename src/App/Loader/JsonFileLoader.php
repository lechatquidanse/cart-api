<?php

/**
 * This file is part of the ShoppingCart package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Loader;

/**
 * Json File Loader
 *
 * JsonFileLoader loads translations from an json file.
 *
 * @package ShoppingCart
 * @author lechatquidanse
 */
class JsonFileLoader
{
    /**
     * Load Resource
     *
     * @param string $resource
     * @return array
     */
    public function loadResource($resource)
    {
        $products = json_decode(file_get_contents($resource), true);

        if (0 < $errorCode = json_last_error()) {
            throw new \Exception(sprintf('Error parsing JSON - %s', $this->getJSONErrorMessage($errorCode)));
        }

        return $products;
    }

    /**
     *
     * @param int $errorCode Error code returned by json_last_error() call
     *
     * @return string Message string
     */
    private function getJSONErrorMessage($errorCode)
    {
        switch ($errorCode) {
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded';
            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch';
            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found';
            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON';
            case JSON_ERROR_UTF8:
                return 'Malformed UTF-8 characters, possibly incorrectly encoded';
            default:
                return 'Unknown error';
        }
    }
}
