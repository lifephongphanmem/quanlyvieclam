<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>DASHBOARD | CUNGCAULAODONG</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{URL::asset('')}}backend/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{URL::asset('')}}backend/css/style.css" rel='stylesheet' type='text/css' />
<link href="{{URL::asset('')}}backend/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{URL::asset('')}}backend/css/font.css" type="text/css"/>
<link href="{{URL::asset('')}}backend/css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="{{URL::asset('')}}backend/css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{URL::asset('')}}backend/css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{URL::asset('')}}backend/js/jquery2.0.3.min.js"></script>
<script src="{{URL::asset('')}}backend/js/raphael-min.js"></script>
<script src="{{URL::asset('')}}backend/js/morris.js"></script>

</head>
<body>
 <table >
				<tr>
				<td colspan=5>
					<h4>ỦY BAN NHÂN DÂN TỈNH QUẢNG BÌNH</h4>
					<h4>SỞ LAO ĐỘNG - THƯƠNG BINH VÀ XÃ HỘI</h4>
						<h4>	-------</h4>
							<h4>Số:</h4>

				</td>
				<td colspan=9>
					<h4>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h4>
					<h4>	Độc lập - Tự do - Hạnh phúc</h4> 
					<h4>	---------------</h4> 
				</td>

			  </tr>
			
			  <tr>
				<td colspan=14>
					<h4> Quảng Bình, ngày … tháng … năm … </h4> 
					<h4> Mẫu số 02/PLI</h4> 
					
				</td>
			  </tr>
			  <tr>
				<td colspan=14>
					<h4>BÁO CÁO </h4> 
					
				</td>
			  </tr>
				<tr>
				<td colspan=14>
			
					<h4>TÌNH HÌNH SỬ DỤNG LAO ĐỘNG</h4> 
				</td>
				</tr>
				 <tr>
				<td colspan=14>
			
					<h5>Kính gửi (1): Bộ Lao động – Thương binh và Xã hội </h5> 
		
				</td>
			  </tr>
		</table>
		
		 <table class="table table-bordered ">
					<thead>
					  <tr>
						<th rowspan=2>STT</th>
						<th rowspan=2>Người sử dụng lao động</th>
						<th colspan= 4>Tổng số lao động được sử dụng</th>
						<th colspan= 4>Vị trí việc làm </th>
						<th colspan= 3>Loại và hiệu lực hợp đồng lao động</th>
						<th  >Ghi chú</th>
					 </tr>
					 
					  <tr>
						<th>Tổng</th>
						<th>Lao động nữ </th>
						<th>Lao động trên 35 tuổi</th>
						<th>Lao động tham gia BHXH bắt buộc</th>
						<th>Nhà quản lý	</th>
						<th>Chuyên môn kỹ thuật bậc cao</th>
						<th>Chuyên môn kỹ thuật bậc trung</th>
						<th>Khác</th>
						<th>Số lao động tham gia HĐLĐ không xác định thời hạn</th>
						<th>Số lao động tham gia HĐLĐ xác định thời hạn</th>
						<th>Số lao động tham gia HĐLĐ khác (dưới 1 tháng, thử việc)</th>
						<th></th>
					  </tr>
					   <tr>
						<th>1</th>
						<th>2 </th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
						<th>10</th>
						<th>11</th>
						<th>12</th>
						<th>13</th>
						<th>14</th>
						
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>1</td>
						<td>Doanh nghiệp</td>
						<td>{{$einfo['tong'] - $htxinfo['tong']-$hkdinfo['tong']-$tcinfo['tong']}}</td>
						<td>{{$einfo['nu'] - $htxinfo['nu']-$hkdinfo['nu']-$tcinfo['nu']}}</td>
						<td>{{$einfo['age']- $htxinfo['age']-$hkdinfo['age']-$tcinfo['age']}}</td>
						<td>{{$einfo['bhxh']- $htxinfo['bhxh']-$hkdinfo['bhxh']-$tcinfo['bhxh']}}</td>
						<td>{{$einfo['quanly']- $htxinfo['quanly']-$hkdinfo['quanly']-$tcinfo['quanly']}}</td>
						<td>{{$einfo['cmktcao']- $htxinfo['cmktcao']-$hkdinfo['cmktcao']-$tcinfo['cmktcao']}}</td>
						<td>{{$einfo['cmkttrung']- $htxinfo['cmkttrung']-$hkdinfo['cmkttrung']-$tcinfo['cmkttrung']}}</td>
						<td>{{$einfo['cmktkhac']- $htxinfo['cmktkhac']-$hkdinfo['cmktkhac']-$tcinfo['cmktkhac']}}</td>
						<td>{{$einfo['hdkhongthoihan']- $htxinfo['hdkhongthoihan']-$hkdinfo['hdkhongthoihan']-$tcinfo['hdkhongthoihan']}}</td>
						<td>{{$einfo['hdcothoihan']- $htxinfo['hdcothoihan']-$hkdinfo['hdcothoihan']-$tcinfo['hdcothoihan']}}</td>
						<td>{{$einfo['hdkhac']- $htxinfo['hdkhac']-$hkdinfo['hdkhac']-$tcinfo['hdkhac']}}</td>
						<td></td>
					  </tr>
					 <tr>
						<td>2</td>
						<td>Hợp tác xã</td>
						<td>{{$htxinfo['tong']}}</td>
						<td>{{$htxinfo['nu']}}</td>
						<td>{{$htxinfo['age']}}</td>
						<td>{{$htxinfo['bhxh']}}</td>
						<td>{{$htxinfo['quanly']}}</td>
						<td>{{$htxinfo['cmktcao']}}</td>
						<td>{{$htxinfo['cmkttrung']}}</td>
						<td>{{$htxinfo['cmktkhac']}}</td>
						<td>{{$htxinfo['hdkhongthoihan']}}</td>
						<td>{{$htxinfo['hdcothoihan']}}</td>
						<td>{{$htxinfo['hdkhac']}}</td>
						<td></td>
					  </tr>
					  <tr>
						<td>3</td>
						<td>Cơ quan/tổ chức</td>
						<td>{{$tcinfo['tong']}}</td>
						<td>{{$tcinfo['nu']}}</td>
						<td>{{$tcinfo['age']}}</td>
						<td>{{$tcinfo['bhxh']}}</td>
						<td>{{$tcinfo['quanly']}}</td>
						<td>{{$tcinfo['cmktcao']}}</td>
						<td>{{$tcinfo['cmkttrung']}}</td>
						<td>{{$tcinfo['cmktkhac']}}</td>
						<td>{{$tcinfo['hdkhongthoihan']}}</td>
						<td>{{$tcinfo['hdcothoihan']}}</td>
						<td>{{$tcinfo['hdkhac']}}</td>
						<td></td>
					  </tr>
					  <tr>
						<td>4</td>
						<td>Hộ kinh doanh</td>
						<td>{{$hkdinfo['tong']}}</td>
						<td>{{$hkdinfo['nu']}}</td>
						<td>{{$hkdinfo['age']}}</td>
						<td>{{$hkdinfo['bhxh']}}</td>
						<td>{{$hkdinfo['quanly']}}</td>
						<td>{{$hkdinfo['cmktcao']}}</td>
						<td>{{$hkdinfo['cmkttrung']}}</td>
						<td>{{$hkdinfo['cmktkhac']}}</td>
						<td>{{$hkdinfo['hdkhongthoihan']}}</td>
						<td>{{$hkdinfo['hdcothoihan']}}</td>
						<td>{{$hkdinfo['hdkhac']}}</td>
						<td></td>
					  </tr>
					  <tr>
						<td></td>
						<td>Tổng</td>
						<td>{{$einfo['tong']}}</td>
						<td>{{$einfo['nu']}}</td>
						<td>{{$einfo['age']}}</td>
						<td>{{$einfo['bhxh']}}</td>
						<td>{{$einfo['quanly']}}</td>
						<td>{{$einfo['cmktcao']}}</td>
						<td>{{$einfo['cmkttrung']}}</td>
						<td>{{$einfo['cmktkhac']}}</td>
						<td>{{$einfo['hdkhongthoihan']}}</td>
						<td>{{$einfo['hdcothoihan']}}</td>
						<td>{{$einfo['hdkhac']}}</td>
						<td></td>
					  </tr>
					</tbody>
				  </table>
				  <table class="table table-bordered text-center">
		
			  <tr>
				<td colspan=9></td>
				<td colspan=5>
					<h4>Giám đốc </h4> <br>
					<i>(Chữ ký,dấu )</i> <br>
					
				</td>
			  </tr>
		
		</table>
	
</body>
</html>
