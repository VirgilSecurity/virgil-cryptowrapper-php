<?php
/**
* Copyright (C) 2015-2024 Virgil Security, Inc.
*
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions are
* met:
*
* (1) Redistributions of source code must retain the above copyright
* notice, this list of conditions and the following disclaimer.
*
* (2) Redistributions in binary form must reproduce the above copyright
* notice, this list of conditions and the following disclaimer in
* the documentation and/or other materials provided with the
* distribution.
*
* (3) Neither the name of the copyright holder nor the names of its
* contributors may be used to endorse or promote products derived from
* this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE AUTHOR ''AS IS'' AND ANY EXPRESS OR
* IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
* WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
* DISCLAIMED. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT,
* INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
* (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
* SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
* HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
* STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING
* IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*
* Lead Maintainer: Virgil Security Inc. <support@virgilsecurity.com>
*/

namespace Virgil\CryptoWrapper\Foundation;

use MyCLabs\Enum\Enum;

class OidId extends Enum
{

    private const int NONE = 0;
    private const int RSA = 1;
    private const int ED25519 = 2;
    private const int CURVE25519 = 3;
    private const int SHA224 = 4;
    private const int SHA256 = 5;
    private const int SHA384 = 6;
    private const int SHA512 = 7;
    private const int KDF1 = 8;
    private const int KDF2 = 9;
    private const int AES256_GCM = 10;
    private const int AES256_CBC = 11;
    private const int PKCS5_PBKDF2 = 12;
    private const int PKCS5_PBES2 = 13;
    private const int CMS_DATA = 14;
    private const int CMS_ENVELOPED_DATA = 15;
    private const int HKDF_WITH_SHA256 = 16;
    private const int HKDF_WITH_SHA384 = 17;
    private const int HKDF_WITH_SHA512 = 18;
    private const int HMAC_WITH_SHA224 = 19;
    private const int HMAC_WITH_SHA256 = 20;
    private const int HMAC_WITH_SHA384 = 21;
    private const int HMAC_WITH_SHA512 = 22;
    private const int EC_GENERIC_KEY = 23;
    private const int EC_DOMAIN_SECP256R1 = 24;
    private const int COMPOUND_KEY = 25;
    private const int HYBRID_KEY = 26;
    private const int FALCON = 27;
    private const int ROUND5_ND_1CCA_5D = 28;
    private const int RANDOM_PADDING = 29;
}
