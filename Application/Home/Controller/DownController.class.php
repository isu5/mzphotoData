<?php
namespace Home\Controller;
use Think\Controller;
class DownController extends Controller {
	private $group = null;
	private $user = null;
	private $content = null;
	private $content_p = null;
	
	public function __construct(){
		parent::__construct();
		$this->group = M('Group');
        $this->user = M('User');
        $this->content = M('Content');
        $this->content_p = M('Content_picture');	
        $this->down = M('Download');	
	}

	public function index(){
		
		//2015年时间段
		$stime5 = date('2015-01-01 00:00:00',time());
		$etime5 = date('2015-12-31 23:59:59',time());
		//2016年时间
		$stime6 = date('2016-01-01 00:00:00',time());
		$etime6 = date('2016-12-31 23:59:59',time());
		//2017年时间
		$stime7 = date('2017-01-01 00:00:00',time());
		$etime7 = date('2017-12-31 23:59:59',time());
		//2018年时间
		$stime8 = date('2018-01-01 00:00:00',time());
		$etime8 = date('2018-12-31 23:59:59',time());
		//2019年时间
		$stime9 = date('2019-01-01 00:00:00',time());
		$etime9 = date('2019-12-31 23:59:59',time());
		//2020年时间
		$stime20 = date('2020-01-01 00:00:00',time());
		$etime20 = date('2020-12-31 23:59:59',time());
		//2021年时间
		$stime21 = date('2021-01-01 00:00:00',time());
		$etime21 = date('2021-12-31 23:59:59',time());
		//2022年时间
		$stime22 = date('2022-01-01 00:00:00',time());
		$etime22 = date('2022-12-31 23:59:59',time());
		
		$where="1 = 1";
		$excel = 0;
		if(IS_POST){		
			$excel = I('post.excel');
			$where = array();
			if($excel==1){
				//2015
				$where['a.downloads_day'] = array('between',"$stime5,$etime5");
			}else if($excel==2){
				//2016
				$where['a.downloads_day'] = array('between',"$stime6,$etime6");
			}else if($excel==3){
				//2017
				$where['a.downloads_day'] = array('between',"$stime7,$etime7");
			}else if($excel==4){
				//2018
				$where['a.downloads_day'] = array('between',"$stime8,$etime8");
			}else if($excel==5){
				//2019
				$where['a.downloads_day'] = array('between',"$stime9,$etime9");
			}else if($excel==6){
				//2020
				$where['a.downloads_day'] = array('between',"$stime20,$etime20");
			}else if($excel==7){
				//2021
				$where['a.downloads_day'] = array('between',"$stime21,$etime21");
			}else if($excel==8){
				//2022
				$where['a.downloads_day'] = array('between',"$stime22,$etime22");
			}
		}
		
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("Max(a.content_id)"=>"cons","count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where($where)
		->group('p.photographer')
		->select();
		
		p($data);
		//p(M()->getLastSql());
		$this->assign('data' , $data);
		$this->assign('excel' , $excel);
		$this->display();
		
		
	}
	//导出2015年数据
	public function excel2015(){
		//2015年时间段
		$stime5 = date('2015-01-01 00:00:00',time());
		$etime5 = date('2015-12-31 23:59:59',time());
		$excel=1;
		$where['a.downloads_day'] = array('between',"$stime5,$etime5");
		
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where($where)
		->group('p.photographer')
		->select();
		if(empty($data)){
			$this->error('没有数据');
		}else{
			
			$this->assign('excel' , $excel);
			$title = array('基层公司','照片下载数量'); //设置要导出excel的表头
			exportExcel($data, '媒资系统2015照片下载数量统计', $title);
		}
	}
	//导出2016年数据
	public function excel2016(){
		//2016年时间段
		$stime6 = date('2016-01-01 00:00:00',time());
		$etime6 = date('2016-12-31 23:59:59',time());
		$excel=1;
		//2016
		$where['a.downloads_day'] = array('between',"$stime6,$etime6");
		
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where($where)
		->group('p.photographer')
		->select();
		//p(M()->getLastSql());die;
		if(empty($data)){
			$this->error('没有数据');
		}else{
			$this->assign('excel' , $excel);
			$title = array('基层公司','照片下载数量'); //设置要导出excel的表头
			exportExcel($data, '媒资系统2016照片下载数量统计', $title);
		}
	}
	//导出2017年数据
	public function excel2017(){
		//2016年时间段
		$stime6 = date('2017-01-01 00:00:00',time());
		$etime6 = date('2017-12-31 23:59:59',time());
		$excel=3;
		//2016
		$where['a.downloads_day'] = array('between',"$stime6,$etime6");
		
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where($where)
		->group('p.photographer')
		->select();
		//p(M()->getLastSql());die;
		if(empty($data)){
			$this->error('没有数据');
		}else{
			$this->assign('excel' , $excel);
			$title = array('基层公司','照片下载数量'); //设置要导出excel的表头
			exportExcel($data, '媒资系统2017照片下载数量统计', $title);
		}
	}
	//导出2018年数据
	public function excel2018(){
		//2016年时间段
		$stime6 = date('2018-01-01 00:00:00',time());
		$etime6 = date('2018-12-31 23:59:59',time());
		$excel=4;
		//2016
		$where['a.downloads_day'] = array('between',"$stime6,$etime6");
		
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where($where)
		->group('p.photographer')
		->select();
		//p(M()->getLastSql());die;
		if(empty($data)){
			$this->error('没有数据');
		}else{
			$this->assign('excel' , $excel);
			$title = array('基层公司','照片下载数量'); //设置要导出excel的表头
			exportExcel($data, '媒资系统2018照片下载数量统计', $title);
		}
	}
	//导出2019年数据
	public function excel2019(){
		//2016年时间段
		$stime6 = date('2019-01-01 00:00:00',time());
		$etime6 = date('2019-12-31 23:59:59',time());
		$excel=5;
		//2016
		$where['a.downloads_day'] = array('between',"$stime6,$etime6");
		
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where($where)
		->group('p.photographer')
		->select();
		//p(M()->getLastSql());die;
		if(empty($data)){
			$this->error('没有数据');
		}else{
			$this->assign('excel' , $excel);
			$title = array('基层公司','照片下载数量'); //设置要导出excel的表头
			exportExcel($data, '媒资系统2019照片下载数量统计', $title);
		}
	}
	//导出2020年数据
	public function excel2020(){
		//2016年时间段
		$stime6 = date('2020-01-01 00:00:00',time());
		$etime6 = date('2020-12-31 23:59:59',time());
		$excel=6;
		//2016
		$where['a.downloads_day'] = array('between',"$stime6,$etime6");
		
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where($where)
		->group('p.photographer')
		->select();
		//p(M()->getLastSql());die;
		//p($data);
		if(empty($data)){
			$this->error('没有数据');
		}else{
			$this->assign('excel' , $excel);
			$title = array('基层公司','照片下载数量'); //设置要导出excel的表头
			exportExcel($data, '媒资系统2020照片下载数量统计', $title);
		}
	}
	//导出2021年数据
	public function excel2021(){
		//2016年时间段
		$stime6 = date('2021-01-01 00:00:00',time());
		$etime6 = date('2021-12-31 23:59:59',time());
		$excel=7;
		//2016
		$where['a.downloads_day'] = array('between',"$stime6,$etime6");
		
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where($where)
		->group('p.photographer')
		->select();
		//p(M()->getLastSql());die;
		if(empty($data)){
			$this->error('没有数据');
		}else{
			$this->assign('excel' , $excel);
			$title = array('基层公司','照片下载数量'); //设置要导出excel的表头
			exportExcel($data, '媒资系统2021照片下载数量统计', $title);
		}
	}
	//导出2022年数据
	public function excel2022(){
		//2016年时间段
		$stime6 = date('2022-01-01 00:00:00',time());
		$etime6 = date('2022-12-31 23:59:59',time());
		$excel=8;
		//2016
		$where['a.downloads_day'] = array('between',"$stime6,$etime6");
		
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where($where)
		->group('p.photographer')
		->select();
		//p(M()->getLastSql());die;
		if(empty($data)){
			$this->error('没有数据');
		}else{
			$this->assign('excel' , $excel);
			$title = array('基层公司','照片下载数量'); //设置要导出excel的表头
			exportExcel($data, '媒资系统2022照片下载数量统计', $title);
		}
	}
	//导出全部数据表格
	public function excelLastYear(){
		$excel = 0;
		//根据内容id 查 用户
		$data = $this->down->alias('a')
		->field(array("count(a.content_id)"=>"countCom",'g.group_name','p.photographer'))
		->join('LEFT JOIN __CONTENT_PICTURE__ p on p.content_id=a.content_id
			LEFT JOIN __CONTENT__ c on c.content_id=p.content_id 
			LEFT JOIN __USER__ u on u.user_id=c.user_id 
			LEFT JOIN __GROUP__ g on g.group_id=u.group_id 
		')
		->where()
		->group('p.photographer')
		->select();
		if(empty($data)){
			$this->error('没有数据');
		}else{
			$this->assign('excel' , $excel);
			$title = array('基层公司','照片下载数量'); //设置要导出excel的表头
			exportExcel($data, '媒资系统全部照片下载数量统计', $title);
		}
		
	}
	
	
}