<?php

namespace Sagarv1997\RpVelocity\Services;

class Constants {

    public static $DEFAULT_REPOSITORY_DIRECTORY = "Repositories";
    public static $DEFAULT_MODELS_DIRECTORY = "Models";

    public static $MY_SQL = 'MySQL';
    public static $MONGO_DB = 'MongoDB';

    public static $database = [];

    /**
     * Initialize all the Constants
     */
    public static function init() {
        self::$database = [
            self::$MY_SQL,
            self::$MONGO_DB,
        ];

    }

}

Constants::init();
