<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Bienvenido al index de home controller</h1>
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
</body>

</html>