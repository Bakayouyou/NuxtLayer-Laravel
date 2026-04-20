<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items'                       => ['required', 'array', 'min:1'],
            'items.*.product.id'          => ['required', 'string'],
            'items.*.product.name'        => ['required', 'string'],
            'items.*.product.description' => ['required', 'string'],
            'items.*.product.price'       => ['required', 'integer', 'min:1'],
            'items.*.product.category'    => ['required', 'string'],
            'items.*.product.image'       => ['required', 'url'],
            'items.*.product.stock'       => ['required', 'integer', 'min:0'],
            'items.*.quantity'            => ['required', 'integer', 'min:1'],
            'items.*.subtotal'            => ['required', 'integer', 'min:0'],
            'subtotal'                    => ['required', 'integer', 'min:0'],
            'tax'                         => ['required', 'integer', 'min:0'],
            'total'                       => ['required', 'integer', 'min:0'],
        ];
    }

    /**
     * Add business-logic validation on top of field rules.
     */
    public function withValidator(\Illuminate\Validation\Validator $validator): void
    {
        $validator->after(function (\Illuminate\Validation\Validator $v) {
            $data = $v->validated();

            if (!isset($data['items'], $data['subtotal'], $data['tax'], $data['total'])) {
                return;
            }

            $calculatedSubtotal = collect($data['items'])->sum('subtotal');

            if ($calculatedSubtotal !== $data['subtotal']) {
                $v->errors()->add('subtotal', 'Order subtotal does not match item totals.');
            }

            $expectedTax = (int) round($data['subtotal'] * 0.1);
            if (abs($data['tax'] - $expectedTax) > 1) {
                $v->errors()->add('tax', 'Order tax calculation is incorrect.');
            }

            if (abs($data['total'] - ($data['subtotal'] + $data['tax'])) > 1) {
                $v->errors()->add('total', 'Order total does not match subtotal + tax.');
            }
        });
    }
}

