<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wen;
use App\Wenf;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
class WenController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page=request()->page??1;
        //搜索
        $all=request()->all();
        $wen_name=request()->wen_name??"";
        $wenf_name=request()->wenf_name??"";
        // Cache::flush(); 
        // echo 'wen_'.$page.'_'.$wen_name.'_'.$wenf_name;   
        $wen=Cache::get('wen_'.$page.'_'.$wen_name.'_'.$wenf_name);
        // dump($wen);
        if(!$wen){
            // echo "DB==";
            $where=[];
            if($wen_name){
            $where[]=["wen_name","like","%$wen_name%"];
            }
            if($wenf_name){
                $where[]=["wenf_name","like","%$wenf_name%"];
            }
        
            $wen=Wen::leftjoin("wenf","wen.wenf_id","=","wenf.wenf_id")->where($where)->orderBy("wen_id","desc")->paginate(3);
            Cache::put("wen_".$page.'_'.$wen_name.'_'.$wenf_name,$wen,60);
        }
        //分页
        // $pageSize=config("app.pageSize");
        
        // dd($wen);
        $wenf=Wenf::all();
        
        //检测是否是ajax请求
        if(request()->ajax()){
            return view("wen.ajaxpage",['wen'=>$wen,'all'=>$all]);
        }

        return view("wen.index",['wen'=>$wen,'wenf'=>$wenf,'all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *添加列表
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wenf=Wenf::all();
        return view("wen.create",['wenf'=>$wenf]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'wen_name' => 'required|unique:wen|regex:/^[\x{4e00}-\x{9fa5}\w]{1,}$/u',
        ],[
            'wen_name.required' => '文章标题必填！',
            'wen_name.unique' => '文章标题已存在！',
            'wen_name.regex' => '文章标题格式有误（中文/字母/数字/下划线组成）！',
        ]);
        $post=request()->except("_token");
        //文件上传
        if ($request->hasFile('wen_logo')) {
            $post["wen_logo"]=upload("wen_logo");
        }
        // dd($post);
        $res=Wen::insert($post);
        if($res){
            return redirect("/wen/index");
        }
    }

    /**
     * Display the specified resource.
     *资源详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑列表
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wenf=Wenf::all();
        $res=Wen::find($id);
        return view("wen.edit",['res'=>$res,'wenf'=>$wenf]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'wen_name' => ['required',
                           Rule::unique('wen')->ignore($id, 'wen_id'),
                           'regex:/^[\x{4e00}-\x{9fa5}\w]{1,}$/u'],
        ],[
            'wen_name.required' => '文章标题必填！',
            'wen_name.unique' => '文章标题已存在！',
            'wen_name.regex' => '文章标题格式有误（中文/字母/数字/下划线组成）！',
        ]);
        $post=request()->except("_token");
        //文件上传
        if ($request->hasFile('wen_logo')) {
            $post["wen_logo"]=$this->upload("wen_logo");
        }
        // dd($post);
        $res=Wen::where("wen_id",$id)->update($post);
        if($res!==false){
            return redirect("/wen/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Wen::destroy($id);
        if($res){
            if(request()->ajax()){
                return json_encode(['code'=>'00000','msg'=>'删除成功']);
            }
        }
        return redirect("/wen/index");
    }
}
