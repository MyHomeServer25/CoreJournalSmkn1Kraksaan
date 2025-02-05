<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JournalResource extends JsonResource
{
    // public $status;
    // public $message;
    // public $resource;

     /**
     * __construct
     *
     * @param  mixed $status
     * @param  mixed $message
     * @param  mixed $resource
     * @return void
     */
    // public function __construct($status, $message, $resource)
    // {
    //     parent::__construct($resource);
    //     $this->status  = $status;
    //     $this->message = $message;
    // }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'name_student' => $this->User->name, 
                'name_teachers' => $this->Teacher->name, 
                'date' => $this->date,
                'name' => $this->name,
                'description' => $this->description,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
