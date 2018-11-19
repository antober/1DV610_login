<?php

include_once('IException.php');

class UsernameMissing extends Exception implements IException {}
class PasswordMissing extends Exception implements IException{}
class WrongCredentials extends Exception implements IException{}
class InvalidChars extends Exception implements IException{}
class ShortUsername extends Exception implements IException{}
class ShortPassword extends Exception implements IException{}
class PasswordDontMatch extends Exception implements IException{}
class UserExists extends Exception implements IException{}
class NoContent extends Exception implements IException{}
class NotPostOwner extends Exception implements IException{}
class SQLConnectionError extends Exception implements IException{}
