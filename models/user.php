<?php

abstract class UserLvl {
    const EVERYONE = 0;
    const LOGED_USER = 1;
    const PRIVILEGED_USERS = 2;
    const ADMIN = 3;
}

class User {

    public $acces = UserLvl::EVERYONE;

    // Modify depending of db implementation

}