<?php
namespace App\Resources\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Defining generic scope to be reused in models to assist in queries
 *
 * @author Flávio Caetano <flavoluzio22@gmail.com>
 */
trait PrepareTrait
{
    /**
     * This method is the core of this trait. It will call the other methods dynamically
     *
     * @param Request $request
     * @param object $object optional parameter, usually a model instance
     * @return void
     */
    public function prepare(Request $request, $object = null)
    {
        /**
         * The creation of this array is to allow a dynamic quantity of parameters.
         * * Just prepare the array accordingly your necessity
         * * Use the prepareUserDestroy() method as an example of use
         */
        $params = [
            'request' => $request,
            'object' => $object,
        ];

        $method = isset($object->nomeMetodo) ? "prepare".Str::ucfirst($object->nomeMetodo) : "prepare".Str::ucfirst(debug_backtrace()[1]['function']);
        return $this->$method($params);
    }
}
