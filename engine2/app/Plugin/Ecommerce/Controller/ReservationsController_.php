<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Reservations Controller
 *
 * @property Reservation $Reservation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReservationsController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','EmailSender');


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Reservation->recursive = 0;
		if($this->langsName=='English'){
			$this->paginate = array(
				'conditions'=>array("Reservation.lang_id"=>1),				
				'order'=>array('Reservation.created'=>'DESC')
			);
		}else{
			$this->paginate = array(
				'conditions'=>array("Reservation.lang_id"=>2),				
				'order'=>array('Reservation.created'=>'DESC')
			);
		}
		$this->set('reservations', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Reservation->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		$options = array('conditions' => array('Reservation.' . $this->Reservation->primaryKey => $id));
		$this->set('reservation', $this->Reservation->find('first', $options));
	}



/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_reject($id = null) {
		$this->Reservation->id = $id;
		if (!$this->Reservation->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$reservations=$this->Reservation->find('first',array('conditions'=>array('id'=>$id),'fields'=>array('email')));
			//pr($reservations);exit;
			$data['Reservation']['status']='Reject';
			if ($this->Reservation->save($data['Reservation'])) {

				$dat['message']='unfortunately we can not accept your reservation request.we are sorry for the inconvenience.';

				$siteSettings=ClassRegistry::init('SiteSetting');				
				$siteSettingData=$siteSettings->find('first',array('fields' => array('site_author_email','company_name')));		
				//pr($siteSettingData);exit;				
				
				//$emailConfig['from_email'] = 'info@nrbbuysell.com'; //'joopdeyn@msn.com';
				$emailConfig['from_email'] = $siteSettingData['SiteSetting']['site_author_email'];
				$emailConfig['from_name'] =$siteSettingData['SiteSetting']['company_name'];
				$emailConfig['to'] =$reservations['Reservation']['email'];			
				$emailConfig['subject'] = 'Thai-Atrium reservation declined';
				$emailConfig['template'] = 'reservations';
				$emailConfig['data'] = $dat;				
				if($this->EmailSender->sendEmail($emailConfig)){						
					$this->Session->setFlash('The reservation has been rejected.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
				}else{
				 $this->Session->setFlash('The reservation mail could not be sent. Please, try again.','default',array('class'=>'alert alert-warnging'));
				return $this->redirect(array('action' => 'index'));
				}

				
			} else {
				$this->Session->setFlash('The reservation could not be rejected. Please, try again.','default',array('class'=>'alert alert-warnging'));
				return $this->redirect(array('action' => 'index'));
			}
		} 
	}


	public function admin_accept($id = null) {
		$this->Reservation->id = $id;
		if (!$this->Reservation->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$reservations=$this->Reservation->find('first',array('conditions'=>array('id'=>$id),'fields'=>array('email','date','time','num_of_person')));
			
			$data['Reservation']['status']='Accept';
			if ($this->Reservation->save($data['Reservation'])) {

					//$date=date_create($reservations['Reservation']['date']);		
					//$datt=date_format($date,"d-m-Y");
					$time=$reservations['Reservation']['time'];
					$num=$reservations['Reservation']['num_of_person'];

					$dat['message']="your reservation on at {$time} for {$num} person has been successful.thank you for your reservation.";

					//pr($dat);exit;

					$siteSettings=ClassRegistry::init('SiteSetting');				
					$siteSettingData=$siteSettings->find('first',array('fields' => array('site_author_email','company_name')));		
					//pr($siteSettingData);exit;				
					
					//$emailConfig['from_email'] = 'info@nrbbuysell.com'; //'joopdeyn@msn.com';
					$emailConfig['from_email'] = $siteSettingData['SiteSetting']['site_author_email'];
					$emailConfig['from_name'] =$siteSettingData['SiteSetting']['company_name'];
					$emailConfig['to'] =$reservations['Reservation']['email'];			
					$emailConfig['subject'] = 'Thai-Atrium reservation confirmation';
					$emailConfig['template'] = 'reservations';
					$emailConfig['data'] = $dat;				
					if($this->EmailSender->sendEmail($emailConfig)){						
						$this->Session->setFlash('The reservation has been accepted.','default',array('class'=>'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
					}else{
					 $this->Session->setFlash('The reservation mail could not be sent. Please, try again.','default',array('class'=>'alert alert-warnging'));
					return $this->redirect(array('action' => 'index'));
					}

					
				} else {
					$this->Session->setFlash('The reservation could not be accepted. Please, try again.','default',array('class'=>'alert alert-warnging'));
					return $this->redirect(array('action' => 'index'));
				}			
		} 
	}


/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Reservation->id = $id;
		if (!$this->Reservation->exists()) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Reservation->delete()) {
			$this->Session->setFlash('The reservation has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The reservation could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
