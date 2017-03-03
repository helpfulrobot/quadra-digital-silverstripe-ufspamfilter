<?php

class UserDefinedFormControllerExtension extends DataExtension
{
	public function SpamProcess($data, $form)
	{
		if (!$this->owner->UseSpamFilter || !$this->owner->spamCheck($data)) {
			$this->owner->process($data, $form);
		} else {
			$form->addErrorMessage('Spam', $this->owner->SpamMessage, 'bad');
            Controller::curr()->redirectBack();
			return false;
		}
	}
}
