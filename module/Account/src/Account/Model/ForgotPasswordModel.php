<?php
	namespace Account\Model;

	// Add these import statements
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;

	class ForgotPasswordModel implements InputFilterAwareInterface
	{

		public $email;
		protected $inputFilter;

		public function exchangeArray($data)
		{
 			$this->email = (isset($data['email'])) ? $data['email'] : null;

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
									\Zend\Validator\EmailAddress::INVALID_FORMAT => 'Your email address is not correct'
								)
							)
						)
					)

				));


				$this->inputFilter = $inputFilter;
			}

			return $this->inputFilter;
		}
	}
