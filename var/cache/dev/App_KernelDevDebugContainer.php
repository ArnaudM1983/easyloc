<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerJpvl5NE\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerJpvl5NE/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerJpvl5NE.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerJpvl5NE\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerJpvl5NE\App_KernelDevDebugContainer([
    'container.build_hash' => 'Jpvl5NE',
    'container.build_id' => '4dfc0f50',
    'container.build_time' => 1712653332,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerJpvl5NE');
