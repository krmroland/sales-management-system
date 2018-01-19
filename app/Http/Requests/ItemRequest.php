<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->has("isEditingPrices")) {
            $mSP=$this->minimumSellingPrice();
            return [

             "buyingPrice"=>"required|numeric|min:0",
             "sellingPrice"=>["required","numeric","min:$mSP"],
             "quantity"=>"required|numeric"
            ];
            
        }


        return [

        "name"=>$this->makeNameRule(),
        "category"=>"required",
       
        "unitName"=>"required|string",
        "bundleName"=>"nullable|string|max:100",
        "unitsPerBundle"=>"nullable|numeric",
        ];
    }
    /**
     * computes what the minimum selling price can be
     *
     * @return     integer  
     */
    protected function minimumSellingPrice()
    {
        return ($this->buyingPrice+1);
    }
    /**
     * customized validation messages
     *
     * @return     array  
     */
    public function messages()
    {
        return[
            "sellingPrice.min"=>"The selling price must be greater than buying price"

        ];
    }

    public function makeNameRule()
    {
        if ($this->method()=="POST") {
            return "required|unique:items|max:100|string";
        }

        if ($this->method()=="PUT") {

            return["required","max:100","string",
                Rule::unique("items")->ignore($this->route("item")->name,"name")
            ];
        }
        
    }
    
}
