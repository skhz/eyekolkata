<?php
$cmsArray = array();
$CMSHwnd = new CMSHwnd();
$cmsArray = $CMSHwnd->CMSArray();
?>
<h2>eyekolkata pages</h2>
<br />
<div id="accordion">
<?php foreach($cmsArray as $key => $val){ ?>
    <div>
        <h3><a href="#" title="<?php echo strtoupper(str_replace('_',' ',$val['page_name'])); ?>" class="tooltip"><?php echo strtoupper(str_replace('_',' ',$val['page_name'])); ?></a></h3>
        <div><?php echo $val['page_info']; ?><a href="add-edit-cms-page.php?cms_id=<?php echo base64_encode($key);?>">Edit</a> | <a href="../?page_name=<?php echo $val['page_name']; ?>.jsp" target="_blank">Live</a></div>
    </div>
<?php }?>
</div>