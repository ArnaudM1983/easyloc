<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerHGYHti3\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerHGYHti3/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerHGYHti3.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerHGYHti3\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerHGYHti3\App_KernelDevDebugContainer([
    'container.build_hash' => 'HGYHti3',
    'container.build_id' => 'd3747dd7',
    'container.build_time' => 1711609358,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerHGYHti3');
