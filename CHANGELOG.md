# Changelog


## 2026.11.03

### Fixes
- Validate the plugin bundle before stopping cache_dirs or changing installed files.
- Report bundle extraction failures.
- Preserve the current plugin bundle when removing older bundles.
- Replace `at` scheduling with direct delayed startup.
- Wait for pending startup before stopping cache_dirs.
- Report shutdown failures.

## 2026.08.11 - UI Modernization

### Added
- Added a Folder Caching summary panel showing the current operating mode and key settings at a glance.
- Added status information showing whether Folder Caching is currently running.
- Added responsive page layout for improved usability on different screen sizes.

### Changed
- Completely refreshed the Folder Caching user interface with a cleaner, more modern layout.
- Simplified the settings page by reorganizing controls and reducing visual clutter.
- Rewrote all Help documentation using plain language with clearer descriptions and recommendations.
- Updated setting folders to cache and descriptions to be more intuitive and consistent.
- Improved guidance for Adaptive and Fixed scan modes.
- Improved explanations of scan depth, scan timeouts, memory usage, and performance-related settings.
- Simplified advanced configuration guidance while retaining access to all cache_dirs options.
- Improved the Folder Caching information section with a concise overview of how directory caching works.

### Removed
- Removed obsolete and unnecessary configuration options from the user interface.
- Removed redundant technical explanations in favor of practical configuration guidance.
- Removed unnecessary warning messages from the settings page.
