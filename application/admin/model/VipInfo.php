<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/5 0005
 * Time: 12:36
 */
namespace app\admin\model;
use think\Model;
class VipInfo extends Model
{
    protected $autoWriteTimestamp = true;


    const STATUS_NORMAL = 1;
    const STATUS_DELETE = 2;

    public static $status_map = [
        self::STATUS_NORMAL => '正常',
        self::STATUS_DELETE => '删除',
    ];

    const SEX_NAN = 1;
    const SEX_NV = 2;

    public static $sex_map = [
        self::SEX_NAN => '男',
        self::SEX_NV => '女',
    ];

    public function getHandleTimeAttr(){
        return date('Y-m-d H:i:s', $this->getData('handle_time'));
    }

    public function getStatusAttr(){
        return self::$status_map[$this->getData('status')];
    }

    public function getVipSexAttr(){
        return self::$sex_map[$this->getData('vip_sex')];
    }

    public function getHandleClassHourAttr(){
        return $this->getData('handle_class_hour') . ' 小时';
    }

    public function getSurplusClassHourAttr(){
        return $this->getData('surplus_class_hour') . ' 小时';
    }

    public function getVipAgeAttr(){
        return $this->getData('vip_age') . ' 岁';
    }
}