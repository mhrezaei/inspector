<h5>Upload images ...</h5>
<h6>Accepted formats: JPG, GIF, PNG</h6>
<hr>

<?php
    if($status == 1)
    {
?>
        <form action="" method="post" enctype="multipart/form-data" name="sendPost">
            <input type="file" name="userfile" size="1" /><br />
            <input type="hidden" name="uploadFile" value="yes">
            <input type="submit" value="Upload Picture!" />
        </form>
<?php
    }
    elseif($status == 2)
    {
?>
        <input type="text" style="width: 100%;" value="<?php echo asset_url() . 'uploads/' . $success['upload_data']['file_name']; ?>">
        <br> <br>
        <input type="button" value="Upload another picture!" onclick="window.location = '<?php echo base_url(); ?>' + 'admin/manage_pages/uploadImages'" />
        <br><br>
<?php
    }
?>

