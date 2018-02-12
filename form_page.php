<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<title></title>
</head>
<body style="background-image: url('http://saberprevidenciario.com.br/wp-content/uploads/2017/10/medico-2.jpg'); background-attachment: fixed; font-family: Jazz LET, fantasy;">

	<div><h1 align="center" style="font-size: 45px;">Health Help</h1></div>

	<div align="center"> <h2>Select type that you want to check</h2></div>
	<br>
	<div align="center">
		<select id = "menu">
			<option selected="selected" value="no">Choose Type</option>
			<option value="BMI">BMI</option>
			<option value="BMR">BMR</option>
			<option value="Cholesterol">Cholesterol</option>
		</select>
	</div>

	<br>
	<br>
	<br>

	<form align="center" id="form" action="result.php" onsubmit="return checkEmpty()" method="post">
	</form>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<section>
		<div align="center"><h2>Definition</h2></div>
		<br>
		<table>
			<tr>
				<td class="definition" align="center">
					<h3>BMI</h3>
					<p>
						Body Mass Index (BMI) คือ อัตราส่วนระหว่างน้ำหนักต่อส่วนสูง ที่ใช้บ่งว่าอ้วนหรือผอม ในผู้ใหญ่ตั้งแต่อายุ 20 ปีขึ้นไป ความสำคัญของการรู้ค่าดัชนีมวลร่างกาย เพื่อดูอัตราการเสี่ยงต่อการเกิดโรคต่างๆ ถ้าค่าที่คำนวนได้ มากหรือน้อยเกินไป.
					</p>
					
				</td>
				<td class="definition" align="center">
					<h3>BMR</h3>
					<p>
						Basal Metabolic Rate (BMR) คือ อัตราการความต้องการเผาผลาญของร่างกายในชีวิตประจำวัน หรือจำนวนแคลอรี่ขั้นต่ำที่ต้องการใช้ในชีวิตแต่ละวัน ดังนั้นการคำนวณ BMR จะช่วยให้คุณคำนวณปริมาณแคลอรี่ที่ใช้ต่อวันเพื่อรักษาน้ำหนักปัจจุบันได้
					</p>
					
				</td>
				<td class="definition" align="center">
					<h3>Cholesterol</h3>
					<p>
						Cholesterol คือ สารไขมันคล้ายขี้ผึ้งหรือที่เรียกว่าลิพิด (สารชีวโมเลกุลที่ไม่ละลายในน้ำ) ที่ไหลเวียนอยู่ในเลือดของมนุษย์ คอเลสเตอรอลมีหน้าที่สำคัญในการคงสภาพเยื่อชั้นนอกของเซลล์ต่างๆ ในร่างกาย
					</p>
					
				</td>
			</tr>
		</table>
	</section>



</body>

<script>
	var clickNum = 0;
	$('#menu').click(function() {
		// body...
		if (clickNum == 0){
			clickNum++;
		}
		else {
			let selected = $.trim($('#menu :selected').text());
			console.log(selected);
			$('#form').load('input_form.html #' + selected);
			clickNum = 0;
		}
	});

	// check empty before send form
	function checkEmpty(){
		let breakout = false;
		$('#form :input').each(function(){
			if ($(this).val() == ''){
				if ($(this).attr("type") == 'text'){
					alert('Please Enter ' + $(this).attr("name"));
				}
				else if ($(this).attr("type") == 'radio'){
					alert('Please Select the ' + $(this).attr("name"));
				}
				
				breakout = true;
				return false;
			}
		});	
		if (breakout == true){
			breakout = false;
			return false;
		}
	}
</script>
<style>
	body {
		width: 70%;
	}
	h2 {
		font-size: 36px;

	}
	.detail {
		border-style: inset;
		border-width: 15px;
		border-color: #FF5F5F;
		background-color: #FFC9C9;		
	}
	.definition {
		border-style: inset;
		border-width: 15px;
		border-color: #EF9850;
		background-color: #FFDBBE;
		color: brown;
		width: 400px;
		padding: 20px;
	}
</style>
</html>