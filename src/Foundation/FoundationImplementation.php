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

use Exception;

class FoundationImplementation
{

    const int AES256_CBC = 1;
    const int AES256_GCM = 2;
    const int ALG_INFO_DER_DESERIALIZER = 3;
    const int ALG_INFO_DER_SERIALIZER = 4;
    const int ASN1RD = 5;
    const int ASN1WR = 6;
    const int CIPHER_ALG_INFO = 7;
    const int COMPOUND_KEY_ALG = 8;
    const int COMPOUND_KEY_ALG_INFO = 9;
    const int COMPOUND_PRIVATE_KEY = 10;
    const int COMPOUND_PUBLIC_KEY = 11;
    const int CTR_DRBG = 12;
    const int CURVE25519 = 13;
    const int ECC = 14;
    const int ECC_ALG_INFO = 15;
    const int ECC_PRIVATE_KEY = 16;
    const int ECC_PUBLIC_KEY = 17;
    const int ED25519 = 18;
    const int ENTROPY_ACCUMULATOR = 19;
    const int FAKE_RANDOM = 20;
    const int FALCON = 21;
    const int HASH_BASED_ALG_INFO = 22;
    const int HKDF = 23;
    const int HMAC = 24;
    const int HYBRID_KEY_ALG = 25;
    const int HYBRID_KEY_ALG_INFO = 26;
    const int HYBRID_PRIVATE_KEY = 27;
    const int HYBRID_PUBLIC_KEY = 28;
    const int KDF1 = 29;
    const int KDF2 = 30;
    const int KEY_ASN1_DESERIALIZER = 31;
    const int KEY_ASN1_SERIALIZER = 32;
    const int KEY_MATERIAL_RNG = 33;
    const int MESSAGE_INFO_DER_SERIALIZER = 34;
    const int PBE_ALG_INFO = 35;
    const int PKCS5_PBES2 = 36;
    const int PKCS5_PBKDF2 = 37;
    const int PKCS8_SERIALIZER = 38;
    const int RANDOM_PADDING = 39;
    const int RAW_PRIVATE_KEY = 40;
    const int RAW_PUBLIC_KEY = 41;
    const int ROUND5 = 42;
    const int RSA = 43;
    const int RSA_PRIVATE_KEY = 44;
    const int RSA_PUBLIC_KEY = 45;
    const int SALTED_KDF_ALG_INFO = 46;
    const int SEC1_SERIALIZER = 47;
    const int SEED_ENTROPY_SOURCE = 48;
    const int SHA224 = 49;
    const int SHA256 = 50;
    const int SHA384 = 51;
    const int SHA512 = 52;
    const int SIMPLE_ALG_INFO = 53;

