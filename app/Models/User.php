<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["first_name", "last_name", "email", "password"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes["first_name"] .
                " " .
                $attributes["last_name"]
        );
    }

    public function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::needsRehash($value)
                ? Hash::make($value)
                : $value
        );
    }

    public function scopeOrderByName(Builder $query)
    {
        return $query->orderBy("last_name")->orderBy("first_name");
    }

    /**
     * @param Builder $query
     * @param array<string,string> $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters)
    {
        return $query
            ->when(
                $filters["search"] ?? null,
                fn(Builder $query, $search) => $query->where(
                    fn(Builder $query) => $query
                        ->where("first_name", "like", "%" . $search . "%")
                        ->orWhere("last_name", "like", "%" . $search . "%")
                        ->orWhere("email", "like", "%" . $search . "%")
                )
            )
            ->when($filters["trashed"] ?? null, function ($query, $trashed) {
                if ($trashed === "with") {
                    $query->withTrashed();
                } elseif ($trashed === "only") {
                    $query->onlyTrashed();
                }
            });
    }
}
