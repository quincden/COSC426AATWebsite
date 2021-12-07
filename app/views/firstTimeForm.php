<!DOCTYPE html>
<html lang="en">
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="public/css/nav.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<link rel="stylesheet" href="public/css/scheduleNew.css">

	<?php
		ob_start();
		session_start();
		// require 'vendor/autoload.php';

		// include_once 'funcs/CourseFunctions.php';
		// include_once 'funcs/StudentFunctions.php';
		// include_once 'funcs/FourYearFunctions.php';

		// available courses
		echo '<script> var available_courses = ' . json_encode( getCoursebyRegex("", "", "", ""))  . '; </script>';

		//student information
		//$student = getStudent($_SESSION['username']);
		$student_name = $_POST['name'];
		$student_id = $_POST['s_id'];
		
	?>
    
</head>

<body>
<header>
		<h2>Salisbury University</h2>
	</header>

	<datalist id="available_courses"></datalist>
	<datalist id="recommended_courses"></datalist>

	<script>
		available_courses = available_courses.filter(function(val){
			return val["Allowd Unt"] != "999.00";
		});

		// sort by course number
		available_courses.sort(function(a,b) {
			if ( a["Subject"] > b["Subject"] ){ return 1;}
			else if( a["Subject"] < b["Subject"] ) { return -1;}
			else { // same
				if (a["Catalog"] > b["Catalog"]) { return 1; }
				else { return -1; }
			}
		});

		var text = "";
		var seperator =  Array(4).fill(' ').join(''); //4 blank space
		available_courses.forEach( val => text += '<option value="'+ val["Subject"] + " " +$.trim(val["Catalog"])+ seperator + val["Long Title"] + seperator + val["Allowd Unt"] + '">');
		$('#available_courses').html( text );
	</script>

	

		<div id="content" style="overflow: auto; width: 80%; margin: auto; border: none;">
		<div class="welcome">
			<?php echo "<h1> Welcome To The Academic Planner</h1>"; ?>
		</div>
        <div class="title">
            <h1 style="margin-top: 5px;">Course History</h1>
            <p style="margin-top: 5px;">Please enter all courses you have completed at Salisbury University</p>
            <p style="margin-top: 5px; margin-bottom: 15px;">This will help your advisors determine which courses are best for you</p>
        </div>
			<div class="schedule-new" style="background: #f0eeea;">
				<form action="" id="programplanningworksheet">
					<div id="coursesearchsection" style="margin:20px auto 40px auto; width:50%; border-bottom: solid 1px; ">
						<div style="display:inline-block; padding: 15px;">
							<label for="course" style="margin: auto;">Search for a course <br> <font size="2">enter a subject, course number, title or credit amount</font></label><br>
							<input list="available_courses" id="coursesearch" name="coursesearch" style="width:31vw;">
						</div>
						<button type='button' onclick="scheduleAddCourse(coursesearch.value, '', false)">Add</button>
					</div>

					<!-- Course table goes here -->
					<div id="schedule-course">
						<table id="schedule-coursetable">
							<tr>
								<b>
									<th style="width:10%px;">Course Number<span class="required">*</span></th>
									<th style="width:50%;">Title</th>
									<th style="width:5%;">Credits</th>
									<th style="width:20%;">Fulffilment</a></th>
									<th></th>
								</b>
							</tr>
						</table>
					</div>
                    <input type="hidden" id="forBackup" name="forBackup" value="No">
					<input type="hidden" id="studentname" name="studentname" value=<?php echo $student_name; ?>>
					<input type="hidden" id="studentid" name="studentid" value=<?php echo $student_id; ?>>
					<button type="button" onclick="saveStudent_firstTime()">Submit</button>

				</form>
			</div>
		</div>
</div> <!-- flexbox div ends -->
<script>
	$('nav ul .schedule-show').toggleClass("sch");
	$('nav ul .first').toggleClass("rotate");
	$('.schedule-new-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});

</script>

<!-- table and buttons functionalities -->
<script src="public/js/scheduleNewFuncs.js"></script>


</body>
</html>