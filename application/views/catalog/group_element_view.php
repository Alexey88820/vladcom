<div>
    <h1><?=$content['group']['name']?></h1>
    <table class="table table-bordered">
        <tbody>
        <?php foreach ($content['items'] as $item) { ?>
            <tr class="show-more">
                <td><span class="link" title="<?=$item['name']?>. Подробности."><?=$item['name']?></span></td>
                <td class="td-price"><?=convertDollarToRubel($item['price'], $course)?></td>
            </tr>
            <tr class="more">
                <td colspan="2"><?=$item['description']?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div><?=$content['group']['description']?></div>
</div>