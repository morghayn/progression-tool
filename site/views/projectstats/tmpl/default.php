<?php defined('_JEXEC') or die; ?>

    <input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<?php

echo $this->loadTemplate('title');

foreach ($this->categories as $this->category):
    echo $this->loadTemplate('cat');
endforeach;

foreach ($this->measurementCategories as $this->measurementCategory):
    echo $this->loadTemplate('measurementCat');
endforeach;

?>