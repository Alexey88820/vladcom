<?php
echo get_ol($photos);

function get_ol ($array)
{
	$str = '';

	if (count($array)) {
		$str .= '<ol class="sortable">';

		foreach ($array as $item) {
			$str .= '<li id="list_' . $item->id .'"><div><img width=150 src="' . site_url('/assets/uploads/photos/' . $item->filename) . '"></div></li>' . PHP_EOL;
		}

		$str .= '</ol>' . PHP_EOL;
	}

	return $str;
}
?>

<script>
$(document).ready(function(){

    $('.sortable').nestedSortable({
        handle: 'div',
        items: 'li',
        toleranceElement: '> div',
        maxLevels: 1
    });

});
</script>