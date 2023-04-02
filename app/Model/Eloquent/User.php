<?php

namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Model\Eloquent
 * 
 * @property-read $id
 * @property-read $name
 * @property-read $password
 * @property-read $email
 */



class User extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
       'id',
       'name',
       'email',
       'password',
       'created_at',
       'image',
    ];


    public function getId()
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public static function getPasswordHash(string $password)
    {
        return sha1('olilrjgljdlgj' . $password);
    }

    public static function getById(int $id): ?self
    {
        return self::query()->find($id);

    }
        
    public static function getByEmail(string $email): ?self
    {
        return self::query()->where('email', '=', $email)->first();

    }

    public static function getList(int $limit = 20, int $offset = 0)
    {
        return self::query()->limit($limit)->offset($offset)->orderBy('id', 'DESC')->get();
    }

    
    public function isAdmin(): bool
    {
        return in_array($this->id, ADMIN_IDS);
    }

    public static function deleteUser(int $userId)
    {
        return self::destroy($userId);
    }

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->genFileName();
            move_uploaded_file($file, getcwd() . '/images/' . $this->image);
        }
        
    }

    private function genFileName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }

    public function getImage()
    {
        return $this->image;
    }
}


?>