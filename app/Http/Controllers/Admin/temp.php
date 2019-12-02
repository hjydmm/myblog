/**
* author: カ シュンヨウ
* description:
* @param array $data
* @return mixed
*/

public function store(array $data)
{
return self::$admin::create([
'username' => $data['username'],
'email' => $data['email'],
'password' => bcrypt($data['password']),
'api_token' => substr(encrypt(str_random(rand(35,45))),1,40),
]);
}

/**
*
* @author:wuyanwen
* @description:用户分页
* @date:2017年9月3日
* @param unknown $page
*/
public function page($offset=0, $limit = 15, $where = [])
{
$data = self::$admin::where($where)
->select('id','username','email','created_at')
->offset($offset)
->limit($limit)
->get();

$total = self::$admin::where($where)->count();

return ['data' => $data, 'total' => $total];
}

/**
*
* @author:wuyanwen
* @description:查找记录
* @date:2017年9月3日
*/
public function find($field, $value)
{
return self::$admin::where($field, $value)->first();
}

/**
* @description:删除一条记录
* @author wuyanwen(2017年9月5日)
* @param unknown $id
* @return unknown
*/
public function delete($id)
{
return self::$admin::destroy($id);
}

/**
* @description:
* @author wuyanwen(2017年9月6日)
*/
public function update($data)
{
$user = self::$admin::find($data['id']);

$user->username = $data['username'];
$user->email = $data['email'];

if ($data['password']) {
$user->password = $data['password'];
}

return $user->save();
}
}