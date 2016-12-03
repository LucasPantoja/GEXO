<?php

namespace PhantomInstaller;

class PhantomBinary
{
    const BIN = '/Users/lucaspantoja/Desktop/GEXOL/vendor/bin/phantomjs';
    const DIR = '/Users/lucaspantoja/Desktop/GEXOL/vendor/bin';

    public static function getBin() {
        return self::BIN;
    }

    public static function getDir() {
        return self::DIR;
    }
}
