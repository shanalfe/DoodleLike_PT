<!DOCTYPE html>
<html>
	<head>
		<title>DoodleLike</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

		<style>
			body, h1
			{
				font-family: "Raleway", sans-serif;
				color: rgb(255, 255, 255);
			}

			body, html
			{
				height: 100%;
			}

			.bgimg
			{
				background-image: url('https://static.vecteezy.com/system/resources/previews/001/979/978/non_2x/morning-fog-in-dense-tropical-rainforest-kaeng-krachan-thailand-free-photo.jpg');
				min-height: 100%;
				background-position: center;
				background-size: cover;
			}



			.FinalCountdown
			{
				display: flex;
				height: 100vh;
				width: 100%;
			}

			.countdown-wrapper
			{
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				width: 100%;
				color: white;
			}

			.countdown {
				margin: 0;
				margin-top: 15px;
				margin-bottom: 40px;
				letter-spacing: 4.2px;
				text-transform: uppercase;
				text-align: center;
				font-size: 20px;
			}
		</style>
	</head>

	<body>
		<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
			<div class="w3-display-topleft w3-padding-large w3-xlarge">
				DoodleLike
			</div>
			<div class="w3-display-middle">
				
				
				<!--<p class="w3-large w3-center">35 days left</p>-->
				<div class="FinalCountdown">
					<div class="countdown-wrapper">
						<h1 class="w3-jumbo w3-animate-top bg-text">COMING SOON</h1>
						<span class="countdown">
							<span class="day">-</span> days,
							<span class="hours">-</span> houres,
							<span class="minutes">-</span> minutes,
							<span class="seconds">-</span> secondes
						</span>
					</div>
				</div>
			</div>
			<div class="w3-display-bottomleft w3-padding-large">
				Powered by <a href="https://dwarves.iut-fbleau.fr/~lefevres/V4/">Shana LEFEVRE</a> & <a href="https://dwarves.iut-fbleau.fr/~decorbeza/Portfolio/">Arthur DECORBEZ</a>
			</div>
		</div>

		<script>
			function timeDiffCalc(diffDate)
			{
				let diffInMilliSeconds = Math.abs(diffDate) / 1000;

				const days = Math.floor(diffInMilliSeconds / 86400);
				diffInMilliSeconds -= days * 86400;

				const hours = Math.floor(diffInMilliSeconds / 3600) % 24;
				diffInMilliSeconds -= hours * 3600;

				const minutes = Math.floor(diffInMilliSeconds / 60) % 60;
				diffInMilliSeconds -= minutes * 60;

				const seconds = Math.floor(diffInMilliSeconds);

				return { days, hours, minutes, seconds };
			}

			document.addEventListener("DOMContentLoaded", () => {
				const day = document.querySelector('.day');
				const hours = document.querySelector('.hours');
				const minutes = document.querySelector('.minutes');
				const seconds = document.querySelector('.seconds');

				const endDate = new Date(1624053599000).getTime();

				setDiffDate()
				const interval = setInterval(setDiffDate, 1000);

				function setDiffDate()
				{
					const diffDate = endDate - Date.now();
					if (diffDate <= 0)
					{
						clearInterval(interval.current);
						return;
					}

					setDiff(timeDiffCalc(diffDate));
				}

				function setDiff(diffDate)
				{
					day.textContent = diffDate.days
					hours.textContent = diffDate.hours
					minutes.textContent = diffDate.minutes
					seconds.textContent = diffDate.seconds
				}
			})
		</script>
	</body>
</html>