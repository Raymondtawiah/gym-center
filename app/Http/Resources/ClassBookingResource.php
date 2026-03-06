<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'gym_class_id' => $this->gym_class_id,
            'booking_date' => $this->booking_date->format('Y-m-d'),
            'status' => $this->status,
            'gym_id' => $this->gym_id,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'first_name' => $this->user->first_name,
                    'last_name' => $this->user->last_name,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone,
                ];
            }),
            'gym_class' => $this->whenLoaded('gymClass', function () {
                if (!$this->gymClass) {
                    return null;
                }
                return [
                    'id' => $this->gymClass->id,
                    'name' => $this->gymClass->name,
                    'description' => $this->gymClass->description,
                    'instructor' => $this->gymClass->instructor,
                    'day_of_week' => $this->gymClass->day_of_week,
                    'start_time' => $this->gymClass->start_time,
                    'end_time' => $this->gymClass->end_time,
                    'capacity' => $this->gymClass->capacity,
                    'room' => $this->gymClass->room,
                ];
            }),
            'gym' => $this->whenLoaded('gym', function () {
                if (!$this->gym) {
                    return null;
                }
                return [
                    'id' => $this->gym->id,
                    'name' => $this->gym->name,
                    'address' => $this->gym->address,
                ];
            }),
        ];
    }
}
