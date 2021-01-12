<?php
/*
 * Mod: Accordion Btn
 */

$is_open = $is_open ?? false;
$toggles = "#" .$accordion_id. ",#" .$accordion_id. " .toggle-icon,#" .$accordion_id. " .accordion-pullout";
?>

<button class="accordion-btn js-toggler" type="button"
data-toggles='<?php echo $toggles; ?>'
data-focus-in="<?php echo $accordion_id; ?> .accordion-pullout"
data-focus-out="<?php echo $accordion_id; ?>"
>
  <span class="layout">
    <h2 class="accordion-title">
      <?php echo $title; ?>

      <span class="toggle">
        <span class="toggle-icon expand <?php echo !$is_open ? "active" : false; ?>"></span>
        <span class="toggle-icon close <?php echo $is_open ? "active" : false; ?>"></span>
      </span>
    </h3>
  </span>
</button>
