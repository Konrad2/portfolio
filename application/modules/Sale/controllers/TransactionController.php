<?php		   
/**
 * Kontroler odpowiedzialny za realizowanie zam�wien(kasa).
 * @author Konrad
 *@package Sale
 */
class Sale_TransactionController extends abstract_Controllers_baseController 
{	
    
    public function step1loggedAction(){
         
               
                
        $ns = new Zend_Session_Namespace('saleOrder');		
	$ids = $ns->ids;
             
        $form = new Zend_Form();
       
        
        require_once '../application/modules/courier/common/whoCourier.php';
        $courierForm = new whoCourier();
        $form->addElement($courierForm->getElement('id_courier'));
        
        require_once '../application/modules/pay/common/choosePayingType.php';
        $fpt = new choosePayingType();       
        $form->addElement( $fpt->getElement('id_paying') );
       // $form->addSubForm(new choosePayingType(), 'paingType');
        $form->addElement( new Zend_Form_Element_Submit('submit',array('label'=>'Następny krok')) );
        
         $personModel = new Class_Models_Person();                    
         $addressModel = new Components_Address_models_Address1();                    
         $modelAccount = new components_createaccount_models_Account();  

        
         $clientId = Zend_Auth::getInstance()->getStorage()->read()->getId();     
         $rowAccount = $modelAccount->fetchRow($modelAccount->select()->where('id = ?', $clientId));
         
         if( ($rowAccount['id_person']== 0) || ($rowAccount['id_person']== null) ){
             echo 'Nie posiadasz wypełnionych danych osobowych';
             
         }else if( ($rowAccount['id_address'] ==0) || ($rowAccount['id_address']) == null ){
             echo "Nie posiadasz wypełnionych danych wysyłki";
         }else{
              
                   $rowPerson = $personModel->fetchRow($personModel->select()->where('id = ?', $rowAccount['id_person']));
                   $rowAddress = $addressModel->fetchRow($addressModel->select()->where('id = ?', $rowAccount['id_address']));

                  if ($this->_request->isPost()){

                      if( $form->isValid($_POST)){

                          require_once '../application/modules/Sale/models/order.php';

                          $modelOrder = new order();
                          $rowOrder = $modelOrder->createRow();

                          $rowOrder->data = date('Y-m-d');

                          $rowOrder->id_account = $rowAccount->id;
                          $rowOrder->id_address = $rowAddress->id;
                          $rowOrder->id_person = $rowPerson->id;
                          $rowOrder->id_status = 1;                

                          $paingtype = $form->getElement('id_paying')->getValue();

                          if (!is_numeric($paingtype)){
                              throw new Exception('Niepoprawne dane, id_payingtype.');
                          }

                          $rowOrder->id_paying = $paingtype;

                           $id_courier = $form->getElement('id_courier')->getValue();
                          if (!is_numeric($id_courier)){
                              throw new Exception('Niepoprawne dane, id_courier.');
                          }                
                          $rowOrder->id_courier = $id_courier;                
                          $rowOrder->save();

                            require_once '../application/modules/Sale/models/orderThings.php';
                          $modelOrderThings = new orderThings();

                          foreach( $ids as $thingId){
                              $rowOrderThings = $modelOrderThings->createRow();
                              $rowOrderThings->things_id = $thingId;
                              $rowOrderThings->order_id = $rowOrder->id;
                              $rowOrderThings->save();

                          }

                          $this->_forward('clear','Cart','Cart');

                      }
                  }else {        


                      $this->view->rowAccount = $rowAccount;
                      $this->view->rowPerson = $rowPerson;
                      $this->view->rowAddress = $rowAddress;


                  }
                  $this->view->form = $form;
         }
	
    }
	/**
	 * for conecting other module with action other module have to have class modulename/library/saleTransactionStep1.php intherit from clas aFoctoryClient
	 * and it have to be write in sale/config.xml in section connections 
	 * uwaga nie przetestowane
	 */
	
	public function step1Action()
	{		
		$ns = new Zend_Session_Namespace('saleOrder');		
		$ids = $ns->ids;
			
		if ( count($ids) > 0 )
		{
			require_once ('../application/modules/Sale/library/dataFromClient.php');
			
			$formDb = new dataFromClient();

			$formDb->build( $this->param() );			
							
					if($this->_request->isPost())
					{
					    if ($formDb->isValid($_POST))
						{
							//Urzywa interfejsu interface_FormDbClient.		
						    $formDb->formToDb(null,null,$ids);		
							
							$this->_forward('clear','Cart','Cart');
					    }
						else 
						{
							echo "dane niepoprawne<br/>";
							$this->view->form = $formDb;
						}
					}
					else
					{
						echo "krok 1 podaj dane";
						$this->view->form = $formDb;
					}				
		}else{
			echo "koszyk jest pusty";
		}
	
	}
	
	/**
	 * Jaki� ��cznik
	 */
	public function orderAction()
	{
		$ids = $this->_request->getIntParams();
			
		if( count($ids) > 0 )
		{
			$ns = new Zend_Session_Namespace('saleOrder');
			$ns->ids = $ids;
		}
		
		/*
		 *jeli czy co ma by� wywietlone z innych modu��w
		 */
		$system = new Class_system(); 
		$this->view->contract = $system->getConnections( $this->param() );
	}	
	
}
