<!DOCTYPE html>
<html>
<head>
    <title>Parking Status</title>
</head>
<body>
    <h1>Parking Status</h1>

    <form method="post" action="<?= site_url('parking/submit') ?>">
        <label for="slot1_park">Slot 1:</label>
        <select name="slot1_park" id="slot1_park">
            <option value="0" <?= $slots[0] == 0 ? 'selected' : '' ?>>Available</option>
            <option value="1" <?= $slots[0] == 1 ? 'selected' : '' ?>>Occupied</option>
        </select>
        <br><br>

        <label for="slot2_park">Slot 2:</label>
        <select name="slot2_park" id="slot2_park">
            <option value="0" <?= $slots[1] == 0 ? 'selected' : '' ?>>Available</option>
            <option value="1" <?= $slots[1] == 1 ? 'selected' : '' ?>>Occupied</option>
        </select>
        <br><br>

        <label for="slot3_park">Slot 3:</label>
        <select name="slot3_park" id="slot3_park">
            <option value="0" <?= $slots[2] == 0 ? 'selected' : '' ?>>Available</option>
            <option value="1" <?= $slots[2] == 1 ? 'selected' : '' ?>>Occupied</option>
        </select>
        <br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>