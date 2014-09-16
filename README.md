FileArchive Symfony integration layer
========================

This repo implements [FileArchive application](https://github.com/cocoders/FileArchive) into symfony

1) Installaton
----------------------------------

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `install` command in project root to install application:

    php composer.phar install --dev

2) Usage
----------------------------------

Create archive command:

    php app/console filearchive:archive:create . --name="archiveName" -fdummy
    php app/console filearchive:archive:create M2M_Architecture.png --name="mynew" -fgaufrette_local

List existing archives command:

    php app/console filearchive:archive:list
    
Upload files to drobbox (you need to configure gaufrette please see `app/config/config.yml`):

    php app/console filearchive:archive:upload --name="archiveName" --providers="gaufrette_dropbox" --verbose
