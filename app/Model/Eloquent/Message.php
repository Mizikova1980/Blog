<?php
namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App\Model\Eloquent
 * 
 * @property-read $id
 * @property-read $text
 * @property-read $email
 * @property-read User $author

 */

class Message extends Model
{
    protected $table = 'messages';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'text',
        'author_id',
        'created_at',
        'image',
    ];
    
    public function author()
    {
        return $this->belongsTo(User::class);
    }  
    
    
    public static function deleteMessage(int $messageId)
    {
        return self::destroy($messageId);
    }

    
    public static function getList(int $limit = 20, int $offset = 0)
    {
        return self::with('author')->limit($limit)->offset($offset)->orderBy('created_at', 'DESC')->get();
    }

    public static function getUserMessages(int $userId, int $limit)
    {
        return self::query()->where('author_id', '=', $userId)->limit($limit)->orderBy('created_at', 'DESC')->get();
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->genFileName();
            move_uploaded_file($file,getcwd() . '/images/' . $this->image);
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

    public function getData()
    {
        return [
            'id',
            'author_id',
            'text',
            'created_at' ,
            'image'
        ];
    }

}



?>