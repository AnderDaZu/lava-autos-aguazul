<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'plate' => $this->plate,
            'color' => $this->color->name,
            'model' => $this->modelcar->name,
            'mark' => $this->modelcar->mark->name,
            'client' => $this->client->name." ".$this->client->last_name,
            'client_id' => $this->client_id
        ]; 
    }
}
