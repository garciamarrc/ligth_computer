<?php

use App\Helpers\View;

define('HEADER_TITLE', 'Home');
include View::layout('header.layout');
include View::component('navbar');
?>
<table>
    <thead>
        <th>Nombre</th>
        <th>Clasificación hija</th>
    </thead>
    <tbody>
        <?php foreach ($classifications as $classification) : ?>
            <tr>
                <td><?= $classification->getName(); ?></td>
                <td><?= $classification->getSubClassification(); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
include View::layout('tail.layout');
?>