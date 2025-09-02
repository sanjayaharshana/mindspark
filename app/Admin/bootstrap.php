<?php

/**
 * qulint-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Qulint\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Qulint\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Qulint\Admin\Form::forget(['editor']);

// Hide admin panel footer links (Resources, Github, Documentation, Demo)
Admin::css('
<style>
/* Hide footer links */
.footer-links,
.admin-footer-links,
.resources-links,
.github-links,
.documentation-links,
.demo-links,
.admin-version,
.admin-environment {
    display: none !important;
}

/* Hide any footer content that might contain these links */
.footer a[href*="github"],
.footer a[href*="documentation"],
.footer a[href*="demo"],
.footer a[href*="resources"] {
    display: none !important;
}
</style>
');
