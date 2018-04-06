cache_dirs script unRAID V6.1 and later
=======================================

This is an updated version of Joe L.'s cache_dirs sript for caching directories in memory to prevent unnecessary disk drive spinup.  Thank you Alex R. Berg for your updates to cache_dirs.

Change Log
==========
Version 2.1.1
- Removed additional unused variables.
- Removed V5 ulimit usage info that doesn't apply.
- Show type of scanning being done - adaptive or fixed when cache_dirs is started.

Version 2.1.0
- Removed code specific to V5, removed wait for array to come online, removed force disks busy, and modified script for readability.


Version 2.0.6
- Included original 'B' option, it is unused but kept for compatibility reasons.  This was done for the Dynamix Cache Dirs plugin.

VVersion 2.0.5
- Updated for unRaid 6.1.2 new location of mdcmd (used to find idle-times of disks).

Version 2.0.4
- Added more lost cache log, enabled by creating log file /var/log/cache_dirs_lost_cache.log.

Version 2.0.3
- Bugfix suspend mover, and added concise log of lost cache.

Version 2.0.2
- Fixed looping bash check in unRaid V6, plus fixed some too aggressive depth checks.

Version 2.0.1
- Fixed missing sleep. Now decreases scan-depth after few seconds (20-40s) if cache is lost after many successful cache-hits, because we don't want cache_dirs to be a resource-hog when system is otherwise occupied.

Version 2.0.0
- Added gradual depth to avoid continous scans of filesystem, monitor of disk-idle, and better user-feedback as to disk spin-up in log-file.

- Now stops cache_dirs immediately on stop signal (eg array stop) including stopping the currently running find-process.

- Force-disk-busy now defaults no and inverted flag (and changed -B to -b) because it was (mostly) unRaid V4 and its unnessary when using plg with unmount disk event.
