<?php

defined('_JEXEC') or die;

$choice = $this->choice->choice;
$choiceID = $this->choice->id;
$projectID = $this->projectID;
$colourHex = $this->colourHex;
$colourRGB = $this->colourRGB;

$checked = is_null($this->choice->project_id) ? "" : " checked";
$onclick = 'onclick="checker(' . $projectID . ',' . $choiceID . ')"';

?>

<label class="optionChest" style="--outlineColour: <?php echo $colourHex; ?>; --optionColour: <?php echo $colourHex; ?>;">
    <input class="optionInput" type="checkbox" <?php echo $onclick . $checked; ?>>
    <span class="optionLabel" style="--labelColour: <?php echo $colourRGB; ?>;">
        <span class="option">
            <?php echo $choice; ?>
        </span>
    </span>
</label>