<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>下载量--导出数据</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/meizi/Public/layui/css/layui.css"  media="all">
   <style>
	#datatable {
		border: 1px solid #ccc;
		border-collapse: collapse;
		border-spacing: 0;
		font-size: 12px;
	}
	td,th {
		border: 1px solid #ccc;
		padding: 4px 20px;
	}
  </style>
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<div class="layui-container">  
  <div class="layui-row">
    <div class="layui-col-md7">
      &nbsp;
    </div>
    <div class="layui-col-md5">
      <form class="layui-form" action="<?php echo U('Down/index');?>"  method="post">
		<div class="layui-form-item">
			<label class="layui-form-label">年度筛选</label>
			<div class="layui-input-inline" style="margin:0 50px 0 20px">
				<select name="excel" lay-verify="" lay-filter="filter" id="excel" >
					<option value="0" <?php if($excel == 0): ?>selected="selected"<?php endif; ?>>全部数据</option>
					<option value="1" <?php if($excel == 1): ?>selected="selected"<?php endif; ?>>2015年数据</option>
					<option value="2" <?php if($excel == 2): ?>selected="selected"<?php endif; ?>>2016年数据</option>
					<option value="3" <?php if($excel == 3): ?>selected="selected"<?php endif; ?>>2017年数据</option>
					<option value="4" <?php if($excel == 4): ?>selected="selected"<?php endif; ?>>2018年数据</option>
					<option value="5" <?php if($excel == 5): ?>selected="selected"<?php endif; ?>>2019年数据</option>
					<option value="6" <?php if($excel == 6): ?>selected="selected"<?php endif; ?>>2020年数据</option>
					<option value="7" <?php if($excel == 7): ?>selected="selected"<?php endif; ?>>2021年数据</option>
					<option value="8" <?php if($excel == 8): ?>selected="selected"<?php endif; ?>>2022年数据</option>
				</select>        	
			</div>
			<button type="submit" id="submit" class="layui-btn layui-btn-normal">查询</button>
		</div>
		
	</form>
		<?php if($excel == 0): ?><a href="<?php echo U('Down/excelLastYear');?>" class="layui-btn layui-btn-normal">导出全部数据表格</a><?php endif; ?>
		<?php if($excel == 1): ?><a href="<?php echo U('Down/excel2015');?>" class="layui-btn layui-btn-normal">导出2015年数据</a><?php endif; ?>
		<?php if($excel == 2): ?><a href="<?php echo U('Down/excel2016');?>" class="layui-btn layui-btn-normal">导出2016年数据</a><?php endif; ?>
		<?php if($excel == 3): ?><a href="<?php echo U('Down/excel2017');?>" class="layui-btn layui-btn-normal">导出2017年数据</a><?php endif; ?>
		<?php if($excel == 4): ?><a href="<?php echo U('Down/excel2018');?>" class="layui-btn layui-btn-normal">导出2018年数据</a><?php endif; ?>
		<?php if($excel == 5): ?><a href="<?php echo U('Down/excel2019');?>" class="layui-btn layui-btn-normal">导出2019年数据</a><?php endif; ?>
		<?php if($excel == 6): ?><a href="<?php echo U('Down/excel2020');?>" class="layui-btn layui-btn-normal">导出2020年数据</a><?php endif; ?>
		<?php if($excel == 7): ?><a href="<?php echo U('Down/excel2021');?>" class="layui-btn layui-btn-normal">导出2021年数据</a><?php endif; ?>
		<?php if($excel == 8): ?><a href="<?php echo U('Down/excel2022');?>" class="layui-btn layui-btn-normal">导出2022年数据</a><?php endif; ?>
    </div>
  </div>
  
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

  
<table class="layui-table" id="datatable">
	<thead>
		<tr>
			<th >姓名</th>
			<th >公司</th>
			<th >全部照片下载数量</th>
		</tr>
	
	</thead>
	<tbody>
	<?php if(empty($data)): ?><tr>
			<td style="color:red;font-weight:700">您搜索的年度没有数据</td>
		</tr>
    <?php else: ?>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
			  <th><?php echo ($v["photographer"]); ?></th>
			  <td><?php echo ($v["group_name"]); ?></td>
			  <td><?php echo ($v["countcom"]); ?></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	
  </tbody>
</table>
              
          
<script src="/meizi/Public/layui/layui.js" charset="utf-8"></script>
<script src="/meizi/Public/layui/jquery.js" charset="utf-8"></script>
<script src="/meizi/Public/layui/highcharts.js" charset="utf-8"></script>
<script src="/meizi/Public/layui/exporting.js" charset="utf-8"></script>
<script src="/meizi/Public/layui/data.js" charset="utf-8"></script>
<script src="/meizi/Public/layui/highcharts-zh_CN.js" charset="utf-8"></script>

<script>
layui.use(['jquery', 'form'], function(){
	var $ = layui.$ //重点处
	,form = layui.form;
	
});

$(function(){
	$('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '从 HTML 表格中提取数据并生成图表'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: '个',
                rotation: 0
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' 个' + this.point.name.toLowerCase();
            }
        },
		credits: {
            enabled: false
        },
		 exporting: {
            enabled: false
        }
    });
	$('#submit').click(function(){
		var opt = $('#excel').val();
		var optxt = $('#excel').find("option:selected").text();

		$.post("<?php echo U('Down/index');?>", {excel:opt},function(data){
			console.log(data);
			//$('#excel option[text='+optxt+']').attr("selected", true)
		});
			
	})
	
});

	



</script>

</body>
</html>