    /**
    * Wrap C implementation object to the PHP object that implements protocol Cipher.
    *
    * @param $ctx
    * @return Cipher
    * @throws Exception
    */
    public static function wrapCipher($ctx): Cipher
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::AES256_GCM => (new Aes256Gcm($ctx)),
            self::AES256_CBC => (new Aes256Cbc($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol AuthEncrypt.
    *
    * @param $ctx
    * @return AuthEncrypt
    * @throws Exception
    */
    public static function wrapAuthEncrypt($ctx): AuthEncrypt
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::AES256_GCM => (new Aes256Gcm($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol AuthDecrypt.
    *
    * @param $ctx
    * @return AuthDecrypt
    * @throws Exception
    */
    public static function wrapAuthDecrypt($ctx): AuthDecrypt
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::AES256_GCM => (new Aes256Gcm($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol CipherAuth.
    *
    * @param $ctx
    * @return CipherAuth
    * @throws Exception
    */
    public static function wrapCipherAuth($ctx): CipherAuth
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::AES256_GCM => (new Aes256Gcm($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol CipherAuthInfo.
    *
    * @param $ctx
    * @return CipherAuthInfo
    * @throws Exception
    */
    public static function wrapCipherAuthInfo($ctx): CipherAuthInfo
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::AES256_GCM => (new Aes256Gcm($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol CipherInfo.
    *
    * @param $ctx
    * @return CipherInfo
    * @throws Exception
    */
    public static function wrapCipherInfo($ctx): CipherInfo
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::AES256_GCM => (new Aes256Gcm($ctx)),
            self::AES256_CBC => (new Aes256Cbc($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Decrypt.
    *
    * @param $ctx
    * @return Decrypt
    * @throws Exception
    */
    public static function wrapDecrypt($ctx): Decrypt
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::AES256_GCM => (new Aes256Gcm($ctx)),
            self::AES256_CBC => (new Aes256Cbc($ctx)),
            self::PKCS5_PBES2 => (new Pkcs5Pbes2($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Encrypt.
    *
    * @param $ctx
    * @return Encrypt
    * @throws Exception
    */
    public static function wrapEncrypt($ctx): Encrypt
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::AES256_GCM => (new Aes256Gcm($ctx)),
            self::AES256_CBC => (new Aes256Cbc($ctx)),
            self::PKCS5_PBES2 => (new Pkcs5Pbes2($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol SaltedKdf.
    *
    * @param $ctx
    * @return SaltedKdf
    * @throws Exception
    */
    public static function wrapSaltedKdf($ctx): SaltedKdf
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::HKDF => (new Hkdf($ctx)),
            self::PKCS5_PBKDF2 => (new Pkcs5Pbkdf2($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Hash.
    *
    * @param $ctx
    * @return Hash
    * @throws Exception
    */
    public static function wrapHash($ctx): Hash
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::SHA224 => (new Sha224($ctx)),
            self::SHA256 => (new Sha256($ctx)),
            self::SHA384 => (new Sha384($ctx)),
            self::SHA512 => (new Sha512($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Mac.
    *
    * @param $ctx
    * @return Mac
    * @throws Exception
    */
    public static function wrapMac($ctx): Mac
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::HMAC => (new Hmac($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Kdf.
    *
    * @param $ctx
    * @return Kdf
    * @throws Exception
    */
    public static function wrapKdf($ctx): Kdf
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::HKDF => (new Hkdf($ctx)),
            self::KDF1 => (new Kdf1($ctx)),
            self::KDF2 => (new Kdf2($ctx)),
            self::PKCS5_PBKDF2 => (new Pkcs5Pbkdf2($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Random.
    *
    * @param $ctx
    * @return Random
    * @throws Exception
    */
    public static function wrapRandom($ctx): Random
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::CTR_DRBG => (new CtrDrbg($ctx)),
            self::FAKE_RANDOM => (new FakeRandom($ctx)),
            self::KEY_MATERIAL_RNG => (new KeyMaterialRng($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol EntropySource.
    *
    * @param $ctx
    * @return EntropySource
    * @throws Exception
    */
    public static function wrapEntropySource($ctx): EntropySource
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::ENTROPY_ACCUMULATOR => (new EntropyAccumulator($ctx)),
            self::FAKE_RANDOM => (new FakeRandom($ctx)),
            self::SEED_ENTROPY_SOURCE => (new SeedEntropySource($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Key.
    *
    * @param $ctx
    * @return Key
    * @throws Exception
    */
    public static function wrapKey($ctx): Key
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::RSA_PUBLIC_KEY => (new RsaPublicKey($ctx)),
            self::RSA_PRIVATE_KEY => (new RsaPrivateKey($ctx)),
            self::ECC_PUBLIC_KEY => (new EccPublicKey($ctx)),
            self::ECC_PRIVATE_KEY => (new EccPrivateKey($ctx)),
            self::RAW_PUBLIC_KEY => (new RawPublicKey($ctx)),
            self::RAW_PRIVATE_KEY => (new RawPrivateKey($ctx)),
            self::COMPOUND_PUBLIC_KEY => (new CompoundPublicKey($ctx)),
            self::COMPOUND_PRIVATE_KEY => (new CompoundPrivateKey($ctx)),
            self::HYBRID_PUBLIC_KEY => (new HybridPublicKey($ctx)),
            self::HYBRID_PRIVATE_KEY => (new HybridPrivateKey($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol KeyAlg.
    *
    * @param $ctx
    * @return KeyAlg
    * @throws Exception
    */
    public static function wrapKeyAlg($ctx): KeyAlg
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::RSA => (new Rsa($ctx)),
            self::ECC => (new Ecc($ctx)),
            self::ED25519 => (new Ed25519($ctx)),
            self::CURVE25519 => (new Curve25519($ctx)),
            self::FALCON => (new Falcon($ctx)),
            self::ROUND5 => (new Round5($ctx)),
            self::COMPOUND_KEY_ALG => (new CompoundKeyAlg($ctx)),
            self::HYBRID_KEY_ALG => (new HybridKeyAlg($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol PublicKey.
    *
    * @param $ctx
    * @return PublicKey
    * @throws Exception
    */
    public static function wrapPublicKey($ctx): PublicKey
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::RSA_PUBLIC_KEY => (new RsaPublicKey($ctx)),
            self::ECC_PUBLIC_KEY => (new EccPublicKey($ctx)),
            self::RAW_PUBLIC_KEY => (new RawPublicKey($ctx)),
            self::COMPOUND_PUBLIC_KEY => (new CompoundPublicKey($ctx)),
            self::HYBRID_PUBLIC_KEY => (new HybridPublicKey($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol PrivateKey.
    *
    * @param $ctx
    * @return PrivateKey
    * @throws Exception
    */
    public static function wrapPrivateKey($ctx): PrivateKey
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::RSA_PRIVATE_KEY => (new RsaPrivateKey($ctx)),
            self::ECC_PRIVATE_KEY => (new EccPrivateKey($ctx)),
            self::RAW_PRIVATE_KEY => (new RawPrivateKey($ctx)),
            self::COMPOUND_PRIVATE_KEY => (new CompoundPrivateKey($ctx)),
            self::HYBRID_PRIVATE_KEY => (new HybridPrivateKey($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol KeyCipher.
    *
    * @param $ctx
    * @return KeyCipher
    * @throws Exception
    */
    public static function wrapKeyCipher($ctx): KeyCipher
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::RSA => (new Rsa($ctx)),
            self::ECC => (new Ecc($ctx)),
            self::ED25519 => (new Ed25519($ctx)),
            self::CURVE25519 => (new Curve25519($ctx)),
            self::COMPOUND_KEY_ALG => (new CompoundKeyAlg($ctx)),
            self::HYBRID_KEY_ALG => (new HybridKeyAlg($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol KeySigner.
    *
    * @param $ctx
    * @return KeySigner
    * @throws Exception
    */
    public static function wrapKeySigner($ctx): KeySigner
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::RSA => (new Rsa($ctx)),
            self::ECC => (new Ecc($ctx)),
            self::ED25519 => (new Ed25519($ctx)),
            self::FALCON => (new Falcon($ctx)),
            self::COMPOUND_KEY_ALG => (new CompoundKeyAlg($ctx)),
            self::HYBRID_KEY_ALG => (new HybridKeyAlg($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol ComputeSharedKey.
    *
    * @param $ctx
    * @return ComputeSharedKey
    * @throws Exception
    */
    public static function wrapComputeSharedKey($ctx): ComputeSharedKey
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::ECC => (new Ecc($ctx)),
            self::ED25519 => (new Ed25519($ctx)),
            self::CURVE25519 => (new Curve25519($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol KeySerializer.
    *
    * @param $ctx
    * @return KeySerializer
    * @throws Exception
    */
    public static function wrapKeySerializer($ctx): KeySerializer
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::PKCS8_SERIALIZER => (new Pkcs8Serializer($ctx)),
            self::SEC1_SERIALIZER => (new Sec1Serializer($ctx)),
            self::KEY_ASN1_SERIALIZER => (new KeyAsn1Serializer($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol KeyDeserializer.
    *
    * @param $ctx
    * @return KeyDeserializer
    * @throws Exception
    */
    public static function wrapKeyDeserializer($ctx): KeyDeserializer
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::KEY_ASN1_DESERIALIZER => (new KeyAsn1Deserializer($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Asn1Reader.
    *
    * @param $ctx
    * @return Asn1Reader
    * @throws Exception
    */
    public static function wrapAsn1Reader($ctx): Asn1Reader
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::ASN1RD => (new Asn1rd($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Asn1Writer.
    *
    * @param $ctx
    * @return Asn1Writer
    * @throws Exception
    */
    public static function wrapAsn1Writer($ctx): Asn1Writer
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::ASN1WR => (new Asn1wr($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Alg.
    *
    * @param $ctx
    * @return Alg
    * @throws Exception
    */
    public static function wrapAlg($ctx): Alg
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::SHA224 => (new Sha224($ctx)),
            self::SHA256 => (new Sha256($ctx)),
            self::SHA384 => (new Sha384($ctx)),
            self::SHA512 => (new Sha512($ctx)),
            self::AES256_GCM => (new Aes256Gcm($ctx)),
            self::AES256_CBC => (new Aes256Cbc($ctx)),
            self::HMAC => (new Hmac($ctx)),
            self::HKDF => (new Hkdf($ctx)),
            self::KDF1 => (new Kdf1($ctx)),
            self::KDF2 => (new Kdf2($ctx)),
            self::PKCS5_PBKDF2 => (new Pkcs5Pbkdf2($ctx)),
            self::PKCS5_PBES2 => (new Pkcs5Pbes2($ctx)),
            self::FALCON => (new Falcon($ctx)),
            self::COMPOUND_KEY_ALG => (new CompoundKeyAlg($ctx)),
            self::RANDOM_PADDING => (new RandomPadding($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol AlgInfo.
    *
    * @param $ctx
    * @return AlgInfo
    * @throws Exception
    */
    public static function wrapAlgInfo($ctx): AlgInfo
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::COMPOUND_KEY_ALG_INFO => (new CompoundKeyAlgInfo($ctx)),
            self::HYBRID_KEY_ALG_INFO => (new HybridKeyAlgInfo($ctx)),
            self::SIMPLE_ALG_INFO => (new SimpleAlgInfo($ctx)),
            self::HASH_BASED_ALG_INFO => (new HashBasedAlgInfo($ctx)),
            self::CIPHER_ALG_INFO => (new CipherAlgInfo($ctx)),
            self::SALTED_KDF_ALG_INFO => (new SaltedKdfAlgInfo($ctx)),
            self::PBE_ALG_INFO => (new PbeAlgInfo($ctx)),
            self::ECC_ALG_INFO => (new EccAlgInfo($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol AlgInfoSerializer.
    *
    * @param $ctx
    * @return AlgInfoSerializer
    * @throws Exception
    */
    public static function wrapAlgInfoSerializer($ctx): AlgInfoSerializer
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::ALG_INFO_DER_SERIALIZER => (new AlgInfoDerSerializer($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol AlgInfoDeserializer.
    *
    * @param $ctx
    * @return AlgInfoDeserializer
    * @throws Exception
    */
    public static function wrapAlgInfoDeserializer($ctx): AlgInfoDeserializer
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::ALG_INFO_DER_DESERIALIZER => (new AlgInfoDerDeserializer($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol MessageInfoSerializer.
    *
    * @param $ctx
    * @return MessageInfoSerializer
    * @throws Exception
    */
    public static function wrapMessageInfoSerializer($ctx): MessageInfoSerializer
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::MESSAGE_INFO_DER_SERIALIZER => (new MessageInfoDerSerializer($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol MessageInfoFooterSerializer.
    *
    * @param $ctx
    * @return MessageInfoFooterSerializer
    * @throws Exception
    */
    public static function wrapMessageInfoFooterSerializer($ctx): MessageInfoFooterSerializer
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::MESSAGE_INFO_DER_SERIALIZER => (new MessageInfoDerSerializer($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Padding.
    *
    * @param $ctx
    * @return Padding
    * @throws Exception
    */
    public static function wrapPadding($ctx): Padding
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::RANDOM_PADDING => (new RandomPadding($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }

    /**
    * Wrap C implementation object to the PHP object that implements protocol Kem.
    *
    * @param $ctx
    * @return Kem
    * @throws Exception
    */
    public static function wrapKem($ctx): Kem
    {
        $implTag = vscf_impl_tag_php($ctx);

        return match ($implTag) {
            self::ECC => (new Ecc($ctx)),
            self::ED25519 => (new Ed25519($ctx)),
            self::CURVE25519 => (new Curve25519($ctx)),
            self::ROUND5 => (new Round5($ctx)),
            default => throw new Exception("Unexpected C implementation cast to the PHP implementation."),
        };
    }
}
