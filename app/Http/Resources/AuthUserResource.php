<?php

namespace App\Http\Resources;

use App\Http\Resources\Auth\AdminResource;
use App\Http\Resources\Auth\StudentResource;
use App\Http\Resources\Auth\TeacherResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $role = $this->getRoleNames()->first();

        return [
            'id' => $this->id,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'role' => $this->role,
            'profile' => match($role) {
                'student' => new StudentResource($this->whenLoaded('student')),
                'teacher' => new TeacherResource($this->whenLoaded('teacher')),
                'admin' => new AdminResource($this->whenLoaded('admin')),
            }
        ];
    }
}
