<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $products = [];
        foreach ($this->products as $product) {
            $data = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'discount' => $product->discount,
                'totalPrice' => round($product->price - $product->price * $product->discount / 100, 2),
            ];
            array_push($products, $data);
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'products' => $products
        ];
    }
}
