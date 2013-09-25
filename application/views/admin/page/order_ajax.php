<?php
echo get_ol($pages);

function get_ol ($array)
{
	$str = '';

	if (count($array)) {
		$str .= '<ol class="sortable">';

		foreach ($array as $item) {
			$str .= '<li id="list_' . $item->id .'"><div>' . $item->title .'</div></li>' . PHP_EOL;
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