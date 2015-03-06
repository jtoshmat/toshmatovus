<?php
	namespace Account\Model;

	// Add these import statements
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;

	class LoginModel implements InputFilterAwareInterface
	{

		public $username;
		public $password;
		protected $inputFilter;                       // <-- Add this variable

		public function exchangeArray($data)
		{
 			$this->username = (isset($data['username'])) ? $data['username'] : null;
			$this->title  = (isset($data['password']))  ? $data['password']  : null;
		}

		// Add content to these methods:
		public function setInputFilter(InputFilterInterface $inputFilter)
		{
			throw new \Exception("Not used");
		}

		public function getInputFilter()
		{
			if (!$this->inputFilter) {
				$inputFilter = new InputFilter();


				$inputFilter->add(array(
					'name'     => 'username',
					'required' => true,
					'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
					),


					'validators' => array(
						array(
							'name' => 'EmailAddress',
							'options' => array(
								'messages' => array(
									\Zend\Validator\EmailAddress::INVALID_FORMAT => 'Your username is not correct'
								)
							)
						)
					)

				));

				$inputFilter->add(array(
					'name'     => 'password',
					'required' => true,
					'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
					),
					'validators' => array(
						array(
							'name'    => 'StringLength',
							'options' => array(
								'encoding' => 'UTF-8',
								'min'      => 1,
								'max'      => 100,
							),
						),
					),
				));


				$inputFilter->add(array(
					'name'     => 'token',
					'required' => true,
					'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
					),
					'validators' => array(
						array(
							'name'    => 'StringLength',
							'options' => array(
								'encoding' => 'UTF-8',
								'min'      => 20,
								'max'      => 355,
							),
						),
					),
				));

				$this->inputFilter = $inputFilter;
			}

			return $this->inputFilter;
		}
	}
