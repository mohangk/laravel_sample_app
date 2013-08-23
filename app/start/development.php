<?php

use Woodling\Woodling;

Woodling::getCore()->finder->addPaths(app_path().'/../tests/_blueprints');
Woodling::getCore()->finder->findBlueprints();

