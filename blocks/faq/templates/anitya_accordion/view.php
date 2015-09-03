<?php  defined('C5_EXECUTE') or die("Access Denied.");?>
<div class="ccm-faq-container anitya-accordion faq-accordion">
    <?php  if(count($rows) > 0) { ?>
      <dl>
        <?php  foreach($rows as $row) : ?>
       <dt class='title'>
            <a href="">
                <?php  echo $row['title'] ?>
                <i class='fa fa-chevron-down icon'></i>
            </a>
        </dt>
        <dd class='content'>
          <div class='content-inner'><?php  echo nl2p($row['description']) ?></div>
        </dd> 
        <?php  endforeach ?>
    </dl>
    <?php  } else { ?>
    <div class="ccm-faq-block-links">
        <p><?php  echo t('No Faq Entries Entered.'); ?></p>
    </div>
    <?php  } ?>
</div>

<?php  
function nl2p($string)
{
    $paragraphs = '';

    foreach (explode("\n", $string) as $line) {
        if (trim($line)) {
            $paragraphs .= '<p>' . $line . '</p>';
        }
    }

    return $paragraphs;
} ?>

