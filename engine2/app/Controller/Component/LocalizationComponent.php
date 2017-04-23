<?php
App::uses('Component', 'Controller');
class LocalizationComponent extends Component
{
	public $langsArray=array(
		'English'=>array(
				'emailSub'=>'THAI ATRIUM: your order has been placed',
				'orderSuccess'=>'Thank you so much!Your order has been successfully submitted!',
				'orderError'=>'The Order Could not be saved',
				'emailError'=>'Something Wrong. Email Could not be sent.',
				'OrderTamplate'=>'ordersuccess_en',
				'reservationTamplate'=>'reservations_en',
				'ad_reservationTamplate'=>'ad_reservations_en',
				'reservationSuccess'=>'Thank you for your reservation request.you will get a confirmation email soon.',
				'ad_reservationSuccess'=>'A new reservation come from your new customer',
				'reservationSubject'=>'Thai-Atrium reservation',
				'ad_reservationSubject'=>'Thai Atrium Neue Reservierung.',
				'lang_id'=>'1',
				),
		'German'=>array(
				'emailSub'=>'THAI ATRIUM: Ihre Bestellung wurde aufgegeben',
				'orderSuccess'=>'Vielen Dank! Deine Bestellung wurde erfolgreich übermittelt!',
				'orderError'=>'Der Auftrag konnte nicht gespeichert werden',
				'emailError'=>'Etwas stimmt nicht. E-Mail konnte nicht gesendet werden.',
				'OrderTamplate'=>'ordersuccess',
				'reservationTamplate'=>'reservations',
				'ad_reservationTamplate'=>'ad_reservations',
				'reservationSuccess'=>'Vielen Dank für Ihre Reservierungsanfrage . Sie werden sehr bald eine Bestätigungsmail erhalten.',
				'ad_reservationSuccess'=>'A new reservation come from your new customer',
				'reservationSubject'=>'Thai-Atrium Reservierung',
				'ad_reservationSubject'=>'Thai Atrium Neue Reservierung.',
				'lang_id'=>'2',
				)
		);
    
}