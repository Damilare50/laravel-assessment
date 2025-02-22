<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Tymon\JWTAuth\Contracts\JWTSubject;

    class Account extends Authenticatable implements JWTSubject
    {
        use HasFactory, Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'name',
            'email',
            'password',
        ];

        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
        ];

        /**
         * The attributes that should be cast.
         *
         * @var array<string, string>
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

        public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        public function getJWTCustomClaims(): array
        {
            return [];
        }

        public function products(): HasMany
        {
            return $this->hasMany(Product::class);
        }

        public function categories(): HasMany
        {
            return $this->hasMany(Category::class);
        }
    }
