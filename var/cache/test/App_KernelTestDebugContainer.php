<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerQ9plnRi\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerQ9plnRi/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerQ9plnRi.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerQ9plnRi\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerQ9plnRi\App_KernelTestDebugContainer([
    'container.build_hash' => 'Q9plnRi',
    'container.build_id' => 'd0a46e95',
    'container.build_time' => 1712998544,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerQ9plnRi');
