<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class maxFile implements Rule
{

    protected $maxFiles;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($maxFiles)
    {
        $this->maxFiles = $maxFiles;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_array($value) && !($value instanceof \Countable)) {
            return false;
        }

        $fileCount = count($value);
        return $fileCount <= $this->maxFiles;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute may not have more than {$this->maxFiles} files.";

    }
}
