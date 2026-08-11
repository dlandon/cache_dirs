# Dynamix Cache Directories

Dynamix Cache Directories keeps folder information in memory to reduce unnecessary disk spin-ups when browsing shares. It provides an easy-to-use web interface for configuring and monitoring the `cache_dirs` background service without editing command-line options.

## Installation

**Important:** If you have the original **Dynamix Cache Directories** plugin installed, **uninstall it first** before installing this version. Only one version of the plugin can be installed at a time.

Uninstalling the original plugin preserves your existing folder caching configuration, which will be used automatically by this version.

Install the plugin directly from the following URL:
https://raw.githubusercontent.com/dlandon/cache_dirs/master/dlandon.cache.dirs.plg

In Unraid:

1. Go to **Plugins**.
2. Select **Install Plugin**.
3. Paste the URL into the **Plugin URL** field.
4. Click **Install**.

After installation, the **Folder Caching** page will be available under **Settings**.

## Note

This repository contains a maintenance refresh of the original Dynamix Cache Directories plugin. The improvements are intended to benefit the Unraid community, and Lime Technology is welcome to incorporate any or all of them into future Unraid releases.

## Acknowledgements

This project builds on the original Dynamix Cache Directories plugin and the `cache_dirs` script. This refresh focuses on improving the user interface, documentation, configuration, and overall usability while preserving the existing functionality.
