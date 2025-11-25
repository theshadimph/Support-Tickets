<?php

namespace App\Models;

// Make sure you import HasApiTokens if you use Sanctum/Passport
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role', // IMPORTANT: Make sure 'role' is fillable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================================================
    // ROLE CHECKING METHODS (THE FIX)
    // =========================================================

    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }

    public function isClient(): bool
    {
        // A client is anyone who is not explicitly a manager or employee
        return $this->role === 'client';
    }

    // =========================================================
    // RELATIONSHIPS
    // =========================================================

    /**
     * Get the tickets created by this User (if they are a Client).
     */
    public function createdTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'client_id');
    }

    /**
     * Get the tickets this User is assigned to (if they are an Employee/Manager).
     * The pivot table is ticket_employee.
     */
    public function assignedTickets(): BelongsToMany
    {
        // Pivot table 'ticket_employee', foreign key 'employee_id'
        return $this->belongsToMany(Ticket::class, 'ticket_employee', 'employee_id', 'ticket_listing_id');
    }

    /**
     * Get the comments made by this User (if they are an Employee/Manager).
     */
    public function comments(): HasMany
    {
        return $this->hasMany(TicketComment::class, 'user_id');
    }
}
