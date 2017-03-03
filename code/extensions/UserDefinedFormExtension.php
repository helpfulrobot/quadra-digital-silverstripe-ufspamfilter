<?php

class UserDefinedFormExtension extends DataExtension
{
	private static $db = array(
		'SpamWords' 	=> 'Text',
		'UseSpamFilter' => 'Boolean',
		'SpamMessage'	=> 'Text'
	);

	public function updateCMSFields(FieldList $fields)
	{
		$fields->addFieldToTab('Root.SpamFilter', TextareaField::create('SpamWords', 'Spam Words (comma separated)')->setRows(4));
		$fields->addFieldToTab('Root.SpamFilter', TextareaField::create('SpamMessage', 'Spam catch error message')->setRows(4));
		$fields->addFieldToTab('Root.SpamFilter', CheckboxField::create('UseSpamFilter', 'Activate spam filter'));
	}

	/**
    * SPAM FILTER
    * This method will GET the site config defined string of spam words, remove spaces and convert
    * to an array. Loop over the form data parameter and search for spam words within the values.
    * If spam is found, true will be returned, else false.
    *
    * @param  'Object'  | $data will contain the form data of the included desired form.
    * @return 'Boolean' | False to be returned if no spam is found, true if spam is found.
    **/
    public function spamCheck($data)
    {
        $spamWords = str_replace(' ', '', $this->owner->SpamWords);
        $spamWords = $myArray = explode(',', $spamWords);

        foreach($data as $field => $value) {
            switch($field) {
                case 'url':
                    continue;
                case (preg_match("/action_.*/", $field) ? true : false):
                    continue;
                default:
                    foreach($spamWords as $spam) {
                        if (strpos($value, $spam) !== false)  {
                            return true;
                        }
                    }
                    break;
            }
        }
    }
}
