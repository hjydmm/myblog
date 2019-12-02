<?php


namespace App\Services;

use App\Repositories\AuthRepositoryInterface;
use App\Repositories\PositionRepositoryInterface;
use App\Traits\Response;

class PositionService implements PositionServiceInterface
{
    //引入trait
    use Response;

    protected $positionRepository;
    protected $authRepository;

    public function __construct(PositionRepositoryInterface $positionRepository, AuthRepositoryInterface $authRepository)
    {
        $this->positionRepository = $positionRepository;
        $this->authRepository = $authRepository;
    }

    /**
     * author: カ シュンヨウ
     * description: 根据id数组返回id组合字符串
     * @param array $ids
     * @return string
     */
    public function toIdsString(array $ids){
        //implode第一个参数是分割符号
        return implode(',', $ids);
    }

    /**
     * author: カ シュンヨウ
     * description: 根据id数组返回ac组合字符串
     * @param array $ids
     * @return string
     */
    public function toAcsString(array $ids){
        $tmp = $this->authRepository->getChildAuthByIds($ids);
        //循环拼凑controller和action成字符串
        $ac = '';
        foreach($tmp as $key => $value){
            $ac .= $value -> controller . '@' . $value -> action . ',';
        //去除末尾逗号
        return rtrim($ac, ',');
        }
    }

    /**
     * author: カ シュンヨウ
     * description: 创建一个新的position
     * @param $position_name
     * @param array $auth_ids
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPosition($position_name, array $auth_ids){
        $data['auth_ids'] = $this->toIdsString($auth_ids);
        $data['auth_ac'] = $this->toAcsString($auth_ids);
        $data['position_name'] = $position_name;
        $result = $this->positionRepository->createPosition($data);
        return $result ? $this->ajaxSuccess('职位添加成功！', ['success'=>'1']) : $this->ajaxError('职位添加失败！', ['fail'=>'0']);
    }

    /**
     * author: カ シュンヨウ
     * description: 更新一个已有的position
     * @param $position_name
     * @param array $auth_ids
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePosition($position_id, $position_name, array $auth_ids){
        $data['auth_ids'] = $this->toIdsString($auth_ids);
        $data['auth_ac'] = $this->toAcsString($auth_ids);
        $data['position_name'] = $position_name;
        $result = $this->positionRepository->updatePosition($position_id, $data);
        return $result ? $this->ajaxSuccess('职位修改成功！', ['success'=>'1']) : $this->ajaxError('职位修改失败！', ['fail'=>'0']);
    }

}