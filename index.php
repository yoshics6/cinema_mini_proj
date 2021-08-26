<!DOCTYPE html>
<html>
	<head>
		<title>ระบบบริหารจัดการตั๋วหนัง</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- Sweet alert 2 -->
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="data_cinema.js"></script>
		<link rel="stylesheet" href="css_cinema.css">		
	</head>
	
	<body>
		<div class="container">
			<br />
			<h3 align="center">ระบบบริหารจัดการตั๋วหนัง</h3>
			<br />

			<input class="form-control" id="filter" name="filter" type="text" class="txt" placeholder="ค้นหา"><br/>

			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" onclick="add()" class="btn btn-info">เพิ่มข้อมูล</button>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr class="bg-info">
							<th width="5%">ลำดับ</th>	
							<th width="10%">ชื่อเรื่อง</th>
							<th width="30%">คำอธิบาย</th>
							<th width="10%">ติดต่อข้อมูล</th>
							<th width="8%">วันที่สร้าง</th>
							<th width="15%">เวลาอัพเดทตั๋วล่าสุด</th>
							<th width="10%">สถานะ</th>							     
							<th width="12%">จัดการ</th> 							 
						</tr>
					</thead>
					<tbody id="tbody_show"></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<!-- insert -->

<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="signinModelLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<!-- Modal body -->
			<form action="" name="add_data_flow" id="add_data_flow" method="post">
				<div class="modal-body">
					<div>ชื่อเรื่อง</div>
					<div>
						<input class="form-control" id="c_title_add" name="c_title_add" type="text" class="txt" placeholder="" >
					</div><br/>
					
					<div>คำอธิบาย</div>	
					<div>
						<textarea class="form-control" id="c_description_add" name="c_description_add" rows="10"></textarea>
					</div><br/>  
					
					<div>ติดต่อข้อมูล</div>	
					<div>
						<input class="form-control" id="c_contact_information_add" name="c_contact_information_add" type="text" class="txt" placeholder="">
					</div><br/>       
					
					<div>วันที่สร้าง</div>	
					<div>
						<input class="form-control" id="c_created_timestamp_add" name="c_created_timestamp_add" type="date" class="txt" placeholder="">
					</div><br/>				
					
					<div>เวลาอัพเดทตั๋วล่าสุด</div>	
					<div>
						<input class="form-control" id="c_latest_ticket_update_timestamp_add" name="c_latest_ticket_update_timestamp_add" type="text" class="txt" placeholder=""
						value="<?php date_default_timezone_set('Asia/Bangkok'); echo date("d/m/Y , H:i:s A", strtotime(date("Y/m/d , h:i:s")))?>" readonly>
					</div><br/>						              
					
					<div>สถานะ</div>					
					<div>
						<select class="form-control" id="c_status_add" class="txt" name="c_status_add">
							<option value="">--- กรุณาเลือก ---</option>
							<option value="รอดำเนินการ">รอดำเนินการ</option>
							<option value="ยอมรับ">ยอมรับ</option>
							<option value="แก้ไขแล้ว">แก้ไขแล้ว</option>
							<option value="ปฏิเสธ">ปฏิเสธ</option>						
						</select>
					</div><br/>
					
					<div class="form-submit text-center">
						<div onclick="add_data()" class="btn btn-success">บันทึก</div>
					</div>
				</div>
			</form>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
			</div>
		</div>
	</div>
</div>

<!-- end insert -->

<!-- edit modal -->

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="signupModelLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">แก้ไขข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
			<!-- Modal body -->
			<div class="modal-body">
				<div>ชื่อเรื่อง</div>
				<div>
					<input class="form-control" id="c_title" type="text" class="txt" placeholder="">
				</div><br/>
				
				<div>คำอธิบาย</div>	
				<div>
					<textarea class="form-control" id="c_description" rows="10"></textarea>
				</div><br/>  
				
				<div>ติดต่อข้อมูล</div>	
				<div>
					<input class="form-control" id="c_contact_information" type="text" class="txt" placeholder="">
				</div><br/>       
				
				<div>วันที่สร้าง</div>	
				<div>
					<input class="form-control" id="c_created_timestamp" type="date" class="txt" placeholder="">
				</div><br/>				
				
				<div>เวลาอัพเดทตั๋วล่าสุด</div>	
				<div>
					<input class="form-control" id="c_latest_ticket_update_timestamp" type="text" class="txt" placeholder=""
					value="<?php date_default_timezone_set('Asia/Bangkok'); echo date("d/m/Y , H:i:s A", strtotime(date("Y/m/d , h:i:s")))?>" readonly>
				</div><br/>			
				
				<div>สถานะ</div>					
				<div>
					<select class="form-control" id="c_status" class="txt">
						<option value="">--- กรุณาเลือก ---</option>
						<option value="รอดำเนินการ">รอดำเนินการ</option>
						<option value="ยอมรับ">ยอมรับ</option>
						<option value="แก้ไขแล้ว">แก้ไขแล้ว</option>
						<option value="ปฏิเสธ">ปฏิเสธ</option>						
					</select>
				</div><br/>
				
				<div class="form-submit text-center">
					<div onclick="update_cinema()" class="btn btn-success">บันทึก</div>
				</div>
			</div>
			
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
			</div>
			
		</div>
	</div>
</div>