<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerA2fuyr2\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerA2fuyr2/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerA2fuyr2.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerA2fuyr2\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \ContainerA2fuyr2\appDevDebugProjectContainer(array(
    'container.build_hash' => 'A2fuyr2',
    'container.build_id' => '24033c18',
    'container.build_time' => 1525685412,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerA2fuyr2');
