<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/4 0004
 * Time: 21:43
 */
namespace app\admin\controller;
use app\admin\model\VipInfo as VipInfoModel;
use think\db\Query;
use think\Request;

class VipInfo extends Base
{
    public function __construct(Request $request = null)
    {
        parent::__construct();

        if (empty(session('user'))) {
            return $this->response_error('你还没有登入');
        }
    }

    public function index(){
        $keyword = input('keyword/s', '');

        $query = model('vipInfo');
        $query = $query->where('status',  VipInfoModel::STATUS_NORMAL);

        if (!empty($keyword)) {
            $query->where('vip_name|vip_remark', 'like', '%'. $keyword .'%');
        }

        $result = $query->paginate();

        if (empty($result)) {
            return $this->response_success();
        }

        return $this->response_success($result);
    }

    public function add(){
        $data['vip_name'] = input('vip_name/s');
        $data['vip_age'] = input('vip_age/d');
        $data['vip_sex'] = input('vip_sex/s');
        $data['handle_time'] = input('handle_time/s');
        $data['handle_class_hour'] = input('handle_class_hour/d');
        $data['surplus_class_hour'] = input('surplus_class_hour/d');
        $data['vip_remark'] = input('vip_remark/s');
        trace($data);

        if (empty($data['vip_name'])) {
            return $this->response_error('会员名未填写');
        }

        $res = model('vip_info')->save($data);

        if (empty($res)) {
            return $this->response_error('插入失败，请稍后再试');
        }

        return $this->response_success();
    }

    public function del(){
        $id = input('id/d', 0);

        if (empty($id)) {
            return $this->response_error('要删除的id不存在');
        }

        $res = model('vip_info')->save(['status' => VipInfoModel::STATUS_DELETE], ['id' => $id]);

        if (empty($res)) {
            return $this->response_error('删除失败，请稍后再试');
        }

        return $this->response_success();
    }

    public function edit(){
        $data['id'] = input('id/d');
        $data['vip_name'] = input('vip_name/s');
        $data['vip_age'] = input('vip_age/d');
        $data['vip_sex'] = input('vip_sex/s');
        $data['handle_time'] = input('handle_time/s');
        $data['handle_class_hour'] = input('handle_class_hour/d');
        $data['surplus_class_hour'] = input('surplus_class_hour/d');
        $data['vip_remark'] = input('vip_remark/s');
        trace($data);

        if (empty($data['vip_name'])) {
            return $this->response_error('会员名未填写');
        }

        $res = model('vip_info')->isUpdate(true)->save($data);

        if (empty($res)) {
            return $this->response_error('编辑失败，请稍后再试');
        }

        return $this->response_success();
    }

    public function batchDelete(){
        $ids = input('ids/s', '');

        if (empty($ids)) {
            return $this->response_error('要删除的id不存在');
        }

        $res = model('vip_info')->save(['status' => VipInfoModel::STATUS_DELETE], ['id' => ['in', $ids]]);

        if (empty($res)) {
            return $this->response_error('删除失败，请稍后再试');
        }

        return $this->response_success();
    }
}