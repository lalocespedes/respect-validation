<?php

namespace lalocespedes\Validators;

use Respect\Validation\Validator as V;

    /**
     * Validator for items vale herramienta
     * return exceptions errors array
     */
class Item
{

    /**
     * List of constraints
     *
     * @var array
     */
    protected $rules = [];

    /**
     * List of customized messages
     *
     * @var array
     */
    protected $messages = [];

    /**
     * List of returned errors in case of a failing assertion
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Construct
     * @ return avoid
     */
    function __construct()
    {
        $this->initRules();
        $this->initMessages();
    }

    /**
     * Set items constraints
     *
     * @return void
     */
    public function initRules()
    {
        $this->rules['empleado_id'] = V::numeric()->notEmpty()->setName('Empleado');
        $this->rules['item_price'] = V::numeric()->min(0)->notEmpty()->setName('Valor unitario');
    }

    /**
     * Set user custom error messages
     *
     * @return void
     */
    public function initMessages()
    {
        $this->messages = [
            'notEmpty'  => [
                'message' => '<strong>Error:</strong> {{name}}'
            ],
            'numeric'  => [
                'message' => '<strong>Error:</strong> {{name}}'
            ]
        ];
    }

    /**
     * Assert validation rules.
     *
     * @param array $inputs
     *   The inputs to validate.
     * @return boolean
     *   True on success; otherwise, false.
     */
    public function assert(array $inputs)
    {
        foreach ($this->rules as $rule => $validator) {

            try {

                $input = isset($inputs[$rule]) ? $inputs[$rule] : '';

                $validator->assert($input);

            } catch (\Respect\Validation\Exceptions\NestedValidationExceptionInterface $ex) {

                $this->errors = $ex->findMessages($this->messages);

                return false;
            }
        }

        return true;
    }

    /**
     * Return errors
     */
    public function errors()
    {
        return $this->errors;
    }

}
