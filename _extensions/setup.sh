#!/bin/bash

clear

LOG_DELIMETR="----------"

init() {
    ERR_LEVEL=0
    INI_FILE_NAME="virgil_crypto.ini"
    PATH_TO_BINS="_extensions/bin"

    ERR_LEVEL=0
    IS_DEV=0
}

check_input() {
    printf "Checking input... %s"

    if [ -z "$1" ]; then
        get_err "input_null"
    fi

    LIST_EXT=""

    case "$1" in
        "-all")
            LIST_EXT="vscf_foundation_php vsce_phe_php vscp_pythia_php"
            ;;
        *)
            get_err "input_invalid" "$1"
            ;;
    esac

    get_success
}

get_err() {
    ERR_LEVEL=1
    case "$1" in
        php-v)
            ERR_MSG="Invalid PHP version: $2"
            ;;
        os)
            ERR_MSG="Invalid OS: $2"
            ;;
        package-v)
            ERR_MSG="VERSION file not found or empty" 
            ;;
        ext-input-path)
            ERR_MSG="Invalid path to bin: $2"
            ;;
        ext-dir)
            ERR_MSG="Invalid extensions directory: $2"
            ;;
        ini-dir)
            ERR_MSG="Invalid additional .ini files directory: $2"
            ;;
        cp-ext|cp-ini)
            ERR_MSG="Cannot copy $2 to the $3"
            ;;
        input_null)
            ERR_MSG="Project not specified"
            ;;
        input_invalid)
            ERR_MSG="Invalid project: $2"
            ;;
        *)
            ERR_MSG="Internal error: $1"
            ;;
    esac

    printf "[FAIL]\nError status: %s\n" "$ERR_MSG"

    get_manually

    exit 0
}

get_success() {
    printf "[OK]\n"
}

get_package_v() {
    printf "Checking Package version... "

    if [ -f VERSION ] && [ -s VERSION ]; then
        CRYPTO_VERSION=$(cat VERSION)
        get_success
    else
        get_err "package-v" "No VERSION file"
    fi
}

get_php_v() {

    printf "Checking PHP version... "

    PHP_VERSION=$(php -v)
    set -- $PHP_VERSION
    PHP_VERSION_STRING="$2"
    PHP_VERSION_MAJOR=`echo $PHP_VERSION_STRING | cut -f 1 -d'.'`
    PHP_VERSION_MINOR=`echo $PHP_VERSION_STRING | cut -f 2 -d'.'`
    PHP_VERSION_SHORT=$PHP_VERSION_MAJOR.$PHP_VERSION_MINOR

    if [ $PHP_VERSION_SHORT != "7.2" ] && [ $PHP_VERSION_SHORT != "7.3" ] && [ $PHP_VERSION_SHORT != "7.4" ]; then
        get_err "php-v" "$PHP_VERSION_SHORT"
    else
        get_success
    fi
}

get_os() {
    printf "Checking OS... "
    OS=$(uname)

    case $OS in
         Linux)
              OS_="lin"
              ;;
         Darwin)
              OS_="mac"
              ;;
         *)
              OS_=""
              ;;
    esac

    if [ -z "$OS_" ]; then
        get_err "os" "$OS"
    else
        get_success
    fi
}

get_ext_dir() {
    printf "Checking PHP extensions directory... "

    EXTENSION_DIR=$(php-config --extension-dir)

    if [ -z "EXTENSION_DIR" ]; then
        get_err "ext-dir" "(null)"
    else
        get_success
    fi
}

get_ini_dir() {
    printf "Checking additional .ini files directory... "

    PHP_INI_DIR_STRING=$(php -i | grep "Scan this dir for additional .ini files")
    PHP_INI_DIR_=`echo $PHP_INI_DIR_STRING | cut -f 2 -d'>'`
    PHP_INI_DIR_="$(echo "${PHP_INI_DIR_}" | tr -d '[:space:]')"

    PHP_INI_DIR=$PHP_INI_DIR_

    # Try to convert cli->fpm
    PHP_INI_DIR_CONVERT_TO_FPM=`echo ${PHP_INI_DIR_} | sed 's/cli/fpm/g'`

    if [ -d "$PHP_INI_DIR_CONVERT_TO_FPM" ]; then
        PHP_INI_DIR=""$PHP_INI_DIR_CONVERT_TO_FPM" "$PHP_INI_DIR""
    fi

    if [ -z "$PHP_INI_DIR_STRING" ]; then
        get_err "ini-dir" "(null)"
    else
        get_success
    fi
}

get_config() {
    if [ $ERR_LEVEL -eq 0 ]; then
        printf "%s\nSYSTEM CONFIGURATION:\n" $LOG_DELIMETR

        printf "Crypto version: %s\n" "$CRYPTO_VERSION"
        printf "OS (short): %s\n" "$OS"
        printf "PHP version (short): %s\n" "$PHP_VERSION_SHORT"
        printf "PHP version (full):\n%s\n" "$PHP_VERSION"
        printf "Extensions directory: %s\n" "$EXTENSION_DIR"
        printf "Additional .ini files directory: %s\n" "$PHP_INI_DIR"
        printf "%s\n" $LOG_DELIMETR
    fi
}

cp_ext() {
    for EXT in $LIST_EXT
    do
        EXT_FULL_NAME="${EXT}${PHP_VERSION_SHORT}_${CRYPTO_VERSION}.so"
        PATH_TO_BIN="${PATH_TO_BINS}/${OS_}/php${PHP_VERSION_SHORT}"
        FULL_PATH_TO_BIN="${PATH_TO_BIN}/${EXT_FULL_NAME}"

        if ! [ -f $FULL_PATH_TO_BIN ]; then
            get_err "ext-input-path" $FULL_PATH_TO_BIN
        fi

        printf "Copying ${FULL_PATH_TO_BIN} to the ${EXTENSION_DIR}/${EXT_FULL_NAME}... "

        if sudo cp "$FULL_PATH_TO_BIN" "${EXTENSION_DIR}/${EXT_FULL_NAME}"; then
            get_success
        else
            get_err "cp-ext" "$EXT_FULL_NAME" "$EXTENSION_DIR"
        fi
    done
}

cp_ini() {
    for PID in $PHP_INI_DIR
    do
        printf "Copying ${PATH_TO_BIN}/${INI_FILE_NAME} file to the $PID/${INI_FILE_NAME}... "

        if sudo cp "${PATH_TO_BIN}/${INI_FILE_NAME}" "$PID/${INI_FILE_NAME}"; then
            get_success
        else
            get_err "cp-ini" "${INI_FILE_NAME}" "$PID"
        fi
    done
}

finish() {

    printf "%s\nSTATUS: " "$LOG_DELIMETR"

    case $ERR_LEVEL in
         0)
              printf "Restart your webserver (or php-service if available)\n%s\n" $LOG_DELIMETR
              ;;
         *)
              get_err "$ERR_LEVEL"
    esac
}

get_manually() {
    printf "%s\nPlease try installing the extension manually in accordance with this instruction:\n" $LOG_DELIMETR
    echo '\e]8;;https://github.com/VirgilSecurity/virgil-cryptowrapper-php#additional-information\ahttps://github.com/VirgilSecurity/virgil-cryptowrapper-php#additional-information\e]8;;\a'
    printf "%s\n" $LOG_DELIMETR
}

printf "Сrypto extensions installation...\n%s\n" $LOG_DELIMETR

check_input "$1"

init
get_php_v
get_os
get_package_v
get_ext_dir
get_ini_dir
get_config
cp_ext
cp_ini
finish
