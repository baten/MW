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
				'reservationSuccess'=>'thank you for your reservation request.you will get a confirmation email soon.',
				'reservationSubject'=>'Thai-Atrium reservation',
				'lang_id'=>'1',
				),
		'German'=>array(
				'emailSub'=>'THAI ATRIUM: Ihre Bestellung wurde aufgegeben',
				'orderSuccess'=>'Vielen Dank! Deine Bestellung wurde erfolgreich übermittelt!',
				'orderError'=>'Der Auftrag konnte nicht gespeichert werden',
				'emailError'=>'Etwas stimmt nicht. E-Mail konnte nicht gesendet werden.',
				'OrderTamplate'=>'ordersuccess',
				'reservationTamplate'=>'reservations',
				'reservationSuccess'=>'Vielen Dank für Ihre Reservierungsanfrage . Sie werden sehr bald eine Bestätigungsmail erhalten.',
				'reservationSubject'=>'Thai-Atrium Reservierung',
				'lang_id'=>'2',
				)
		);
    
}