<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<title>result</title>
</head>
<body style="background-image: url('https://cdn.marathontesting.com/wp-content/uploads/2017/01/marathon-track.jpg'); background-attachment: fixed; font-family: 'Sniglet', cursive; color: #088FC3;">

	<?php 
		$data =$_POST;
		$degree = ['BMI' => "", 'BMR' => "BMR", 'ldl' => "", 'hdl' => "", 'triglyceride' => "", 'cholesterol' => ""];
		$result = 0;
		$burn = 0;
		if ($data['category'] == 'BMI'){
			$result = $data['weight']/(($data['height']/100)**2);

			// check result case
			if ($result > 40){
				$degree["BMI"] = 'b6';
			}
			else if ($result >= 35){
				$degree["BMI"] = 'b5';
			}
			else if ($result >= 28.5){
				$degree["BMI"] = 'b4';
			}
			else if ($result >= 23.5){
				$degree["BMI"] = 'b3';
			}			
			else if ($result >= 18.5){
				$degree["BMI"] = 'b2';
			}
			else {
				$degree["BMI"] = 'b1';
			}
		}
		else if($data['category'] == 'BMR'){
			if ($data['gender'] == 'female'){
				$result = 665 + (9.6 * $data['weight']) + (1.8 * $data['height']) - (4.7 * $data['age']);
			}
			else {
				$result = 66 + (13.7 * $data['weight']) + (5 * $data['height']) - (6.8 * $data['age']);
			}

			// calculate burn by exercise
			$burn = $result * $data['activity'];
		}
		else if ($data['category'] == 'Cholesterol'){
			$result = $data['ldl'] + $data['hdl'] + ($data['triglyceride']/5);

			// degree of each result
			// ldl
			if ($data['ldl'] > 190){
				$degree["ldl"] = "Several High: ไขมันแอลดีแอลสูงมาก";
			}
			else if($data['ldl'] >= 160){
				$degree["ldl"] = "High: ไขมันแอลดีแอลสูง";
			}
			else if($data['ldl'] >= 160){
				$degree["ldl"] = "Borderline: ไขมันแอลดีแอลค่อนข้างสูง";
			}
			else if($data['ldl'] >= 160){
				$degree["ldl"] = "Near Optimal: ไขมันแอลดีแอลสูงเล็กน้อย";
			}
			else {
				$degree["ldl"] = "Ideal: ไขมันแอลดีแอลต่ำ";
			}

			// hdl
			// degree of each result
			if ($data['hdl'] >= 60){
				$degree["hdl"] = "ดีมาก";
			}
			else if($data['hdl'] >= 40){
				$degree["hdl"] = "ค่อนข้างเสี่ยงที่จะเป็นโรคหัวใจ";
			}
			else {
				$degree["hdl"] = "มีความเสี่ยงสูงที่จะเป็นโรคหัวใจ";
			}

			// triglyceride
			if ($data['triglyceride'] > 500){
				$degree['triglyceride'] = "Extreamly High";
			}
			else if($data['triglyceride'] >= 200){
				$degree['triglyceride'] = "High";
			}
			else if($data['triglyceride'] >= 150){
				$degree['triglyceride'] = "Elevated";
			}
			else {
				$degree['triglyceride'] = "Ideal";
			}

			// total cholesterol
			if ($result >= 240){
				$degree["cholesterol"] = "สูง";
			}
			else if($result >= 200){
				$degree["cholesterol"] = "ค่อนข้างสูง";
			}
			else {
				$degree["cholesterol"] = "ดีมาก";
			}			

		}
	 ?>

	 <div><h3 style="margin: 0px 0px 0px 200px; background-color: #FFDBBE; border-radius: 15px; font-size: 60px; width: 80%;" align="center">Your <?php echo $data['category'] ?> result is: <?php echo $result ?></h3></div>
	 <br>
	 <br>
	 <div id="case"></div>
	 <br>
	 <br>
	 <div align="center"><a href="index.php"><img align="center" src="http://oidb.gov.in/images/back_button.png"></a></div>

	<script>
		$(document).ready(function() {
			// body...
			$('#case').load('result_form.php #'+<?php echo json_encode($data['category']); ?>, function(){
				if (<?php echo json_encode($data['category']); ?> == "BMI"){
					$("#" + <?php echo json_encode($degree['BMI']); ?>).css("border","10px solid #1FAEE5");
					$("#" + <?php echo json_encode($degree['BMI']); ?>).css("background-color", "#C1FFDE");
				}
				else if(<?php echo json_encode($data['category']); ?> == "BMR"){
					$('#burn').html("Your Total Daily Energy Expenditure: " + <?php echo json_encode($burn); ?>);
					$('#burn').css("font-size", "35px");
					$('#burn').css("border-radius", "15px");
					$('#burn').css("background-color", "#FFDBBE");
					$('#burn').css("width", "80%");
					$('#burn').css("margin", "0px 0px 0px 200px");
				}				
				else if (<?php echo json_encode($data['category']); ?> == "Cholesterol"){
					$('#ldl').html(<?php echo json_encode($degree['ldl']); ?>);
					$('#hdl').html(<?php echo json_encode($degree['hdl']); ?>);
					$('#triglyceride').html(<?php echo json_encode($degree['triglyceride']); ?>);
					$('#total').html(<?php echo json_encode($degree['cholesterol']); ?>);
					$('td').css("border","10px solid #1FAEE5");
					$('td').css("background-color", "#C1FFDE");
				}
			});

		});
	</script>

</body>

<style >
	td {
		border-style: dashed;
		border-color: #1FAEE5;
		width: 200px;
		text-align: center;
		padding: 35px;
	}
</style>
</html>