<?php 
class TimeTravel{

	public $start;
	public $end;
	
	public function __construct(DateTime $start, DateTime $end)
	{
		$this->start=$start;
		$this->end=$end;
	}

	public function getTravelInfo()
	{
		$interval=$this->end->diff($this->start);
		return $interval->format('Il y a %y années, %m mois, %d jours et %h heures, %i minutes, %s secondes entre les deeux dates.');
	}

	public function findDate(DateTime $interval) : DateTime
	{
		$interval->sub(new DateInterval('PT1000000000S'));
		return $interval;
	}

	public function backToFuturStepByStep()
	{
		$interval=new DateInterval('P1M1W1D');
		$period = new DatePeriod($this->start, $interval, $this->end, DatePeriod::EXCLUDE_START_DATE);
		foreach ($period as $per) {
			echo " -> " . $per->format('d-m-Y a:h:i:s');
		}

	}
}
$start = new DateTime('1954-04-23');
$end = new DateTime('1985-12-31');
$timeTravel = new TimeTravel($start, $end);
echo $timeTravel->getTravelInfo() . "<br>";
echo "Date probable d'arrivée " . $timeTravel->findDate(new DateTime('1985-12-31'))->format('d-m-Y h:i:s') . "<br>";
echo $timeTravel->backToFuturStepByStep();

