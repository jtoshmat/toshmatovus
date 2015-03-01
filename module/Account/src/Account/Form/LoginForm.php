<?php
	namespace Account\Form;

	use Zend\Form\Form;
	use Zend\Stdlib\Parameters;


	class LoginForm extends Form
	{
		public function __construct($name = null)
		{
			parent::__construct($name);

			$this->add(array(
				'name' => 'username',
				'type' => 'Text',
				'attributes' => array(
					'class' => 'form-control',
					'required' => 'required',
					'id' => 'username',
					'placeholder' =>'Your email or username'
				),
			));

			$this->add(array(
				'name' => 'password',
				'type' =>'Password',
				'attributes' => array(
					'class' => 'form-control',
					'required' => 'required',
					'id' => 'password',
					'placeholder' =>'Your password'
				),
			));



			$this->add(array(
				'name' => 'ip',
				'type' => 'hidden',
				'attributes' => array(
					'required' => 'required',
					'id' => 'IP'
				),
			));




			$this->add(array(
				'name' => 'reset',
				'type' => 'Button',

				'attributes' => array(
					'value' => 'Reset',
					'id' => 'resetbutton',
					'class' =>'btn btn-default'
				),
			));

			$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
					'value' => 'Submit',
					'id' => 'submitbutton',
					'class' =>'btn btn-success'
				),
			));
		}
	}