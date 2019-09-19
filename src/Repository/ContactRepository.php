<?php

namespace ContactListApp\Repository;

use ContactListApp\Entity\Contact;
use Webmozart\Assert\Assert;

class ContactRepository
{
    const CONTACTS_FILE = __DIR__ . '/../../data/contacts';

    /**
     * @param array $data
     * @throws \InvalidArgumentException
     */
    public function validateContactData(array $data)
    {
        Assert::keyExists($data, 'firstName');
        Assert::keyExists($data, 'lastName');
        Assert::keyExists($data, 'phoneNumber');
        Assert::notEmpty($data['firstName']);
        Assert::notEmpty($data['lastName']);
        Assert::notEmpty($data['phoneNumber']);
    }

    /**
     * Creates a Contact object from an associative array of data
     *
     * @param array $data
     * @return Contact
     */
    public function createContactFromData(array $data): Contact
    {
        return new Contact(
            (string)$data['firstName'],
            (string)$data['lastName'],
            (string)$data['phoneNumber']
        );
    }

    /**
     * Saves a Contact object to disk
     *
     * @param Contact $contact
     */
    public function saveContact(Contact $contact)
    {
        $file = fopen(self::CONTACTS_FILE, 'a');
        fputs($file, json_encode($contact) . PHP_EOL);
        fclose($file);
    }

    /**
     * Fetches Contact objects from disk
     *
     * @return array
     */
    public function fetchContacts(): array
    {
        $contacts = [];
        if (file_exists(self::CONTACTS_FILE)) {
            $file = fopen(self::CONTACTS_FILE, 'r');
            while (($row = fgets($file)) !== false) {
                $row = json_decode($row, true);
                $contacts[] = $this->createContactFromData($row);
            }

            fclose($file);
        }


        return array_reverse($contacts);
    }
}
