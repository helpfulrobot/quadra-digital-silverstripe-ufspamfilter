<?php

/**
*	Extending form actions and adding an intermediary function between form submission and form processing
*	which will check the form data for listed spam words.
*/
class UserFormSpamExtension extends DataExtension
{
	public function updateFormActions($actions)
	{
		$submitText = ($this->owner->controller->SubmitButtonText) ? $this->owner->controller->SubmitButtonText : _t('UserDefinedForm.SUBMITBUTTON', 'Submit');

		$actions->removeByName('action_process');
		$actions->push(new FormAction("SpamProcess", $submitText));
	}

}
