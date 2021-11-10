<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'date' => $this->date,
            'hour' => $this->hour,
            'agenda_id' => $this->agenda_id,
            'service_id' => $this->service_id,
            'vehicle_id' => $this->vehicle_id,
            'client_id' => $this->client_id,
            'state_id' => $this->state_id,
        ];
    }
}
