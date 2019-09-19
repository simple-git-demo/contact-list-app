<?php

use ContactListApp\Constants\Actions;
use ContactListApp\Constants\SessionVariables;
use ContactListApp\Repository\ContactRepository;

require_once __DIR__ . '/../src/bootstrap.php';

try {
    $contactRepository = new ContactRepository();

    $contactRepository->validateContactData($_POST);
    $contact = $contactRepository->createContactFromData($_POST);
    $contactRepository->saveContact($contact);

    $action = Actions::SUCCESSFUL_SAVE;
} catch (\Exception $e) {
    $action = Actions::FALED_SAVE;
}

$_SESSION[SessionVariables::ACTION] = $action;
header("Location: /");
