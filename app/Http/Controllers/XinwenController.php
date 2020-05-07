<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Xinwen;
use Illuminate\Support\Facades\Redis;
class XinwenController extends Controller
{
    
    //列表展示
    public function index()
    {
        $xinwen=Xinwen::get();
        foreach($xinwen as $k=>$v){
            //计算每条新闻的点赞数
            $xinwen[$k]->count=count(Redis::keys("xinwen_".$v->xinwen_id."*"));
            //计算自己是否点过
            $admin_id=session("admin_name")->admin_id;
            $count=count(Redis::keys("xinwen_".$v->xinwen_id."_".$admin_id));
            $xinwen[$k]->isclick=$count ? 1 : 0;
        }
        return view("xinwen.index",["xinwen"=>$xinwen]);
    }
    //新闻详情
    public function xwindex($id)
    {
        $info=Xinwen::where("xinwen_id",$id)->first();
        // dd($info);
        return view("xinwen.xwindex",["info"=>$info]);
    }
    //点赞
    public function addverb(){
        $xinwen_id=request()->xinwen_id;
        $admin_id=session("admin_name")->admin_id;
        //redis 字符串实现
        Redis::setnx("xinwen_".$xinwen_id."_".$admin_id,1);
        //计算总点赞数
        $count=count(Redis::keys("xinwen_".$xinwen_id."*"));
        echo json_encode(["code"=>"00000","count"=>$count]);exit;
    }
    //取消点赞
    public function lessverb(){
        $xinwen_id=request()->xinwen_id;
        $admin_id=session("admin_name")->admin_id;
        //redis 字符串实现
        Redis::del("xinwen_".$xinwen_id."_".$admin_id);
        //计算总点赞数
        $count=count(Redis::keys("xinwen_".$xinwen_id."*"));
        echo json_encode(["code"=>"00000","count"=>$count]);exit;
    }
    //添加列表
    public function create()
    {
        return view("xinwen.create");
    }
    //执行添加
    public function store(Request $request)
    {
        //验证
        $request->validate([
            'xinwen_name' => 'required|unique:xinwen|regex:/^[\x{4e00}-\x{9fa5}\w]{1,}$/u',
            'xinwen_man' => 'required',
            'xinwen_desc' => 'required',
        ],[
            'xinwen_name.required' => '新闻标题必填！',
            'xinwen_name.unique' => '新闻标题已存在！',
            'xinwen_name.regex' => '新闻标题格式有误（中文/字母/数字/下划线组成）！',
            'xinwen_man.required' => '新闻作者必填！',
            'xinwen_desc.required' => '新闻描述必填！',
        ]);
        $post=request()->except("_token");
        $post['xinwen_time']=time();
        $res=Xinwen::insert($post);
        // dd($res);
        if($res){
            return redirect("/xinwen/index");
        }
    }


}
