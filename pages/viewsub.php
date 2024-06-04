<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
	<title>Slamify-submissions</title>
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../css/viewsub.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
	<Style>
		body{
			font-family: 'Marck Script', cursive;
			background-image:url('../images/circlebg.png');
		}
		</style>
	<script>
		$(document).ready(function() {
			// get the table name from the URL
			const urlParams = new URLSearchParams(window.location.search);
			const table_name = urlParams.get('table_name');

			// load the names of all submissions into the left container
			$.ajax({
				url: "getname.php",
				type: "GET",
				dataType: "json",
				data: {table_name: table_name},
				success: function(response) {
					const table = $("<table>");
					$.each(response, function(index, value) {
						const row = $("<tr>");
						const button = $("<button>").addClass("name").attr("data-name", value).text(value);
						const cell = $("<td>").append(button);
						row.append(cell);
						table.append(row);
					});
					$("#names").append(table);

					// display the first submission by default
					if ($(".name").length > 0) {
						const first_name = $(".name").eq(0).data("name");
						$("#answers").load("getrowdata.php?table_name=" + table_name + "&name=" + first_name);
					} else {
						$("#answers").html("<h2>No submissions for " + table_name + "</h2>");
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
				}
			});

			// when a name button is clicked, display the corresponding submission
			$("#names").on("click", ".name", function() {
				const name = $(this).data("name");
				$("#answers").load("getrowdata.php?table_name=" + table_name + "&name=" + name);
			});
		});
	</script>
</head>
<body>
<header>
		<nav class="nav">
		  <a href="../pages/main.html" class="logo">Slamify</a>
  
		  <div class="hamburger">
			<span class="line"></span>
			<span class="line"></span>
			<span class="line"></span>
		  </div>
  
		  <div class="nav__link hide">
			<a href="../pages/main.html#about_section">create</a>
			<a href="../pages/searchslam.html">Write</a>
			<a href="../pages/view.php">Read</a>
			<a href="../pages/slamques.html">Questions for u</a>
			<a href="../pages/about.html">About us</a>
		  </div>
		</nav>
	  </header>
	<div class="container">
		<div id="names"></div>
    <div class="form-container">
      <h1>Slam Answers</h1>
      <div class="form-card">
		<div id="answers"></div></div></div>
	</div>
	<script src="../js/nav.js"></script>
</body>
</html>