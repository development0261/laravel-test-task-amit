<?php

namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','profile_image','father','mother','wife','child','address','country','city','state','zipcode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //Login validations
    public static function loginRules ($merge=[]) {
        return array_merge(
            [
                'email'     => 'required|string|email|max:100',
                'password'  => 'required|string|min:8',
            ], 
            $merge);
    }
    //Register validations
    public static function registerRules ($merge=[]) {
        return array_merge(
            [
                'name'      => 'required',
                'email'     => 'required|string|email|max:100|unique:users',
                'password'  => 'required|string|min:8|confirmed',
                'phone'     => 'required|numeric|min:10',
            ], 
            $merge);
    }
    //Update validations
    public static function updateRules ($id=0, $merge=[]) {
        return array_merge(
            [
                'name'      =>  'required',
                'email'     =>  'required|string|email|max:100|unique:users,email,' . $id,
                'phone'     =>  'required|numeric|min:10',
                'father'    =>  'sometimes|nullable|min:3',
                'mother'    =>  'sometimes|nullable|min:3',
                'wife'      =>  'sometimes|nullable|min:3',
                'child'     =>  'sometimes|nullable|min:3',
                'address'   =>  'required',
                'zipcode'   =>  'required|numeric|min:6',
            ], 
            $merge);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
