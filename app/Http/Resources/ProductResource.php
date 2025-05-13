<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $goodDiscount = false;
        $priceStatus = '';

        if ($this->stock >= 20) {
            $goodDiscount = true;
        }
        if ($this->price >= 100000) {
            $priceStatus = 'expensive';
        } else {
            $priceStatus = 'cheap';
        }

        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "discount" => $this->stock,
            'goodDiscount' => $goodDiscount,
            'priceStatus' => $priceStatus,
            'image_url' => $this->imageUrl,
            "created_at" => $this->created_at,
        ];
    }
}
