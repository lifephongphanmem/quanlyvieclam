@extends ('admin.layout')

@section ('content')


		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>DOANH NGHIỆP</h4>
					<h4>{{$dinfo['pcompany']}}/{{$dinfo['upcompany']}}</h4>
					<p> Hoạt động/ Dừng</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Lao động</h4>
						<h3>{{$dinfo['laodong']}}</h3>
						<p>Tổng số lao động trên toàn tỉnh</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Tuyển dụng</h4>
						<h3>{{$dinfo['tuyendung']}}</h3>
						<p> Nhu cầu tuyển dụng</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Khai báo </h4>
						<h3>{{$dinfo['report']}}</h3>
						<p>Số doanh nghiệp đã khai báo  </p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Thống kê tình trạng thất nghiệp</h3>
										<div class="toolbar">
											
											
										</div>
								</header>
								<div class="agileits-box-body clearfix">
									<div id="hero-area"></div>
								</div>
							</div>
						</div>
	<!--//agileinfo-grap-->

				</div>
			</div>
		</div>
		
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
			
		<div class="agileits-w3layouts-stats">
					<div class="col-md-4 stats-info widget">
						<div class="stats-info-agileits">
							<div class="stats-title">
								<h4 class="title">Phân bố nhu cầu tuyển dụng</h4>
							</div>
							<div class="stats-body">
								<ul class="list-unstyled">
									<li>Lao động phổ thông <span class="pull-right">85%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar green" style="width:85%;"></div> 
										</div>
									</li>
									<li>Trung cấp <span class="pull-right">35%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar yellow" style="width:35%;"></div>
										</div>
									</li>
									<li>Cao đẳng <span class="pull-right">78%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar red" style="width:78%;"></div>
										</div>
									</li>
									<li>Đại học <span class="pull-right">50%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar blue" style="width:50%;"></div>
										</div>
									</li>
									<li>Sau đại học <span class="pull-right">80%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar light-blue" style="width:80%;"></div>
										</div>
									</li>
									 
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-4 stats-info widget">
						<div class="stats-info-agileits">
							<div class="stats-title">
								<h4 class="title">Phân bố doanh nghiệp hoạt động</h4>
							</div>
							<div class="stats-body">
								<ul class="list-unstyled">
									<li>Du lịch<span class="pull-right">85%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar green" style="width:85%;"></div> 
										</div>
									</li>
									<li>Điện <span class="pull-right">35%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar yellow" style="width:35%;"></div>
										</div>
									</li>
									<li>Điện lạnh <span class="pull-right">78%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar red" style="width:78%;"></div>
										</div>
									</li>
									<li>Giáo viên <span class="pull-right">50%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar blue" style="width:50%;"></div>
										</div>
									</li>
									<li>Khác <span class="pull-right">80%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar light-blue" style="width:80%;"></div>
										</div>
									</li>
									 
								</ul>
							</div>
						</div>
					</div>
			
					<div class="col-md-4 stats-info widget">
						<div class="stats-info-agileits">
							<div class="stats-title">
								<h4 class="title">Phân bố thất nghiệp</h4>
							</div>
							<div class="stats-body">
								<ul class="list-unstyled">
									<li>Đồng Hới <span class="pull-right">85%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar green" style="width:85%;"></div> 
										</div>
									</li>
									<li>Quảng Trạch <span class="pull-right">35%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar yellow" style="width:35%;"></div>
										</div>
									</li>
									<li>Bố Trạch <span class="pull-right">78%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar red" style="width:78%;"></div>
										</div>
									</li>
									<li>Lệ Thủy <span class="pull-right">50%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar blue" style="width:50%;"></div>
										</div>
									</li>
									<li>Tuyên Hóa <span class="pull-right">80%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar light-blue" style="width:80%;"></div>
										</div>
									</li>
									 <li>Minh Hóa <span class="pull-right">80%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar light-blue" style="width:80%;"></div>
										</div>
									</li>
									<li>Quảng Ninh <span class="pull-right">80%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar light-blue" style="width:80%;"></div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="clearfix"> </div>
					</div>
			<div class="taskoverview">
					<div class="col-md-12 stats-info stats-last widget-shadow">
						<div class="stats-last-agile">
							<table class="table stats-table ">
								<thead>
									<tr>
										<th>S.NO</th>
										<th>Công việc</th>
										<th>Tình trạng</th>
										<th>Tiến trình</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Tổ chức tuyển dụng trong kỳ</td>
										<td><span class="label label-success">Đang tiến hành</span></td>
										<td><h5>85% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">2</th>
										<td>Báo cáo định kỳ cho sở</td>
										<td><span class="label label-warning">Sắp tới deadline</span></td>
										<td><h5>35% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">3</th>
										<td>Tập huấn phần mềm cho cán bộ</td>
										<td><span class="label label-danger">Quá hạn</span></td>
										<td><h5 class="down">40% <i class="fa fa-level-down"></i></h5></td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
<script>
	$(document).ready(function() {
		
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2019 Q1', cung : 2668, cau: null},
				{period: '2019 Q2', cung: 15780, cau: 13799},
				{period: '2019 Q3', cung: 12920, cau: 10975},
				{period: '2019 Q4', cung: 8770, cau: 6600},
				{period: '2020 Q1', cung: 10820, cau: 10924},
				{period: '2020 Q2', cung: 9680, cau: 9010},
				{period: '2020 Q3', cung: 4830, cau: 3805},
				{period: '2020 Q4', cung: 15083, cau: 8977},
				{period: '2021 Q1', cung: 10697, cau: 4470},
			
			],
			lineColors:['#eb6f6f','#926383'],
			xkey: 'period',
            redraw: true,
            ykeys: ['cung', 'cau'],
            labels: ['Thất nghiệp', 'Nhu cầu'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>

@endsection