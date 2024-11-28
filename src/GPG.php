<?php

declare(strict_types=1);

namespace PharIo\GnuPG;

interface GPG
{
    /**
     * @param string $keyData raw key data
     *
     * @throws InvalidHomeDirectory
     * @throws InvalidKey
     */
    public function importPublicKey(string $keyData): PublicKey;

    /**
     *
     * @since 2.1 this method can be added later because phive is no just using the verify logic
     * @param string $keyData raw key data
     *
     * @throws InvalidHomeDirectory
     * @throws InvalidKey
     */
    public function importSecretKey(string $keyData, ?string $passphrase = null): SecretKey;

    /**
     * Verifies the message is signed with the sigature
     *
     */
    public function verify(string $message, SignatureData $signature): Signature;

    /**
     * Uses the secret to create a signature.
     *
     * @since 2.1 this method can be added later because phive is no just using the verify logic
     * @return Signature
     */
    public function sign(SecretKey $privateKey, string $message): Signature;
}
