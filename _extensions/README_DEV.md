# HOWTO update extensions

This tutorial describes how to update `_extensions/bin` folder with up to date binaries.

## Get pre-build binaries

1. Download production ready binaries from the [CDN](https://cdn.virgilsecurity.com/virgil-crypto-c/php).
2. Or download it from a Jenkins build.
3. Put pre-build binaries to a separate folder.

## Unpack pre-build binaries to the `_extensions/bin` folder

1. Open terminal.
2. Run script `unpack_bin.py` from the `_extensions` folder, i.e.
    ```sh
    python3 ./_extensions/unpack_bin.py /path/to/the/prebuild_binaries
    ```
3. That's it.
