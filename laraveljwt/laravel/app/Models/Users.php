<?php
namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{
    use Notifiable ;

    protected $table = 'users';
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable = [ 'password','account'];
    protected $hidden = [
        'password',
    ];
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }


    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }
    /**
     * 创建用户
     *
     * @param array $array
     * @return |null
     * @throws \Exception
     */
    public static function createUser($array = [])
    {
        try {
            $student_id = self::create($array)->id;
            //echo "student_id:" . $student_id;
            return $student_id ?
                $student_id :
                false;
        } catch (\Exception $e) {
            logError('添加用户失败!', [$e->getMessage()]);
            die($e->getMessage());
            return false;
        }
    }

    /**
     * 查询该工号是否已经注册
     * 返回该工号注册过的个数
     * @param $request
     * @return false
     */
    public static function checknumber($request)
    {
        $student_job_number = $request['account'];
        try{
            $count = Users::select('account')
                ->where('account',$student_job_number)
                ->count();
            //echo "该账号存在个数：".$count;
            //echo "\n";
            return $count;
        }catch (\Exception $e) {
            logError("账号查询失败！", [$e->getMessage()]);
            return false;
        }
    }
}

