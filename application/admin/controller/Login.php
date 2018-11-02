<?php
namespace app\admin\controller;

class Login extends Base
{
    public function login(){
        $username = input('username/s');
        $password = input('password/s');

        if (empty($username) || empty($password)) {
            return  $this->response_error('用户名或密码未填写');
        }

        $user = db('user')->where(['username' => $username])->find();
        if (empty($user)) {
            return $this->response_error('用户不存在');
        }

        if (empty($user['password']) || $user['password'] != md5(md5($password))) {
            return $this->response_error('密码错误');
        }

        session('user', $user);
        return $this->response_success($user);
    }

    public function logout(){
        session('user', null);
        return $this->response_success([], '退出登入成功');
    }

    public function changePassword(){
        $old_password = input('oldPwd/s');
        $new_password = input('newPwd/s');

        $user = session('user');

        if (empty($user) || empty($user['password'])) {
            return $this->response_error('你还没登入，请重新登入');
        }

        if (empty($old_password) || empty($new_password)) {
            return $this->response_error('缺少必要参数');
        }

        $pwd = db('user')->where('username', $user['username'])->value('password');

        if ($pwd != md5(md5($old_password))) {
            return $this->response_error('你输入的旧密码不对，请重新输入');
        }

        $result = db('user')->where(['username' => $user['username']])->update([
            'password' => md5(md5($new_password)),
            'update_time' => time()]);

        if (empty($result)) {
            return $this->response_error('修改失败请稍后再试');
        }

        return $this->response_success([], '修改成功');
    }
}
