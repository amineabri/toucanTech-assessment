<?php
class Test {
    /*
     * This function checks if a user has a valid default email address
     * and returns a value based on the validation result.
     *
     * Return values :
     * -1: The user id is empty or null
     * 0: The email address is invalid or not verified
     * 1: The email address is valid and verified
     * 2: The email address is invalid
    */
    private function checkDefaultEmailValid($userId = null)
    {
        // Check if the user id is empty or null
        if (empty($userId)) {
            return -1;
        }
        // Get the default email address for the user
        $defaultEmail = $this->getDefaultEmailByUserId($userId);
        // If the default email address is empty, set it as the default email address for the user
        if (empty($defaultEmail)) {
            $this->set_default_email($userId);
            $defaultEmail = $this->getDefaultEmailByUserId($userId);
        }
        // If the default email address is still empty, return -1
        if (empty($defaultEmail)) {
            return -1;
        }
        // If the default email address is valid and was validated within the past 12 months, return 1
        if ($defaultEmail['valid'] >= 1 and
            ($defaultEmail['validated_on'] > (time() - strtotime('-12 months')))) {
            return 1;
        }
        // Get the email address from the default email address array
        $email = $defaultEmail['email'];
        // If the email address is empty or not valid, return 2
        if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 2;
        }
        // Check if the email address is valid
        $validationResults = $this->checkIfValid($email);
        // If the email address is not valid, return 0. If it is valid, return 1.
        if (!$validationResults) {
            return 0;
        } else {
            return 1;
        }
    }
}
