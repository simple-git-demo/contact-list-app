<?php

use ContactListApp\Constants\Actions;
use ContactListApp\Constants\SessionVariables;
use ContactListApp\Repository\ContactRepository;

require_once __DIR__ . '/../src/bootstrap.php';

$action = isset($_SESSION[SessionVariables::ACTION]) ? $_SESSION[SessionVariables::ACTION] : Actions::LIST;
unset($_SESSION[SessionVariables::ACTION]);

$contactRepository = new ContactRepository();
$contacts = $contactRepository->fetchContacts();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact List</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
<h1>Contact List</h1>

<?php if ($action === Actions::FALED_SAVE): ?>
<p class="message message-error">
    Failed to save contact.
</p>
<?php endif; ?>

<form method="post" action="/save.php">
    <fieldset>
        <legend>New Contact</legend>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName">
        <br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName">
        <br>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber">
        <br>

        <button type="submit">Save</button>
    </fieldset>
</form>

<table>
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($contacts) > 0): ?>
        <?php foreach ($contacts as $contact): ?>
        <tr class="contact">
            <td><?php echo htmlspecialchars($contact->firstName); ?></td>
            <td><?php echo htmlspecialchars($contact->lastName); ?></td>
            <td><?php echo htmlspecialchars($contact->phoneNumber); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr class="contact">
            <td colspan="3">No contacts</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<?php if ($action === Actions::SUCCESSFUL_SAVE): ?>
<script src="/js/contactSaved.js"></script>
<?php endif; ?>

</body>
</html>
