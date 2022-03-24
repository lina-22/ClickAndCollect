<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $categories =[];    
        foreach($this->categories as $category){
            $data = [
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->image
            ];
            array_push($categories, $data);
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'totalPrice' => round($this->price-$this->price* $this->discount/100, 2),
            'description' => $this->description,
            'image' => $this->image,
            'categories' => $categories
        ];
    }
}