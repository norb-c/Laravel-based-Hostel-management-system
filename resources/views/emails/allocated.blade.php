@component('mail::message')
# Payment Successful

A bed space has been allocatd to you Successfully with
the following details
<?php
$floor;
if ($mail->floor == 1) {
	$floor = 'First Floor';
} elseif($mail->floor == 2) {
	$floor = 'Second Floor';
}else{
	$floor = 'Third Floor';
}

?>

@component('mail::table')
|Details  | |
|--|--|
|Campus | {{ucwords($mail->campus->name)}} |
|Hostel | {{ucwords($mail->hostel->name)}} |
|Floor | {{$floor}} |
|Room Number | {{$mail->room_no}} |
|Bed Position | {{ucfirst($mail->bed)}} Space|
|Payment Receipt ID |   {{$mail->receipt}} |
@endcomponent

Thanks,<br>
NAU {{ config('app.name') }}
@endcomponent
