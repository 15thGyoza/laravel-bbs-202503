<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreReplyRequest
 * This request class handles the validation for storing a reply.
 *
 * @package App\Http\Requests
 * @property string $content The content of the reply.
 * @property int $topic_id The ID of the topic to which the reply belongs.
 */
class StoreReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|min:2'
        ];
    }
}
