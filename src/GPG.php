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
    public function importSecretKey(string $keyData): SecretKey;

    /**
     * Verifies the message is signed with the sigature
     *
     * Ensures that the signature is valid.
     *
     * @throws VerificiationFailed When message was not signed with the signature
     * @throws UnknownFingerPrint When signature doesn't belong to a known key, key must be imported first
     */
    public function verify(string $message, Signature $signature): KeyInfo;

    /**
     * Uses the secret to create a signature.
     *
     * @since 2.1 this method can be added later because phive is no just using the verify logic
     * @return Signature
     */
    public function sign(SecretKey $privateKey, string $message): Signature;
}
