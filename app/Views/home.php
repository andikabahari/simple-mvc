<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Simple MVC</title>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <?php $tableNumber = 1; ?>
        <?php foreach ($games as $game): ?>
          <tr>
            <td width="25"><?php echo $tableNumber++; ?></td>
            <td><?php echo $game['title']; ?></td>
            <td width="480"><?php echo $game['description']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </body>
</html>
