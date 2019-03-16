<style>
body {
	font-family: Roboto, Arial, Segoe UI, sans-serif;
}

.card-brexit {
	border-top: 3px solid #003399;
	border-bottom: 3px solid #ffcc00;
}

.badge-brexit {
	background: #003399;
	color: #ffcc00;
}

.cd-digit {
	text-align: center;
}

.cd-spacer {
	font-size: 60px;
	color: #6c757d;
}

.cd-digit .cd-number {
	display: block;
	font-size: 60px;
	font-weight: bold;
}

.cd-digit .cd-label {
	display: block;
	margin-top: -20px;
}
</style>
<div class="bg-light py-4">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1 class="display-1">BrexitApp</h1>
				<p class="lead">A website to aid with Britans exit from the European Uninon</p>
			</div>
			<div class="col-md-6">
				<div class="card card-brexit">
					<div class="card-body">
						<p><span class="badge badge-brexit">Brexit Countdown</span> 29 March 11pm</p>
						<div class="d-flex justify-content-center">
							<div class="cd-digit">
								<span id="days" class="cd-number">0</span>
								<span class="cd-label">Days</span>
							</div>
							<div class="cd-spacer">:</div>
							<div class="cd-digit">
								<span id="hours" class="cd-number">0</span>
								<span class="cd-label">Hours</span>
							</div>
							<div class="cd-spacer">:</div>
							<div class="cd-digit">
								<span id="minutes" class="cd-number">0</span>
								<span class="cd-label">Minutes</span>
							</div>
							<div class="cd-spacer">:</div>
							<div class="cd-digit">
								<span id="seconds" class="cd-number">0</span>
								<span class="cd-label">Seconds</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
(function (d, DEADLINE, serverTime) {
var timeDelta = serverTime - (Date.now() + 3600000) / 1000,
  interval;
var UI = {
  days: d.getElementById('days'),
  hours: d.getElementById('hours'),
  minutes: d.getElementById('minutes'),
  seconds: d.getElementById('seconds')
};
function getTimeRemaining() {
  var dt = DEADLINE - (Date.now() + 3600000) / 1000 - timeDelta;
  return {
    total: dt,
    days: Math.floor(dt / (60 * 60 * 24)),
    hours: Math.floor((dt / (60 * 60)) % 24),
    minutes: Math.floor((dt / 60) % 60),
    seconds: Math.floor(dt % 60)
  };
}
function updateClock() {
  var t = getTimeRemaining();
  if (t.total < 0) {
    clearInterval(interval);
    return;
  }
  UI.days.innerHTML = t.days;
  UI.hours.innerHTML = ('0' + t.hours).slice(-2);
  UI.minutes.innerHTML = ('0' + t.minutes).slice(-2);
  UI.seconds.innerHTML = ('0' + t.seconds).slice(-2);
}
d.documentElement.className = 'js';
interval = setInterval(updateClock, 1000);
updateClock();
})(document, 1553900400, Date.now() / 1000);
</script>
