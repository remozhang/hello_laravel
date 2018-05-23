<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/***
 * 这里没有明确指定Flight使用了哪个数据库
 * 除非数据表明确指定了其他名称，否则都将以类的复数形式蛇形名称来作为表名
 * Class Flight
 *
 * @package App
 */
class Flight extends Model
{
    // 自定义 timestamps 字段
    const CREATE_AT = 'ctime';

    const UPDATE_AT = 'post_time';

    // 与模型关联的表
    protected $table = 'my_flight';

    // 定义主键 默认为自增  个人感觉没什么卵用
    protected $primaryKey = 'id';

    // 默认情况下 eloquent存在creat_at 和 update_at这两个字段
    public $timestamps = false;

    // 定义了日期如何存储在数据库中
    protected $dataFormat = 'U';

    // 此模型的链接名称
    protected $connection = 'connection-name';


    // 在其他地方上使用
//    use App\Flight;
//    // 这里all获取模型表中所有结果
//    $flights = Flight::all();
//    foreach ($flights as $flight) {
//        echo $flight->name
//    }

    public function unions()
    {
        $first = DB::table('users')
                    ->whereNull("first_name");

        $user = DB::table('users')
                    ->whereNull('last_name')
                    ->union($first)
                    ->get();
    }

    public function where()
    {
        $user = DB::table('users')->where('votes', '=', 100)->get();

        // 简单等于 等同于
        $user = DB::table('users')->where('votes', 100)->get();
        // 也可以是数组
        $user = DB::table('users')->where([
            ['status', '=', '1'],
            ['subscribed', '<>' ,'1']
        ])->get();
    }

    public function whereExists()
    {
        // 最终生成SQL
        // select * from users where name = 'John' or (votes > 100 and title <> 'Admin');
        DB::table('users')
                ->where('name', '=', 'John')
                ->orWhere(function($query) {
                    $query->where('vote', '>', 100)
                          ->where('title', '<>', 'Admin');
                })
                ->get();
    }

    public function joinClosure()
    {
//        DB::table('users')
//                ->join('contacts', )
    }

    public function nativeSelect()
    {
        $users = DB::select('select * from users where active = ?', [1]);
        $comments = DB::select('select * from users where active = :id', ['id' => 1]);
        // 这块应该等同于 view('user/index')->with('users', $users);
        return view('user.index', ['users' => $users]);
    }

    public function nativeTransaction()
    {
        DB::transaction(function(){
            DB::table('users')->update(['votes' => '1']);
            DB::table('posts')->delete(); // 这段不知道是不是删除整张表？？
        });

        // manual transaction
        DB::beginTransaction();
        DB::rollback();
        DB::commit();
    }

    public function queryBuilder()
    {
        // get all
        $users = DB::table('users')->get();
//        return view('user.index', ['users' => $users]);

        // get a single row
        $user = DB::table('users')->where('name', 'jack')->first();

        //Chunk Result
        DB::table('users')->orderBy('id')->chunk('100', function($user){
           foreach ($user as $user) {

           }
        });

        // aggregates
        $user = DB::table('user')->count();

        // select clause
        $users = DB::table('users')->select('name', 'email as user_email')->get();

        // raw expression
        $select = DB::table('users')
                    ->select(DB::raw('count(*) as user_count,status'))
                    ->where('status', '=' ,'1')
                    ->groupBy('status')
                    ->get();

        // raw methods
        DB::table('users')
            ->selectRaw('price * ? as price_with_tax', [1.0875])
            ->get();

        // advanced Join clause
        DB::table('users')
            ->join('contacts', function($join) {
            });

        // latest
        // by default, order by the 'create_at' column
        $user = DB::table('users')
                    ->latest();

        // skip/take
        // it's looks like limit 0, 20
        // equal to offset limit
        $user = DB::table('users')->skip('20')->take(5)->get();
        $user = DB::table('users')->offset('20')->limit(5)->get();

        // inserts
        DB::table('users')
            ->insert(
                ['email' => 'john@example.com']
            );
        // if you want retrieve  the ID, you should use insertById
        $id = DB::table('users')
                ->insertById(
                    ['email' => 'john@example.com']
                );

        // truncate
        DB::table('users')->truncate();
    }

    public function getUsersByPaginator()
    {
//        $users = DB::table('users')->paginate('15');
//
//        return $users;
        $users = \App\User::paginate(15);

    }
}
