<?php

namespace App;

use App\Enumerate\UserType;
use App\Exceptions\NoUsernameAndPasswordSet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * @property int id
 * @property User user
 * @property Section section
 * @property string name
 * @property bool is_head
 * @property bool is_admin
 */
class Staff extends Model
{

    #region internal attributes

    public $username;
    public $password;

    #endregion

    #region settings

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'section_id', 'position', 'is_admin', 'is_head'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    #endregion

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function section() {
        return $this->belongsTo('App\Section');
    }

    public function fill(array $attributes)
    {
        // Extract username and password
        if(array_has($attributes, 'username')) $this->username = array_pull($attributes, 'username');
        if(array_has($attributes, 'password')) $this->password = array_pull($attributes, 'password');

        // Check section, if not match update the association model
        if(array_has($attributes, 'section_id')) {
            if(!isset($this->section) || $attributes['section_id'] != $this->section->id) {
                $this->section()->associate(Section::find($attributes['section_id']));
            }

            // Remove section_id, not used in table
            $attributes = array_except($attributes, ['section_id']);
        }

        // Convert variable & checks
        foreach(['is_head', 'is_admin'] as $key)
        if(array_has($attributes, $key)) {
            $attributes[$key] = !!$attributes[$key];
        } else {
            $attributes[$key] = false;
        }

        return parent::fill($attributes);
    }

    public function save(array $options = []) {
        // If not exists in database, create and associate to User
        if(!$this->exists) {
            if(!isset($this->username) || !isset($this->password)) {
                throw new NoUsernameAndPasswordSet();
            }

            // Create a user or get if exists
            $this->user()->associate(User::create(
                [
                    'username' => $this->username,
                    'password' => Hash::make($this->password),
                    'type' => UserType::STAFF
                ]
            ));
        }

        // Unset these attributes to prevent the update into table (not used in table)
        unset($this->username);
        unset($this->password);

        return parent::save($options);
    }

}
