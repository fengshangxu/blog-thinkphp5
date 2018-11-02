<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/1 0001
 * Time: 21:09
 */
namespace app\admin\controller;
use think\Controller;
class Base extends  Controller
{
    public function __construct(){
	if (!session('user')) {
	    return $this->response_error('未登录');;
	}
    }

    public function response_success($data = [], $msg = 'success', $code = 0) {
        return json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
    }

    public function response_error($msg = 'error', $code = 1 ,$data = []) {
        return json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
    }
}
