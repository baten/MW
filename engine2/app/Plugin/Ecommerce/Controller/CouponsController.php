<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Coupons Controller
 *
 * @property Coupon $Coupon
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
App::uses('CakeTime', 'Utility');

class CouponsController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public function beforeFilter(){
			parent::beforeFilter();
		}
	public $uses = array('Ecommerce.Coupon');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Coupon->recursive = 0;
		$this->paginate = array(
	       'order' => array(
	            'Coupon.id' => 'DESC'
	        )
   		 );
		$this->set('coupons', $this->Paginator->paginate());
		$validitY_options = array(
		    '1' => 'Yes',
		    '0' => 'No'
		);
		$this->set('validitY_options', $validitY_options);
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Coupon->exists($id)) {
			throw new NotFoundException(__('Invalid coupon'));
		}
		$options = array('conditions' => array('Coupon.' . $this->Coupon->primaryKey => $id));
		$this->set('coupon', $this->Coupon->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$numOfCoupon=$this->request->data['Coupon']['num_of_coupon'];
			$start_time=CakeTime::format('Y-m-d H:i:s',$this->request->data['Coupon']['start_time']);
			$end_time=CakeTime::format('Y-m-d H:i:s',$this->request->data['Coupon']['end_time']);
			$discount_type=$this->request->data['Coupon']['discount_type'];
			$discount_amount=$this->request->data['Coupon']['discount_amount'];
			$is_validity=$this->request->data['Coupon']['is_validity'];
			$status=$this->request->data['Coupon']['status'];
			
			for ($i=0; $i < $numOfCoupon ; $i++) { 
				$data['Coupon'][$i]['coupon_number']=substr(md5(uniqid(rand(), true)),0,6);
				$data['Coupon'][$i]['discount_type']=$discount_type;
				$data['Coupon'][$i]['discount_amount']=$discount_amount;
				$data['Coupon'][$i]['is_validity']=$is_validity;
				$data['Coupon'][$i]['start_time']=$start_time;
				$data['Coupon'][$i]['end_time']=$end_time;
				$data['Coupon'][$i]['status']=$status;
			}
			//pr($data);exit;
			$this->Coupon->create();
			if ($this->Coupon->saveAll($data['Coupon'])) {
				$this->Session->setFlash('The coupon has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The coupon could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$discountType = $this->Coupon->getColumnType('discount_type');		
		// extract values in single quotes separated by comma
		preg_match_all("/'(.*?)'/", $discountType, $discountTypes);		
		$this->set('discountTypes', array_filter(array_merge(array(0),$discountTypes[1])));

		$statu = $this->Coupon->getColumnType('status');
		// extract values in single quotes separated by comma
		preg_match_all("/'(.*?)'/", $statu, $status);
		$this->set('status', array_filter(array_merge(array(0),$status[1])));			
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Coupon->exists($id)) {
			throw new NotFoundException(__('Invalid coupon'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Coupon']['start_time']=CakeTime::format('Y-m-d H:i:s',$this->request->data['Coupon']['start_time']);
			$this->request->data['Coupon']['end_time']=CakeTime::format('Y-m-d H:i:s',$this->request->data['Coupon']['end_time']);
			if ($this->Coupon->save($this->request->data)) {
				$this->Session->setFlash('The coupon has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The coupon could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$discountType = $this->Coupon->getColumnType('discount_type');		
			// extract values in single quotes separated by comma
			preg_match_all("/'(.*?)'/", $discountType, $discountTypes);		
			$this->set('discountTypes', array_filter(array_merge(array(0),$discountTypes[1])));
			$statu = $this->Coupon->getColumnType('status');
			// extract values in single quotes separated by comma
			preg_match_all("/'(.*?)'/", $statu, $status);			
			$this->set('status', array_filter(array_merge(array(0),$status[1])));

			$options = array('conditions' => array('Coupon.' . $this->Coupon->primaryKey => $id));
			$this->request->data = $this->Coupon->find('first', $options);

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
		$this->Coupon->id = $id;
		if (!$this->Coupon->exists()) {
			throw new NotFoundException(__('Invalid coupon'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Coupon->delete()) {
			$this->Session->setFlash('The coupon has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The coupon could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
