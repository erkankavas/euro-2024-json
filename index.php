<?php
$json_file = 'data.json';
$json_data = file_get_contents($json_file);
if ($json_data === false) {
    die('Error reading JSON file');
}
$data = json_decode($json_data, true);

if ($data === null) {
    die('Error decoding JSON');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Euro 2024</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-2">
        <nav class="navbar navbar-light bg-light"><a class="navbar-brand" href="./">EURO 2024</a></nav>

        <div class="alert alert-danger mt-2" role="alert">Match times are based on GMT+2.</div>

        <?php if (!empty($data['rounds'])): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Round</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Team 1</th>
                        <th>Team 2</th>
                        <th>Group</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['rounds'] as $round): ?>
                        <?php foreach ($round['matches'] as $match): ?>
                            <tr>
                                <td><?php echo $round['name']; ?></td>
                                <td><?php echo $match['date']; ?></td>
                                <td><?php echo $match['time']; ?></td>
                                <td><?php echo $match['team1']['name'] . ' (' . $match['team1']['code'] . ')'; ?></td>
                                <td><?php echo $match['team2']['name'] . ' (' . $match['team2']['code'] . ')'; ?></td>
                                <td><?php echo $match['group'] ?? "";?></td>
                                <td><?php echo $match['score'] ?? "";?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No matches found.</p>
        <?php endif; ?>
    </div>
<footer class="footer mt-auto p-3" style="background-color: #f5f5f5;">
  <div class="container">
    <span class="text-muted">Euro 2024</span>
  </div>
</footer>
</body>
</html>