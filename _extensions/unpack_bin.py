#!/usr/bin/python3

#   Copyright (C) 2015-2021 Virgil Security, Inc.
#
#   All rights reserved.
#
#   Redistribution and use in source and binary forms, with or without
#   modification, are permitted provided that the following conditions are
#   met:
#
#       (1) Redistributions of source code must retain the above copyright
#       notice, this list of conditions and the following disclaimer.
#
#       (2) Redistributions in binary form must reproduce the above copyright
#       notice, this list of conditions and the following disclaimer in
#       the documentation and/or other materials provided with the
#       distribution.
#
#       (3) Neither the name of the copyright holder nor the names of its
#       contributors may be used to endorse or promote products derived from
#       this software without specific prior written permission.
#
#   THIS SOFTWARE IS PROVIDED BY THE AUTHOR ''AS IS'' AND ANY EXPRESS OR
#   IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
#   WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
#   DISCLAIMED. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT,
#   INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
#   (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
#   SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
#   HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
#   STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING
#   IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
#   POSSIBILITY OF SUCH DAMAGE.
#
#   Lead Maintainer: Virgil Security Inc. <support@virgilsecurity.com>

import sys
import os
import re
import shutil
import tempfile

def print_usage():
    print("USAGE:")
    print("    python3", sys.argv[0], " <PREBUILD_DIR>")
    print("")
    print("ARGS:")
    print("    <PREBUILD_DIR> - path to the pre-build PHP wrappers of the virgil-crypto-c libraries.")

def error(errorMessage):
    print(errorMessage, file=sys.stderr)
    print_usage()
    exit(1)


def extractArchive(srcFile, destDir):
    print()

    #
    #   Parse archive name.
    #
    _, filename = os.path.split(srcFile)
    filenameRegex = re.compile('([a-zA-Z0-9-.]+php-([0-9]+[.][0-9]+)-([a-zA-Z]+)-([0-9]+[.][0-9]+)-([a-zA-Z0-9_]+))')
    filenameMatch = filenameRegex.search(filename)

    if not filenameMatch:
        print("Unexpected file name! Skip.")
        return

    srcName = filenameMatch.groups()[0]
    phpVersion = filenameMatch.groups()[1]
    osName = filenameMatch.groups()[2]
    osVersion = filenameMatch.groups()[3]
    osArch = filenameMatch.groups()[4]

    #
    #   Extract archive.
    #
    destArchiveRoot = os.path.join(destDir, osName + "_" + osArch)
    destArchiveDir = os.path.join(destArchiveRoot, "php" + phpVersion)
    print("Extracting:", srcFile)
    print("    to:", destArchiveDir)

    if not os.path.exists(destArchiveRoot):
        os.makedirs(destArchiveRoot)

    #
    #   Extract archive to the temporary folder.
    #
    tempArchDir = tempfile.TemporaryDirectory()
    shutil.unpack_archive(srcFile, tempArchDir.name)

    #
    #   Move extracted directory to the destination directory.
    #
    if os.path.isdir(destArchiveDir):
        shutil.rmtree(destArchiveDir)

    extractedLibDir = os.path.join(tempArchDir.name, srcName, "lib")

    os.rename(extractedLibDir, destArchiveDir)

    tempArchDir.cleanup()

    return destArchiveDir

def main():
    #
    #   Parse arguments.
    #
    scriptDir = os.path.dirname(os.path.realpath(__file__))
    binDir = os.path.join(scriptDir, "bin")
    iniFileName = "virgil_crypto.ini"
    iniFile = os.path.join(scriptDir, iniFileName)

    if len(sys.argv) < 2:
        error("A directory with binaries was not provided.")

    prebuildPath = os.path.realpath(sys.argv[1])

    if not os.path.isdir(prebuildPath):
        error("Provided directory with binaries is not exists:", prebuildPath)

    #
    #   Unpack archives and copy binaries.
    #
    for (dirpath, dirnames, filenames) in os.walk(prebuildPath):
        for filename in filenames:
            destArchiveDir = extractArchive(os.path.join(dirpath, filename), binDir)
            shutil.copyfile(iniFile, os.path.join(destArchiveDir, iniFileName))

if __name__ == "__main__":
    main()

