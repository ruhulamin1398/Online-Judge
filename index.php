<?php
	include "header.php";
?>

<div id="demo"></div>

<script type="text/javascript">
	$('#demo').pagination({
    dataSource: [1, 2, 3, 4, 5, 6, 7, ... , 195],
    callback: function(data, pagination) {
        // template method of yourself
        var html = template(data);
        dataContainer.html(html);
    }
});
</script>
<?php

	include "footer.php";

?>

      