<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alien;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;
class AlienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=request()->all();
        $alien_name=request()->alien_name;
        $where=[];
        if($alien_name){
           $where[]=["alien_name","like","%$alien_name%"];
        }
        $page=request()->page?:1;
        //Redis::del("alien");
        //获取redis
        $alien=Redis::get("alien_".$page);
        // dump($alien);
        //判断redis里是否有值
        if(!$alien){
            // echo "db";
            $alien=Alien::where($where)->orderBy("alien_id","desc")->paginate(2);
            //存redis
            $alien=serialize($alien);
            Redis::setex("alien_".$page,60*24*7,$alien);
        }
        $alien=unserialize($alien);
        // dd($alien);
        //检测是否是ajax请求
        if(request()->ajax()){
            return view("alien.ajaxindex",["alien"=>$alien,"all"=>$all]);
        }

        return view("alien.index",["alien"=>$alien,"all"=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("alien.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证
        $request->validate([
            'alien_name' => 'regex:/^[\x{4e00}-\x{9fa5}]{2,15}$/u',
            'alien_age' => 'regex:/^[0-9]{1,2}$/',
            'alien_card' => 'unique:alien|regex:/^[0-9a-zA-Z]{18}$/',
        ],[
            'alien_name.regex' => '姓名格式有误（中文、长度2-15位）！',
            'alien_age.regex' => '年龄格式有误（不超过99纯数字）！',
            'alien_card.unique' => '身份证号码已存在！',
            'alien_card.regex' => '身份证号格式有误（符合身份证规则只能是18位数字或字母）！',
        ]);
        $post=request()->except("_token");
        $post["alien_time"]=time();
        //文件上传
        //判断文件在请求中是否存在
        if ($request->hasFile('alien_img')) {
            $post["alien_img"]=upload("alien_img");
        }
        // dd($post);
        $res=Alien::insert($post);
        if($res){
            return redirect("/alien/index");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Alien::find($id);
        return view("alien.edit",["res"=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //验证
        $request->validate([
            'alien_name' => 'regex:/^[\x{4e00}-\x{9fa5}]{2,15}$/u',
            'alien_age' => 'regex:/^[0-9]{1,2}$/',
            'alien_card' => [ Rule::unique('alien')->ignore($id,'alien_id'),
                             'regex:/^[0-9a-zA-Z]{18}$/'
                            ],
        ],[
            'alien_name.regex' => '姓名格式有误（中文、长度2-15位）！',
            'alien_age.regex' => '年龄格式有误（不超过99纯数字）！',
            'alien_card.unique' => '身份证号码已存在！',
            'alien_card.regex' => '身份证号格式有误（符合身份证规则只能是18位数字或字母）！',
        ]);
        $post=request()->except("_token");
        $post["alien_time"]=time();
        //文件上传
        //判断文件在请求中是否存在
        if ($request->hasFile('alien_img')) {
            $post["alien_img"]=upload("alien_img");
        }
        // dd($post);
        $res=Alien::where("alien_id",$id)->update($post);
        if($res!==false){
            return redirect("/alien/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Alien::destroy($id);
        // dd($res);
        if($res){
            return redirect("/alien/index");
        }
    }
}
