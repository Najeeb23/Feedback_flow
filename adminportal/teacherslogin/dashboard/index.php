<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<script src="../../../scripts/material.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Product+Sans:500,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="../../../styles/material.min.css">
	<link rel="stylesheet" href="../../../styles/main.css">
	<link rel="icon" type="image/png" href="../../../images/logo.png">
	<title>Dashboard | Feedie</title>
</head>

<body class="mdl-demo mdl-color-text--grey-900 mdl-base">
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header mdl-color--white mdl-color-text--grey-600">
			<div class="mdl-layout__header-row">
				<a href="../">
					<button class="mdl-button mdl-js-button mdl-button--icon">
						<i class="material-icons">home</i>
					</button>
				</a>
				<span class="mdl-layout-title">Feedie</span>
				<div class="mdl-layout-spacer"></div>
				<span class="mdl-layout-title">
					<?php
						include('../../../db_config.php');
						session_start();
						if (!isset($_SESSION["te_username"])){
							header('Location: ../../');
						}
						echo $_SESSION["te_username"];
						echo " &middot; ";
						echo $_SESSION["dept"];
					?>
				</span>
				<button id="more" class="mdl-button mdl-js-button mdl-button--icon">
					<i class="material-icons">account_circle</i>
				</button>
				<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="more">
					<a href="../../?logout=1">
						<li class="mdl-menu__item">
							<i class="material-icons" role="presentation">exit_to_app</i>
							Logout
						</li>
					</a>
				</ul>
			</div>
			<div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--white">
				<a href="#overview" class="mdl-layout__tab is-active">Feedback</a>
				<a href="#account" class="mdl-layout__tab">Profile</a>
			</div>
		</header>
		<main class="mdl-layout__content">
			<div class="mdl-layout__tab-panel is-active" id="overview">
				<section class="section--center mdl-card mdl-grid mdl-grid--no-spacing">
					<h4 class="mdl-cell mdl-cell--12-col">Subjects</h4>
					<?php
						$sql = "SELECT class, sub_name, sub_code FROM teachersinfo WHERE te_username = '".$_SESSION["te_username"]."'";
						$result = $conn->query($sql);
						if($result->num_rows > 0) {
							while($row = $result->fetch_assoc()){
					?>
					<div onclick="location.href='feedshow/?class=<?php echo $row["class"]; ?>&sub_code=<?php echo $row["sub_code"] ?>'" class="mdl-cell mdl-cell--12-col mdl-grid subjects">
						<div class="flex-center mdl-cell mdl-cell--1-col">
							<span class="mdl-color-text--green-a400">
								<i class="material-icons">done</i>
							</span>
						</div>
						<div class="section__text mdl-cell mdl-cell--11-col-desktop mdl-cell--7-col-tablet mdl-cell--3-col-phone">
							<h5>
								<?php echo $row["sub_name"]; ?> (<?php echo $row["class"]; ?>)
							</h5>
						</div>
					</div>
					<?php
							}
						}
					?>
				</section>
			</div>
			<div class="mdl-layout__tab-panel" id="account">
				<section class="section--center mdl-card mdl-grid mdl-grid--no-spacing">
					<h4 class="mdl-cell mdl-cell--12-col">Account</h4>
					<div class="mdl-cell mdl-cell--12-col mdl-grid">
						<div class="flex-center mdl-cell mdl-cell--1-col">
							<span class="mdl-color-text--red-a400">
								<i class="material-icons">close</i>
							</span>
						</div>
						<div class="section__text mdl-cell mdl-cell--11-col-desktop mdl-cell--7-col-tablet mdl-cell--3-col-phone">
							<h5>
								Name: <span style="text-transform: capitalize;"><?php echo $_SESSION["te_username"]; ?></span>
							</h5>
						</div>
					</div>
					<div class="mdl-cell mdl-cell--12-col mdl-grid">
						<div class="flex-center mdl-cell mdl-cell--1-col">
							<span class="mdl-color-text--red-a400">
								<i class="material-icons">close</i>
							</span>
						</div>
						<div class="section__text mdl-cell mdl-cell--11-col-desktop mdl-cell--7-col-tablet mdl-cell--3-col-phone">
							<h5>
								Department: <?php echo $_SESSION["dept"]; ?>
							</h5>
						</div>
					</div>
					<h4 class="mdl-cell mdl-cell--12-col">Change password</h4>
					<form action="" method="post">
						<div class="mdl-grid mdl-grid--no-spacing">
							<div class="flex-center mdl-cell mdl-cell--1-col">
								<div class="section__circle-container__circle mdl-color-text--amber-300">
									<i class="material-icons">vpn_key</i>
								</div>
							</div>
							<div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--2-col-phone">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="password" name="currentpassword" id="currentpassword">
									<label class="mdl-textfield__label">Current password</label>
								</div>
							</div>
							<div class="flex-center mdl-cell mdl-cell--1-col">
								<span onclick="cptoggler()" class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent">
									<i id="cp" class="material-icons">visibility_off</i>
								</span>
							</div>
							<div class="flex-center mdl-cell mdl-cell--1-col">
								<div class="section__circle-container__circle mdl-color-text--green-a400">
									<i class="material-icons">vpn_key</i>
								</div>
							</div>
							<div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--2-col-phone">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="password" name="newpassword" id="newpassword">
									<label class="mdl-textfield__label">New password</label>
								</div>
							</div>
							<div class="flex-center mdl-cell mdl-cell--1-col">
								<span onclick="nptoggler()" class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent">
									<i id="np" class="material-icons">visibility_off</i>
								</span>
							</div>
							<div class="flex-center mdl-cell mdl-cell--1-col">
								<div class="section__circle-container__circle mdl-color-text--green-a400">
									<i class="material-icons">vpn_key</i>
								</div>
							</div>
							<div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--2-col-phone">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="password" name="renewpassword" id="renewpassword">
									<label class="mdl-textfield__label">Retype new password</label>
								</div>
							</div>
							<div class="flex-center mdl-cell mdl-cell--1-col">
								<span onclick="rptoggler()" class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent">
									<i id="rp" class="material-icons">visibility_off</i>
								</span>
							</div>
							<div class="mdl-cell mdl-cell--12-col questions">
								<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
									Change password
								</button>
							</div>
							<script>
								function cptoggler() {
									if (document.getElementById("cp").innerHTML == 'visibility_off') {
										document.getElementById("cp").innerHTML = 'visibility';
										document.getElementById("currentpassword").type = "text";
									} else {
										document.getElementById("cp").innerHTML = 'visibility_off';
										document.getElementById("currentpassword").type = "password";
									}
								}

								function nptoggler() {
									if (document.getElementById("np").innerHTML == 'visibility_off') {
										document.getElementById("np").innerHTML = 'visibility';
										document.getElementById("newpassword").type = "text";
									} else {
										document.getElementById("np").innerHTML = 'visibility_off';
										document.getElementById("newpassword").type = "password";
									}
								}

								function rptoggler() {
									if (document.getElementById("rp").innerHTML == 'visibility_off') {
										document.getElementById("rp").innerHTML = 'visibility';
										document.getElementById("renewpassword").type = "text";
									} else {
										document.getElementById("rp").innerHTML = 'visibility_off';
										document.getElementById("renewpassword").type = "password";
									}
								}

							</script>
							<div class="mdl-cell mdl-cell--12-col mdl-color-text--red-a400 questions">
							</div>
						</div>
					</form>
				</section>
			</div>
		</main>
	</div>
</body>

</html>
